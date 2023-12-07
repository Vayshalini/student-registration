<?php

session_start();
include('../dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

$mail = new PHPMailer(true);

function send_password_reset($mail, $get_name, $get_email, $token){
    

    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP();           
    
    //Send using SMTP
                    
    $mail->SMTPAuth   = true;   
    
    
    //Enable SMTP authentication
    $mail->Host       = 'smtp.gmail.com';    
    $mail->Username   = 'andreabrynnstories@gmail.com';                     //SMTP username
    $mail->Password   = 'jtsm ckmj ixyx vngm'; 
    
    //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('andreabrynnstories@gmail.com', $get_name);
    $mail->addAddress($get_email);     //Add a recipient
  

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';
    

    $email_template = "<h2>Hello</h2>
    <h3>You are receiving this email to reset password</h3>
    <br />
    <a href='http://localhost:3000/loginpage/change_password.php?token=$token'>Click here</a>";

    $mail->Body = $email_template;
    try {
        $mail->send();
        $_SESSION['status'] = "Email sent successfully"; // Set a success message
        header("Location: forgotpw.php");
        exit(0);
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: forgotpw.php");
        exit(0);
    }
  
}



if(isset($_POST['password_reset_button'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token = '$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);
    
        if($update_token_run){

                send_password_reset($mail, $get_name, $get_email, $token);
                $_SESSION['status'] = "We emailed you a password reset link";
                header("Location: forgotpw.php");
                exit(0);
        
        }else{
            $_SESSION['status'] = "No Email Found";
            header("Location: forgotpw.php");
            exit(0);
        }
    
    
    
    }
}
else{
    $_SESSION['status'] = "No Email Found";
    header("Location: forgotpw.php");
    exit(0);
}
