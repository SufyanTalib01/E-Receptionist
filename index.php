<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();


  $module = 'Dashboard';

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
                    <!-- body here  -->
                    
                    <!-- Table  -->
                    
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php
                require_once('partials/footer.php');  
                ?>

                <!-- partial -->
             </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php
        require_once('partials/footer-links.php');  
      ?>
      
</body>

</html>