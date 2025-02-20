<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- plugins:css -->
<link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="/assets/css/commom-style.css">
<!-- End layout styles -->
<link rel="shortcut icon" href="assets/images/favicon.png" />

<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

<!-- TOGGLE BUTTON CSS  -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>


<?php 
    $messageExists = null;
    if(isset($_SESSION['message'])){
        $messageExists = $_SESSION['message'];
        unset($_SESSION['message']);
    }

// check user login or not 
$current_page = basename($_SERVER['PHP_SELF']);

$excluded_pages = ['login.php', 'signup.php', 'forget-password.php', 'otp.php', 'new-password.php'];

if (!in_array($current_page, $excluded_pages)) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }
}

?>

