<?php 

    function db_connect(){
        
        $db_host = "localhost:3308";
        $db_user = "root";
        $db_pass = "";
        $db_name = "tree_life_shop";

        return mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    }

    function get_all($table_name){
        $get_query = "SELECT * FROM $table_name";
        return mysqli_query(db_connect(), $get_query);
    }

?>