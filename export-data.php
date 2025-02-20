<?php 
  require_once('DB.php'); 
  $permission = 'create user';
    $flag = $obj->db_has_user_permission($permission);
    if($flag){
    }else{
        header('location: unauthorized.php');
    }
  $module = 'Generate Report'; 

  $users = $obj->getUsers();
?>

<?php 
    if(isset($_SESSION['new_message'])){
        $newMsg = $_SESSION['new_message'];
        ?>
        <script>
            alert("<?php echo $newMsg ?>");
        </script>
        <?php
        unset($_SESSION['new_message']);
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
                                Create Report
                            </div>
                            <!-- BEGIN :: FORM -->
                            <form action="total-report.php" method="POST" class="m-4">
                                <div class="row">
                                    <!-- START DATE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Start Date<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="enter start date"></i>
                                            <input required type="date" class="form-control" name="start_date" id="start_date" placeholder="John Doe" value="<?php echo isset($startDate) ? $startDate : '' ?>">
                                        </div>
                                    </div>
                                    <!-- END DATE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">End Date<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="enter end date"></i>
                                            <input required type="date" class="form-control" name="end_date" placeholder="John Doe" value="<?php echo isset($endDate) ? $endDate : '' ?>">
                                        </div>
                                    </div>
                                    <!-- User List  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">By User<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter roll"></i>
                                            <!-- roles selected -->
                                            <select required class="form-control form-control-sm" style="border-radius: 0" name="select">
                                                <option selected value="all_users">All Users</option>
                                                <?php if(!empty($users)){
                                                    foreach ($users as $user){
                                                    ?>
                                                    <option value="<?php echo $user['name'] ?>" ><?php echo $user['name']?></option>
                                                  <?php  }  
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- submit -->
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Generate</button>
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