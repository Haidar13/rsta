<?php

// error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

//print_r($_POST);

// mysql information
$cxn = mysqli_connect("warehouse", "sas1030", "ub357uak", "sas1030_assignment_7");

$username = $_POST['username'];
$pin = $_POST['pin'];

$login_query = "SELECT user_id FROM users WHERE user_username=\"{$username}\" AND user_pin=\"{$pin}\"";
$login_result = $cxn->query($login_query);
$login_row = mysqli_fetch_array($login_result);

if (!empty($login_row))
{
	header("Location:user.php?user_id={$login_row['user_id']}");
}
else
{
	header("Location:login.php");
}

?>