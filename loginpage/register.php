<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="wrapper">
        <form action="./signup.php" method="post">
            <h1>Register</h1>

            <!-- Error Msg -->

            <?php if(isset($_GET['error'])){ ?>

                <p class="error-msg" id="error-msg"><?= $_GET['error']; ?></p>

            <?php } ?>

            <!-- Register Form -->

            <div class="input-box">
                <input type="text" name = "username" placeholder="Username" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="email" name = "email" placeholder="Email" required>
                <i class='bx bx-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name = "password" placeholder="Password" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="password" name = "confirm_password" placeholder="Confirm Password" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <!-- <button type="submit" name = "registeruser" class="btn">Register</button> -->
            <input type="submit" class= "btn" name="registeruser" value="Register">
            
            <div class="login-link"> Already have an account?
                <a href="./index.php">Login</a>
            </div>
        </form>
    </div>



    <script>
      var errorMsg = document.getElementById('error-msg');

        // Function to hide the insertmsg element
        function errorDisplayMsg() {
            errorMsg.style.display = 'none';
        }

        // Add event listeners to the document body for keydown and mousedown events
        document.body.addEventListener('keydown', errorDisplayMsg);
        document.body.addEventListener('mousedown', errorDisplayMsg);



  </script>

</body>
</html>
