<?php

// error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

print_r($_POST);

// mysql information
$cxn = mysqli_connect("warehouse", "sas1030", "ub357uak", "sas1030_assignment_7");

$username = $_POST['username'];
$pin = $_POST['pin'];
$attending = $_POST['attending'];
$eventID = $_POST['event_id'];

$login_query = "SELECT user_id FROM users WHERE user_username=\"{$username}\" AND user_pin=\"{$pin}\"";
$login_result = $cxn->query($login_query);
$login_row = mysqli_fetch_array($login_result);

if (!empty($login_row))
{
	$guest_list_query = "SELECT * FROM guest_list WHERE user_id={$login_row['user_id']} AND event_id={$eventID}";
	$guest_list_result = $cxn->query($guest_list_query);
	$guest_list_row = mysqli_fetch_array($guest_list_result);
	if (!empty($guest_list_row))
	{
		if ($attending == "on")
		{
			$rsvp_update_query = "UPDATE guest_list SET is_user_going_to_event=1 WHERE user_id={$login_row['user_id']} AND event_id={$eventID}";
		}
		else
		{
			$rsvp_update_query = "UPDATE guest_list SET is_user_going_to_event=0 WHERE user_id={$login_row['user_id']} AND event_id={$eventID}";
		}
		$rsvp_update_result = $cxn->query($rsvp_update_query);
	}
	else
	{
		if ($attending == "on")
		{
			$rsvp_create_query = "INSERT INTO guest_list (event_id, user_id, is_user_going_to_event) VALUES({$eventID}, {$login_row['user_id']}, 1)";
		}
		else
		{
			$rsvp_create_query = "INSERT INTO guest_list (event_id, user_id, is_user_going_to_event) VALUES({$eventID}, {$login_row['user_id']}, 0)";
		}
	}
	header("Location:event.php?event_id={$eventID}");
}
else
{
	header("Location:rsvp.php");
}

?>