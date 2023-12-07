

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
<style>
    body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

h2 {
    margin: 0 0 20px;
}

label {
    display: block;
    text-align: left;
    margin-top: 10px;
}

input {
    width: 90%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>
    


<div>
       <?php
             if(isset($_SESSION['status'])){
                ?> 
                <div class="alert alert-success">
                    <h5><?= $_SESSION['status']; ?></h5>
                </div>
                <?php
                unset($_SESSION['status']);
            }
        ?>

    </div>
    
    <div class="container">
        <h2>Change Password</h2>
        <form action="./update_password.php" method="post">
            
        <input type="hidden" name="token" value="<?php echo isset($_POST['token']) ? $_POST['token'] : ''; ?>">
            
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>
            
            
            <button type="submit" name="password_update_btn">Change Password</button>

            </div>
        </form>
    </div>
    </body>
</html>