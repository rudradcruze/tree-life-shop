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
                            <a class="button" href="shop.php">Discover Now </a>
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
                            <a class="button" href="shop.php">Discover Now </a>
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
                            <a class="button" href="shop.php">Discover Now </a>
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
                        <a href="shop.php"><img src="assets/img/bg/banner1.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>Big Sale Products</h3>
                            <h2>Plants <br> For Interior</h2>
                            <a href="shop.php">Shop Now</a>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-lg-6 col-md-6">
                <figure class="single_banner">
                    <div class="banner_thumb">
                        <a href="shop.php"><img src="assets/img/bg/banner2.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>Top Products</h3>
                            <h2>Plants <br> For Healthy</h2>
                            <a href="shop.php">Shop Now</a>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->

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

<?php
    require_once('client/footer2.php');
?>