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

<?php 
        if(isset($messageExists)){?>
<script>
let msg = "<?php echo $messageExists ?>";
alert(msg);
</script> <?php
        }
    ?>

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
                                        <label for="name">Name</label>
                                        <input required type="text" class="form-control" name="name" id="name"
                                            placeholder="Name">
                                    </div>

                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input required type="email" class="form-control" name="email" id="email"
                                            placeholder="Please enter your email">
                                        <small id="emailHelp" class="form-text text-muted">
                                            We'll never share your email with anyone else.
                                        </small>
                                    </div>

                                    <!-- password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input required type="password" class="form-control" name="password"
                                            id="password" placeholder="Please enter your password">
                                    </div>

                                    <!-- confirm password -->
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input required type="password" class="form-control" name="confirm_password"
                                            id="confirm_password" placeholder="Please enter same password">
                                    </div>

                                    <!-- SELECT ROLE  -->
                                    <div class="form-group">
                                            <label for="">Role</label>
                                            <!-- role selected -->
                                            <select required class="form-control form-control-sm"
                                                style="border-radius: 0" name="role" id="role">
                                                <option selected  value="user">user</option>
                                            </select>
                                        </div>

                                    <!-- submit -->
                                    <button type="submit" class="btn btn-primary">Submit</button>

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
</body>

</html>