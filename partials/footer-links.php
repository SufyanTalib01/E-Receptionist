<!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
     <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
     <script>
        let table = new DataTable('#myTable');
     </script>

     <!-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });
    </script> -->

     <!-- FONT AWESOME  -->
     <script src="https://kit.fontawesome.com/b69ee90ce9.js" crossorigin="anonymous"></script>

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


   <!-- TOGGLE BUTTON JS  -->
   <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

   <!-- jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<!-- toaster  -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>          
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="assets/js/common.js"></script>


<!-- tooltip i icon  -->
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- Tostify messageee  -->
<?php if(isset($messageExists)){ ?>
    <script type="text/javascript">
    $(document).ready(function() {
        toastr.options.timeOut = 1500; // 1.5s
        <?php if($messageExists == 'account deleted' || $messageExists == 'Role deleted'){ ?>
        toastr.error('<?php echo $messageExists ?>');
    <?php }else if($messageExists == 'Account created! please login' || $messageExists ==  'User Added' || $messageExists ==  'User Edited' || $messageExists == 'Login Successfully'){?>  
        toastr.success('<?php echo $messageExists ?>');
    <?php }
    else{ ?>
        toastr.info('<?php echo $messageExists ?>');
        <?php } ?>
    });
    </script>
<?php } ?>