<?php
session_start();
include "../dbconn.php";
include "logging.php";


if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email) && empty($pass)) {
        header("Location: index.php?error=Login Failed");
        exit();
    } elseif (empty($email)) {      
        header("Location: index.php?error=Email is required");
        exit();
    } elseif (empty($pass)) {    
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT id, email, name, password FROM users WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $pass) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];

                // Log successful login
                logger("Successful login by {$row['name']}");

                header("Location: ../homepage/home.php");
                exit();
            } else {
                logger("Login Failed - Incorrect email or password entered by someone");
                header("Location: index.php?error=Retype email and password");
                exit();
            }
        } else {
            logger("Login Failed - Unauthrized email or password entered by someone");
            header("Location: index.php?error=Retype email and password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>
