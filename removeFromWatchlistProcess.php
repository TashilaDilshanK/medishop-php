<?php
require "connection.php";
    if(isset($_GET["id"])){
        $watchlistId = $_GET["id"];
        $watchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `id`='".$watchlistId."'");
        $watchlistRownumber = $watchlistResultset->num_rows;
        $watchData = $watchlistResultset->fetch_assoc();

        if($watchlistRownumber == 0){
            echo("Something went wrong");
        }else{
            Database::insertUpdateDelete("INSERT INTO `recent` (`user_email`,`product_id`) VALUES ('".$watchData["user_email"]."','".$watchData["product_id"]."')");
            Database::insertUpdateDelete("DELETE FROM `watchlist` WHERE `id`='".$watchlistId."'");
            echo("Item removed");
        }
    }else{
        echo("Please select a product");
    }
?>