<?php
session_start();
include 'dbconn.php';

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=Username and password are required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email='$uname' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] === $uname && $row['password'] === $pass) {
            // Login successful, set session variables
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect username or password");
            exit();
        }
    } else {
        header("Location: index.php?error=Incorrect username or password");
        exit();
    }
} else {
    header("Location: index.php");
}
?>
