<?php

include 'connection/connect.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');



if (isset($_POST['email'])) {
   
     $em = $_POST['email'];
   

    // Check if the email exists in the database
    $q2 = "SELECT * FROM users";
    $result = mysqli_query($db, $q2);
    $countem = mysqli_num_rows($result);
    if ($countem == 1) { // If email exists
        date_default_timezone_set("Asia/Kolkata");
        $s_time = date("Y-m-d G:i:s");

        // Generate a token for this session
        $token = hash('sha512', $s_time);
        $otp = mt_rand(100000, 999999); // Generate a random OTP

        // Insert token and OTP into database
        $ins_token = "INSERT INTO token VALUES ('','$em','$s_time','$token',$otp)";
        if (mysqli_query($db, $ins_token)) {

            // Create a PHPMailer instance
            $mail = new PHPMailer();
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;     
                $mail->Username = 'rajthummar2512@gmail.com'; // Your Gmail email
                $mail->Password = 'pymf odir tmmg ipas'; // Your Gmail password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('rajthummar2512@gmail.com', 'manan ghevariya'); // Your Name and your Gmail email
                $mail->addAddress($em); // Recipient email address
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset OTP';
                $mail->Body = 'Your OTP to reset your account password is ' . $otp;

                // Send the email
                if ($mail->send()) {
                    // Redirect to OTP verification page
                    $_SESSION['forgot_em'] = $em;
                    $_SESSION['forgot_token'] = $token;
                    setcookie("success", "OTP to reset your password is sent to your registered email address", time() + 2, "/");
                    header("Location: pass_otp.php"); // Redirect to pass_otp.php after sending email
                    exit();
                } else {
                    setcookie("error", "Error in sending OTP. Please try again later.", time() + 2, "/");
                    header("Location: forgate.php");
                    exit();
                }
                
            } catch (Exception $e) {
                echo "Email sending failed. Error: {$mail->ErrorInfo}";
            }
        }
    } else { // If email doesn't exist
        setcookie('error', "This email is not registered.", time() + 2, "/");
        header("Location: Forgot_password.php");
        exit();
    }
}
?>
