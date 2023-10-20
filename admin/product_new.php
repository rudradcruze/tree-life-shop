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

<!-- Create New Category Button -->
<div class="text-end">
    <a href="product_list.php" class="btn btn-primary">Product List</a>
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
                <label class="form-label" for="productDescription">Product Description <span class="text-danger">*</span></label>
                <textarea name="productDescription" class="form-control" id="productDescription" required></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="regularPrice">Regular Price <span class="text-danger">*</span></label>
                <input type="text" name="regularPrice" class="form-control" id="regularPrice" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="discountPrice">Discount Price <span class="text-danger">*</span></label>
                <input type="text" name="discountPrice" class="form-control" id="discountPrice" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="availability">Availability <span class="text-danger">*</span></label>
                <select name="availability" class="form-control" id="availability" required>
                    <option value="very_common">Very common</option>
                    <option value="common" selected>Common</option>
                    <option value="uncommon">Uncommon</option>
                    <option value="rare">Rare</option>
                </select>
            </div>
        </div>

        <!-- Additional Fields -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="species">Species <span class="text-danger">*</span></label>
                <input type="text" name="species" class="form-control" id="species" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="containerType">Container Type <span class="text-danger">*</span></label>
                <input type="text" name="containerType" class="form-control" id="containerType" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="age">Age <span class="text-danger">*</span></label>
                <input type="number" name="age" class="form-control" id="age" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="size">Size <span class="text-danger">*</span></label>
                <select name="size" class="form-control" id="size" required>
                    <option value="Small">Small</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="waterNeeds">Water Needs <span class="text-danger">*</span></label>
                <select name="waterNeeds" class="form-control" id="waterNeeds" required>
                    <option value="Low">Low</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="growthRate">Growth Rate <span class="text-danger">*</span></label>
                <select name="growthRate" class="form-control" id="growthRate" required>
                    <option value="Slow">Slow</option>
                    <option value="Medium" selected>Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label" for="productImage">Product Image <span class="text-danger">*</span></label>
                <input type="file" name="productImage" class="form-control" id="productImage" required>
            </div>
        </div>

        <div class="login_submit">
            <button class="btn btn-success rounded" type="submit" name="submit">Create Product</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>