use sas1030_assignment_7;

LOAD DATA LOCAL INFILE 'locations.txt' INTO TABLE locations; # insert actual addresses
LOAD DATA LOCAL INFILE 'images.txt' INTO TABLE images;
LOAD DATA LOCAL INFILE 'users.txt' INTO TABLE users; # insert dummy user data
LOAD DATA LOCAL INFILE 'events.txt' INTO TABLE events; # insert events
LOAD DATA LOCAL INFILE 'guests.txt' INTO TABLE guest_list;