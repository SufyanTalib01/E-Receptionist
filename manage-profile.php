<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Manage Profile';
  
  $id = $_SESSION['user_id'];
  $getDataById = $obj->db_get_data_by_id($id);
  $roles = $obj->db_getRoles();

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
    $role_name = $_SESSION['form_data']['role'];
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
                    <!-- BEGIN :: BODY  -->
                    <div class="container">
                        <div class="card">
                            <div class="card-header p-3">
                                Profile
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="action" id="action"
                                    placeholder="Please enter your name" value="manage_profile">

                                <!-- HIDDEN ID -->
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="edit_serial_num" id="name"
                                        value="<?php echo $getDataById['id'] ?>" placeholder="Name">
                                </div>

                                <!-- old image name  -->
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="old_image" id="name"
                                        value="<?php echo $getDataById['profile_picture'] ?>" placeholder="Name">
                                </div>



                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Full Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name"></i>
                                            <input required type="text" class="form-control" name="name" id="name"
                                                value="<?php echo isset($name) ? $name : $getDataById['name'] ?>" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- email -->
                                        <div class="form-group">
                                            <label for="email">Email address<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter email address"></i>
                                            <input required type="email" class="form-control" name="email" id="email"
                                                value="<?php echo isset($email) ? $email : $getDataById['email'] ?>" placeholder="email">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <!-- Profile Picture -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="image">Update Profile Picture</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="update your profile picture"></i>
                                            <input  type="file" accept="image/jpeg, image/png, image/gif" class="form-control" name="image" id="image">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    

                                    <!-- PROFILE IMAGE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <img width="180" id='show_profile_image' src="upload-images/<?php echo isset($getDataById['profile_picture']) ? $getDataById['profile_picture'] : 'user.jpg' ?>" class="img-thumbnail">
                                        </div>
                                    </div>  

                                </div>

                                <!-- submit -->
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- END :: FORM -->
                    </div>
                    <!-- END :: BODY -->

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

    require_once 'components/tostify-msg.php';
?>



</body>

</html>