<?php 
    require_once('DB.php'); 
  
    $users = $obj->getUsers();

    $module = 'Forget Password';

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
                        <div class="card">
                            <div class="card-header p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Forget Password</span>
                                </div>
                            </div>


                            <div class="container py-3">
                                <!-- BEGIN :: FORM -->
                                <form action="/route.php" method="POST">
                            <input type="hidden" class="form-control" name="action" id="action"
                                placeholder="Please enter your name" value="forget">

                            <!-- email -->
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input required type="email" class="form-control" name="email" id="email"
                                    placeholder="Please enter your email">
                                <small id="emailHelp" class="form-text text-muted">
                                    We'll never share your email with anyone else.
                                </small>
                            </div>

                            <!-- submit -->
                            <button type="submit"  class="btn btn-primary">Submit</button>

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

