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
	<title>rsta :: login</title>
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
            <div class="card-panel small card-content">
            <form method="POST" action="process_login.php" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                    <input name="username" type="text">
                    <label>Username: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                    <label>Four-digit PIN: </label>
                    <input name="pin" type="password">
                    </div>
                </div>
                <button class="btn-large waves-effect waves-light blue" type="submit" name="action">Login</button>
            </form>
            </div>

            <div class="card-panel small card-content">
                <h3>Demo logins:</h3>
                <h5>Username: sergey</h5>
                <h5>PIN: 1234</h5><br />
                <h5>Username: david</h5>
                <h5>PIN: 4321</h5><br />
                <h5>Username: roni</h5>
                <h5>PIN: 0000</h5><br />
                <h5>Username: wellschan</h5>
                <h5>PIN: 4325</h5><br />
                <h5>Username: zuck</h5>
                <h5>PIN: 9430</h5><br />
                <h5>Username: richard</h5>
                <h5>PIN: 7235</h5><br />
                <h5>Username: erlich</h5>
                <h5>PIN: 0001</h5><br />
                <h5>Username: jared</h5>
                <h5>PIN: 0002</h5><br />
                <h5>Username: dinesh</h5>
                <h5>PIN: 0003</h5><br />
                <h5>Username: gilfoyle</h5>
                <h5>PIN: 6666</h5><br />
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