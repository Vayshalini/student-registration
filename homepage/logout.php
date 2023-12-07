<?php
include "../dbconn.php";
include "../loginpage/logging.php"; // Include the logging file

session_start();

// Get user information before unsetting the session
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";

logger("$userName has concluded the session and logged out.");

// Unset the session data
unset($_SESSION['email']);
unset($_SESSION['name']);

header("Location: ../loginpage/login.php");
exit(); // Make sure to exit after setting the header
