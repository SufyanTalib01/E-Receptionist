<?php
session_start();

require_once('config.php');

// write the code of class - contructor - obj
// DB_HOST , -- config 


class MyDB{

    private $conn = '';

    // Constructor for Database Connection
    public function __construct($host = DB_HOST, $username =DB_USERNAME, $pass = DB_PASSWORD, $db = DB_NAME) {

        $this->conn = mysqli_connect($host, $username, $pass, $db) or die("Connection failed");
    }

    public function getUsers(){
        
        $sql = "SELECT * FROM users WHERE deleted_at IS NULL";
        $result =(mysqli_query($this->conn, $sql));
        if($result->num_rows > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
                
            }
            return $data;
        }
        else{
            return [];
        }
        
    }
    public function debug($record){

        echo "<pre>";
        print_r($record);
        echo "</pre>";
        exit();

    }

    public function db_form_validation($records){
        extract($records);

        

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = test_input($name);
        $email = test_input($email);
        $password = test_input($password);

        $invalidFormInput = "";

        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $invalidFormInput = "Only letters and white space allowed in name.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $invalidFormInput = "Invalid email format.";
        }

        // if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        //     $invalidFormInput = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        // }

        if(empty($invalidFormInput)){
            return true;
        }else{
            $_SESSION['invalid_form_input'] = $invalidFormInput;
            return false;
        }
    }

    public function signUp($records){

        // EXTRACT FORM FIELDS 
        extract($records);

        $name = ucwords(strtolower($name));

        // INSERT DATAA
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role` , is_active) VALUES ('$name', '$email', '$password' , 'User' , '1')";
        $result = (mysqli_query($this->conn , $sql));
        if($result == 1){
            return true;
        }
        return false;
    }
    // FOR SIGNUP 
    public function db_email_verification($records){
        extract($records);
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = (mysqli_query($this->conn , $sql));
        $num = mysqli_num_rows($result);
        if($num >= 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function db_login($records){
        extract($records);
        
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($this->conn , $sql);
        $num = mysqli_num_rows($result);
        if($num >= 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password , $row['password'])){
                    return true;
                }else{
                   return false; 
                }
            }
        }else{
            return false;
        }
    }

    // IS EMAIL AVAILABLE IN DATABASE FOR FORGET PASSWORD 
    public function db_get_user_email($records){
        extract($records);

        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($this->conn , $sql);
        $num = mysqli_num_rows($result);
        if($num >= 1){
            while($row = mysqli_fetch_assoc($result)){
                if($email == $row['email']){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        
    }

    // OTP SAVE IN DATABASE
    public function db_save_user_otp($otp, $records){
        extract($records);
        // save the otp on this email
        $sql = "UPDATE `users` SET `otp` = '$otp' WHERE `email` = '$email'";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return true;
        }
        
    }

    // CHECK OTP IS CORRECT 
    public function db_verify_otp($records){
        extract($records);
        $sql = "SELECT `otp` FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                if($otp == $row['otp']){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    // FORGET NEW PASSWORD 
    public function db_new_password($records){
        extract($records);
        if($password == $cpassword){
            $password = password_hash($password , PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `password` = '$password', `otp` = NULL WHERE `email` = '$email'";
            $result = mysqli_query($this->conn , $sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    
    // ADD USER 
    public function db_add_new_user($records){

        // EXTRACT FORM FIELDS 
        extract($records);

        $name = ucwords(strtolower($name));

        // INSERT DATAA
        
        
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role` , `is_active`) VALUES ('$name', '$email', '$password' , '$role' , '1')";
        $result = (mysqli_query($this->conn , $sql));
        if($result == 1){
            return true;
        }
        return false;
    }
    // DELETE USER
    public function db_delete_user($records){
        extract($records);
        $sql = "UPDATE users SET deleted_at = CURRENT_TIMESTAMP WHERE sno = $delete_serial_num";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }

    }


    // CHECK EMAIL IS ALREADY WHEN EDIT USER EXCEPT ALREADY EMAIL IN EDIT FORM 
    public function db_is_email_already($records){
        extract($records);
        

        $sql = "SELECT * FROM `users` WHERE email = '$email' AND sno != '$edit_serial_num'";
        $result = (mysqli_query($this->conn , $sql));
        $num = mysqli_num_rows($result);
        if($num >= 1){
            return true;
        }
        else{
            return false;
        }
    }


    // EDIT USER
    public function db_edit_user($records){
        extract($records);

        if(isset($is_active)){
            $is_active = 1;
        }else{
            $is_active = 0;
        }
        
        if(empty($password)){
            $sql = "UPDATE users SET name = '$name', email = '$email' , role = '$role' , is_active = '$is_active' WHERE sno = '$edit_serial_num'";
            $result = mysqli_query($this->conn , $sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            $password = password_hash($password , PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name', email = '$email' , password = '$password' , role = '$role' , is_active = '$is_active' WHERE sno = '$edit_serial_num'";
            $result = mysqli_query($this->conn , $sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }

    }

    // CALL DATA BY USING ID 
    public function db_get_data_by_id($records){
        
        
        $sql = "SELECT * FROM users WHERE sno = $records";
        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }
    }

    
}

$obj = new MyDB();
?>
