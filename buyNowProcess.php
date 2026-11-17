<?php

session_start();
require "connection.php";

if(isset($_SESSION["user"])){
    $pid = $_GET ["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];

    $array;
    $orderId = uniqid();

    $productResultset = Database::search ("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $productData = $productResultset->fetch_assoc();

    $cityResultset = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
    $cityRownumber = $cityResultset->num_rows;

    if($cityRownumber == 1){
        $cityData = $cityResultset->fetch_assoc();

        $cityId = $cityData["city_id"];
        $address = $cityData["line1"].", ".$cityData["line2"];

        $districtresultset = Database::search("SELECT * FROM `city` WHERE `id`='".$cityId."'");
        $districtData = $districtresultset->fetch_assoc();

        $districtId = $districtData["district_id"];
        $delivery = "0";

        
            $delivery = $productData["delivery_cost_id"];

        $item = $productData["title"];
        $amount = ((int)$productData["price"] * (int)$qty + (int)$delivery);

        $fname = $_SESSION["user"]["fname"];
        $lanme = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile"];
        $userAddress = $address;
        $city = $districtData["name"];

        $array["id"] = $orderId;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lanme;
        $array["mobile"] = $mobile;
        $array["address"] = $userAddress;
        $array["city"] = $city;
        $array["mail"] = $umail;
        echo(json_encode($array));

    }else{
        echo("2");
    }
}else{
    echo("1");
}

?>