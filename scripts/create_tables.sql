use sas1030_assignment_7;

CREATE TABLE events (
    event_id INT(4) NOT NULL AUTO_INCREMENT,
    event_name VARCHAR(255) NOT NULL,
    event_date DATETIME NOT NULL,
    event_location INT(4) NOT NULL,
    event_host_id INT(4) NOT NULL,
    event_description TEXT(65500),
    event_price INT(4),
    event_age_restriction INT(2),
    event_image_id INT(6) NOT NULL,
    PRIMARY KEY (event_id)
);

CREATE TABLE users (
    user_id INT(4) NOT NULL AUTO_INCREMENT,
    user_username VARCHAR(32) NOT NULL,
    user_fullname VARCHAR(64) NOT NULL,
    user_pin INT(4) NOT NULL,
    user_age INT(3) NOT NULL,
    user_bio TEXT(65500),
    user_pic INT(6),
    user_twitter VARCHAR(32),
    user_facebook VARCHAR(32),
    PRIMARY KEY (user_id)
);

CREATE TABLE images (
    image_id INT(6) NOT NULL AUTO_INCREMENT,
    image_address VARCHAR(255) NOT NULL,
    PRIMARY KEY (image_id)
);

CREATE TABLE guest_list (
    response_id INT(6) NOT NULL AUTO_INCREMENT,
    event_id INT(4) NOT NULL,
    user_id INT(4) NOT NULL,
    is_user_going_to_event TINYINT(1) NOT NULL,
    PRIMARY KEY (response_id)
);

CREATE TABLE locations (
    loc_id INT(4) NOT NULL AUTO_INCREMENT,
    street VARCHAR(64) NOT NULL,
    city VARCHAR(64) NOT NULL,
    state VARCHAR(2) NOT NULL,
    zip INT(5) NOT NULL,
    PRIMARY KEY (loc_id)
);