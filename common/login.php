<?php
    session_start();
    $_SESSION['title'] = "Login Page";
    if (isset($_SESSION['user_status'])) {
        if ($_SESSION['is_admin'] == "yes")
            header('location: ../admin/index.php');
        else
            header('location: ../client/index.php');
    }

    require_once('../client/header.php');
?>
<header>
    <div class="main_header">
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-4">
                        <div class="logo">
                            <a href="../index.php"><img src="../assets/img/logo/logo.png" alt="logo"></a>
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
                                        <li><a href="checkout.html">Checkout </a></li>
                                        <li><a href="my-account.html">My Account </a></li>
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                    </ul>
                                </div>
                                <div class="header_account-list header_wishlist">
                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                </div>
                                <div class="header_account-list  mini_cart_wrapper">
                                    <a href="#">
                                        <i class="icon-shopping-bag"></i><span class="item_count">2</span>
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
                                    <li><a href="#"> Lighting</a></li>
                                    <li><a href="#"> Accessories</a></li>
                                    <li><a href="#">Body Parts</a></li>
                                    <li><a href="#">Perfomance Filters</a></li>
                                    <li><a href="#"> Engine Parts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li><a href="index.html">home</a></li>
                                    <li class="mega_items"><a href="shop.html">shop<i class="fa fa-angle-down"></i></a>
                                        <div class="mega_menu">
                                            <ul class="mega_menu_inner">
                                                <li><a href="#">Shop Layouts</a>
                                                    <ul>
                                                        <li><a href="shop-fullwidth.html">Full Width</a></li>
                                                        <li><a href="shop-fullwidth-list.html">Full Width list</a>
                                                        </li>
                                                        <li><a href="shop-right-sidebar.html">Right Sidebar </a>
                                                        </li>
                                                        <li><a href="shop-right-sidebar-list.html"> Right Sidebar
                                                                list</a></li>
                                                        <li><a href="shop-list.html">List View</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">other Pages</a>
                                                    <ul>
                                                        <li><a href="cart.html">cart</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="my-account.html">my account</a></li>
                                                        <li><a href="404.html">Error 404</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Product Types</a>
                                                    <ul>
                                                        <li><a href="product-details.html">product details</a></li>
                                                        <li><a href="product-sidebar.html">product sidebar</a></li>
                                                        <li><a href="product-grouped.html">product grouped</a></li>
                                                        <li><a href="variable-product.html">product variable</a>
                                                        </li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a href="blog.html">blog<i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="blog-details.html">blog details</a></li>
                                            <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                            <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="active" href="#">pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="services.html">services</a></li>
                                            <li><a href="faq.html">Frequently Questions</a></li>
                                            <li><a href="contact.html">contact</a></li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html"> Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="call-support">
                            <p>Call Support: <a href="tel:0123456789">0123456789</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header area end-->

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="../index.php">home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- customer login start -->
<div class="customer_login">
    <div class="container">
        <div class="row">
            <!--login area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form">
                    <h2>login</h2>
                    <form action="login_post.php" method="post">
                        <div>
                            <?php if (isset($_SESSION['login_error'])) { ?>

                                <div class="alert alert-danger" role="alert">
                                    <?php
                                    echo $_SESSION['login_error'];
                                    unset($_SESSION['login_error']);
                                    ?>
                                </div>

                            <?php } ?>
                        </div>
                        <p>
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input id="email" type="text" name="email" required>
                        </p>
                        <p>
                            <label for="password">Passwords <span class="text-danger">*</span></label>
                            <input id="password" type="password" name="password" required>
                        </p>
                        <div class="login_submit">
                            <button id="submit" type="submit">login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->

            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register">
                    <h2>Register</h2>
                    <form action="register_post.php" method="post">
                        <div class="mb-3">
                            <label for="firstName">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="firstName" id="firstName" required>
                            <small class="text-danger">
                                <?php
                                if (isset($_SESSION['f_name_msg'])) {
                                    echo $_SESSION['f_name_msg'];
                                    unset($_SESSION['f_name_msg']);
                                }
                                ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="lastName">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lastName" id="lastName" required>
                            <small class="text-danger">
                                <?php
                                if (isset($_SESSION['l_name_msg'])) {
                                    echo $_SESSION['l_name_msg'];
                                    unset($_SESSION['l_name_msg']);
                                }
                                ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="numberNumber">Mobile Number <span class="text-danger">*</span></label>
                            <input type="string" name="numberNumber" id="numberNumber" required>
                            <small class="text-danger">
                                <?php
                                if (isset($_SESSION['number_msg'])) {
                                    echo $_SESSION['number_msg'];
                                    unset($_SESSION['number_msg']);
                                }
                                ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="emailReg">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="emailReg" required>
                            <small class="text-danger">
                                <?php
                                if (isset($_SESSION['email_msg'])) {
                                    echo $_SESSION['email_msg'];
                                    unset($_SESSION['email_msg']);
                                }
                                ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="passwordReg">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="passwordReg" required>
                            <small class="text-danger">
                                <?php
                                if (isset($_SESSION['pass_msg'])) {
                                    echo $_SESSION['pass_msg'];
                                    unset($_SESSION['pass_msg']);
                                }
                                ?>
                            </small>
                        </div>

                        <div class="login_submit">
                            <button id="submit" name="submit" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div>
<!-- customer login end -->

<?php
    require_once('../client/footer.php');
?>