<?php
session_start();
require "connection.php";

if(isset($_GET["id"])){
    $productId = $_GET["id"];
    $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='".$productId."' AND `user_email`='".$_SESSION["adminUser"]["email"]."'");
    $productRownumber = $productResultset->num_rows;
    if($productRownumber == 1){
        $productData = $productResultset->fetch_assoc();
        if($productData["recycle_bin_id"] != "2"){
            Database::insertUpdateDelete("UPDATE `product` SET `recycle_bin_id`='2' WHERE `id`='".$productId."'");
            echo("Product deleted");
        }else{
            echo("Product delete already");
        }
    }
}else{
    echo("Something went wrong");
}

?>