<?php
    session_start();
    unset($_SESSION['user_status']);
    unset($_SESSION['is_admin']);
    header('location: login.php');
?>