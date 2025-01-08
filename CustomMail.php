<?php

require_once('config.php');
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// write the code of class - contructor - obj
// DB_HOST , -- config 


class CustomMail{

    public function cm_send_otp_mail($otp, $records){
        $mail = new PHPMailer(true);

        try {
            
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sufyantalib125@gmail.com';                     //SMTP username
            $mail->Password   = 'evmsvobdgqlhxzgs';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('sufyantalib125@gmail.com', 'doctor_app');
            $mail->addAddress($records['email'], 'doctor_app_user');     //Add a recipient

        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Your OTP for Verification';
            $mail->Body    = 'Your OTP is: <b>'. $otp  . '</b>';

            $mail->send();
            $_SESSION['message'] = 'OTP sent. Please Check your email';
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $records['email'];
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }
        
}

$mail = new CustomMail();
?>
