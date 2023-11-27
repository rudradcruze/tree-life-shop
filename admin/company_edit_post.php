<?php
require_once 'is_admin.php';
require_once '../db.php';

if (isset($_POST['submit'])) {
    $companyId = (int)1;
    $company_query = "SELECT * FROM company WHERE id = $companyId";
    $company_result = mysqli_query(db_connect(), $company_query);
    $company = mysqli_fetch_assoc($company_result);

    $companyName = $_POST['companyName'];
    $companyPhone = $_POST['companyPhone'];
    
    $allow_extension = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'webp');
    $light_image_path = $company['image_light'];
    $dark_image_path = $company['image_dark'];

    // Check if new light image is provided
    if (isset($_FILES['companyImageLight']) && $_FILES['companyImageLight']['size'] > 0) {
        $light_image = $_FILES['companyImageLight'];
        $light_image_name = $light_image['name'];
        $light_image_temp = $light_image['tmp_name'];

        $after_explode = explode('.', $light_image_name);
        $image_extension = end($after_explode);

        if (in_array(strtolower($image_extension), $allow_extension)) {
            unlink("../" . $company['image_light']);

            $light_image_path = "uploads/logo/light_" . uniqid() . '.' . $image_extension;
            move_uploaded_file($light_image_temp, '../' . $light_image_path);
        } else {
            $_SESSION['error'] = "Invalid image extension. Allowed extensions: jpg, jpeg, png, webp, gif.";
            header("location: company_edit.php?");
        }
    }

    // Check if new dark image is provided
    if (isset($_FILES['companyImageDark']) && $_FILES['companyImageDark']['size'] > 0) {
        $dark_image = $_FILES['companyImageDark'];
        $dark_image_name = $dark_image['name'];
        $dark_image_temp = $dark_image['tmp_name'];

        $after_explode = explode('.', $dark_image_name);
        $image_extension = end($after_explode);

        if (in_array(strtolower($image_extension), $allow_extension)) {
            unlink("../" . $company['image_dark']);

            $dark_image_path = "uploads/logo/dark_" . uniqid() . '.' . $image_extension;
            move_uploaded_file($dark_image_temp, '../' . $dark_image_path);
        } else {
            $_SESSION['error'] = "Invalid image extension. Allowed extensions: jpg, jpeg, png, webp, gif.";
            header("location: company_edit.php?");
        }
    }

    // Update company details in the database
    $update_query = "UPDATE company SET `name`='$companyName', `image_light`='$light_image_path', `image_dark`='$dark_image_path', `phone`='$companyPhone' WHERE id=$companyId";
    mysqli_query(db_connect(), $update_query);

    $_SESSION['success'] = "Company details updated successfully!";
    header('location: index.php');
} else {
    $_SESSION['error'] = "Form submission failed. Please try again.";
    header('location: company_edit.php');
}
?>