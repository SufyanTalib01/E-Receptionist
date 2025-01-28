<?php 
  require_once('DB.php'); 
  
  $users = $obj->getUsers();
  $module = 'Create Role';

  $permissions = $obj->getPermissions();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo TITLE ?></title>
    <?php
      require_once('partials/head-links.php');
    ?>

<style>
        .toggle.btn.btn-primary {
        width: 130px !important; /* Set your desired width */
        height: 42px !important;
    }
    .toggle.btn.btn-default.off {
        width: 130px !important; /* Set your desired width */
        height: 42px !important;
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
                    <!-- BEGIN :: BODY  -->
                    <div class="container">
                        <div class="card">
                            <div class="card-header p-3">
                                Create a new Role
                            </div>

                            <!-- BEGIN :: FORM -->
                            <form action="route.php" method="POST" class="m-4">
                                <input type="hidden" class="form-control" name="action" id="name"
                                    placeholder="Please enter your name" value="create_roles">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">Role Name<span class="text-danger">*</span></label>
                                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="right" title="Please enter the name of the new role"></i>
                                            <input required  type="text" class="form-control" name="name" id="name" placeholder="Editor">
                                        </div>
                                    </div>
                                </div>

                                <div class="container my-4">
                                    <div class="card">
                                        <div class="card-header p-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>Permissions</span>
                                                
                                            </div>
                                        </div>


                                        <div class="container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th width="5%" scope="col">#</th>
                                                        <th scope="col">Permissions</th>
                                                        <th width="5%" scope="col">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                $sno = 1;
                                                if(!empty($permissions)){
                                                    foreach ($permissions as $permission){
                                                        $id = $permission['id'];
                                                        ?>
                                                    <tr>
                                                        <!-- sno  -->
                                                        <th scope="row"> <?php echo $sno++ ?> </th>
                                                        <!-- name  -->
                                                        <td> <?php echo  $permission['name'] ?>  </td>
                                                        <!-- Action  -->
                                                        <td><!-- Active button  -->
                                                            <div class="bg-secondary d-inline-block p-0 rounded-1">
                                                            <input  class="active_btn" type="hidden" name="is_active[<?php echo $id ?>]" value="off" data-toggle="toggle">
                                                            <input  class="active_btn" type="checkbox" name="is_active[<?php echo $id ?>]" data-toggle="toggle">
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

                                

                                <!-- submit -->

                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="submit" class="btn btn-primary rounded-1 btn-sm">Submit</button>
                                        <button type="button" onclick="window.history.back()" class="btn btn-secondary mx-2 rounded-1 btn-sm">Cancel</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- END :: FORM -->
                    </div>

                    
                    <!-- END :: BODY -->
                    

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