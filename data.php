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

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta author="Sergey Smirnov">
	<title>rsta :: main</title>
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
    </div><br />

    <div class="container">
    <form method="POST" action="process_data.php" class="col s12">
        <label>Choose an option to see data</label>
        <select class="browser-default" name="sort_method">
            <option value="" disabled>Choose an option...</option>
            <option value="1">See events sorted by date</option>
            <option value="2">See events sorted by alphabetically</option>
            <option value="3">See events sorted by event ID</option>
        </select><br />
    	<div class="row center">
            <button class="btn-large waves-effect waves-light green" type="submit" name="action">Click on this obnoxiously large button to see the data</button>
        </div>
    </div>
    <br />

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