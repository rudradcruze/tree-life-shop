<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes")
        header('location: ../admin/index.php');
}

$_SESSION['title'] = $_SESSION['company']['name'];

require_once('client/header2.php');
?>

<!--header area start-->
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
                                    <li><a class="active" href="index.php">home</a></li>
                                    <li><a href="shop.php">shop</a></li>
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
<!--header area end-->

<!--slider area start-->
<section class="slider_section">
    <div class="slider_area owl-carousel">
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>BIG SALE</h1>
                            <p>Discount <span>20% Off </span> For Lukani Members </p>
                            <a class="button" href="shop.html">Discover Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>TOP SALE</h1>
                            <p>Discount <span>20% Off </span> For Lukani Members </p>
                            <a class="button" href="shop.html">Discover Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider3.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>Lovely Plants </h1>
                            <p>Discount <span>20% Off </span> For Lukani Members </p>
                            <a class="button" href="shop.html">Discover Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--slider area end-->

<!--shipping area start-->
<div class="shipping_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping1.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>Free Delivery</h3>
                        <p>Free shipping around the world for all <br> orders over $120</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_2">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping2.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>Safe Payment</h3>
                        <p>With our payment gateway, don’t worry <br> about your information</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_3">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping3.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>Friendly Services</h3>
                        <p>You have 30-day return guarantee for <br> every single order</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--shipping area end-->

<!--banner area start-->
<div class="banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <figure class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="assets/img/bg/banner1.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>Big Sale Products</h3>
                            <h2>Plants <br> For Interior</h2>
                            <a href="shop.html">Shop Now</a>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-lg-6 col-md-6">
                <figure class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.html"><img src="assets/img/bg/banner2.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>Top Products</h3>
                            <h2>Plants <br> For Healthy</h2>
                            <a href="shop.html">Shop Now</a>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->

<!--product area start-->
<div class="product_area  mb-95">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <div class="section_title">
                        <h2>Our Products</h2>
                    </div>
                    <div class="product_tab_btn">
                        <ul class="nav" role="tablist" id="nav-tab">
                            <li>
                                <a class="active" data-bs-toggle="tab" href="#plant1" role="tab" aria-controls="plant1" aria-selected="true">
                                    Plant Stands & Movers
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#plant2" role="tab" aria-controls="plant2" aria-selected="false">
                                    Plant families
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#plant3" role="tab" aria-controls="plant3" aria-selected="false">
                                    Outdoor Plant Pots
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                <div class="row">
                    <div class="product_carousel product_column4 owl-carousel">
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-7%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">commodo augue
                                                    nisi</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">eget
                                                    sagittis</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">fringilla
                                                    augue</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£68.00</span>
                                                <span class="old_price">£75.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-5%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">massa massa</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£75.00</span>
                                                <span class="old_price">£80.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">placerat
                                                    vestibulum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Porro Cook</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£62.00</span>
                                                <span class="old_price">£68.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-4%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">sapien
                                                    libero</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">vulputate
                                                    rutrum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£64.00</span>
                                                <span class="old_price">£72.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">adipiscing
                                                    cursus</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Donec eu
                                                    cook</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£67.00</span>
                                                <span class="old_price">£77.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="plant2" role="tabpanel">
                <div class="row">
                    <div class="product_carousel product_column4 owl-carousel">
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-4%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">sapien
                                                    libero</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">vulputate
                                                    rutrum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£64.00</span>
                                                <span class="old_price">£72.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">adipiscing
                                                    cursus</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Donec eu
                                                    cook</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£67.00</span>
                                                <span class="old_price">£77.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-7%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">commodo augue
                                                    nisi</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">eget
                                                    sagittis</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">fringilla
                                                    augue</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£68.00</span>
                                                <span class="old_price">£75.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-5%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">massa massa</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£75.00</span>
                                                <span class="old_price">£80.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">placerat
                                                    vestibulum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Porro Cook</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£62.00</span>
                                                <span class="old_price">£68.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="plant3" role="tabpanel">
                <div class="row">
                    <div class="product_carousel product_column4 owl-carousel">
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">fringilla
                                                    augue</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£68.00</span>
                                                <span class="old_price">£75.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-5%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">massa massa</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£75.00</span>
                                                <span class="old_price">£80.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">placerat
                                                    vestibulum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Porro Cook</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">£62.00</span>
                                                <span class="old_price">£68.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product7.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-4%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">sapien
                                                    libero</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product8.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-6%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">vulputate
                                                    rutrum</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£64.00</span>
                                                <span class="old_price">£72.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-7%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">commodo augue
                                                    nisi</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£69.00</span>
                                                <span class="old_price">£74.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">eget
                                                    sagittis</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£65.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product9.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-8%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">adipiscing
                                                    cursus</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£60.00</span>
                                                <span class="old_price">£70.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img src="assets/img/product/product10.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">-9%</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><i class="icon-sliders"></i></a></li>
                                                    <li class="wishlist"><a href="wishlist.html" title="Add to Wishlist"><i class="icon-heart"></i></a>
                                                    </li>
                                                    <li class="quick_button"><a href="#" data-bs-toggle="modal" data-bs-target="#modal_box" title="quick view"> <i class="icon-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <div class="product_rating">
                                                <ul>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4 class="product_name"><a href="product-details.html">Donec eu
                                                    cook</a></h4>
                                            <div class="price_box">
                                                <span class="current_price">£67.00</span>
                                                <span class="old_price">£77.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->

<!--product area start-->
<div class="product_area product_deals ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Today Deals</h2>
                </div>
            </div>
        </div>
        <div class="product_deals_container">
            <div class="row">
                <div class="product_carousel product_column5 owl-carousel">
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product1.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-7%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">commodo augue nisi</a>
                                    </h4>
                                    <div class="price_box">
                                        <span class="current_price">£69.00</span>
                                        <span class="old_price">£74.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product2.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">eget sagittis</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£65.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product3.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-6%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">fringilla augue</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£68.00</span>
                                        <span class="old_price">£75.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product4.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-5%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">massa massa</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£75.00</span>
                                        <span class="old_price">£80.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>

                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product5.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-8%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">placerat vestibulum</a>
                                    </h4>
                                    <div class="price_box">
                                        <span class="current_price">£65.00</span>
                                        <span class="old_price">£70.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a class="primary_img" href="product-details.html"><img src="assets/img/product/product6.jpg" alt=""></a>
                                    <div class="label_product">
                                        <span class="label_sale">-9%</span>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="2022/12/15"></div>
                                    </div>
                                </div>
                                <figcaption class="product_content">
                                    <div class="product_rating">
                                        <ul>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Porro Cook</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">£62.00</span>
                                        <span class="old_price">£68.00</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->

<!--testimonial area start-->
<div class="testimonial_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>What Our Customers Says ?</h2>
                </div>
            </div>
        </div>
        <div class="testimonial_container">
            <div class="row">
                <div class="testimonial_carousel owl-carousel">
                    <div class="col-12">
                        <div class="single-testimonial">
                            <div class="testimonial-icon-img">
                                <img src="assets/img/about/testimonials-icon.png" alt="">
                            </div>
                            <div class="testimonial_content">
                                <p>“ When a beautiful design is combined with powerful technology, <br>
                                    it truly is an artwork. I love how my website operates and looks with this
                                    theme. Thank you for the awesome product. ”</p>
                                <div class="testimonial_text_img">
                                    <a href="#"><img src="assets/img/about/testimonial1.png" alt=""></a>
                                </div>
                                <div class="testimonial_author">
                                    <p><a href="#">Rebecka Filson</a> / <span>CEO of CSC</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="single-testimonial">
                            <div class="testimonial-icon-img">
                                <img src="assets/img/about/testimonials-icon.png" alt="">
                            </div>
                            <div class="testimonial_content">
                                <p>“ When a beautiful design is combined with powerful technology, <br>
                                    it truly is an artwork. I love how my website operates and looks with this
                                    theme. Thank you for the awesome product. ”</p>
                                <div class="testimonial_text_img">
                                    <a href="#"><img src="assets/img/about/testimonial2.png" alt=""></a>
                                </div>
                                <div class="testimonial_author">
                                    <p><a href="#">Amber Laha</a> / <span>CEO of DND</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="single-testimonial">
                            <div class="testimonial-icon-img">
                                <img src="assets/img/about/testimonials-icon.png" alt="">
                            </div>
                            <div class="testimonial_content">
                                <p>“ When a beautiful design is combined with powerful technology, <br>
                                    it truly is an artwork. I love how my website operates and looks with this
                                    theme. Thank you for the awesome product. ”</p>
                                <div class="testimonial_text_img">
                                    <a href="#"><img src="assets/img/about/testimonial3.png" alt=""></a>
                                </div>
                                <div class="testimonial_author">
                                    <p><a href="#">Lindsy Neloms</a> / <span>CEO of SFD</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--testimonial area end-->

<!--blog area start-->
<section class="blog_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Our Latest Posts</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog_carousel blog_column3 owl-carousel">
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog1.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h4 class="post_title"><a href="blog-details.html">Libero lorem</a></h4>
                                <div class="articles_date">
                                    <p>By <span>admin / July 16, 2021</span></p>
                                </div>
                                <p class="post_desc">Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras
                                    pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus praesent</p>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Continue Reading</a>
                                    <p><i class="icon-message-circle"></i> <span>0</span></p>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog2.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h4 class="post_title"><a href="blog-details.html">Blog image post</a></h4>
                                <div class="articles_date">
                                    <p>By <span>admin / July 16, 2021</span></p>
                                </div>
                                <p class="post_desc">Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras
                                    pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus praesent</p>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Continue Reading</a>
                                    <p><i class="icon-message-circle"></i> <span>0</span></p>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog3.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h4 class="post_title"><a href="blog-details.html">Post with Gallery</a></h4>
                                <div class="articles_date">
                                    <p>By <span>admin / July 16, 2021</span></p>
                                </div>
                                <p class="post_desc">Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras
                                    pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus praesent</p>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Continue Reading</a>
                                    <p><i class="icon-message-circle"></i> <span>0</span></p>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-3">
                    <article class="single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="assets/img/blog/blog2.jpg" alt=""></a>
                            </div>
                            <figcaption class="blog_content">
                                <h4 class="post_title"><a href="blog-details.html">Post with Audio</a></h4>
                                <div class="articles_date">
                                    <p>By <span>admin / July 16, 2021</span></p>
                                </div>
                                <p class="post_desc">Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras
                                    pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus praesent</p>
                                <footer class="blog_footer">
                                    <a href="blog-details.html">Continue Reading</a>
                                    <p><i class="icon-message-circle"></i> <span>0</span></p>
                                </footer>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!--blog area end-->

<!--newsletter area start-->
<div class="newsletter_area_start">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>Get <span>20% Off</span> Your Next Order</h2>
                </div>
                <div class="newsletter_container">
                    <div class="subscribe_form">
                        <form id="mc-form" class="mc-form footer-newsletter">
                            <input id="mc-email" type="email" autocomplete="off" placeholder="Enter you email" />
                            <button id="mc-submit">Subscribe</button>
                            <div class="email_icon">
                                <i class="icon-mail"></i>
                            </div>
                        </form>
                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts text-centre">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                        </div><!-- mailchimp-alerts end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--newsletter area end-->

<!--footer area start-->
<footer class="footer_widgets">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container contact_us">
                        <h3>Opening Time</h3>
                        <p><span>Mon - Fri:</span> 8AM - 10PM</p>
                        <p><span>Sat:</span> 9AM-8PM</p>
                        <p><span>Suns:</span> 14hPM-18hPM</p>
                        <p><b>We Work All The Holidays</b></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Information</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="faq.html">Frequently Questions</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="widgets_container widget_app">
                        <div class="footer_logo">
                            <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <div class="footer_widgetnav_menu">
                            <ul>
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Internet</a></li>
                            </ul>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="footer_app">
                            <ul>
                                <li><a href="#"><img src="assets/img/icon/icon-app.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/icon/icon1-app.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>My Account</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="cart.html">Shopping cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="#">Order History</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Customer Service</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="contact.html">Site Map</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="#">Returns</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright_area">
                        <p class="copyright-text">&copy; 2021 <a href="index.html">Lukani</a>. Made with <i class="fa fa-heart text-danger"></i> by <a href="https://hasthemes.com/" target="_blank">HasThemes</a> </p>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer_payment">
                        <a href="#"><img src="assets/img/icon/payment.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

<!-- JS
============================================ -->
<!--jquery min js-->
<script src="assets/js/vendor/jquery-3.4.1.min.js"></script>
<!--popper min js-->
<script src="assets/js/popper.js"></script>
<!--bootstrap min js-->
<script src="assets/js/bootstrap.min.js"></script>
<!--owl carousel min js-->
<script src="assets/js/owl.carousel.min.js"></script>
<!--slick min js-->
<script src="assets/js/slick.min.js"></script>
<!--magnific popup min js-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!--counterup min js-->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--jquery countdown min js-->
<script src="assets/js/jquery.countdown.js"></script>
<!--jquery ui min js-->
<script src="assets/js/jquery.ui.js"></script>
<!--jquery elevatezoom min js-->
<script src="assets/js/jquery.elevatezoom.js"></script>
<!--isotope packaged min js-->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!--slinky menu js-->
<script src="assets/js/slinky.menu.js"></script>
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>



</body>

</html>