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

    // -------------------------TABLES ALL DATA-------------------------
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
    // GET PERMISSIONS TABLE DATA 
    public function getPermissions(){
        
        $sql = "SELECT * FROM permissions";
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
    // GET PATIENTS and DOCTORS TABLE DATA 
    public function db_patients_table_data(){
        $sql = "SELECT patients. * , 
        patients.id AS patients_id,
        doctors.name AS doctor_name,
        doctors.fee
        FROM patients
        JOIN doctors ON doctors.id = patients.doctor_id WHERE patients.deleted_at IS NULL";

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
    // GET DOCTOR TABLE DATA 
    public function db_doctor_table_data(){
        $sql = "SELECT * FROM doctors WHERE deleted_at IS NULL";
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

    // check error 
    public function debug($record){

        echo "<pre>";
        print_r($record);
        echo "</pre>";
        exit();

    }
    // Form Validation 
    public function db_form_validation($records){
        extract($records);

        

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(isset($name)){
            $name = test_input($name);
        }
        if(isset($email)){
            $email = test_input($email);
        }
        if(isset($father_name)){
            $fatherName = test_input($father_name);
        }

        

        $invalidFormInput = "";

        if(isset($name)){
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $invalidFormInput = "Only letters and white space allowed in name.";
            }
        }
        if(isset($fatherName)){
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fatherName)) {
                $invalidFormInput = "Only letters and white space allowed in father name.";
            }
        }
        if(isset($email)){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $invalidFormInput = "Invalid email format.";
            }
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
    // SIGN UP 
    public function signUp($records){

        // EXTRACT FORM FIELDS 
        extract($records);

        $name = ucwords(strtolower($name));

        // INSERT DATAA
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password` , is_active) VALUES ('$name', '$email', '$password' , '1')";
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
                    $_SESSION['profilePicture'] = $row['profile_picture'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['user_id'] = $row['id'];
                    $role_id = $row['role_id'];

                    $sql = "SELECT * FROM `roles` WHERE id = '$role_id'";
                    $result = mysqli_query($this->conn , $sql);
                    $num = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['role_name'] = $row['name'];
                    return true;
                }else{
                   return false; 
                }
            }
        }else{
            return false;
        }
    }
    public function db_has_user_permission($permission){
        $user_id  = $_SESSION['user_id'];
        
        $sql = "SELECT users.id, permissions.name
            FROM users
            INNER JOIN roles ON roles.id = users.role_id
            INNER JOIN role_has_permission ON role_has_permission.role_id = roles.id
            INNER JOIN permissions ON role_has_permission.permissions_id = permissions.id

            WHERE users.id  = $user_id
            and 
            permissions.name='$permission'";

        $result = mysqli_query($this->conn , $sql);
        $num = mysqli_num_rows($result);
        if($num >= 1){
        return true;
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
    // -------------------USERS QUERIES START--------------- 
    // ADD USER 
    public function db_add_new_user($records){

        // EXTRACT FORM FIELDS 
        extract($records);

        $name = ucwords(strtolower($name));

        if(!empty($_FILES['image']['name'])){

            $image_name = $_FILES['image']['name'];
            $image_name = substr($image_name , -10);
            $image_name = rand(00000,99999).$image_name;

            $image_size = $_FILES['image']['size'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_type = $_FILES['image']['type'];

            if($image_size > 1 * 1024 * 1024){
                $_SESSION['error'] = 'File size exceeds 1MB limit!';
                return false;
            }else{
                $uploadImages = move_uploaded_file($image_tmp , 'upload-images/'.$image_name);
                
                if($uploadImages){
                    $password = password_hash($password , PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role_id` , `is_active` , `profile_picture`) VALUES ('$name', '$email', '$password' , '$role' , '1' , '$image_name')";
                    
                    $result = (mysqli_query($this->conn , $sql));
                    if($result == 1){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }

            }
        }else{
            
            // INSERT DATA
            $password = password_hash($password , PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `email`, `password` , `role_id` , `is_active`) VALUES ('$name', '$email', '$password' , '$role' , '1')";
            $result = (mysqli_query($this->conn , $sql));
            if($result == 1){
                $_SESSION['error'] = 'User Added Successfully';
                return true;
            }else{
                $_SESSION['error'] = 'Invalid Credentials';
                return false;}
        }

            
    }
    // DELETE USER
    public function db_delete_user($records){
        extract($records);
        $sql = "UPDATE users SET deleted_at = CURRENT_TIMESTAMP WHERE id = $delete_serial_num";
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
        $sql = "SELECT * FROM `users` WHERE email = '$email' AND id != '$edit_serial_num'";
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
        if(!empty($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            $image_name = substr($image_name , -10);
            $image_name = rand(00000,99999).$image_name;

            $image_size = $_FILES['image']['size'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_type = $_FILES['image']['type'];

            if($image_size > 1 * 1024 * 1024){
                $_SESSION['error'] = 'File size exceeds 1MB limit!';
                return false;
            }else{
                if ($old_image && file_exists("upload-images/" . $old_image)) {
                    unlink("upload-images/" . $old_image); // Delete the old image
                }
                $uploadImages = move_uploaded_file($image_tmp , 'upload-images/'.$image_name);
                if($uploadImages){
                    if(empty($password)){
                        $sql = "UPDATE users SET name = '$name', email = '$email' , role_id = '$role' , is_active = '$is_active' , profile_picture = '$image_name' WHERE id = '$edit_serial_num'";
                        $result = mysqli_query($this->conn , $sql);
                        if($result){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        $password = password_hash($password , PASSWORD_DEFAULT);

                        $sql = "UPDATE users SET name = '$name', email = '$email' , password = '$password' , role_id = '$role' , is_active = '$is_active' , profile_picture = '$image_name' WHERE id = '$edit_serial_num'";
                        $result = mysqli_query($this->conn , $sql);
                        if($result){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }else{
                    return false;
                }

            }
        }else{
            
            if(empty($password)){
                $sql = "UPDATE users SET name = '$name', email = '$email' , role_id = '$role' , is_active = '$is_active' WHERE id = '$edit_serial_num'";
                $result = mysqli_query($this->conn , $sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else{
                $password = password_hash($password , PASSWORD_DEFAULT);
                $sql = "UPDATE users SET name = '$name', email = '$email' , password = '$password' , role_id = '$role' , is_active = '$is_active' WHERE id = '$edit_serial_num'";
                $result = mysqli_query($this->conn , $sql);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        
    }
    // CALL DATA BY USING ID 
    public function db_get_data_by_id($records){
    
        $sql = "SELECT * FROM users WHERE id = $records";
        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }
    }
    // -------------------USERS QUERIES END--------------- 

    // -------------------ROLE QUERIES START--------------- 
    // GET ROLES DATA 
    public function db_getRoles(){
        
        $sql = "SELECT * FROM roles WHERE deleted_at IS NULL";
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
    // Create New Role 
    public function db_create_new_role($records){
        extract($records);

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = test_input($name);

        $name = ucwords(strtolower($name));

        $sql = "SELECT * FROM roles WHERE  `name` = '$name'";
        $result = mysqli_query($this->conn , $sql);
        $num = mysqli_num_rows($result);
        if($num >= 1){
            $_SESSION['error'] = 'Roles is Already Exist';
            return false;
            
        }else{
            $sql = "INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, '$name', NOW(), NOW())";
        $result = mysqli_query($this->conn , $sql);

        if($result){
            
            $roleId = mysqli_insert_id($this->conn);

            if (!empty($is_active)) {
                foreach ($_POST['is_active'] as $key => $value) {
                    // echo "Permission ID $key: $value <br>";
                    if($value == 'on'){
                        $sql = "INSERT INTO `role_has_permission` (`role_id`, `permissions_id`) VALUES ('$roleId', '$key')";
                        $result = mysqli_query($this->conn , $sql);
                    }
                }
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else {
                return false;
            }

        }else{
            return false;
        }
        }
    }
    // GET ROLES DATA BY ID 
    public function db_get_roles_data_by_id($id){

        $sql = "SELECT * FROM roles WHERE id = $id";
        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }
    }
    // GET Role_has_permission DATA BY ID 
    public function db_get_role_has_permission_data_by_id($id){
        
        $sql = "SELECT * FROM role_has_permission WHERE role_id = $id";
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
    // check during edit role - role has already exist or not 
    public function db_role_already_exist($records){

        extract($records);

        
        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = test_input($name);

        $name = ucwords(strtolower($name));

        $sql = "SELECT * FROM `roles` WHERE name = '$name' AND id != '$roles_id'";
        // $sql = "SELECT * FROM roles WHERE  `name` != '$name'";
        $result = mysqli_query($this->conn , $sql);
        $num = mysqli_num_rows($result);
        if($num >= 1){
            return true;
        }else{
            return false;
        }
    }
    // edit and update role permission 
    public function db_edit_role_permission($records){
        extract($records);

        $sql = "UPDATE `roles` SET `name` = '$name', `updated_at` = NOW() WHERE `roles`.`id` = $roles_id";
        $result = mysqli_query($this->conn , $sql);
        if($result){

            

            if (!empty($is_active)) {

                $sql = "DELETE FROM role_has_permission WHERE role_id = $roles_id";
                $result = mysqli_query($this->conn , $sql);

                if($result){
                    foreach ($is_active as $key => $value) {
                        if($value == 'on'){
                            $sql = "INSERT INTO `role_has_permission` (`role_id`, `permissions_id`) VALUES ('$roles_id', '$key')";
                            $result = mysqli_query($this->conn , $sql);
                        }
                    }
                    if($result){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }                
            }else {
                return false;
            }

        }else{
            return false;
        }
    }
    // DELETE ROLE
    public function db_delete_role($records){
        extract($records);
        $sql = "UPDATE roles SET deleted_at = CURRENT_TIMESTAMP WHERE id = $delete";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }

    }
    // -------------------ROLE QUERIES END------------------
    // -------------------MANAGE PROFILE SATRT--------------- 
    public function db_manage_user($records){
        extract($records);

        if(!empty($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
            $image_name = substr($image_name , -10);
            $image_name = rand(00000,99999).$image_name;

            $image_size = $_FILES['image']['size'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_type = $_FILES['image']['type'];

            if($image_size > 1 * 1024 * 1024){
                $_SESSION['error'] = 'File size exceeds 1MB limit!';
                return false;
            }else{
                if ($old_image && file_exists("upload-images/" . $old_image)) {
                    unlink("upload-images/" . $old_image); // Delete the old image
                }
                $uploadImages = move_uploaded_file($image_tmp , 'upload-images/'.$image_name);
                if($uploadImages){
                    $sql = "UPDATE users SET name = '$name', email = '$email' ,  profile_picture = '$image_name' WHERE id = '$edit_serial_num'";
                        $result = mysqli_query($this->conn , $sql);
                        if($result){
                            $sql = "SELECT * FROM `users` WHERE id = '$edit_serial_num'";
                            $result = mysqli_query($this->conn , $sql);
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['profilePicture'] = $row['profile_picture'];
                            return true;
                        }else{
                            return false;
                        }
                }else{
                    return false;
                }

            }
        }else{
            $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$edit_serial_num'";
                $result = mysqli_query($this->conn , $sql);
                if($result){
                    $sql = "SELECT * FROM `users` WHERE id = '$edit_serial_num'";
                        $result = mysqli_query($this->conn , $sql);
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['profilePicture'] = $row['profile_picture'];
                    return true;
                }else{
                    return false;
                }
        }
    }
    // -------------------MANAGE PROFILE END---------------
    // DELETE Doctor
    public function db_delete_doctor($records){
        extract($records);
        $sql = "UPDATE doctors SET deleted_at = CURRENT_TIMESTAMP WHERE id = $delete_serial_num";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // DELETE PATIENT 
    public function db_delete_patient($records){
        extract($records);
        $sql = "UPDATE patients SET deleted_at = CURRENT_TIMESTAMP WHERE id = $delete_serial_num";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // ADD PATIENT 
    public function db_add_patient($records){
        extract($records);
        $created_by = $_SESSION['name'];

        $sql = "INSERT INTO `patients` (`name`, `father_name`, `age` , `doctor_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `status`) VALUES ('$name', '$father_name', '$age' ,  '$select', NOW(), NOW(), NULL, '$created_by', '1');";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            $_SESSION['recent_id'] = mysqli_insert_id($this->conn);
            return true;
        }else{
            return false;
        }
    }
    // GET PATIENT DATA BY ID 
    public function db_get_patients_data($records){
        $sql = "SELECT * FROM patients WHERE id = $records";
        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }

    }
    // EDIT PATIENT DATA 
    public function db_edit_patient($records){
        extract($records);
        $sql = "UPDATE `patients` SET `name` = '$name', `father_name` = '$father_name', `age` = $age , `doctor_id` = '$select' , `updated_at` = NOW() WHERE `id` = '$id'";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // ADD DOCTOR 
    public function db_add_doctor($records){
        extract($records);
        $sql = "INSERT INTO `doctors` (`name`, `father_name`, `specialist`,  `fee` , `created_at`, `updated_at`) VALUES ('$name', '$father_name', '$specialist', '$fee' , NOW() , NOW())";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // GET DATA DOCTOR TABLE USING ID 
    public function db_doctor_data_by_id($records){
        $sql = "SELECT * FROM doctors WHERE id = $records";
        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }
    }
    // Edit Doctor 
    public function db_edit_doctor($records){
        extract($records);
        $sql = "UPDATE `doctors` SET `name` = '$name', `father_name` = '$father_name', `specialist` = '$specialist' , `fee` = '$fee' ,  `updated_at` = NOW() WHERE `id` = '$id'";
        $result = mysqli_query($this->conn , $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // GET PATIENT AND DOCTOR DATA BY ID 
    public function db_patient_doctor_data($records){
        $sql = "SELECT patients. * , 
        patients.id AS patients_id,
        doctors.name AS doctor_name,
        doctors.fee
        FROM patients
        JOIN doctors ON doctors.id = patients.doctor_id WHERE patients.id = $records";

        $result =(mysqli_query($this->conn, $sql));
        $num = mysqli_num_rows($result);
        if($num > 0){
            return mysqli_fetch_assoc($result);
        }else{
            return NULL;
        }
    }
    // GENERATE REPORT 
    public function db_generate_report($startDate , $endDate , $select){
        if($select == 'all_users'){
            
            $sql = "SELECT COUNT(patients.id) AS total_patients,
            SUM(doctors.fee) AS total_amount
            FROM patients
            JOIN doctors ON doctors.id = patients.doctor_id
            WHERE DATE(patients.created_at) BETWEEN '$startDate' AND '$endDate'";

            $result = mysqli_query($this->conn , $sql);
            $num = mysqli_num_rows($result);
            if($num > 0){
                return mysqli_fetch_assoc($result);
            }else{
                return NULL;
            }
        }else{
            $sql = "SELECT COUNT(patients.id) AS total_patients,
            SUM(doctors.fee) AS total_amount
            FROM patients
            JOIN doctors ON doctors.id = patients.doctor_id
            WHERE DATE(patients.created_at) BETWEEN '$startDate' AND '$endDate'
            AND
            patients.created_by = '$select'
            ";

            $result = mysqli_query($this->conn , $sql);
            $num = mysqli_num_rows($result);
            if($num > 0){
                return mysqli_fetch_assoc($result);
            }else{
                return NULL;
            }
        }
    }
}

$obj = new MyDB();
?>
