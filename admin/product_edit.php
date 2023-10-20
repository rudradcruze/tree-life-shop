<?php
    require_once 'is_admin.php';
    $_SESSION['title'] = "Edit Product";
    require_once 'header.php';
    require_once '../db.php';

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        $product_query = "SELECT p.id, p.name, p.description, p.regular_price, p.discount_price, p.image_location, p.species, p.size, p.age, p.growth_rate, p.water_needs, p.availability, p.container_type, c.name AS category_name
                            FROM products p
                            JOIN category c ON p.category_id = c.id
                            WHERE p.id = $productId";
        $product_result = mysqli_query(db_connect(), $product_query);
        $product = mysqli_fetch_assoc($product_result);

        if (!$product) {
            $_SESSION['error'] = "Product not found!";
            header('location: product_list.php');
        }
    } else {
        $_SESSION['error'] = "Product ID not provided!";
        header('location: product_list.php');
    }
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Edit Product</h1>
    </div>
</div>

<!-- Edit Product Form -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>

    <form action="product_edit_post.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="category">Category</label>
                <select name="category" class="form-control" id="category">
                    <?php
                        $categories_query = "SELECT id, name FROM category";
                        $categories_result = mysqli_query(db_connect(), $categories_query);

                        while ($category = mysqli_fetch_assoc($categories_result)) {
                            $selected = ($product['category_name'] === $category['name']) ? 'selected' : '';
                            echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="productName">Product Name</label>
                <input type="text" name="productName" class="form-control" value="<?= $product['name'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="productDescription">Product Description</label>
                <textarea name="productDescription" class="form-control" id="productDescription"><?= $product['description'] ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="regularPrice">Regular Price</label>
                <input type="text" name="regularPrice" class="form-control" value="<?= $product['regular_price'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="discountPrice">Discount Price</label>
                <input type="text" name="discountPrice" class="form-control" value="<?= $product['discount_price'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="availability">Availability</label>
                <select name="availability" class="form-control" id="availability">
                    <option value="very_common" <?= ($product['availability'] === 'Very common') ? 'selected' : '' ?>>Very common</option>
                    <option value="common" <?= ($product['availability'] === 'Common') ? 'selected' : '' ?>>Common</option>
                    <option value="uncommon" <?= ($product['availability'] === 'Uncommon') ? 'selected' : '' ?>>Uncommon</option>
                    <option value="rare" <?= ($product['availability'] === 'Rare') ? 'selected' : '' ?>>Rare</option>
                </select>
            </div>
        </div>

        <!-- Additional Fields -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="species">Species</label>
                <input type="text" name="species" class="form-control" value="<?= $product['species'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="containerType">Container Type</label>
                <input type="text" name="containerType" class="form-control" value="<?= $product['container_type'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="age">Age</label>
                <input type="number" name="age" class="form-control" value="<?= $product['age'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="size">Size</label>
                <select name="size" class="form-control" id="size">
                    <option value="Small" <?= ($product['size'] === 'Small') ? 'selected' : '' ?>>Small</option>
                    <option value="Medium" <?= ($product['size'] === 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="Large" <?= ($product['size'] === 'Large') ? 'selected' : '' ?>>Large</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="waterNeeds">Water Needs</label>
                <select name="waterNeeds" class="form-control" id="waterNeeds">
                    <option value="Low" <?= ($product['water_needs'] === 'Low') ? 'selected' : '' ?>>Low</option>
                    <option value="Medium" <?= ($product['water_needs'] === 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="High" <?= ($product['water_needs'] === 'High') ? 'selected' : '' ?>>High</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="growthRate">Growth Rate</label>
                <select name="growthRate" class="form-control" id="growthRate">
                    <option value="Slow" <?= ($product['growth_rate'] === 'Slow') ? 'selected' : '' ?>>Slow</option>
                    <option value="Medium" <?= ($product['growth_rate'] === 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="High" <?= ($product['growth_rate'] === 'High') ? 'selected' : '' ?>>High</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="productImage">Product Image</label>
                <input type="file" name="productImage" class="form-control" id="productImage">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Current Image</label>
                <img src="../<?= $product['image_location'] ?>" alt="Product Image" width="150">
            </div>
        </div>

        <div class="login_submit">
            <button class="btn btn-primary rounded" type="submit" name="submit">Save Changes</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>