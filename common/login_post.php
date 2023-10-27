<?php 

    session_start();
    
    require_once('../db.php');

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $checking_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";


    $from_db = mysqli_query(db_connect(), $checking_query);

    if (mysqli_num_rows($from_db) == 1) {
        
        $row = mysqli_fetch_assoc($from_db);

        $_SESSION['user'] = array(
            'id' => $row['id'],
            'f_name' => $row['f_name'],
            'l_name' => $row['l_name'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'u_type' => $row['u_type']
        );
        $_SESSION['user_status'] = "yes";

        if ($row['u_type'] == "admin") {
            $_SESSION['is_admin'] = "yes";
            header('location: ../admin/index.php');
        }
        else {
            $_SESSION['is_admin'] = "no";
            header('location: ../index.php');
        }

    }else {
        $_SESSION['login_error'] = "Your Credentials are wrong or register!";
        header('location: login.php');
    }

?>