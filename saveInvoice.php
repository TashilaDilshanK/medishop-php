<?php

    session_start();
    require "connection.php";

    if(isset($_SESSION["user"])){
        $orderId = $_POST["orderId"];
        $productId = $_POST["productId"];
        $mail = $_POST["mail"];
        $amount = $_POST["amount"];
        $qty = $_POST["qty"];

        $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='".$productId."'");
        $productData = $productResultset->fetch_assoc();

        $currentQty = $productData["qty"];
        $newQty = $currentQty - $qty;

        Database::insertUpdateDelete("UPDATE `product` SET `qty`='".$newQty."' WHERE `id`='".$productId."'");

        $date = new DateTime();
        $timezone = new DateTimeZone("Asia/colombo");
        $date->setTimezone($timezone);
        $newDate = $date->format("Y-m-d H:i:s");

        Database::insertUpdateDelete("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) VALUES ('".$orderId."','".$newDate."','".$amount."','".$qty."','0','".$productId."','".$mail."')");

        echo("1");
    }

?>