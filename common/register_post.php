<?php

session_start();
require_once('../db.php');

if (isset($_POST['submit'])) {

    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $numberNumber = $_POST['numberNumber'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Password Validation
    $password_cap = preg_match('@[A-Z]@', $password);
    $password_low = preg_match('@[a-z]@', $password);
    $password_num = preg_match('@[0-9]@', $password);
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $password_char = preg_match($pattern, $password);

    $validate_email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($firstName != null && $lastName != null && $numberNumber != null && $email != null && $password != null) {

        $first_name_check = preg_match('@[A-Z]@', $firstName);
        $first_name_check_num = preg_match('@[0-9]@', $firstName);
        $first_name_check_pattern = preg_match($pattern, $firstName);

        if($first_name_check == 1 && $first_name_check_num == 0 && $first_name_check_pattern == 0){

            $last_name_check = preg_match('@[A-Z]@', $lastName);
            $last_name_check_num = preg_match('@[0-9]@', $lastName);
            $last_name_check_pattern = preg_match($pattern, $lastName);

            if ($last_name_check == 1 && $last_name_check_num == 0 && $last_name_check_pattern == 0) {
                
                $number_number_match = preg_match('@[0-9]@', $numberNumber);

                if (strlen($numberNumber) == 11 && $number_number_match == 1 && $numberNumber[0] == 0 && $numberNumber[1] == 1) {

                    if ($validate_email) {

                        if (strlen($password) > 5 && $password_cap == 1 && $password_low == 1 && $password_num == 1 && $password_char == 1) {

                            $encrypted_password = md5($password);
                            
                            $checking_Query = "SELECT COUNT(*) AS check_user FROM users WHERE email = '$validate_email'";
                            $checking_db_result = mysqli_query(db_connect(), $checking_Query);
            
                            $checking_fetch_result = mysqli_fetch_assoc($checking_db_result);
            
                            if ($checking_fetch_result['check_user'] == 0) {
                                
                                $insert_query = "INSERT INTO users (f_name, l_name, mobile, email, password, u_type) VALUES ('$firstName', '$lastName', '$numberNumber', '$email', '$encrypted_password', 'user')";
            
                                mysqli_query(db_connect(), $insert_query);
                                $_SESSION['suss_msg'] = "Congratulation! You Successfully Registered.";
                                header('location: register.php');

                            } else {
                                $_SESSION['err_msg'] = "The user is already excised. You can't register";
                                header('location: register.php');
                            }
                        } else {
                            $_SESSION['pass_msg'] = "6 character long, 1 uppercase, 1 lowercase, 1 number & 1 special character";
                            header('location: register.php');
                        }
                    } else {
                        $_SESSION['email_msg'] = "Invalid Email. Please input a valid email.";
                        header('location: register.php');
                    }
                } else {
                    $_SESSION['number_msg'] = "Your number must be number & 11 character long";
                    header('location: register.php');
                }
            } else {
                $_SESSION['l_name_msg'] = "Last name must be A to Z.";
                header('location: register.php');
            }
        } else {
            $_SESSION['f_name_msg'] = "First name must be A to Z.";
            header('location: register.php');
        }
    } else {
        $_SESSION['empty_msg'] = "Frist Name, Last Name, Mobile Number, Email, Password cannot be empty! -_-";
        header('location: register.php');
    }
}