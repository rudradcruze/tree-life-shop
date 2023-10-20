<?php
    require_once 'is_admin.php';
    require_once '../db.php';

    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
        
        // Check if the category exists
        $query = "SELECT * FROM category WHERE id = $categoryId";
        $result = mysqli_query(db_connect(), $query);

        if (mysqli_num_rows($result) > 0) {
            $delete_query = "DELETE FROM category WHERE id = $categoryId";

            if (mysqli_query(db_connect(), $delete_query)) {
                $_SESSION['success'] = "Category deleted successfully!";
            } else {
                $_SESSION['error'] = "Category deletion failed: " . mysqli_error(db_connect());
            }
        } else {
            $_SESSION['error'] = "Category not found!";
        }
    }

    header('location: category_list.php');
?>
