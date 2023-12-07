<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        /* Add your imported styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('../images/background_login.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }

        h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
            color: #fff; /* Set the text color to white */
        }

        form {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
            font-family: "Poppins", sans-serif;
            margin-top: 20px; /* Add some top margin for spacing */
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

/* Set the hover color to white */
        button:hover {
            background: #fff;
            color: #333; /* You can adjust the color if needed */
        }

       
    </style>
</head>
<body>
    

    <form method="post" action="change_password_process.php">
    <h1>Reset Password</h1>
        <?php
            // Check if "token" is set in the URL parameters
            $token = isset($_GET["token"]) ? htmlspecialchars($_GET["token"]) : null;

            if (empty($token)) {
                die("Token not found");
            }
        ?>

          <!-- Error Message -->

          <?php if(isset($_GET['error'])){ ?>
                <p class="error-msg" id="error-msg"><?= $_GET['error']; ?></p>

            <?php } ?>


            <!-- Success Msg -->
            <?php if(isset($_GET['successmsg'])){ ?>
                <p class="successs-msg" id="successs-msg"><?= $_GET['successmsg']; ?></p>

            <?php } ?>

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="new_password">New password</label>
        <input type="password" id="new_password" name="new_password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit">Send</button>

    </form>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get form and input elements
        var form = document.querySelector('form');
        var newPasswordInput = document.getElementById('new_password');
        var confirmPasswordInput = document.getElementById('password_confirmation');
        var errorMessage = document.getElementById('error-msg');

        // Add event listener to form submit
        form.addEventListener("submit", function (event) {
            // Check if passwords match
            if (newPasswordInput.value !== confirmPasswordInput.value) {
                // Prevent form submission
                event.preventDefault();
                // Show error message
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'Passwords must match';
            }
        });
    });
</script>

</body>
</html>




<?php

// include('../dbconn.php');

// $token = isset($_GET["token"]) ? htmlspecialchars($_GET["token"]) : null;

// // echo "Input Token: $token\n";


// // $token_hash = hash("sha256", $token);

// // echo "Token Hash: $token_hash\n"; // Debugging output

// $sql = "SELECT * FROM users
//         WHERE verify_token = ?";

// $stmt = $conn->prepare($sql);

// $stmt->bind_param("s", $token_hash);

// if (!$stmt->execute()) {
//     die("Error executing the query: " . $stmt->error);
// }

// $result = $stmt->get_result();

// $user = $result->fetch_assoc();

// print_r($user); // Debugging output

// if (empty($user)) {
//     die("Token not found");
// }

// if (strtotime($user["reset_token_expires_at"]) <= time()) {
//     die("Token has expired");
// }

// if (strlen($_POST["password"]) < 8) {
//     die("Password must be at least 8 characters");
// }

// if (!preg_match("/[a-z]/i", $_POST["password"])) {
//     die("Password must contain at least one letter");
// }

// if (!preg_match("/[0-9]/", $_POST["password"])) {
//     die("Password must contain at least one number");
// }

// if ($_POST["password"] !== $_POST["password_confirmation"]) {
//     die("Passwords must match");
// }

// $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// $sql = "UPDATE users
//         SET password = ?,
//             verify_token = NULL,
//             created_at = NULL
//         WHERE id = ?";

// $stmt = $conn->prepare($sql);

// $stmt->bind_param("ss", $password_hash, $user["id"]);

// $stmt->execute();

// echo "Password updated. You can now login.";
?>
