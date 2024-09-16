<?php

include 'connection/connect.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');


if (isset($_POST['email'])) {
   
    $em = $_POST['email'];
  

   // Check if the email exists in the database
   $q2 = "SELECT * FROM users where email='$em'";
   $result = mysqli_query($db, $q2);
   $countem = mysqli_num_rows($result);


    if($countem == 1)
    {
         $row = mysqli_fetch_assoc($result);
          $name=$row['username'];
          $otp = rand(100000, 999999);

          $_SESSION['forgot_em'] = $em;
          $_SESSION['forgot_token'] = $otp;




        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'rajthummar2512@gmail.com';                 // SMTP username
            $mail->Password   = 'pymf odir tmmg ipas';                        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('rajthummar2512@gmail.com', 'Link and Paper');
            $mail->addAddress($em, $name);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'forgot password otp';
            $mail->Body    = 'otp for forgot password <b>'.$otp.'</b>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            header('location:otp.php');
        } catch (Exception $em) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}

?>
