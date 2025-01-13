<?php 
    require_once('DB.php'); 
  
    $users = $obj->getUsers();

    $module = 'OTP';

    $email = isset($_GET['email']) ? $_GET['email'] : '';

    // $obj->debug($email);

    // if email is not set, then redirect to the forgot password page.

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

<?php 
    
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
                        <div class="card">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Forget Password</span>
                                </div>
                            </div>


                            <div class="container">
                                <!-- BEGIN :: FORM -->
                                <form action="route.php" method="POST">
                                <input type="hidden" class="form-control" name="action" id="action" placeholder="Please enter your name" value="otp">

                                <!-- email -->
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="email" id="email" value="<?php echo $email?>"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="otp">OTP</label>
                                    <input required type="text" class="form-control" name="otp" id="otp"
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