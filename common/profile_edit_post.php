<?php
    session_start();
    require_once '../db.php';
    $user_email = $_SESSION['user']['email'];


if (isset($_POST['submit'])) {

    // Get the posted user data
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $mobile = $_POST['mobile'];

    // Get the old password and new password (if changing the password)
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $retypeNewPassword = $_POST['retypeNewPassword'];

    // Fetch the user's current information from the database
    $user_query = "SELECT * FROM users WHERE email = '$user_email'";

    $user_result = mysqli_query(db_connect(), $user_query);
    $user = mysqli_fetch_assoc($user_result);

    if ($user) {
        // Verify the old password and ensure it matches the hashed password in the database
        if ($oldPassword != null) {
            if (md5($oldPassword) === $user['password']) {
                // Check if the new password and retyped password match
                if ($newPassword === $retypeNewPassword) {
                    // Hash the new password before storing it in the database
                    $hashedPassword = md5($newPassword);
                    $updatePasswordQuery = "UPDATE users SET password = '$hashedPassword' WHERE email='$user_email'";
                    mysqli_query(db_connect(), $updatePasswordQuery);
                    $_SESSION['success'] = "Password changed successfully!";
                } else {
                    $_SESSION['error'] = "New password and retyped password do not match.";
                }
            } else {
                $_SESSION['error'] = "Incorrect old password. Password not changed.";
            }
            header('location: profile_edit.php');
        } else {
            // Update the user's profile information (excluding the password)
            $updateQuery = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', mobile = '$mobile' WHERE email='$user_email'";
            mysqli_query(db_connect(), $updateQuery);
            $_SESSION['success'] = "Profile updated successfully!";

            if ($_SESSION['is_admin'] != "yes")
                header('location: ../client/index.php');
            else
                header('location: ../admin/index.php');
        }
    } else {
        $_SESSION['error'] = "User not found!";
        header('location: 404.php');
    }
}
?>