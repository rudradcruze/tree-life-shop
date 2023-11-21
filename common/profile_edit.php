<?php
session_start();
$_SESSION['title'] = "Profile Edit";
if (!isset($_SESSION['user_status'])) {
    header('location: login.php');
}

require_once('../db.php');
require_once('../client/header.php');

$user_email = $_SESSION['user']['email'];

// Fetch the user's current information from the database
$user_query = "SELECT f_name, l_name, mobile FROM users WHERE email = '$user_email'";
$user_result = mysqli_query(db_connect(), $user_query);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    $_SESSION['error'] = "User not found!";
    header('location: 404.php');
}
?>
<?php if ($_SESSION['is_admin'] != "yes") {?>
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
    <?php
    } ?>

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My Account</h3>

                    <?php if ($_SESSION['is_admin'] == "yes") { ?>
                        <a class="btn btn-danger rounded" href="../admin/index.php">Back To Admin Panel</a>
                    <?php } ?>
                    
                    <?php if ($_SESSION['is_admin'] != "yes") { ?>
                        <ul>
                            <li><a href="../index.php">home</a></li>
                            <li>My account</li>
                        </ul>
                    <?php } ?>
                </div>

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
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="container mt-5">
    <div class="row">
        <!--login area start-->
        <div class="col">
            <div class="account_form">
                <form action="profile_edit_post.php" method="post" class="border-0 p-0 m-0">
                    <h2>Basic Information</h2>
                    <div class="border p-3 rounded mb-5">
                        <div class="mb-3">
                            <label class="form-label" for="f_name">First Name</label>
                            <input type="text" name="f_name" class="form-control" value="<?= $user['f_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="l_name">Last Name</label>
                            <input type="text" name="l_name" class="form-control" value="<?= $user['l_name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="mobile">Mobile Number</label>
                            <input type="text" name="mobile" class="form-control" value="<?= $user['mobile'] ?>" required>
                        </div>
                    </div>

                    <h2>Change Password</h2>

                    <div class="border p-3 rounded mb-5">
                        <div class="mb-3">
                            <label class="form-label" for="oldPassword">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="newPassword">New Password</label>
                            <input type="password" name="newPassword" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="retypeNewPassword">Retype New Password</label>
                            <input type="password" name="retypeNewPassword" class="form-control">
                        </div>
                    </div>

                    <div class="login_submit mb-5">
                        <button class="btn btn-primary rounded" name="submit" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('../client/footer.php'); ?>