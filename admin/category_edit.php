<?php
    $_SESSION['title'] = "Edit Category";
    require_once 'header.php';
    require_once '../db.php';

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];

        $query = "SELECT * FROM category WHERE id = $categoryId";
        $result = mysqli_query(db_connect(), $query);
        $category = mysqli_fetch_assoc($result);

        if (!$category) {
            $_SESSION['error'] = "Category not found!";
            header('location: category_list.php');
        }
    } else {
        $_SESSION['error'] = "Category ID not provided!";
        header('location: category_list.php');
    }
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Edit Category</h1>
    </div>
</div>

<!-- Edit Category Form -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <form action="category_edit_post.php" method="post">
        <div class="mb-3">
            <label class="form-label" for="categoryName">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="id" class="form-control" hidden id="categoryName" value="<?= $category['id'] ?>" required>
            <input type="text" name="categoryName" class="form-control" id="categoryName" value="<?= $category['name'] ?>" required>
        </div>

        <div class="login_submit">
            <button class="btn btn-primary rounded" id="submit" name="submit" type="submit">Update Category</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>