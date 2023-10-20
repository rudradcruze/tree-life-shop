<?php
    require_once 'is_admin.php';
    require_once '../db.php';

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        // Check if the product exists
        $check_query = "SELECT id FROM products WHERE id = $productId";
        $check_result = mysqli_query(db_connect(), $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $delete_query = "DELETE FROM products WHERE id = $productId";
            mysqli_query(db_connect(), $delete_query);
            $_SESSION['success'] = "Product successfully deleted!";
        } else {
            $_SESSION['error'] = "Product not found!";
        }
    } else {
        $_SESSION['error'] = "Product ID not provided!";
    }

    header('location: product_list.php');
?>