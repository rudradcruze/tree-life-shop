<?php
session_start();
require_once('../db.php');
require_once('header.php');

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please Login";
    header('location: ../common/login.php');
}

// Check if the order ID is provided as a query parameter
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Retrieve order information from the database based on $orderId

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

<header>
    <div class="main_header">
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-4">
                        <div class="logo">
                            <a href="../index.php"><img src="../<?= $_SESSION['company']['image_dark'] ?>" alt="<?= $_SESSION['company']['name'] ?>"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-6">
                        <div class="header_right_info">
                            <div class="search_container">
                                <form action="#">
                                    <div class="search_box">
                                        <input placeholder="Search product..." type="text">
                                        <button type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="header_account_area">
                                <div class="header_account-list top_links">../
                                    <a href="#"><i class="icon-users"></i></a>
                                    <ul class="dropdown_links">
                                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                            <li><a href="../common/profile_edit.php">My Account </a></li>
                                            <li><a href="cart.php">Shopping Cart</a></li>
                                            <li><a href="../common/logout.php" class="text-danger">Log Out</a></li>
                                        <?php } else { ?>
                                            <li><a href="../common/login.php">Login / Register</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                    <div class="header_account-list  mini_cart_wrapper">
                                        <a href="cart.php">
                                            <i class="icon-shopping-bag"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">Categories</h2>
                            </div>
                            <div class="categories_menu_toggle">
                                <ul>
                                    <?php
                                    foreach (get_all('category') as $category) :
                                        echo "<li><a href='#'>" . $category['name'] . "</a></li>";
                                    endforeach
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li><a href="../index.php">home</a></li>
                                    <li><a href="../shop.php">shop</a></li>
                                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                        <li><a href="cart.php">cart</a></li>
                                        <li><a class="active" href="order.php">order</a></li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="call-support">
                            <p>Call Support: <a <?php echo "href='tel:+88" . $_SESSION['company']['phone'] . "'" ?>><?= $_SESSION['company']['phone'] ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="order-details">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title fs-4 fw-medium mb-0">Order ID: <?= $orderId ?></h2>
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
                                <div class="table_desc mb-2">
                                    <div class="cart_page table-responsive">
                                        <table>
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