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
        
        $sql = "SELECT * FROM users ";
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

        // INSERT DATAA
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `usersaccount` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
        $result = (mysqli_query($this->conn , $sql));
        if($result == 1){
            return true;
        }
        return false;
    }
    // FOR SIGNUP 
    public function db_email_verification($records){
        extract($records);
        $sql = "SELECT * FROM `usersaccount` WHERE email = '$email'";
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
        
        $sql = "SELECT * FROM `usersaccount` WHERE email = '$email'";
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

    

    // IS EMAIL AVAILABLE IN DATABASE DURING FORGET PASSWORD 
    public function db_get_user_email($records){
        extract($records);

        $sql = "SELECT * FROM `usersaccount` WHERE email = '$email'";
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
        $sql = "UPDATE `usersaccount` SET `otp` = '$otp' WHERE `email` = '$email'";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return true;
        }
        
    }

    public function db_otp_email_check($records){

        extract($records);



    }

    public function db_verify_otp($records){
        extract($records);
        $sql = "SELECT `otp` FROM `usersaccount` WHERE `email` = '$email'";
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

    
    public function db_new_password($records){

        extract($records);

        
    }

}

$obj = new MyDB();
?>
