<?php

# We're on the local environment so toggle IN_PRODUCTION off
define('IN_PRODUCTION', FALSE);

# Always display errors on local environment
define('DISPLAY_ERRORS', TRUE);

# To avoid accidentally sending a mass amount of emails to your users when testing, always disable outgoing emails on your local environment
define('ENABLE_OUTGOING_EMAIL', FALSE);

# Toggle this based on whether you want to connect to your local DB or your live DB
define('REMOTE_DB', FALSE);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');