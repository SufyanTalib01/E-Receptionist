<?php 
  require_once('DB.php'); 
  $permission = 'create user';
    $flag = $obj->db_has_user_permission($permission);
    if($flag){
    }else{
        header('location: unauthorized.php');
    }

  $module = 'Add Doctor';
  $doctors = $obj->db_doctor_table_data();
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
                                Add a new Doctor
                            </div>
                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4">
                                <input type="hidden" class="form-control" name="action"
                                    value="add_doctor">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Full Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name"></i>
                                            <input required type="text" class="form-control" name="name" id="name" placeholder="John Doe" >
                                        </div>
                                    </div>
                                    <!-- FATHER NAME  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Father/Guardian Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name of father/Guardian"></i>
                                            <input required type="text" class="form-control" name="father_name" id="name" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <!-- Doctor Specialist  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Specialist<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter the specialist"></i>
                                            <input required type="text" class="form-control" name="specialist"  placeholder="Sycolopedia">
                                        </div>
                                    </div>
                                    <!-- Doctor Fee  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Fee<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter fee"></i>
                                            <input required type="number" class="form-control" name="fee" placeholder="500">
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