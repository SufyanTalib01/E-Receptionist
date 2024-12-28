<?php

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
        
        $sql = "SELECT * FROM receipts ";
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

    public function signUp(){
       
        if(($_SERVER['REQUEST_METHOD'] == 'POST')){
            $sName = $_POST['s-name'];
            $sEmail = $_POST['s-email'];
            $sPassword = $_POST['s-password'];
            $sCpassword = $_POST['s-cpassword'];

            
            if($sPassword == $sCpassword){
                $sql = "INSERT INTO `usersaccount` (`name`, `email`, `password`) VALUES ('$sName', '$sEmail', '$sPassword')";
                $result = (mysqli_query($this->conn , $sql));

                return $accountCreated = true;
            }
            else{
                return $accountCreated = false;
            }
            
        }
        
        
    }

}

$obj = new MyDB();
?>
