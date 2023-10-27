<?php
require_once 'is_admin.php';
$_SESSION['title'] = "Orders";
require_once '../db.php';
require_once 'header.php';

// Check if the order ID is provided as a query parameter
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    $order_query = "SELECT o.*, COALESCE(SUM(od.total_items), 0) AS total_items
                FROM `orders` o
                LEFT JOIN (
                    SELECT order_id, SUM(quantity) AS total_items
                    FROM order_details
                    GROUP BY order_id
                ) od ON o.id = od.order_id
                WHERE o.id = '$orderId'";
    $order_result = mysqli_query(db_connect(), $order_query);

    // Check if the order exists
    if (mysqli_num_rows($order_result) > 0) {
        $order = mysqli_fetch_assoc($order_result);
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Order: <?= $orderId ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="order-details">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title fs-4 fw-medium mb-0">Order Basic Info</h2>
                        </div>
                        <div class="card-body">
                            <p class="fs-6 mb-1">Order Date: <?= date('d M Y', strtotime($order['order_date'])) ?></p>
                            <p class="fs-6 mb-1">Total Price: ৳<?= $order['total_price'] ?></p>
                            <p class="fs-6 mb-1">Total Items: <?= $order['total_items'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title fs-4 fw-medium mb-0">Shipping Information</h2>
                        </div>
                        <div class="card-body">
                            <p class="fs-6 mb-1">Bill Name: <?= $order['bill_name'] ?></p>
                            <p class="fs-6 mb-1">Email: <?= $order['email'] ?></p>
                            <p class="fs-6 mb-1">Phone Number: <?= $order['phone_number'] ?></p>
                            <p class="fs-6 mb-1">Shipping Address: <?= $order['shipping_address'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title fs-4 fw-medium mb-0">Order Items</h2>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-body rounded shadow">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sl = 1;
                                        $cart_query = "SELECT p.id, p.name, p.image_location, od.price, od.quantity
                                    FROM order_details od
                                    JOIN products p ON od.product_id = p.id
                                    WHERE od.order_id = '$orderId'";
                                        $cart_result = mysqli_query(db_connect(), $cart_query);

                                        while ($item = mysqli_fetch_assoc($cart_result)) {
                                            $subTotal = $item['quantity'] * $item['price'];
                                        ?>
                                            <tr>
                                                <td><?= $sl ?></td>
                                                <td class="text-start"><?= $item['name'] ?></td>
                                                <td><img src="../<?= $item['image_location'] ?>" width="80px" alt="<?= $item['name'] ?>"></td>
                                                <td><?= $item['quantity'] ?></td>
                                                <td>৳<?= $item['price'] ?></td>
                                                <td>৳<?= $subTotal ?></td>
                                            </tr>
                                        <?php
                                            $sl++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    } else {
        $_SESSION['error'] = "Order not found.";
        header('location: cart.php');
    }
} else {
    $_SESSION['error'] = "Order ID is missing.";
    header('location: cart.php');
}

require_once('footer.php');
?>