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

                    <!-- Table  -->
                    <div class="container">
                        <div class="card">
                            <div class="card-header p-3">
                                <div class="row">
                                    <div class="col">
                                        List
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary">Add user</button>
                                    </div>
                                </div>
                            </div>


                            <div class="container">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">sno</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                    $sno = 1;
                                    if(!empty($users)){
                                        foreach ($users as $user){
                                            ?>
                                        <tr>
                                            <th scope="row"> <?php echo $sno++ ?> </th>
                                            <td> <?php echo $user['name'] ?> </td>
                                            <td> <?php echo $user['email'] ?> </td>
                                            <td>
                                                <div class="btn-toolbar" role="toolbar"
                                                    aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <form action="edit-user.php" method="post">
                                                            <input type="hidden" name="action" value="edit_user">
                                                            <input type="hidden" name="delete_serial_num" value="<?php echo $user['sno'] ?>">
                                                            <input type="hidden" name="user_name"value="<?php echo $user['name'] ?>">
                                                            <input type="hidden" name="user_email"value="<?php echo $user['email'] ?>">
                                                            <button class="btn btn-primary btn-sm btn-info"type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        </form>
                                                        <form id="delete_user_form" action="route.php" method="post">
                                                            <input type="hidden" name="action" value="delete_user">
                                                            <input type="hidden" name="delete_serial_num"value="<?php echo $user['sno'] ?>">
                                                            <button class="delete btn btn-primary btn-sm btn-danger mx-1"type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                            <div class="col p-0">
                                                <form action="edit-user.php" method="post">
                                                    <input type="hidden" name="action" value="edit_user">
                                                    <input type="hidden" name="delete_serial_num"
                                                    value="<?php echo $user['sno'] ?>">
                                                    <input type="hidden" name="user_name" value="<?php echo $user['name'] ?>">
                                                    <input type="hidden" name="user_email" value="<?php echo $user['email'] ?>">
                                                    <button class="btn btn-primary btn-sm btn-info" type="submit">Edit</button>
                                                </form>
                                            </div>
                                            <div class="col p-0">
                                                <form id="delete_user_form" action="route.php" method="post">
                                                    <input type="hidden" name="action" value="delete_user">
                                                    <input type="hidden" name="delete_serial_num"
                                                    value="<?php echo $user['sno'] ?>">
                                                    <button class="delete btn btn-primary btn-sm btn-danger"
                                                        type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div> -->
                                            </td>
                                        </tr>
                                        <?php }
                                }
                                ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- content-wrapper ends -->
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