
<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once('DB.php'); 

    if(($_SERVER['REQUEST_METHOD'] == 'POST')){

        $action = $_POST['action'];
        
        // SIGNUP 
        if($action == "signup"){
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $dbEmailVerificaition = $obj->db_email_verification($_POST);
            if($dbEmailVerificaition){
                $_SESSION['message'] = "Email Already Existed";
                header('location: signup.php');
            }
            else{
                if($password == $confirmPassword){
                    $flag = $obj->signUp($_POST);
    
                    if($flag){
                        $_SESSION['message'] = 'Data Saved';
                        header('location: login.php');
                    }else{
                        $_SESSION['message'] = 'Data Not Saved';
                        header('location: signup.php');
                    }
                }
                else{
                    $_SESSION['message'] = 'Password and Confirm Password is not same';
                    header('location: signup.php');
                }
            }

                
            
            // LOGIN 
        }else if($action == "login"){

            $login = $obj->db_login($_POST);
            if($login){
                session_start();
                $_SESSION['loggedin'] = true;
                header('location: index.php');
            }else{
                $_SESSION['message'] = 'Invalid Email or Password';
                header('location: login.php');
            }


        // FORGET PASSWORD 
        }else if($action == "forget"){
            $otp = rand(00000 , 99999);

            $forgetPass = $obj->db_otp($_POST);
            if($forgetPass){

            require 'PHPMailer/SMTP.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/Exception.php';

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
                $mail->addAddress($_POST['email'], 'doctor_app_user');     //Add a recipient

            

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your OTP for Verification';
                $mail->Body    = 'Your OTP is: <b>'. $otp  . '</b>';

                $mail->send();
                $_SESSION['message'] = 'OTP sent. Please Check your email';
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $_POST['email'];
                header('location: otp.php');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
                }else{
                    $_SESSION['message'] = 'Invalid Email';
                    header('location: forget-password.php');
                }

                // OTP_VERIFICATION 
            }else if($action == 'otp'){
                $otp = $_POST['otp'];
                if($_SESSION['otp'] == $otp){
                    $_SESSION['message'] = 'Enter Your New Password';
                    header('location: new-password.php');
                }else{
                    $_SESSION['message'] = 'Incorrect OTP';
                    header('location: otp.php');
                }

            }else if($action == 'newpassword'){
                $newPassword = $obj->db_new_password($_POST);
            }

        

    }
        
?>