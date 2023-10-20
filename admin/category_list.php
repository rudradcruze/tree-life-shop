<?php
require_once 'is_admin.php';
$_SESSION['title'] = "Category List";
require_once '../db.php';
require_once 'header.php';
?>

<!-- Heading -->
<div class="d-flex align-items-center justify-content-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h2 mb-0 text-white lh-1">Category List</h1>
    </div>
</div>

<!-- Create New Category Button -->
<div class="text-end">
    <a href="category_new.php" class="btn btn-success">Create New Category</a>
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

<!-- Main Category List Content -->
<div class="mt-5 p-3 bg-body rounded shadow">
    <table class="table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query(db_connect(), $query);

            $serialNumber = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$serialNumber}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>
                                <a href='category_edit.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                                <a href='category_delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            </td>";
                echo "</tr>";

                $serialNumber++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>