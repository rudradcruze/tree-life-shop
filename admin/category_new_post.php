<?php
    require_once 'is_admin.php';
    require_once '../db.php';

    if (isset($_POST['submit'])) {

        $categoryName = $_POST['categoryName'];

        if (empty($categoryName)) {
            $_SESSION['error'] = "Category name is required";
            header('location: category_new.php');
        } else {

            $insert_query = "INSERT INTO category (`name`) VALUES ('$categoryName')";
            
            try {
                mysqli_query(db_connect(), $insert_query);
                $_SESSION['success'] = "Category created successfully!";
                header('location: category_list.php');
            } catch (Throwable $th) {
                $   $_SESSION['error'] = "Category creation failed";
                header('location: category_new.php');
            }

        }
    }

?>