<?php
    session_start();
    $_SESSION['title'] = "Register Page";
    if (isset($_SESSION['user_status'])) {
        header('location: admin/dashboard.php');
    }

    require_once('header.php');
?>

    <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="frontend/assets/images/Tree-Hunting-White.png" alt="Tree Hunting">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="assets/img/bg/graphic.svg" alt="Graphic Login">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 class="mb-3">Register into tree hunting.</h3>
                        <div class="page-links">
                            <a href="login.php">Login</a><a href="register.php" class="active">Register</a>
                        </div>

                        <?php if (isset($_SESSION['empty_msg'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                    echo $_SESSION['empty_msg'];
                                    unset($_SESSION['empty_msg']);
                                ?>
                            </div>

                        <?php
                            }
                            if (isset($_SESSION['err_msg'])) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                    echo $_SESSION['err_msg'];
                                    unset($_SESSION['err_msg']);
                                ?>
                            </div>
                        <?php
                            }
                            if (isset($_SESSION['suss_msg'])) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                    echo $_SESSION['suss_msg'];
                                    unset($_SESSION['suss_msg']);
                                ?>
                            </div>
                        <?php } ?>

                        <form action="register_post.php" method="post">
                            <input type="text" name="firstName" required placeholder="First Name" class="form-control my-3">
                            <small class="text-danger">
                                <?php
                                    if(isset($_SESSION['f_name_msg'])){
                                        echo $_SESSION['f_name_msg'];
                                        unset($_SESSION['f_name_msg']);
                                    }
                                ?>
                            </small>

                            <input type="text" name="lastName" required placeholder="Last Name" class="form-control my-3">
                            <small class="text-danger">
                                <?php
                                    if(isset($_SESSION['l_name_msg'])){
                                        echo $_SESSION['l_name_msg'];
                                        unset($_SESSION['l_name_msg']);
                                    }
                                ?>
                            </small>

                            <input type="string" name="numberNumber" required placeholder="Mobile Number" class="form-control my-3">
                            <small class="text-danger">
                                <?php
                                    if(isset($_SESSION['number_msg'])){
                                        echo $_SESSION['number_msg'];
                                        unset($_SESSION['number_msg']);
                                    }
                                ?>
                            </small>
                            <input type="email" name="email" required placeholder="Email Address" class="form-control my-3">
                            <small class="text-danger">
                                <?php
                                    if(isset($_SESSION['email_msg'])){
                                        echo $_SESSION['email_msg'];
                                        unset($_SESSION['email_msg']);
                                    }
                                ?>
                            </small>
                            <input type="password" name="password" placeholder="Password" class="form-control my-3" required>
                            <small class="text-danger">
                                <?php
                                    if(isset($_SESSION['pass_msg'])){
                                        echo $_SESSION['pass_msg'];
                                        unset($_SESSION['pass_msg']);
                                    }
                                ?>
                            </small>
                            <div class="form-button">
                                <button id="submit" name="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('footer.php'); ?>