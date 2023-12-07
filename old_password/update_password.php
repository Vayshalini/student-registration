<?php


$token = $_POST["token"];
$token_hash = hash("sha256", $token);

$conn = require __DIR__ . "/dbconn.php";

$sql = "SELECT * FROM users
        WHERE verify_token = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

if (strtotime($user["created_at"]) <= time()) {
    die("Token has expired");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// Instead of hashing the password, store the plain text password in the database.
// You should also consider using prepared statements here for security.

$sql = "UPDATE users
        SET password = ?,
            verify_token = NULL,
            created_at = NULL
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error in preparing the SQL statement: " . $conn->error);
}

$stmt->bind_param("ss", $_POST['password'], $user["id"]);

if ($stmt->execute()) {
    echo "Password updated. You can now login.";
} else {
    die("Error updating the password: " . $stmt->error);
}
