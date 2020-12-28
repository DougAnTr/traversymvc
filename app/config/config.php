<?php
//DB Params
define('DB_HOST', getenv('DB_HOST'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));

// App Root
define('APP_ROOT', dirname(dirname(__FILE__)));

// Base URL
define('BASE_URL', getenv('BASE_URL'));

// Site Name
define('SITE_NAME', 'TraversyMVC');
