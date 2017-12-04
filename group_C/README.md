# Meals for a Steal (CIS 444)

When using Scout/Scss, select the following for environment:

 * Production (removes comments in css file)
 * Expanded (makes the css easier to read)

When using MAMP or similar Apache Server Application (LAMP, WAMP), consider the following:

 * environment.php contains access to db -- this is different between your local machine and where we are deploying it.
 * Use php version 7.1.8 (same version on deployment environment)
 * Point document root to project folder
 
Once server is setup, initialize your database
 * phpMyAdmin is useful for quickly looking at your local database
 * run the database.sql migragation, which also has some prefilled data
