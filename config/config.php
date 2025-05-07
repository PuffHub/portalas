<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'funkcinis_puslapis');
define('DB_USER', 'root');
define('DB_PASS', '');

// Set timezone
date_default_timezone_set('Europe/Vilnius');

// Error reporting (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
?>
