<?php
require_once 'is_admin.php';
$_SESSION['title'] = "Orders";
require_once '../db.php';
require_once 'header.php';

$order_query = "SELECT o.*, COALESCE(SUM(od.total_items), 0) AS total_items
                    FROM `orders` o
                    LEFT JOIN (
                        SELECT order_id, SUM(quantity) AS total_items
                        FROM order_details
                        GROUP BY order_id
                    ) od ON o.id = od.order_id
                    GROUP BY o.id";
$order_result = mysqli_query(db_connect(), $order_query);

if (mysqli_num_rows($order_result) > 0) {
    // Display a list of orders
?>

    <!-- Heading -->
    <div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
        <div class="lh-1">
            <h1 class="h2 mb-0 text-white lh-1">Orders</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 p-3 bg-body rounded shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Payment Type</th>
                            <th>Total Price</th>
                            <th>Total Items</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sl = 1;
                        while ($order = mysqli_fetch_assoc($order_result)) {
                            $orderId = $order['id'];
                            $orderDate = date('d M Y', strtotime($order['order_date']));
                            $paymentType = $order['payment_type'];
                            $totalPrice = $order['total_price'];
                            $totalItems = $order['total_items'];
                        ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td>
                                    <a href="order_details.php?order_id=<?= $orderId ?>"><?php echo $orderId; ?></a>
                                </td>
                                <td><?php echo $paymentType; ?></td>
                                <td><?php echo $orderDate; ?></td>
                                <td><?php echo "৳" . $totalPrice; ?></td>
                                <td><?php echo $totalItems; ?></td>
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

<?php
} else {
    echo "You have no orders.";
}

require_once('footer.php');
?>