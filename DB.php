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

        // INSERT DATA
        $sql = "INSERT INTO `usersaccount` (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
        $result = (mysqli_query($this->conn , $sql));
        if($result == 1){
            return true;
        }
        
        return false;

    }

}

$obj = new MyDB();
?>
