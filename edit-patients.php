<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Edit Patient';

  if(isset($_GET['id'])){
}else{
    header('location: patients.php');
}
  
  $id = $_GET['id'];
  $getPatientData = $obj->db_get_patients_data($id);
  $doctors = $obj->db_doctor_table_data();

?>

<!-- RETAIN FORM DATAA -->
<?php 
if(isset($_SESSION['form_data']['name'])){
    $name = $_SESSION['form_data']['name'];
}
if(isset($_SESSION['form_data']['father_name'])){
    $fatherName = $_SESSION['form_data']['father_name'];
}
if(isset($_SESSION['form_data']['age'])){
    $age = $_SESSION['form_data']['age'];
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
                                Edit Patient
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4" >
                                <input type="hidden" class="form-control" name="action" id="action"
                                    placeholder="Please enter your name" value="edit_patient">

                                <!-- HIDDEN ID -->
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="id" id="name"
                                        value="<?php echo $getPatientData['id'] ?>" placeholder="Name">
                                </div>

                                


                                <div class="row">
                                    <!-- NAME  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name"></i>
                                            <input required type="text" class="form-control" name="name" id="name"
                                                value="<?php echo isset($name) ? $name : $getPatientData['name'] ?>" placeholder="Name">
                                        </div>
                                    </div>
                                    <!-- FATHER NAME  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Father/Guardian Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter full name of father/Guardian"></i>
                                            <input required type="text" class="form-control" name="father_name" value="<?php echo isset($fatherName) ? $fatherName : $getPatientData['father_name'] ?>" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <!-- Age  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Age<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter Age"></i>
                                            <input required type="number" class="form-control" name="age" value="<?php echo isset($age) ? $age : $getPatientData['age'] ?>" placeholder="30">
                                        </div>
                                    </div>
                                    
                                    <!-- SELECT ROLE  -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Doctor<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter roll"></i>
                                            <!-- roles selected -->
                                            <select required class="form-control form-control-sm" style="border-radius: 0" name="select">
                                                <option selected disabled value="">Select Doctor</option>
                                                <?php if(!empty($doctors)){
                                                    foreach ($doctors as $doctor){
                                                    ?>
                                                    <option value="<?php echo $doctor['id'] ?>" <?php echo (isset($getPatientData['id']) && $doctor['id'] === $getPatientData['doctor_id']) ? 'Selected' : ''; ?>><?php echo $doctor['name']?> (<?php echo $doctor['fee'] ?>)</option>
                                                  <?php  }  
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    

                                </div>

                                <!-- submit -->
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Submit</button>
                                        <button type="button" onclick="window.location.href='patients.php'" class="btn btn-secondary mx-2 rounded-1 btn-sm">Cancel</button>
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