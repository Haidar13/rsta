<?php
// error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

// mysql information
$cxn = mysqli_connect("warehouse", "sas1030", "ub357uak", "sas1030_assignment_7");

// tables information for reference:
// events: event_id, event_name, event_date, event_location, event_host_id, event_description, event_price, event_age_restriction, event_image_id
// users: user_id, user_username, user_fullname, user_pin, user_age, user_bio, user_pic, user_twitter, user_facebook
// images: image_id, image_address
// guest_list: response_id, event_id, user_id, is_user_going_to_event
// locations: loc_id, street, city, state, zip

$get_all_events_query = "SELECT * FROM events";
$all_events_result = $cxn->query($get_all_events_query);
$all_events = mysqli_fetch_array($all_events_result);

$userId = $_GET['user_id'];

$get_user_query = "SELECT * FROM users WHERE user_id={$userId}";
$get_user = $cxn->query($get_user_query);
$the_user = mysqli_fetch_array($get_user);

$get_image_query = "SELECT * FROM images WHERE image_id={$the_user['user_pic']}";
$get_images_result = $cxn->query($get_image_query);
$images = mysqli_fetch_array($get_images_result);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta author="Sergey Smirnov">
	<title><?php echo $the_user['user_fullname']; ?> :: rsta</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="css/main.css">
</head>

<body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a href="index.php">rsta</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="../index.html">Sergey's CSCI-UA 60 Home</a></li>
                <li><a href="create_event.php">Create an event</a></li>
            </ul>
        </div>
    </nav>

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <a href="index.php"><img class="logo" src="images/logo.png" /></a>
            <div class="row center">
                <h5 class="header col s12 light">materialize your attendance</h5>
            </div>
        </div>
    </div>

    <div class="container">
    	<div class="section">
            <div class="card-panel medium card-content">
                <?php if ($the_user['user_pic'] == 0): ?>
                    <img src="img/users/default.png" class="user" />
                <?php else: ?>
                    <img src="<?php echo $images['image_address']; ?>" class="user" />
                <?php endif; ?>
                <h3><?php echo $the_user['user_fullname']; ?></h3>
                <h4>AKA "<?php echo $the_user['user_username']; ?>"</h4>
                <h4><?php echo $the_user['user_age']; ?> years old</h4>
                <?php if ($the_user['user_facebook'] != 'null'): ?>
                    <h4><a href="https://www.facebook.com/<?php echo $the_user['user_facebook']; ?>">Facebook profile</a></h4>
                <?php endif; ?>
                <?php if ($the_user['user_twitter'] != 'null'): ?>
                    <h4><a href="http://twitter.com/<?php echo $the_user['user_twitter']; ?>">@<?php echo $the_user['user_twitter']; ?></a></h4>
                <?php endif; ?>
                <h5>Bio:</h5>
                <p><?php echo $the_user['user_bio']; ?></p>
            </div>

            <div class="card-panel large card-content">
                <h3>Events hosted by you</h3>
                <?php
                    $events_created_by_user_query = "SELECT * FROM events WHERE event_host_id={$the_user['user_id']}";
                    $events_created_by_user_result = $cxn->query($events_created_by_user_query);
                    $events_created_by_user = mysqli_fetch_array($events_created_by_user_result);
                ?>
                <?php if (empty($events_created_by_user)): ?>
                    <h5>No events have been created by you! Why don't you <a href="create_event.php">create one</a>?</h5>
                <?php else: ?>
                    <ul>
                        <li><h5><a href="event.php?event_id=<?php echo $events_created_by_user['event_id']; ?>"><?php echo $events_created_by_user['event_name']; ?></a></h5></li>
                    <?php // loop through the rest of the events
                        while ($events_created_by_user = mysqli_fetch_array($events_created_by_user_result))
                        {
                            echo "<li><h5><a href=\"event.php?event_id=" . $events_created_by_user['event_id'] . "\">" . $events_created_by_user['event_name'] . "</a></h5></li>";
                        }
                    ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card-panel large card-content">
                <h3>Events you attended</h3>
                <?php
                    $events_attended_by_user_query = "SELECT * FROM guest_list INNER JOIN events USING (event_id) WHERE user_id={$the_user['user_id']} AND is_user_going_to_event=1";
                    $events_attended_by_user_result = $cxn->query($events_attended_by_user_query);
                    $events_attended_by_user = mysqli_fetch_array($events_attended_by_user_result);
                ?>
                <?php if (empty($events_attended_by_user)): ?>
                    <h5>Looks like you haven't attended anything yet!</h5>
                <?php else: ?>
                    <ul>
                        <li><h5><a href="event.php?event_id=<?php echo $events_attended_by_user['event_id']; ?>"><?php echo $events_attended_by_user['event_name']; ?></a></h5></li>
                    <?php // loop through the rest of the events
                        while ($events_attended_by_user = mysqli_fetch_array($events_attended_by_user_result))
                        {
                            echo "<li><h5><a href=\"event.php?event_id=" . $events_attended_by_user['event_id'] . "\">" . $events_attended_by_user['event_name'] . "</a></h5></li>";
                        }
                    ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="card-panel large card-content">
                <h3>Events you declined</h3>
                <?php
                    $events_declined_by_user_query = "SELECT * FROM guest_list INNER JOIN events USING (event_id) WHERE user_id={$the_user['user_id']} AND is_user_going_to_event=0";
                    $events_declined_by_user_result = $cxn->query($events_declined_by_user_query);
                    $events_declined_by_user = mysqli_fetch_array($events_declined_by_user_result);
                ?>
                <?php if (empty($events_declined_by_user)): ?>
                    <h5>Looks like you haven't declined any events yet. Good for you!</h5>
                <?php else: ?>
                    <ul>
                        <li><h5><a href="event.php?event_id=<?php echo $events_declined_by_user['event_id']; ?>"><?php echo $events_declined_by_user['event_name']; ?></a></h5></li>
                    <?php // loop through the rest of the events
                        while ($events_declined_by_user = mysqli_fetch_array($events_declined_by_user_result))
                        {
                            echo "<li><h5><a href=\"event.php?event_id=" . $events_declined_by_user['event_id'] . "\">" . $events_declined_by_user['event_name'] . "</a></h5></li>";
                        }
                    ?>
                    </ul>
                <?php endif; ?>
            </div>
    		
    	</div>
    </div>

    <footer class="page-footer blue">
    	<div class="container">
    		<div class="row">
    			<div class="col l6 s12">
    				<h5 class="white-text">rsta</h5>
    				<p class="grey-text text-lighten-4">Pronounced like "Rosetta," as in Rosetta Stone. This has no relation to language learning whatsoever.</p>
    			</div>
				<div class="col l3 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="white-text" href="login.php">Login</a></li>
						<li><a class="white-text" href="../index.html">Sergey's CSCI-UA 60 page</a></li>
						<li><a class="white-text" href="http://cs.nyu.edu/~amos/courses/database_design/index.php/Lamp_App_Assignment_continued">Assignment specs</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>

</body>

</html>