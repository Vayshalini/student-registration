<?php
include "../dbconn.php";
include "../loginpage/logging.php"; // Include the logging file

session_start();

// Get user information before unsetting the session
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";



if(isset($_POST['reset'])) {
    $email = $_POST['email'];
}
else {
    exit();
}

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/../mail/Exception.php';
require __DIR__ . '/../mail/PHPMailer.php';
require __DIR__ . '/../mail/SMTP.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'andreabrynnstories@gmail.com';                     //SMTP username
        $mail->Password   = 'jtsm ckmj ixyx vngm';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('andreabrynnstories@gmail.com', 'noreply@example.com');
        $mail->addAddress($email);     


        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $token = bin2hex(random_bytes(16));
    
        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Password Reset';
    


        $email_template = "
                        <!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Password Reset</title>
                            <style>
                            body {
                                font-family: 'Arial', sans-serif;
                                background-color: #f4f4f4;
                                color: #333;
                                text-align: center;
                                padding: 20px;
                            }
                            h2 {
                                color: #007BFF;
                            }
                            h3 {
                                color: #6C757D;
                            }

                            a {
                                color: #fff !important; 
                            }

                            .reset-link {
                                display: inline-block;
                                padding: 10px 20px;
                                background-color: #007BFF;
                                color: #fff;
                                text-decoration: none;
                                border-radius: 5px;
                            }
                        </style>
                        </head>
                        <body>
                            <h2>Forgot Password - Account Recovery</h2>
                            <h3>You are receiving this email to reset your password.</h3>
                            <p>To reset your password, click the link below:</p>
                            <a class='reset-link' href='http://localhost:3000/loginpage/change_password.php?token=$token'>Reset Password</a>
                            <p>If you did not request a password reset, please ignore this email.</p>
                        </body>
                        </html>";



        $mail->Body = $email_template;
        // try {
        //     $mail->send();
        //     $_SESSION['status'] = "Email sent successfully"; // Set a success message
        //     header("Location: forgotpw.php");
        //     exit(0);
        // } catch (Exception $e) {
        //     $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //     header("Location: forgotpw.php");
        //     exit(0);
        // }


        $conn = new mySqli('localhost', 'root', '', 'studentpro');

        if($conn->connect_error) {
            die('Could not connect to the database.');
        }

        $verifyQuery = $conn->query("SELECT * FROM users WHERE email = '$email'");

        if($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE users SET verify_token = '$token' , created_at = '$expiry' WHERE email = '$email'");
                

    
            $mail->send();
            logger("$userName has requested for password reset.");
            echo 'Message has been sent, check your email';
        }
        $conn->close();
    
    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }



 
?>

