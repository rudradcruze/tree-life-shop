<?php
    session_start();
    if(!isset($_SESSION['user_status']) || $_SESSION['is_admin'] != "yes"){
        header('location: ../common/login.php');
    }
?>