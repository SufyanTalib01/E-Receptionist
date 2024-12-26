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

    <style>
        table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date, table.dataTable td.dt-type-numeric, table.dataTable td.dt-type-date{
            text-align: left !important;
        }
    </style>
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
                    <div class="card p-4">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">sno</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 $sno = 1;
                                 if(!empty($users)){
                                    foreach ($users as $user){
                                        echo '<tr>
                                            <th scope="row"> ' . $sno++ .'</th>
                                            <td> '.$user['fname'].' </td>
                                            <td> '. $user['lname'].'</td>
                                            <td> '. $user['email'] .' </td>
                                        </tr>';
                                    }
                                 }
                                ?>
                        </tbody>
                    </table>
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
        <!-- page-body-wrapper ends -->
    </div>
    <?php
        require_once('partials/footer-links.php');  
      ?>
</body>

</html>