
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
                                unset($_SESSION['form_data']);
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
                $_SESSION['form_data'] = $_POST;
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

        // Create Roles 
        }else if($action == 'create_roles'){

            $createNewRole = $obj->db_create_new_role($_POST);
                if($createNewRole){
                    $_SESSION['message'] = 'Role Created Successfully';
                    header('location: list-role-permissions.php');   
                }else{
                    ($_SESSION['message'] = $_SESSION['error']) ? $_SESSION['message'] = $_SESSION['error'] : $_SESSION['message'] = 'Role Not Create';
                    header('location: create-roles.php');
                }
            
         
        // Edit Roles and Roles Permission 
        }else if($action == 'edit_role_permissions'){
            $isRoleAlreadyExist = $obj->db_role_already_exist($_POST);

            if($isRoleAlreadyExist){
                $_SESSION['message'] = 'Roles is Already Exist';
                $_SESSION['form_data'] = $_POST;
                header('location: edit-role-permissions.php?id='.$_POST['roles_id']);
            }else{
                $isRoleEdited = $obj->db_edit_role_permission($_POST);

                if($isRoleEdited){
                    $_SESSION['message'] = 'Role Updated';
                    header('location: list-role-permissions.php');
                }else{
                    $_SESSION['message'] = 'Something went wrong please try again';
                    header('location: edit-role-permissions.php?id='.$_POST['roles_id']);
                }
            }
            

        // DELETE ROLE 
        }else if($action == 'delete_role'){

            $deleteRole = $obj->db_delete_role($_POST);

            if($deleteRole){
                $_SESSION['message'] = 'Role deleted';
                header('location: list-role-permissions.php');
            }else{
                $_SESSION['message'] = 'Role not deleted';
                header('location: list-role-permissions.php');
            }
        // Manage Profile 
        }else if($action == 'manage_profile'){
            $isEmailExist = $obj->db_is_email_already($_POST);
            if(!$isEmailExist){ 
                $isFormCorrect = $obj->db_form_validation($_POST);
                if($isFormCorrect){
                    $upateData = $obj->db_manage_user($_POST);
                    if($upateData){
                        $_SESSION['message'] = 'Profile Updated';
                        header('location: manage-profile.php');
                    }else{
                        $_SESSION['message'] = 'Invalid Crendentials';
                        $_SESSION['form_data'] = $_POST;
                        header('location: manage-profile.php');
                    }
                }else{
                    $_SESSION['message'] = $_SESSION['invalid_form_input'];
                    $_SESSION['form_data'] = $_POST;
                    header('location: manage-profile.php');
                }
            }else{
                $_SESSION['message'] = 'Email Already Exist';
                $_SESSION['form_data'] = $_POST;
                header('location: manage-profile.php');
            }
        // DELETE DOCTORS 
        }else if($action == 'delete_doctor'){

            $deleteDoctor = $obj->db_delete_doctor($_POST);

            if($deleteDoctor){
                $_SESSION['message'] = 'deleted Successfully';
                header('location: doctors.php');
            }else{
                header('location: doctors.php');
            }
        // ADD PATIENT
        }else if($action == 'add_patient'){
            $isPatientAdded = $obj->db_add_patient($_POST);
            if($isPatientAdded){
                $_SESSION['message'] = 'Patient Added';
                header("location: patients.php");
                header("location: generate_pdf.php");
                exit;
            }else{
                $_SESSION['message'] = 'Invalid Credentials';
                header("location: add-patients.php");
            }
        // DELETE PATIENT 
        }else if($action == 'delete_patient'){
            $deletePatient = $obj->db_delete_patient($_POST);

            if($deletePatient){
                $_SESSION['message'] = 'Patient deleted';
                header('location: patients.php');
            }else{
                header('location: patients.php');
            }
        // EDIT PATIENT 
        }else if($action == 'edit_patient'){
            $isValid = $obj->db_form_validation($_POST);
                if($isValid){
                    $isPatientEdited = $obj->db_edit_patient($_POST);
                if($isPatientEdited){
                    $_SESSION['message'] = 'Patient Edited';
                    header('location: patients.php');
                }else{
                    $_SESSION['message'] = 'Invalid Credentials';
                    $_SESSION['form_data'] = $_POST;
                    header('location: edit-patients.php?id='.$_POST['id']);
                }
                }else{
                    $_SESSION['message'] = $_SESSION['invalid_form_input'];
                    $_SESSION['form_data'] = $_POST;
                    header('location: edit-patients.php?id='.$_POST['id']);
                }
        // ADD DOCTOR 
        }else if($action == 'add_doctor'){
            $isDoctorAdded = $obj->db_add_doctor($_POST);
            if($isDoctorAdded){
                $_SESSION['message'] = 'Doctor Added';
                header('location: doctors.php');
            }else{
                $_SESSION['message'] = 'Invalid Credentials';
                header('location: add-doctor.php');
            }
        // EDIT DOCTOR 
        }else if($action == 'edit_doctor'){
            $isValid = $obj->db_form_validation($_POST);
            if($isValid){
            $isDoctorEdited = $obj->db_edit_doctor($_POST);
            if($isDoctorEdited){
                $_SESSION['message'] = 'Doctor Edited';
                header('location: doctors.php');
            }else{
                $_SESSION['message'] = 'Invalid Credentials';
                header('location: add-doctor.php');
            }
            }else{
                $_SESSION['message'] = $_SESSION['invalid_form_input'];
                $_SESSION['form_data'] = $_POST;
                header('location: edit-doctor.php?id='.$_POST['id']);
            }
        }
        // GENERATE REPORT 
        else if($action == 'generate_report'){
            $start_date = $_POST['start_date'];;
            $end_date = $_POST['end_date'];;

            if(strtotime($start_date) > strtotime($end_date)){
                $_SESSION['message'] = 'Start Date must be earlier than End Date.';
                header('location: export-data.php');
            }else{
                $hasGeneratedReport = $obj->db_generate_report($_POST);
            }
        }
    }

    

?>

