<?php 

    require_once('DB.php'); 
  
    $users = $obj->getUsers();

    $module = 'Edit User';

?>





<!DOCTYPE html>
<html lang="en">

    <head>
        <title>
            <?php
                echo EDITUSER 
            ?>
        </title>

        <!--HEADER-LINKS -->
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
        <div class="container-fluid page-body-wrapper justify-content-center">
            <div class="main-panel">
                <div class="content-wrapper">
                
                    <div class="container w-50">
                        <?php
                            require_once('partials/page-header.php');  
                        ?>
                    </div>

                    <!-- body here  -->
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
                </div>

                <!-- FOOTER -->
                <?php
                    require_once('partials/footer.php');  
                ?>

            </div>
        </div>
    </div>
    
    <!-- FOOTER LINKS  -->
    <?php
        require_once('partials/footer-links.php');  
    ?>

</body>

</html>