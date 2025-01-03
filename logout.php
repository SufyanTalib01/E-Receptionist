<?php 
    require_once('DB.php'); 

    session_unset();
    session_destroy();

    session_start();
    $_SESSION['message'] = 'Logout Successfully';
    header('location: login.php');
?>