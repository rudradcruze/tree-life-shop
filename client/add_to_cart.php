<?php
    session_start();
    require_once('../db.php');

    if (isset($_SESSION['user_status'])) {
        if ($_SESSION['is_admin'] == "yes")
            header('location: ../admin/index.php');
    } else
        header('location: ../common/login.php');
    
    if (isset($_GET['productId']) && isset($_GET['userId'])) {
        $productId = $_GET['productId'];
        $userId = $_GET['userId'];

        // Check if the product is already in the user's cart
        $check_query = "SELECT * FROM cart_items WHERE user_id = $userId AND product_id = $productId";
        $check_result = mysqli_query(db_connect(), $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Product already exists in the cart, update the quantity
            $row = mysqli_fetch_assoc($check_result);
            $quantity = $row['quantity'] + 1;
            $update_query = "UPDATE cart_items SET quantity = $quantity WHERE user_id = $userId AND product_id = $productId";
            mysqli_query(db_connect(), $update_query);
        } else {
            // Product doesn't exist in the cart, insert it with quantity 1
            $insert_query = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
            mysqli_query(db_connect(), $insert_query);
        }
        
        header('location: cart.php');
    } else {
        $_SESSION['error'] = "Add to Card Error Please Try Later";
        header('location: ../shop.php');
    }
?>