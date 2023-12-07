<?php

include('../dbconn.php');

// Check if "token" key is set in the $_POST array
$token = isset($_POST["token"]) ? htmlspecialchars($_POST["token"]) : null;

if (empty($token)) {
    die("Token not found");
}

// Remove hashing the token here
// $token_hash = hash("sha256", $token);

// Include the database connection
// $conn = require __DIR__ . "/dbconn.php";

$sql = "SELECT * FROM users
        WHERE verify_token = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("s", $token);

if (!$stmt->execute()) {
    die("Error executing the query: " . $stmt->error);
}

$result = $stmt->get_result();

// Debugging: Output SQL query, token, and fetched token value for inspection
// echo "SQL Query: $sql, Token: $token, Fetched Token: ";
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // echo $user['verify_token'];
    
    // Check if the token has expired
    if (strtotime($user["created_at"]) <= time()) {
        die("Token has expired");
    }
} else {
    die("Token not found or invalid");
}

// Check if the keys are set before using them
if (!isset($_POST["new_password"]) || !isset($_POST["password_confirmation"])) {
    die("New password or password confirmation not provided");
}

if ($_POST["new_password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// Directly use the plain text password from the form
$new_password = $_POST["new_password"];

$sql = "UPDATE users
        SET password = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("ss", $new_password, $user["id"]);

if ($stmt->execute()) {
    echo "Password updated. You can now login. <a href='http://localhost:3000/loginpage/index.php'>Click here to redirect</a>";
    // Redirect the user to the main page after a delay
    header("refresh:5;url=http://localhost:3000/loginpage/index.php");
} else {
    die("Error updating the password: " . $stmt->error);
}

?>
