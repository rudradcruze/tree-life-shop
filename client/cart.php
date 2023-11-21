<?php
session_start();
require_once('../db.php');
$_SESSION['title'] = "Cart";
require_once('header.php');

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes")
        header('location: ../admin/index.php');
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
                                            <li><a class="active" href="cart.php">cart</a></li>
                                            <li><a href="order.php">order</a></li>
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
                        <h3>Cart</h3>
                        <ul>
                            <li><a href="../index.php">home</a></li>
                            <li><a href="../shop.php">shop</a></li>
                            <li>cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <div class="cart_area mt-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                    ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($_SESSION['success'])) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </div>
                            <?php } ?>

                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_remove">SL</th>
                                        <th class="product_thumb">Product</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_price">Unit Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Sub Total</th>
                                        <th class="product_action">Action</th>
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
                                            <td class="product_quantity">
                                                <form action="update_cart.php" method="post">
                                                    <input type="hidden" name="productId" value="<?= $cartItem['product_id'] ?>">
                                                    <input type="number" name="quantity" value="<?= $cartItem['quantity'] ?>" min="1" max="999">
                                                    <button type="submit" class="btn text-primary" name="update"><i class="fa fa-exchange" aria-hidden="true"></i></button>
                                                </form>
                                            </td>
                                            <td class="product_sub_total">৳<?= $subTotal ?></td>
                                            <td class="product_remove">
                                                <!-- Remove Product -->
                                                <form action="remove_from_cart.php" method="post">
                                                    <input type="hidden" name="productId" value="<?= $cartItem['product_id'] ?>">
                                                    <button type="submit" name="remove" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        $sl++;
                                    } ?>
                                </tbody>
                            </table>
                            <div id="totalPriceDisplay" class="fw-bold fs-6 p-3">Total Price: ৳<?= $totalPrice ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart_submit">
                        <a href="../shop.php" class="btn btn-dark"><i class="fa fa-chevron-left" aria-hidden="true"></i> Continue Shopping</a>
                        <a href="checkout.php" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Check Out</a>
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