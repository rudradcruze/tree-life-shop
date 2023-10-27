<?php
require_once 'is_admin.php';
require_once '../db.php';

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $regularPrice = $_POST['regularPrice'];
    $discountPrice = $_POST['discountPrice'];
    $species = $_POST['species'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $growthRate = $_POST['growthRate'];
    $waterNeeds = $_POST['waterNeeds'];

    $availability = $_POST['availability'];

    switch ($availability) {
        case 'very_common':
            $availability = 'Very common';
            break;
        case 'common':
            $availability = 'Common';
            break;
        case 'uncommon':
            $availability = 'Uncommon';
            break;
        case 'rare':
            $availability = 'Rare';
            break;
        default:
            $availability = 'Unknown';
            break;
    }

    $containerType = $_POST['containerType'];

    // Check if an image file is selected
    if (isset($_FILES['productImage'])) {
        $upload_image_name = $_FILES['productImage']['name'];
        $upload_image_size = $_FILES['productImage']['size'];
        $upload_image_temp = $_FILES['productImage']['tmp_name'];

        // Check if the file size is within the allowed limit (2MB)
        if ($upload_image_size <= 2000000) {
            $after_explode = explode('.', $upload_image_name);
            $image_extension = end($after_explode);
            $allow_extension = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'webp');

            // Check if the image extension is allowed
            if (in_array(strtolower($image_extension), $allow_extension)) {

                // Generate a unique image name
                $image_new_name = uniqid() . '.' . strtolower($image_extension);

                // Define the save location
                $save_location = "../uploads/products/product." . $image_new_name;

                // Move the uploaded image to the designated location
                move_uploaded_file($upload_image_temp, $save_location);

                // Update the image location in the database
                $image_location = "uploads/products/product." . $image_new_name;

                // Insert product details into the database
                $insert_query = "INSERT INTO products (category_id, name, description, regular_price, discount_price, image_location, species, size, age, growth_rate, water_needs, availability, container_type) VALUES ('$category', '$productName', '$productDescription', '$regularPrice', '$discountPrice', '$image_location', '$species', '$size', '$age', '$growthRate', '$waterNeeds', '$availability', '$containerType')";

                // Execute the update query
                mysqli_query(db_connect(), $insert_query);

                $_SESSION['success'] = "Product Successfully Created!";
                header('location: product_list.php');
            } else {
                $_SESSION['error'] = "Invalid image extension. Allowed extensions: jpg, jpeg, png, webp, gif.";
                header('location: product_new.php');
            }
        } else {
            $_SESSION['error'] = "File size is too large. Max file size is 2MB.";
            header('location: product_new.php');
        }
    } else {
        $_SESSION['error'] = "Please select an image for the product.";
        header('location: product_new.php');
    }
} else {
    $_SESSION['error'] = "Form submission failed. Please try again.";
    header('location: product_new.php');
}
