<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Users';


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
                    <div class="container w-50">
                        <!-- BEGIN :: FORM -->
                        <form action="route.php" method="POST">
                            <input type="hidden" class="form-control" name="action" id="name"
                                placeholder="Please enter your name" value="adduser">

                            <!-- name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" name="name" id="name"
                                    placeholder="enter name">
                            </div>

                            <!-- email -->
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input required type="email" class="form-control" name="email" id="email"
                                    placeholder="enter email">
                            </div>

                            <!-- password  -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" id="password"
                                    placeholder="enter password">
                            </div>

                            <!-- confirm password -->
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input required type="password" class="form-control" name="confirm_password" id="confirm_password"
                                    id="confirm_password" placeholder="Please enter same password">
                            </div>
                            

                            
                            <div class="form-group">
                                <label for="">Role</label>
                                <!-- roles selected -->
                                <select class="form-control form-control-sm" style="border-radius: 0">
                                    <option selected>Select Role</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <!-- <input required type="password" class="form-control" name="confirm_password"id="confirm_password" placeholder="Please enter same password"> -->

                            <!-- submit -->
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                        <!-- END :: FORM -->
                    </div>
                    <!-- END :: BODY -->
                    <!-- body end  -->
                
                <!-- partial:partials/_footer.html -->
                <?php
            require_once('partials/footer.php');  
          ?>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper endss -->
    </div>
    <?php
        require_once('partials/footer-links.php');  
    ?>

    <script>
    let deleteUser = document.getElementsByClassName('delete');
    Array.from(deleteUser).forEach((element) => {
        element.addEventListener("click", (e) => {
            e.preventDefault();
            let confirmation = confirm("Are you sure you want to delete this?");
            if (confirmation) {
                e.target.closest('form').submit();
            } else {
                console.log("Action canceled by the user.");
            }
        })
    });
    </script>
</body>

</html>