<?php
session_start();
require_once('../db.php');
$_SESSION['title'] = "Orders";
require_once('header.php');

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes") {
        header('location: ../admin/index.php');
    }
} else {
    header('location: ../common/login.php');
}



// Retrieve user-specific orders
$userId = $_SESSION['user']['id'];
$order_query = "SELECT o.*, COALESCE(SUM(od.total_items), 0) AS total_items
                FROM `orders` o
                LEFT JOIN (
                    SELECT order_id, SUM(quantity) AS total_items
                    FROM order_details
                    GROUP BY order_id
                ) od ON o.id = od.order_id
                WHERE o.customer_id = $userId
                GROUP BY o.id";
$order_result = mysqli_query(db_connect(), $order_query);

if (mysqli_num_rows($order_result) > 0) {
    // Display a list of orders
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
                                    <div class="header_account-list top_links">
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


    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Your Orders</h3>
                        <ul>
                            <li><a href="../common/profile_edit.php">My Account</a></li>
                            <li>orders</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="table_desc">
                    <div class="cart_page table-responsive">
                        <table>
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
        </div>
    </div>
<?php
} else {
    echo "You have no orders.";
}

require_once('footer.php');
?>