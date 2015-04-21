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

$eventId = $_GET['event_id'];

$get_event_query = "SELECT * FROM events WHERE event_id={$eventId}";
$get_event = $cxn->query($get_event_query);
$the_event = mysqli_fetch_array($get_event);

$get_image_query = "SELECT * FROM images WHERE image_id={$the_event['event_image_id']}";
$get_images_result = $cxn->query($get_image_query);
$images = mysqli_fetch_array($get_images_result);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta author="Sergey Smirnov">
	<title><?php echo $the_event['event_name']; ?> :: rsta</title>
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
            <h1 class="header center blue-text"><?php echo $the_event['event_name']; ?></h1>
            <?php if ($the_event['event_image_id'] != 0): ?>
                    <img src="<?php echo $images['image_address']; ?>" class="event" />
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
    	<div class="section">
            <div class="card-panel medium card-content">
                <h3>What</h3>
                <h5><?php echo $the_event['event_name']; ?></h5>
                <p><?php echo $the_event['event_description']; ?></p><br />
                <h3>Where</h3>
                <?php
                    $location_query = "SELECT * FROM locations WHERE loc_id={$the_event['event_location']}";
                    $location_result = $cxn->query($location_query);
                    $location = mysqli_fetch_array($location_result);
                ?>
                <h5><?php echo $location['street']; ?><br /><?php echo $location['city'] . ", " . $location['state'] . " " . $location['zip']; ?></h5><br />
                <h3>When</h3>
                <?php
                    $date_query = "SELECT DATE_FORMAT(event_date, '%W, %e %M %Y, %T') AS 'date' FROM events WHERE event_id={$the_event['event_id']}";
                    $date_result = $cxn->query($date_query);
                    $the_date = mysqli_fetch_array($date_result);
                ?>
                <h5><?php echo $the_date['date']; ?></h5></br />
                <h3>Who</h3>
                <?php
                    $host_query = "SELECT * FROM users WHERE user_id={$the_event['event_host_id']}";
                    $host_result = $cxn->query($host_query);
                    $host = mysqli_fetch_array($host_result);
                ?>
                <h5>Host: <a href="user.php?user_id=<?php echo $host['user_id']; ?>"><?php echo $host['user_fullname']; ?></a></h5>
                <h5>Guests coming:</h5>
                <?php
                    $guest_list_query = "SELECT * FROM guest_list INNER JOIN users USING (user_id) WHERE event_id={$the_event['event_id']} AND is_user_going_to_event=1";
                    $guest_list_result = $cxn->query($guest_list_query);
                    $full_guest_list = mysqli_fetch_array($guest_list_result);
                ?>
                <?php if (empty($full_guest_list)): ?>
                    <p>Nobody is coming to the event :(</p>
                <?php else: ?>
                    <ul>
                        <li><a href="user.php?user_id=<?php echo $full_guest_list['user_id']; ?>"><?php echo $full_guest_list['user_fullname']; ?></a></li>
                        <?php while ($full_guest_list = mysqli_fetch_array($guest_list_result)): ?>
                            <li><a href="user.php?user_id=<?php echo $full_guest_list['user_id']; ?>"><?php echo $full_guest_list['user_fullname']; ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <br />
                <form method="post" action="rsvp.php">
                <input type="hidden" name="event_id" value="<?php echo $the_event['event_id']; ?>">
                <button class="btn-large waves-effect waves-light blue" type="submit" name="action">RSVP to this event!</button>
                </form>
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