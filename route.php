
<?php 

    require_once('DB.php'); 
    require_once('CustomMail.php'); 

    if(($_SERVER['REQUEST_METHOD'] == 'POST')){

        $action = $_POST['action'];
        
        // SIGNUP 
        if($action == "signup"){

            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $is_form_valid = $obj->db_form_validation($_POST);
            
            if($is_form_valid){
                $dbEmailVerificaition = $obj->db_email_verification($_POST);
                if($dbEmailVerificaition){
                    $_SESSION['message'] = "Email Already Existed";
                    header('location: signup.php');
                }
                else{
                    if(strlen($password) >= 8){
                        if($password == $confirmPassword){
                            $flag = $obj->signUp($_POST);
        
                            if($flag){
                                $_SESSION['message'] = 'Account created! please login';
                                header('location: login.php');
                            }else{
                                $_SESSION['message'] = 'Data Not Saved';
                                header('location: signup.php');
                            }
                        }else{
                            $_SESSION['message'] = 'Password and Confirm Password is not same';
                            header('location: signup.php');
                        }
                    }else{
                        $_SESSION['message'] = 'Password should be greater than 8 character';
                        header('location: signup.php');
                    }
                }
            }else{
                $_SESSION['message'] = $_SESSION['invalid_form_input'];
                header('location: signup.php');
            }

                
            
        // LOGIN 
        }else if($action == "login"){

            $login = $obj->db_login($_POST);
            if($login){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['message'] = 'Login Successfully';
                header('location: index.php');
            }else{
                $_SESSION['message'] = 'Invalid Email or Password';
                header('location: login.php');
            }


        // FORGET PASSWORD 
        }else if($action == "forget"){
            $isEmailExist = $obj->db_get_user_email($_POST);
            if($isEmailExist){

                // generate rand number for OTP
                $otp = rand(00000 , 99999);
                
                // send otp via email
                $mail->cm_send_otp_mail($otp, $_POST);

                // save otp to this user table
                $isSaved = $obj->db_save_user_otp($otp, $_POST);


                if($isSaved){
                    
                    // redirect to otp page;
                    header("location:otp.php?email=".$_POST['email']);

                }else{
                    // redirect to forget password page
                $_SESSION['message'] = 'Invalid Email';
                header('location: forget-password.php');
                }
                
                }else{
                $_SESSION['message'] = 'Invalid Email';
                header('location: forget-password.php');
                }

                // OTP_VERIFICATION 
        // OTP VERIFICATION 
        }else if($action == 'otp'){

                $otp = $_POST['otp'];

                // verify the password and confirm - password must be same

                $isOtpCorrrect = $obj->db_verify_otp($_POST);

                if($isOtpCorrrect){
                    $_SESSION['message'] = 'OTP is Correct';
                    header("location:new-password.php?email=".$_POST['email']);
                }else{
                    $_SESSION['message'] = 'Incorrect OTP';
                    header("location:otp.php?email=".$_POST['email']);
                }

        // GENERATE NEW PASSWORD 
        }else if($action == 'newpassword'){
            $isPasswordchanged = $obj->db_new_password($_POST);

            if($isPasswordchanged){
                $_SESSION['message'] = 'Your password has been changed. Please Log in';
                header("location:login.php");
            }else{
                $_SESSION['message'] = 'Password and Confirm password is not same';
                header("location:new-password.php?email=".$_POST['email']);
            }

        // ADD USER 
        }else if($action == 'adduser'){
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            
            $is_form_valid = $obj->db_form_validation($_POST);
            if($is_form_valid){
                $dbEmailVerificaition = $obj->db_email_verification($_POST);
                if($dbEmailVerificaition){
                    $_SESSION['message'] = "Email Already Existed";
                    header('location: add-user.php');
                }
                else{
                    if(strlen($password) >= 8){
                        if($password == $confirmPassword){
                            $flag = $obj->db_add_new_user($_POST);
            
                            if($flag){
                                $_SESSION['message'] = 'User Added';
                                header('location: users.php');
                            }else{
                                if(isset($_SESSION['error'])){
                                    $_SESSION['message'] = $_SESSION['error'];
                                }else{
                                    $_SESSION['invalid Credentials'];
                                }
                                header('location: add-user.php');
                            }
                        }else{
                            $_SESSION['message'] = 'Invalid Credentials';
                            header('location: add-user.php');
                        }
                    }else{
                        $_SESSION['message'] = 'Password must be 8 characters';
                        header('location: add-user.php');
                    }
                }
            }else{
                $_SESSION['message'] = $_SESSION['invalid_form_input'];
                header('location: add-user.php');
            }
            
                
                
        // DELETE USER 
        }else if($action == 'delete_user'){

            $deleteUser = $obj->db_delete_user($_POST);

            if($deleteUser){
                $_SESSION['message'] = 'account deleted';
                header('location: users.php');
            }else{
                header('location: users.php');
            }
        // EDIT USER 
        }else if($action == 'edit_user'){
            extract($_POST);

            $is_form_valid = $obj->db_form_validation($_POST);

            if($is_form_valid){
                $isEmailExist = $obj->db_is_email_already($_POST);
                if($isEmailExist){
                    $_SESSION['message'] = 'Already Email Exist';
                    $_SESSION['form_data'] = $_POST;
                    header('location: edit-user.php?id='.$_POST['edit_serial_num']);
                    // header('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                        if(!empty($password)){
                            if(strlen($password) >= 8){
                                if($password == $confirm_password){
                                    $editUser = $obj->db_edit_user($_POST);
                                    
                                    if($editUser){
                                        $_SESSION['message'] = 'User Edited';
                                        header('location: users.php');
                                    }else{
                                        $_SESSION['message'] = 'Invalid Credentials';
                                        $_SESSION['form_data'] = $_POST;
                                        header('location: edit-user.php?id='.$_POST['edit_serial_num']);
                                    }
                                }else{
                                    $_SESSION['message'] = 'Passoword not Same';
                                    header('location: edit-user.php?id='.$_POST['edit_serial_num']);
                                }
                            }else{
                                $_SESSION['message'] = 'Password must be 8 characters';
                                $_SESSION['form_data'] = $_POST;
                                header('location: edit-user.php?id='.$_POST['edit_serial_num']);
                            }
                        }else{
                                $editUser = $obj->db_edit_user($_POST);
            
                                if($editUser){
                                    $_SESSION['message'] = 'User Edited';
                                    header('location: users.php');
                                }else{
                                    $_SESSION['message'] = 'Invalid Credentials';
                                    $_SESSION['form_data'] = $_POST;
                                    header('location: edit-user.php?id='.$_POST['edit_serial_num']);
                                }
                        }
                    }
            }else{
                $_SESSION['message'] = $_SESSION['invalid_form_input'];
                $_SESSION['form_data'] = $_POST;
                header('location: edit-user.php?id='.$_POST['edit_serial_num']);
            }
        }
        
        

    }

    

?>

