<?php

require '../app/models/Model.php';

$env = parse_ini_file('../.env');

if (!$env) {
    die("Error loading .env file.");
}

// Define constants for the first database (portfolio)
define('DB1NAME', $env['DB1NAME']);
define('DB1HOST', $env['DB1HOST']);
define('DB1PORT', $env['DB1PORT']);
define('DB1USER', $env['DB1USER']);
define('DB1PASS', $env['DB1PASS']);

// Define constants for the second database (contact messages)
define('DB2NAME', $env['DB2NAME']);
define('DB2HOST', $env['DB2HOST']);
define('DB2PORT', $env['DB2PORT']);
define('DB2USER', $env['DB2USER']);
define('DB2PASS', $env['DB2PASS']);

// Define constants for the second database (website users)
define('DB3NAME', $env['DB3NAME']);
define('DB3HOST', $env['DB3HOST']);
define('DB3PORT', $env['DB3PORT']);
define('DB3USER', $env['DB3USER']);
define('DB3PASS', $env['DB3PASS']);

define('DEBUG', true);
