<?php 
  require_once('DB.php'); 
  $users = $obj->getUsers();
  $module = 'Create User';
  $roles = $obj->db_getRoles();
  $permission = 'create user';
    $flag = $obj->db_has_user_permission($permission);
    if($flag){
    }else{
        header('location: unauthorized.php');
    }
?>
<!-- RETAIN FORM DATAA -->
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
                                Create a new user
                            </div>
                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="action" id="name"
                                    placeholder="Please enter your name" value="adduser">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Full Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name"></i>
                                            <input required type="text" class="form-control" name="name" id="name" placeholder="John Doe" value="<?php echo (isset($name)) ? $name : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- email -->
                                        <div class="form-group">
                                            <label for="email">Email address<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter email address"></i>
                                            <input required type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" value="<?php echo (isset($email)) ? $email : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- password  -->
                                        <div class="form-group">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter password"></i>
                                            <input required type="password" class="form-control" name="password" id="password" placeholder="enter password" value="<?php echo (isset($password)) ? $password : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- confirm password -->
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter confirm password"></i>
                                            <input required type="password" class="form-control" name="confirm_password" id="confirm_password" id="confirm_password" placeholder="Please enter same password" value="<?php echo (isset($confirmPassword)) ? $confirmPassword : '' ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- SELECT ROLE  -->
                                        <div class="form-group">
                                            <label for="">Role<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter roll"></i>
                                            <!-- roles selected -->
                                            <select required class="form-control form-control-sm" style="border-radius: 0" name="role" id="roles">
                                                <option selected disabled value="">Select Role</option>
                                                <?php if(!empty($roles)){
                                                    foreach ($roles as $role){
                                                    ?>
                                                    <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                                                  <?php  }  
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- upload Profile Picture -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="image">Upload Profile Picture</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="upload your profile picture"></i>
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

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Submit</button>
                                        <button type="button" onclick="window.history.back()" class="btn btn-secondary mx-2 rounded-1 btn-sm">Cancel</button>
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
            </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper endss -->
        </div>
<?php
    require_once('partials/footer-links.php');  
?>
<?php 
    require_once 'components/tostify-msg.php';
?>
</body>

</html>