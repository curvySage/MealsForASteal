<?php

# What is the name of this app?
define('APP_NAME', 'Meals for a Steal');

# When email is sent out from the server, where should it come from?
# Ideally, this should match the domain name
//define('APP_EMAIL', 'webmaster@sample-app.com');

/*
A email designated to receive messages from the server. Examples:
 	* When there's a MySQL error on the live server it will send it to this email
 	* If you're BCCing yourself on outgoing emails you may want them to go there
 	* Logs, cron results, errors, etc.

 	Some might want this to be the same as the APP_EMAIL, others might want to create a designated gmail address for it
*/
//define('SYSTEM_EMAIL', 'webmaster@myapp.com');

# Default DB name for this app
define('DB_NAME', 'group_c');

# Timezone
define('TIMEZONE', 'America/Los_Angeles');


# For extra security, you might want to set different salts than what the core uses
define('PASSWORD_SALT', 'asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad');
define('TOKEN_SALT', 'ajksdnkabfeiywbfiasnjdasodnibeafodasajsndkjasndkhanskdjaskndjasknsadasd');
