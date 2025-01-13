<?php 
    require_once('DB.php'); 

    $users = $obj->getUsers();
    
    $module = 'Add User';
?>

<!DOCTYPE html>
<html lang="en">

<!-- BEGIN :: HEAD  -->


<head>
    <title>
        <?php
            echo ADDUSER 
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
    </script> 
<?php
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