<?php
session_start();
$_SESSION['title'] = "Login Page";
if (isset($_SESSION['user_status'])) {
    if ($_SESSION['is_admin'] == "yes")
        header('location: ../admin/index.php');
    else
        header('location: ../index.php');
}

require_once('../db.php');
require_once('../client/header.php');
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
                                            <li><a href="common/logout.php" class="text-danger">Log Out</a></li>
                                            <?php } else { ?>
                                                <li><a href="login.php">Login / Register</a></li>
                                        <?php } ?>
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
                                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != "yes") { ?>
                                    <li><a href="../client/cart.php">cart</a></li>
                                    <li><a href="../client/order.php">order</a></li>
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