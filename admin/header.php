<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">

    <title><?= $_SESSION['title'] ?></title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/offcanvas-navbar.css" rel="stylesheet">
    <link href="../assets/css/font.awesome.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Admin Dashboard</a>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="category_list.php">List</a></li>
                            <li><a class="dropdown-item" href="category_new.php">Create New</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Product</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="product_list.php">List</a></li>
                            <li><a class="dropdown-item" href="product_new.php">Create New</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="company_edit.php">Company Settings</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Orders</a>
                    </li>
                </ul>
                <div class="account">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if(isset($_SESSION['user']['f_name']))
                                $_SESSION['user']['f_name'];
                                else
                                    echo "User";
                            ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../common/profile_edit.php">Edit Profile</a></li>
                            <li><a class="dropdown-item text-danger" href="../common/logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container">