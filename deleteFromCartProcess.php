<?php

    require_once "connection.php";

    if(isset($_GET["id"])){
        $cId = $_GET["id"];
        $cartResultset = Database::search("SELECT * FROM `cart` WHERE `id`='".$cId."'");
        $cartData = $cartResultset->fetch_assoc();

        $user = $cartData["user_email"];
        $product = $cartData["product_id"];

        Database::insertUpdateDelete("INSERT INTO `recent` (`product_id`, `user_email`) VALUES ('".$product."','".$user."')");
        Database::insertUpdateDelete("DELETE FROM `cart` WHERE `id`='".$cId."'");

        echo("Item removed");

    }else{
        echo("somthing went wrong");
    }

?>