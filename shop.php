<?php
session_start();
$_SESSION['title'] = "Login Page";
require_once 'db.php';

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes")
        header('location: ../admin/index.php');
}
$_SESSION['title'] = "Shop";

require_once('client/header2.php');
?>

<header>
    <div class="main_header">
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-4">
                        <div class="logo">
                            <a href="index.php"><img src="<?= $_SESSION['company']['image_dark'] ?>" alt="<?= $_SESSION['company']['name'] ?>"></a>
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
                                            <li><a href="common/profile_edit.php">My Account </a></li>
                                            <li><a href="client/cart.php">Shopping Cart</a></li>
                                            <li><a href="common/logout.php" class="text-danger">Log Out</a></li>
                                        <?php } else { ?>
                                            <li><a href="common/login.php">Login / Register</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                    <div class="header_account-list  mini_cart_wrapper">
                                        <a href="client/cart.php">
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
                                    <li><a href="index.php">home</a></li>
                                    <li><a class="active" href="shop.php">shop</a></li>
                                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                        <li><a href="client/cart.php">cart</a></li>
                                        <li><a href="client/order.php">order</a></li>
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
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="index.php">home</a></li>
                        <li>shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_fullwidth mt-100 mb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">
                        <button data-role="grid_3" type="button" class=" btn-grid-3" data-bs-toggle="tooltip" title="3"></button>

                        <button data-role="grid_4" type="button" class="active btn-grid-4" data-bs-toggle="tooltip" title="4"></button>

                        <button data-role="grid_list" type="button" class="btn-list" data-bs-toggle="tooltip" title="List"></button>
                    </div>
                </div>
                <!--shop toolbar end-->
                <div class="row shop_wrapper grid_4">
                    <?php
                    // Fetch products with category name from the database
                    $products_query = "SELECT p.id, p.name, p.description, p.regular_price, p.discount_price, p.image_location, p.species, p.size, p.age, p.growth_rate, p.water_needs, p.availability, p.container_type, c.name AS category_name FROM products p JOIN category c ON p.category_id = c.id";
                    $products_result = mysqli_query(db_connect(), $products_query);

                    while ($product = mysqli_fetch_assoc($products_result)) {
                    ?>
                        <div class="col-lg-3 col-md-4 col-12 ">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img src="<?= $product['image_location'] ?>" alt="<?= $product['name'] ?>"></a>
                                        <div class="action_links">
                                            <ul>
                                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                                    <li class="add_to_cart"><a href="client/add_to_cart.php?productId=<?= $product['id'] ?>&userId=<?= $_SESSION['user']['id'] ?>" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                <?php } ?>
                                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="action_links list_action">
                                            <ul>
                                                <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_content grid_content">
                                        <div class="product_price_rating">
                                            <h4 class="product_name"><a href="product-details.html"><?= $product['name'] ?></a></h4>
                                            <p class="text-muted text-small"><?= "Category: " . $product['category_name'] ?></p>
                                            <div class="price_box">
                                                <span class="current_price">৳<?= $product['discount_price'] ?></span>
                                                <span class="old_price">৳<?= $product['regular_price'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product_content list_content">
                                        <h4 class="product_name"><a href="product-details.html"><?= $product['name'] ?></a></a>
                                        </h4>
                                        <p class="text-muted text-small"><?= "Category: " . $product['category_name'] ?></p>
                                        <div class="price_box">
                                            <span class="current_price">৳<?= $product['discount_price'] ?></span>
                                            <span class="old_price">৳<?= $product['regular_price'] ?></span>
                                        </div>
                                        <div class="product_desc">
                                            <p><?= $product['description'] ?></p>
                                        </div>
                                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                            <div class="action_links list_action_right">
                                                <ul>
                                                    <li class="add_to_cart">
                                                        <a href="client/add_to_cart.php?productId=<?= $product['id'] ?>&userId=<?= $_SESSION['user']['id'] ?>" title="Add to cart">Add to cart</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </figure>
                            </article>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--shop  area end-->

<?php
require_once('client/footer2.php');
?>