<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start the session only if it's not already started
    session_start();
}

if (!isset($_SESSION['userid'])) {
    header("location: login.php");
    exit(); // Add exit to stop script execution after redirection
}
?>