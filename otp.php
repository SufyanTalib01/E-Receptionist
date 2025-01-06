<?php 
    require_once('DB.php'); 
  
    $users = $obj->getUsers();

    $module = 'OTP';

?>





<!DOCTYPE html>
<html lang="en">

    <head>
        <title>
            <?php
                echo LOGIN 
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
                        <form action="otp.php" method="POST">
                                <input type="hidden" class="form-control" name="action" id="action" placeholder="Please enter your name" value="forget">

                                <!-- email -->
                                <div class="form-group">
                                    <label for="email">OTP</label>
                                    <input required type="email" class="form-control" name="email" id="email"
                                        placeholder="Please enter your OTP">
                                </div>

                                <!-- submit -->
                                <button type="submit" class="btn btn-primary">Submit</button>

                                <!-- login path -->
                                <p class="mt-2">
                                    create a new account?
                                    <a href="/signup.php">
                                        Signup
                                    </a>
                                </p>
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