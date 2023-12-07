<?php
include('../dbconn.php');

if(isset($_POST['registeruser'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirmpassword)) {
        header("Location: register.php?error=Required fields cannot be empty.");
        exit();
    } elseif ($password !== $confirmpassword) {
        header("Location: register.php?error=Passwords do not match.");
        exit();
    } else {
        // Check the maximum length of the 'password' field in your database and adjust it accordingly
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            // Make sure the 'password' column in your database can store plain text passwords
            $stmt->bind_param("sss", $name, $email, $password);
        
            if ($stmt->execute()) {
                header("Location: index.php?successmsg=Account creation successful!");
                exit();
            } else {
                echo "Error executing query: " . $stmt->error;
            }
        
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}
?>
