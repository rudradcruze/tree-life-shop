<?php 

    function db_connect(){
        
        $db_host = "localhost:3308";
        $db_user = "root";
        $db_pass = "";
        $db_name = "tree_life_shop";

        return mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    }

    $get_company_query = "SELECT * FROM company";
    $company_query_result = mysqli_query(db_connect(), $get_company_query);
    $result = mysqli_fetch_assoc($company_query_result);

    $_SESSION['company'] = array(
        'name' => $result['name'],
        'image_dark' => $result['image_dark'],
        'image_light' => $result['image_light'],
        'phone' => $result['phone']
    );

    function get_all($table_name){
        $get_query = "SELECT * FROM $table_name";
        return mysqli_query(db_connect(), $get_query);
    }

?>