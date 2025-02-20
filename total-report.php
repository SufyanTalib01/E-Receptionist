<?php 
  require_once('DB.php'); 
  $permission = 'create user';
    $flag = $obj->db_has_user_permission($permission);
    if($flag){
    }else{
        header('location: unauthorized.php');
    }
  $module = 'Report';
?>

<?php 
    if($_POST){
    }else{
        header('location: export-data.php');
    }
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $select = $_POST['select'];
    $hasData = $obj->db_generate_report($startDate , $endDate , $select);
?>

<?php 
    if(strtotime($startDate) > strtotime($endDate)){
        $_SESSION['new_message'] = 'Start Date must be earlier than End Date.';
        header('location: export-data.php');
    }else{
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
                                Report
                            </div>
                            <!-- BEGIN :: FORM -->
                            <form class="m-4">
                               
                                <div class="row">
                                    <!-- START DATE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Start Date</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="start date"></i>
                                            <input required readonly type="text" class="form-control" name="start_date" id="start_date" placeholder="14/2/2010" value="<?php echo isset($startDate) ? $startDate : '' ?>">
                                        </div>
                                    </div>
                                    <!-- END DATE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">End Date</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="end date"></i>
                                            <input required readonly type="text" class="form-control" name="end_date" placeholder="14/2/2013" value="<?php echo isset($endDate) ? $endDate : '' ?>">
                                        </div>
                                    </div>
                                    <!-- TOTAL PATIENTS  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Total Patients</label>
                                        <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Total Patients"></i>
                                        <input required readonly type="text" class="form-control" name="end_date" placeholder="" value="<?php echo isset($hasData) ? $hasData['total_patients'] : '' ?>">
                                    </div>
                                    </div>
                                    <!-- TOTAL AMOUNT  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Total Amount</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Total Amount"></i>
                                            <input required readonly type="text" class="form-control" name="end_date" placeholder="" value="<?php echo isset($hasData) ? $hasData['total_amount'] : '0' ?>">
                                        </div>
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