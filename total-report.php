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
?>
<?php 
    $hasData = $obj->db_generate_report($_POST);

    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
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
                            <form action="/route.php" method="POST" class="m-4">
                                <div class="row">
                                    <!-- Hidden data  -->
                                     <input type="hidden" name="action" value="generate-pdf-excel">
                                     <input readonly type="hidden" value="<?php echo $_POST['select'] ?>" name="select">
                                     <input readonly type="hidden" value="<?php echo $_POST['select_doctor'] ?>" name="select_doctor">
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
                                        <input required readonly type="text" class="form-control" name="total_patients" placeholder="" value="<?php echo isset($hasData) ? $hasData['total_patients'] : '' ?>">
                                    </div>
                                    </div>
                                    <!-- TOTAL AMOUNTT  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Total Amount</label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Total Amount"></i>
                                            <input required readonly type="text" class="form-control" name="total_amounts" placeholder="" value="<?php echo (isset($hasData) && !empty($hasData['total_amount'])) ? $hasData['total_amount'] : '0' ?>">
                                        </div>
                                    </div>
                                    <!-- GENERATE PDF -->
                                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit"  name = "generate" value="pdf" class="btn btn-primary rounded-1 btn-sm">Generate Pdf</button>
                                        <button type="submit" name = "generate" value="excel" class="btn btn-primary rounded-1 btn-sm mx-2">Generate Excel Sheet</button>
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