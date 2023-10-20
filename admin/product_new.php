<?php
    require_once 'is_admin.php';
    $_SESSION['title'] = "New Product";
    require_once 'header.php';
    require_once '../db.php';

    // Fetch categories from the database
    $categories_query = "SELECT id, name FROM category";
    $categories_result = mysqli_query(db_connect(), $categories_query);
    ?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Create New Product</h1>
    </div>
</div>

<!-- Main Create New Product Content -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <form action="product_new_post.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="category">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-select" id="category" required>
                    <?php while ($category = mysqli_fetch_assoc($categories_result)) { ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="productName">Product Name <span class="text-danger">*</span></label>
                <input type="text" name="productName" class="form-control" id="productName" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="productDescription">Product Description</label>
                <textarea name="productDescription" class="form-control" id="productDescription"></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="regularPrice">Regular Price</label>
                <input type="text" name="regularPrice" class="form-control" id="regularPrice">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="availability">Availability</label>
                <input type="text" name="availability" class="form-control" id="availability">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="containerType">Container Type</label>
                <input type="text" name="containerType" class="form-control" id="containerType">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="productImage">Product Image <span class="text-danger">*</span></label>
                <input type="file" name="productImage" class="form-control" id="productImage" required>
            </div>
        </div>

        <div class="login_submit">
            <button class="btn btn-primary rounded" type="submit" name="submit">Create Product</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>