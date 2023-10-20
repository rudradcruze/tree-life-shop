<?php
require_once 'is_admin.php';
require_once '../db.php';

if (isset($_POST['submit'])) {
    $productId = $_POST['id'];
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

    // Check if a new image file is selected
    if (isset($_FILES['productImage']) && $_FILES['productImage']['size'] > 0) {
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

                // Unlink pervious file
                $get_location_query = "SELECT image_location FROM products WHERE id='$productId'";

                $image_location_from_db = mysqli_query(db_connect(), $get_location_query);
                $after_assoc_image_location = mysqli_fetch_assoc($image_location_from_db);

                unlink("../" . $after_assoc_image_location['image_location']);

                // Generate a unique image name
                $image_new_name = uniqid() . '.' . strtolower($image_extension);

                // Define the save location
                $save_location = "../uploads/products/product." . $image_new_name;

                // Move the uploaded image to the designated location
                move_uploaded_file($upload_image_temp, $save_location);

                // Update the image location in the database
                $image_location = "uploads/products/product." . $image_new_name;

                // Update product details with the new image
                $update_query = "UPDATE products
                                SET category_id = '$category',
                                    name = '$productName',
                                    description = '$productDescription',
                                    regular_price = '$regularPrice',
                                    discount_price = '$discountPrice',
                                    image_location = '$image_location',
                                    species = '$species',
                                    size = '$size',
                                    age = '$age',
                                    growth_rate = '$growthRate',
                                    water_needs = '$waterNeeds',
                                    availability = '$availability',
                                    container_type = '$containerType'
                                WHERE id = $productId";

                // Execute the update query
                mysqli_query(db_connect(), $update_query);

                $_SESSION['success'] = "Product Successfully Updated!";
                header('location: product_list.php');
            } else {
                $_SESSION['error'] = "Invalid image extension. Allowed extensions: jpg, jpeg, png, webp, gif.";
                header("location: product_edit.php?id=$productId");
            }
        } else {
            $_SESSION['error'] = "File size is too large. Max file size is 2MB.";
            header("location: product_edit.php?id=$productId");
        }
    } else {
        // No new image file selected; keep the existing image
        $update_query = "UPDATE products
                        SET category_id = '$category',
                            name = '$productName',
                            description = '$productDescription',
                            regular_price = '$regularPrice',
                            discount_price = '$discountPrice',
                            species = '$species',
                            size = '$size',
                            age = '$age',
                            growth_rate = '$growthRate',
                            water_needs = '$waterNeeds',
                            availability = '$availability',
                            container_type = '$containerType'
                        WHERE id = $productId";

        // Execute the update query
        mysqli_query(db_connect(), $update_query);

        $_SESSION['success'] = "Product Successfully Updated!";
        header('location: product_list.php');
    }
} else {
    $_SESSION['error'] = "Form submission failed. Please try again.";
    header('location: product_edit.php');
}
