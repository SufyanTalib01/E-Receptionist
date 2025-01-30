<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Edit Role';
  
  $id = $_GET['id'];
  $rolesDataById = $obj->db_get_roles_data_by_id($id);
  $roles = $obj->db_getRoles();

  $permissions = $obj->getPermissions();


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
                                Edit Role
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="action" id="action"
                                    placeholder="Please enter your name" value="edit_role_permissions">

                                <!-- HIDDEN ID -->
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="roles_id" id="name"
                                        value="<?php echo $rolesDataById['id'] ?>" placeholder="Name">
                                </div>

                                



                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name"></i>
                                            <input required type="text" class="form-control" name="name" id="name"
                                                value="<?php echo isset($name) ? $name : $rolesDataById['name'] ?>" placeholder="Name">
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <!-- edit roles permission  -->
                                        <div class="container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="5%" scope="col">#</th>
                                                        <th scope="col">Modules</th>
                                                        <th width="5%" scope="col">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                $sno = 1;
                                                if(!empty($permissions)){
                                                    foreach ($permissions as $permission){
                                                        $id = $permission['id'];
                                                        ?>
                                                    <tr>
                                                        <!-- sno  -->
                                                        <th scope="row"> <?php echo $sno++ ?> </th>
                                                        <!-- name  -->
                                                        <td> <?php echo  $permission['name'] ?>  </td>
                                                        <!-- Action  -->
                                                        
                                                        <!-- Active button  -->
                                                        <td>
                                                            <div class="bg-secondary d-inline-block p-0 rounded-1">
                                                            <input  class="active_btn" type="hidden" name="is_active[<?php echo $id ?>]" value="off" data-toggle="toggle">
                                                            <input  class="active_btn" type="checkbox" name="is_active[<?php echo $id ?>]" data-toggle="toggle">
                                                        </div>  
                                                </td>
                                                    </tr>
                                                    <?php }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                </div>

                                <!-- submit -->
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Submit</button>
                                        <button type="button" onclick="window.location.href='list-role-permissions.php'" class="btn btn-secondary mx-2 rounded-1 btn-sm">Cancel</button>
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