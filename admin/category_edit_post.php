<?php
    require_once 'is_admin.php';
    require_once '../db.php';

    if (isset($_POST['submit'])) {
        $categoryId = $_POST['id'];
        $newCategoryName = $_POST['categoryName'];

        if (empty($newCategoryName)) {
            $_SESSION['error'] = "Category name cannot be empty";
            header('location: category_edit.php?id=' . $categoryId);
        } else {
            $update_query = "UPDATE category SET name = '$newCategoryName' WHERE id = $categoryId";

            if (mysqli_query(db_connect(), $update_query)) {
                $_SESSION['success'] = "Category updated successfully!";
            } else {
                $_SESSION['error'] = "Category update failed: " . mysqli_error(db_connect());
            }

            header('location: category_list.php');
        }
    } else {
        $_SESSION['error'] = "Invalid request";
        header('location: category_list.php');
    }
?>