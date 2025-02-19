<?php 
    require_once('DB.php'); 

    $permission = 'list users';
    $flag = $obj->db_has_user_permission($permission);

    if($flag){

    }else{
        header('location: unauthorized.php');
    }
    $patients = $obj->db_patients_table_data();
    
    $roles = $obj->db_getRoles();
    $module = 'Patients';
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>List</span>
                                    <div>
                                    <a href="/export-data.php"><button class="btn btn-primary btn-sm">Export Data <i class="fa-solid fa-file-export"></i></button></a>
                                    <a href="/add-patient.php"><button class="btn btn-primary btn-sm">Add <i  class="fa-solid fa-plus fs-6"></i></button></a>
                                    </div>
                                </div>
                            </div>


                            <div class="container">
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="5%" scope="col">#</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Father Name</th>
                                            <th scope="col">Doctor Name</th>
                                            <th scope="col">Doctor Fees</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Status</th>
                                            <th  width="5%" scope="col">Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                    $sno = 1;
                                    if(!empty($patients)){
                                        foreach ($patients as $patient){
                                            ?>
                                        <tr>
                                            <!-- sno  -->
                                            <th scope="row"> <?php echo $sno++ ?> </th>
                                            <!-- name  -->
                                            <td> <?php echo  $patient['name'] ?>  </td>
                                            <!-- Father name  -->
                                            <td> <?php echo  $patient['father_name'] ?>  </td>
                                            
                                            <!-- doctor name  -->
                                            <td> <?php echo $patient['doctor_name'] ?> </td>
                                            <!-- Doctor Fees  -->
                                            <td> <?php echo  $patient['fee'] ?> </td>
                                            <!-- Created By  -->
                                            <td> <?php echo  $patient['created_by'] ?> </td>
                                            
                                            <!-- status  -->
                                            <td><span class="badge <?php echo ($patient['status'] == 1) ? "badge-primary" : "badge-secondary" ?>"><?php echo ($patient['status'] == 1) ? "Visit" : "Visited" ?></span></td>
                                            <!-- edit button  -->
                                            <td>
                                                <div class="btn-toolbar" role="toolbar"
                                                    aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <form action="edit-patients.php?id=<?php echo $patient['id'] ?>" method="post">
                                                            <!-- edit ID  -->
                                                            <input type="hidden" name="action" value="edit_patient">
                                                            
                                                            <button class="btn btn-primary btn-sm btn-info"type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        </form>

                                                        <!-- delete button  -->
                                                        <form id="delete_user_form" action="route.php" method="post">
                                                            <input type="hidden" name="action" value="delete_patient">
                                                            <input type="hidden" name="delete_serial_num"value="<?php echo $patient['id'] ?>">
                                                            <button class="delete btn btn-primary btn-sm btn-danger mx-1"type="submit"><i class="fa-solid fa-trash"></i></button>
                                                        </form>


                                                        <!-- Print PDF  -->
                                                        <form action="duplicate_pdf.php" method="post">
                                                            <input type="hidden" value="<?php echo $patient['id'] ?>" name="id">
                                                            <button class="btn btn-primary btn-sm btn-dark"type="submit"><i class="fa-solid fa-print"></i></button>
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