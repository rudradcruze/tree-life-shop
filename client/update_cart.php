<?php
session_start();
require_once('../db.php');

if (isset($_POST['update']) && isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $newQuantity = $_POST['quantity'];

    $userId = $_SESSION['user']['id'];
    $update_query = "UPDATE cart_items SET quantity = $newQuantity WHERE user_id = $userId AND product_id = $productId";
    $update_result = mysqli_query(db_connect(), $update_query);


    if ($update_result) {
        $_SESSION['success'] = "Product quantity updated!";
        header('Location: cart.php');
    } else {
        $_SESSION['error'] = "Error!";
        header('Location: cart.php');
    }
} else {
    $_SESSION['error'] = "Error!";
    header('Location: cart.php');
}
?>