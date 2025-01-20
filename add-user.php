<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Create User';


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
                    <div class="container">
                        <div class="card">
                            <div class="card-header p-3">
                                Create a new user
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="action" id="name"
                                    placeholder="Please enter your name" value="adduser">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input required type="text" class="form-control" name="name" id="name" placeholder="enter name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- email -->
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input required type="email" class="form-control" name="email" id="email" placeholder="enter email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- password  -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input required type="password" class="form-control" name="password" id="password" placeholder="enter password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- confirm password -->
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input required type="password" class="form-control" name="confirm_password" id="confirm_password" id="confirm_password" placeholder="Please enter same password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <!-- SELECT ROLE  -->
                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <!-- roles selected -->
                                            <select required class="form-control form-control-sm" style="border-radius: 0" name="role" id="roles">
                                                <option selected disabled value="">Select Role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Moderator">Moderator</option>
                                                <option value="User">User</option>
                                                <option value="Guest">Guest</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Profile Picture -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="image">Upload Profile Picture</label>
                                            <input  type="file" accept="image/jpeg, image/png, image/gif" class="form-control" name="image" id="image">
                                        </div>
                                    </div>

                                </div>

                                <!-- submit -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1">Submit</button>
                                        <button type="button" onclick="window.history.back()" class="btn btn-secondary mx-2 rounded-1">Cacnel</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- END :: FORM -->
                    </div>
                    <!-- END :: BODY -->
                    <!-- body end  -->

                    <!-- partial:partials/_footer.html -->
            <?php
                require_once('partials/footer.php');  
            ?>
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