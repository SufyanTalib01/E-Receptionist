<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Edit';
  
  $id = $_GET['id'];
  $getDataById = $obj->db_get_data_by_id($id);
?>

<!-- RETAIN FORM DATA -->
<?php 

if(isset($_SESSION['form_data']['name'])){
    $name = $_SESSION['form_data']['name'];
}
if(isset($_SESSION['form_data']['email'])){
    $email = $_SESSION['form_data']['email'];
}

if(isset($_SESSION['form_data']['password'])){
    $password = $_SESSION['form_data']['password'];
}
if(isset($_SESSION['form_data']['confirm_password'])){
    $confirmPassword = $_SESSION['form_data']['confirm_password'];
}
if(isset($_SESSION['form_data']['role'])){
    $role = $_SESSION['form_data']['role'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE ?></title>
    <?php
      require_once('partials/head-links.php');
    ?>

    <style>
        .toggle.btn.btn-primary {
        width: 130px !important; /* Set your desired width */
        height: 42px !important;
    }
    .toggle.btn.btn-default.off {
        width: 130px !important; /* Set your desired width */
        height: 42px !important;
    }
    .btn:hover, .ajax-upload-dragdrop .ajax-file-upload:hover{
        
    }
    .form-group label{
        margin-bottom: 0;
    }

    
    </style>
</head>

<?php 

    if(isset($messageExists)) { ?>

    <script>
    let msg = "<?php echo $messageExists; ?>";
    alert(msg);
    </script>

<?php 
}
?>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <?php
        require_once('partials/nav-bar.php');
      ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
          require_once('partials/side-bar.php');  
        ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <?php
              require_once('partials/page-header.php');  
            ?>
                    <!-- body here  -->
                    <!-- BEGIN :: BODY  -->
                    <div class="container">
                        <div class="card">
                            <div class="card-header p-3">
                                Edit User
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4">
                                <input type="hidden" class="form-control" name="action" id="action"
                                    placeholder="Please enter your name" value="edit_user">

                                <!-- HIDDEN ID -->
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="edit_serial_num" id="name"
                                        value="<?php echo $getDataById['sno'] ?>" placeholder="Name">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input required type="text" class="form-control" name="name" id="name"
                                                value="<?php echo isset($name) ? $name : $getDataById['name'] ?>" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- email -->
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input required type="email" class="form-control" name="email" id="email"
                                                value="<?php echo isset($email) ? $email : $getDataById['email'] ?>" placeholder="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- password  -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : ''?>"
                                                id="password" placeholder="enter password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- confirm password -->
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" value="<?php echo isset($confirmPassword) ? $confirmPassword : ''?>"
                                                id="confirm_password" id="confirm_password"
                                                placeholder="Please enter same password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- SELECT ROLE  -->
                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <!-- role selected -->
                                            <select required class="form-control form-control-sm"
                                                style="border-radius: 0" name="role" id="role">
                                                <option disabled value="">Select Role</option>
                                                <option value="Admin" <?php echo (!empty($role) ? ($role == 'Admin' ? 'selected' : '') : (isset($getDataById['role']) && $getDataById['role'] == 'Admin' ? 'selected' : '')); ?> >Admin</option>
                                                <option value="Moderator" <?php echo (!empty($role) ? ($role == 'Moderator' ? 'selected' : '') : (isset($getDataById['role']) && $getDataById['role'] == 'Moderator' ? 'selected' : '')); ?> >Moderator</option>
                                                <option value="User" <?php echo (!empty($role) ? ($role == 'User' ? 'selected' : '') : (isset($getDataById['role']) && $getDataById['role'] == 'User' ? 'selected' : '')); ?> >User</option>
                                                <option value="Guest" <?php echo (!empty($role) ? ($role == 'Guest' ? 'selected' : '') : (isset($getDataById['role']) && $getDataById['role'] == 'Guest' ? 'selected' : '')); ?> >Guest</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!--  Active button  -->
                                        
                                        <div class="form-group">
                                            <div>
                                                <label for="">Status</label>
                                            </div>

                                            <div class="bg-secondary d-inline-block p-0 rounded-1">

                                                <input  class="active_btn" type="checkbox" name="is_active" data-toggle="toggle"
                                                    <?php echo ($getDataById['is_active'] == 1) ? "checked" : " " ?>>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- submit -->
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1">Submit</button>
                                        <button type="button" onclick="window.location.href='users.php'" class="btn btn-secondary mx-2 rounded-1">Cacnel</button>
                                        
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- END :: FORM -->
                    </div>
                    <!-- END :: BODY -->
                    <!-- body end  -->

                    <!-- partial:partials/_footer.html -->
                    <?php
            require_once('partials/footer.php');  
          ?>

                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper endss -->
        </div>
        <?php
        require_once('partials/footer-links.php');  
    ?>

<?php 
unset($_SESSION['form_data']);
?>     

</body>

</html>