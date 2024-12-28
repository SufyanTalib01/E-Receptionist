<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();

  $signUp = $obj->signUp();
  
  $module = 'Sign up';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE ?></title>
    <?php
      require_once('partials/head-links.php');
    ?>

    <style>
    table.dataTable th.dt-type-numeric,
    table.dataTable th.dt-type-date,
    table.dataTable td.dt-type-numeric,
    table.dataTable td.dt-type-date {
        text-align: left !important;
    }

    .page-body-wrapper{
      min-height: calc(100vh) !important;
    }
    .main-panel{
      width: calc(100%) !important;
    }
    
    </style>
</head>

<body style="background-color: #F2EDF3;">

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
                    <form action="/signup.php" method="POST">
                    <div class="form-group">
                            <label for="s-name">Name</label>
                            <input type="text" class="form-control" name="s-name" id="s-name"
                                placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="s-email">Email address</label>
                            <input type="email" name="s-email" class="form-control" id="s-email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="s-password">Password</label>
                            <input type="password" class="form-control" name="s-password" id="s-password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="s-cpassword">Confirm Password</label>
                            <input type="password" class="form-control" name="s-cpassword" id="s-cpassword"
                                placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <p class="mt-2">Have you already account? <a href="/login.php">Login</a></p>
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