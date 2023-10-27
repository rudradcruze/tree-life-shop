<?php
    session_start();
    require_once('../db.php');

    if (isset($_POST['remove']) && isset($_POST['productId'])) {
        $productId = $_POST['productId'];
        $userId = $_SESSION['user']['id'];
        
        $delete_query = "DELETE FROM cart_items WHERE user_id = $userId AND product_id = $productId";
        $delete_result = mysqli_query(db_connect(), $delete_query);

        if ($delete_result) {
            $_SESSION['success'] = "Product remove successfully!";
            header('Location: cart.php');
        } else {
            $_SESSION['error'] = "Product cannot remove!";
            header('Location: cart.php');
        }
    } else {
        $_SESSION['error'] = "Error!";
        header('Location: cart.php');
    }
?>