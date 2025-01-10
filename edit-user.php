<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Edit';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE ?></title>
    <?php
      require_once('partials/head-links.php');
    ?>


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
                    <div class="container w-50">
                        <!-- BEGIN :: FORM -->
                        <form action="route.php" method="POST">
                                <input type="hidden" class="form-control" name="action" id="action" placeholder="Please enter your name" value="edit_user">

                                <!-- HIDDEN ID -->
                                <div class="form-group">
                                    <input required type="hidden" class="form-control" name="edit_serial_num" id="name" value="<?php echo $_POST['delete_serial_num'] ?>"
                                    placeholder="Name">
                                </div>

                                <!-- name  -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required type="text" class="form-control" name="name" id="name" value="<?php echo $_POST['user_name'] ?>"
                                    placeholder="Name">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input required readonly type="email" class="form-control" name="email" id="email" value="<?php echo $_POST['user_email'] ?>"
                                        placeholder="email">
                                </div>

                                
                                
                                <!-- submit -->
                            <button type="submit" class="btn btn-primary">Submit</button>

                                
                        </form>
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

</body>

</html>