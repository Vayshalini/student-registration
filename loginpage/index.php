<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="wrapper">
        <form action="./login.php" method="post">
            <h1>Login</h1>

            <!-- Error Message -->

            <?php if(isset($_GET['error'])){ ?>
                <p class="error-msg" id="error-msg"><?= $_GET['error']; ?></p>

            <?php } ?>


            <!-- Success Msg -->
            <?php if(isset($_GET['successmsg'])){ ?>
                <p class="successs-msg" id="successs-msg"><?= $_GET['successmsg']; ?></p>

            <?php } ?>

            <!-- Login Form -->

            <div class="input-box">
                <input type="text" name= "email" placeholder="Email">
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name= "password" placeholder="Password">
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="remember-forget">
                <label>
                    <input type="checkbox">Remember me
                </label>
                <a href="./forgotpw.php">Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link"> Don't have an account?
                <a href="./register.php">Register</a>
            </div>
        </form>
    </div>

<script>
    // Get the error message element by its id
    const errorMessage = document.getElementById('error-msg');

    // Add an event listener to the document to listen for keypress
    document.addEventListener('keypress', function() {
    // Hide the error message when any key is pressed
    errorMessage.style.display = 'none';
});


      var succMsg = document.getElementById('successs-msg');

        // Function to hide the insertmsg element
        function successDisplayMsg() {
            succMsg.style.display = 'none';
        }

        // Add event listeners to the document body for keydown and mousedown events
        document.body.addEventListener('keydown', successDisplayMsg);
        document.body.addEventListener('mousedown', successDisplayMsg);





</script>
</body>
</html>
