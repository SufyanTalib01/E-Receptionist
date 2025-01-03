
<?php 
    require_once('DB.php'); 

    if(($_SERVER['REQUEST_METHOD'] == 'POST')){

        $action = $_POST['action'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if($action == "signup"){

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

        }else if($action == "signin"){

            // code for sign in

        }



    }
?>