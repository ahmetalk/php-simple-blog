<?php
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect the user to the login page (you can change the URL)
header("Location: login.php");
exit();
?>
