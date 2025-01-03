<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();

  $module = 'Login';

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo LOGIN ?></title>
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



        <!-- partial -->

        <div class="container-fluid page-body-wrapper justify-content-center">
            <!-- partial:partials/_sidebar.html -->

            <!-- partial -->
            <div class="main-panel">


                <div class="content-wrapper">
                
                    <div class="container w-50">
                        <?php
                    require_once('partials/page-header.php');  
                  ?>
                    </div>
                    <!-- body here  -->


                    <div class="container w-50">
                        <form>
                            

                            <div class="form-group">
                                <label for="s-email">Email address</label>
                                <input type="email" name="s-email" class="form-control" id="s-email"
                                    aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone
                                    else.</small>
                            </div>
                            <div class="form-group">
                                <label for="s-password">Password</label>
                                <input type="password" class="form-control" name="s-password" id="s-password"
                                    placeholder="Password">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <p class="mt-2">Register for new account <a href="/signup.php">Signup!</a></p>
                        </form>
                    </div>

                </div>

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