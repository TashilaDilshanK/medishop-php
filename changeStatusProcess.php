<?php
    require "connection.php";

    $productID = $_GET["id"];

    $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='".$productID."'");
    $productRownumber = $productResultset->num_rows;

    if($productRownumber == 1){
        $productData = $productResultset->fetch_assoc();
        if($productData["status_id"] == 1){
            Database::insertUpdateDelete("UPDATE `product` SET `status_id`='2' WHERE `id`='".$productID."'");
            echo("Product deactivated");
        }else if($productData["status_id"] == 2){
            Database::insertUpdateDelete("UPDATE `product` SET `status_id`='1' WHERE `id`='".$productID."'");
            echo("Product activated");
        }
    }else{
        echo("Something went wrong. Please try again later");
        echo($productRownumber);
    }
?>