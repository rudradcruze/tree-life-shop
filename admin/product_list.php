<?php
    require_once 'is_admin.php';
    $_SESSION['title'] = "Product List";
    require_once 'header.php';
    require_once '../db.php';

    // Fetch products with category name from the database
    $products_query = "SELECT p.id, p.name, p.description, p.regular_price, p.discount_price, p.image_location, p.species, p.size, p.age, p.growth_rate, p.water_needs, p.availability, p.container_type, c.name AS category_name FROM products p JOIN category c ON p.category_id = c.id";
    $products_result = mysqli_query(db_connect(), $products_query);
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Product List</h1>
    </div>
</div>

<!-- Create New Product Button -->
<div class="text-end">
    <a href="product_new.php" class="btn btn-success">Create New Product</a>
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

<!-- Main Product List Content -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <table class="table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Regular Price</th>
                <th>Discount Price</th>
                <th>Image</th>
                <th>Species</th>
                <th>Size</th>
                <th>Age</th>
                <th>Growth Rate</th>
                <th>Water Needs</th>
                <th>Availability</th>
                <th>Container Type</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $serialNumber = 1;

            while ($product = mysqli_fetch_assoc($products_result)) {
                echo "<tr>";
                    echo "<td>{$serialNumber}</td>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td>{$product['description']}</td>";
                    echo "<td>{$product['regular_price']}</td>";
                    echo "<td>{$product['discount_price']}</td>";
                    echo "<td><img src='../{$product['image_location']}' alt='Product Image' width='50'></td>";
                    echo "<td>{$product['species']}</td>";
                    echo "<td>{$product['size']}</td>";
                    echo "<td>{$product['age']}</td>";
                    echo "<td>{$product['growth_rate']}</td>";
                    echo "<td>{$product['water_needs']}</td>";
                    echo "<td>{$product['availability']}</td>";
                    echo "<td>{$product['container_type']}</td>";
                    echo "<td>{$product['category_name']}</td>";
                    echo "<td>
                            <a href='product_edit.php?id={$product['id']}' class='text-dark'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                            <a href='product_delete.php?id={$product['id']}' class='text-danger'><i class='fa fa-trash-o' aria-hidden='true'></i></a>
                        </td>";
                echo "</tr>";

                $serialNumber++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>