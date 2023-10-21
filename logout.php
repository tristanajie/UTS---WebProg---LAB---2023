<?php
// Start or resume the existing session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other page
header("Location: loginlol_out.php"); // Change 'login.php' to your actual login page
exit;
?>
