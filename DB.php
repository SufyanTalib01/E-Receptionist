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

    public function signUp($records){

        // EXTRACT FORM FIELDS 
        extract($records);

        $name = ucwords(strtolower($name));

        // INSERT DATAA
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role`) VALUES ('$name', '$email', '$password' , '$role')";
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
        $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role`) VALUES ('$name', '$email', '$password' , '$role')";
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
        
        if(empty($password)){
            $sql = "UPDATE users SET name = '$name', email = '$email' , role = '$role' WHERE sno = '$edit_serial_num'";
            $result = mysqli_query($this->conn , $sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            $password = password_hash($password , PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name', email = '$email' , password = '$password' , role = '$role' WHERE sno = '$edit_serial_num'";
            $result = mysqli_query($this->conn , $sql);
            if($result){
                return true;
            }else{
                return false;
            }
        }

    }

    
}

$obj = new MyDB();
?>
