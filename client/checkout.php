<?php
session_start();
require_once('../db.php');
$_SESSION['title'] = "Checkout";
require_once('header.php');

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes") {
        header('location: ../admin/index.php');
    }
} else {
    header('location: ../common/login.php');
}

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $cart_query = "SELECT ci.id, p.id as product_id, p.name, p.image_location, p.discount_price, ci.quantity
                    FROM cart_items ci
                    JOIN products p ON ci.product_id = p.id
                    WHERE ci.user_id = $userId";
    $cart_result = mysqli_query(db_connect(), $cart_query);
?>

    <header>
        <div class="main_header">
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3 col-4">
                            <div class="logo">
                                <a href="index.php"><img src="../<?= $_SESSION['company']['image_dark'] ?>" alt="<?= $_SESSION['company']['name'] ?>"></a>
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
                                            <li><a href="my-account.html">My Account </a></li>
                                            <li><a href="cart.php">Shopping Cart</a></li>
                                            <li><a href="common/logout.php" class="text-danger">Log Out</a></li>
                                        </ul>
                                    </div>
                                    <div class="header_account-list  mini_cart_wrapper">
                                        <a href="cart.php">
                                            <i class="icon-shopping-bag"></i>
                                        </a>
                                    </div>
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
                                        <li><a class="active" href="cart.php">cart</a></li>
                                        <li><a href="order.php">order</a></li>
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
                        <h3>Checkout</h3>
                        <ul>
                            <li><a href="../index.php">home</a></li>
                            <li><a href="../shop.php">shop</a></li>
                            <li><a href="cart.php">cart</a></li>
                            <li>checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <div class="cart_area mt-60">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="checkout_form">
                        <h3 class="rounded">Billing Details</h3>
                        <form action="process_checkout.php" method="post">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="billing_name">Billing Name</label>
                                    <input require type="text" class="form-control" id="billing_name" name="billing_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input require type="text" class="form-control" id="phone_number" name="phone_number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input require type="email" class="form-control" id="email_address" name="email_address" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="shipping_address">Shipping Address</label>
                                <textarea require class="form-control" id="shipping_address" name="shipping_address" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <!-- Display cart items with quantities and subtotals -->
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_remove">SL</th>
                                        <th class="product_thumb">Product</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_price">Unit Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalPrice = 0;
                                    $sl = 1;

                                    while ($cartItem = mysqli_fetch_assoc($cart_result)) {
                                        $subTotal = $cartItem['discount_price'] * $cartItem['quantity'];
                                        $totalPrice += $subTotal;
                                    ?>
                                        <tr>
                                            <td class="product_remove"><?= $sl ?></td>
                                            <td class="product_name"><?= $cartItem['name'] ?></td>
                                            <td class="product_thumb"><img width="80px" src="../<?= $cartItem['image_location'] ?>" alt="<?= $cartItem['name'] ?>"></td>
                                            <td class="product_unit_price">৳<?= $cartItem['discount_price'] ?></td>
                                            <td class="product_quantity"><?= $cartItem['quantity'] ?></td>
                                            <td class="product_sub_total">৳<?= $subTotal ?></td>
                                        </tr>
                                    <?php
                                        $sl++;
                                    } ?>
                                </tbody>
                            </table>
                            <div id="totalPriceDisplay" class="fw-bold fs-5 p-3">Total Price: ৳<?= $totalPrice ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    $_SESSION['error'] = "Please Login";
    header('location: ../common/login.php');
}

require_once('footer.php');
?>