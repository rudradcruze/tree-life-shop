<?php
session_start();
require_once('../db.php');

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes") {
        header('location: ../admin/index.php');
    }
} else {
    header('location: ../common/login.php');
}

if (isset($_POST['billing_name']) && isset($_POST['phone_number']) && isset($_POST['email_address']) && isset($_POST['shipping_address'])) {
    $billing_name = $_POST['billing_name'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $shipping_address = $_POST['shipping_address'];

    // Get user information from the session
    $user = $_SESSION['user'];
    $userId = $user['id'];

    // Calculate total price from cart_items
    $totalPrice = 0;

    $cart_query = "SELECT ci.id as card_id, ci.product_id, p.discount_price, ci.quantity
                    FROM cart_items ci
                    JOIN products p ON ci.product_id = p.id
                    WHERE ci.user_id = $userId";

    $cart_result = mysqli_query(db_connect(), $cart_query);

    while ($cartItem = mysqli_fetch_assoc($cart_result)) {
        $subTotal = $cartItem['discount_price'] * $cartItem['quantity'];
        $totalPrice += $subTotal;
    }

    // Create a unique order ID
    $orderID = uniqid() . $user['email'] . $userId;

    // Insert order information into the order table
    $orderDate = date('Y-m-d H:i:s');
    $paymentType = "CASH";

    $orderInsertQuery = "INSERT INTO orders (id, order_date, payment_type, total_price, customer_id, bill_name, phone_number, email, shipping_address)
    VALUES ('$orderID', '$orderDate', '$paymentType', $totalPrice, $userId, '$billing_name', '$phone_number', '$email_address', '$shipping_address')";

    $orderInsertResult = mysqli_query(db_connect(), $orderInsertQuery);

    if ($orderInsertResult) {
        // Insert order details into the order_details table
        $cart_result = mysqli_query(db_connect(), $cart_query);

        while ($cartItem = mysqli_fetch_assoc($cart_result)) {
            $cartId = $cartItem['card_id'];
            $productID = $cartItem['product_id'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['discount_price'];

            $orderDetailsInsertQuery = "INSERT INTO order_details (order_id, product_id, quantity, price)
                VALUES ('$orderID', $productID, $quantity, $price)";

            mysqli_query(db_connect(), $orderDetailsInsertQuery);
            // Clear the user's cart after successful checkout
            $clearCartQuery = "DELETE FROM cart_items WHERE id = $cartId and user_id = $userId";
            mysqli_query(db_connect(), $clearCartQuery);
        }

        $_SESSION['success'] = "Order placed successfully with Order ID: $orderID";
        header('location: order.php');
    } else {
        $_SESSION['error'] = "Failed to place the order. Please try again.";
        header('location: checkout.php');
    }
} else {
    $_SESSION['error'] = "Billing information is incomplete. Please fill out all fields.";
    header('location: checkout.php');
}
?>