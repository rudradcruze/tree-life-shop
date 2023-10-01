<?php
    session_start();
    $_SESSION['title'] = "Login Page";
    if (isset($_SESSION['user_status'])) {
        header('location: admin/dashboard.php');
    }

    require_once('header.php');
?>

    <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="frontend/assets/images/Tree-Hunting.png" alt="Tree Hunting">
                </div>
            </a>
        </div>

        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="assets/img/bg/graphic.svg" alt="Graphic login">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 class="mb-3">Loggin into tree hunting.</h3>
                        <div class="page-links">
                            <a href="login.php" class="active">Login</a><a href="register.php">Register</a>
                        </div>
                        <form action="login_post.php" method="post">
                            <?php if(isset($_SESSION['login_error'])){ ?>

                                <div class="alert alert-danger" role="alert">
                                    <?php 
                                        echo $_SESSION['login_error'];
                                        unset($_SESSION['login_error']);
                                    ?>
                                </div>

                            <?php } ?>

                            <input class="form-control" type="text" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>

                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once('footer.php');
?>