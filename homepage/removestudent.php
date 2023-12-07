<?php
include('../dbconn.php');
include "../loginpage/logging.php"; // Include the logging file

session_start();
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM students WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if(!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        logger("$userName DELETED A STUDENT ENTRY.");
        header("Location: deletetudent.php?delete_msg=Data Successfully Removed");
        exit(); // Ensure that the script exits after a successful update
    }
}
?>
