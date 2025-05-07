<?php
require_once '../classes/Auth.php';
session_start();

// Log out the user (destroy session)
Auth::logout();

// Delete cookies if set
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600, '/'); // Set the cookie expiration to 1 hour ago
}

if (isset($_COOKIE['password'])) {
    setcookie('password', '', time() - 3600, '/'); // Set the cookie expiration to 1 hour ago
}

// Redirect to login page
header("Location: index.php");
exit;
?>
