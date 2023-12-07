<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "studentpro";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



