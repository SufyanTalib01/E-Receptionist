<?php 
    require_once('DB.php'); 

    $permission = 'list users';
    $flag = $obj->db_has_user_permission($permission);

    if($flag){
    }else{
        header('location: unauthorized.php');
    }
    
    
    $doctors = $obj->db_doctor_table_data();
    $module = 'Doctors';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE ?></title>
    <?php
      require_once('partials/head-links.php');
    ?>


</head>



<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbarr.html -->
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>List</span>
                                    <a href="/add-doctors.php"><button class="btn btn-primary btn-sm">Add <i  class="fa-solid fa-plus fs-6"></i></button></a>
                                </div>
                            </div>


                            <div class="container">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="5%" scope="col">#</th>
                                            <th scope="col">Doctor Name</th>
                                            <th scope="col">Doctor Specialist</th>
                                            <th scope="col">Doctor fee</th>
                                            <th  width="5%" scope="col">Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                    $sno = 1;
                                    if(!empty($doctors)){
                                        foreach ($doctors as $doctor){
                                            ?>
                                        <tr>
                                            <!-- sno  -->
                                            <th scope="row"> <?php echo $sno++ ?> </th>
                                            <!-- name  -->
                                            <td> <?php echo  $doctor['name'] ?>  </td>
                                            <!-- name  -->
                                            <td> <?php echo  $doctor['specialist'] ?>  </td>
                                            <!-- email  -->
                                            <td> <?php echo $doctor['fee'] ?> </td>
                                            
                                            

                                            <!-- edit button  -->
                                            <td>
                                                <div class="btn-toolbar" role="toolbar"
                                                    aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <form action="edit-doctor.php?id=<?php echo $doctor['id'] ?>" method="post">
                                                            <button class="btn btn-primary btn-sm btn-info"type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        </form>

                                                        <!-- delete button  -->
                                                        <form id="delete_user_form" action="route.php" method="post">
                                                            <input type="hidden" name="action" value="delete_doctor">
                                                            <input type="hidden" name="delete_serial_num"value="<?php echo $doctor['id'] ?>">
                                                            <button class="delete btn btn-primary btn-sm btn-danger mx-1"type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                
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

<?php 
    require_once 'components/tostify-msg.php';
?>
</body>

</html>