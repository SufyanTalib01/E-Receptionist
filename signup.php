<?php 
    require_once('DB.php'); 

    $users = $obj->getUsers();
    
    $module = 'Sign up';
?>

<!DOCTYPE html>
<html lang="en">

<!-- BEGIN :: HEAD  -->


<head>
    <title>
        <?php
                echo SIGN_UP 
            ?>
    </title>
    <!-- HEAD LINKS -->
    <?php
            require_once('partials/head-links.php');
        ?>
</head>

    

<body style="background-color: #F2EDF3;">

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper justify-content-center">
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="container w-50">
                        <!-- PAGE HEADER  -->
                        <?php
                                require_once('partials/page-header.php');  
                            ?>
                    </div>

                    <!-- BEGIN :: BODY  -->

                    <div class="container w-50">
                        <div class="card">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Sign Up Form</span>
                                </div>
                            </div>


                            <div class="container py-3">
                                <form action="route.php" method="POST">
                                    <input type="hidden" class="form-control" name="action" id="name"
                                        placeholder="Please enter your name" value="signup">

                                    <!-- name -->
                                    <div class="form-group">
                                        <label for="name">Full Name<span class="text-danger">*</span></label>
                                        <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter your first and last name."></i>
                                        <input required type="text" class="form-control" name="name" id="name"
                                            placeholder="John Doe">
                                    </div>

                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="email">Email address<span class="text-danger">*</span></label>
                                        <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter your email address"></i>
                                        <input required type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com">
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your email with anyone else.
                                        </small>
                                    </div>

                                    <!-- password -->
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter your password"></i>
                                        <input required type="password" class="form-control" name="password" id="password" placeholder="password">
                                    </div>

                                    <!-- confirm password -->
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                        <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter same password again"></i>
                                        <input required type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="confirm password">
                                    </div>

                                    
                                    <!-- submit -->
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>

                                    <!-- login path -->
                                    <p class="mt-2">
                                        Have you already account?
                                        <a href="/login.php">
                                            Login
                                        </a>
                                    </p>
                                </form>
                            </div>

                        </div>
                    </div>



                    <!-- END :: BODY -->
                </div>
                <!-- Footer  -->
                <?php
                    require_once('partials/footer.php');
                ?>
            </div>
        </div>
    </div>
    <!-- Footer Links  -->
    <?php
        require_once('partials/footer-links.php');  
    ?>



<?php 
    require_once 'components/tostify-msg.php';
?>
</body>

</html>