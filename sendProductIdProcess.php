<?php
session_start();
require "connection.php";

$email = $_SESSION["user"]["email"];
$productId = $_GET["id"];

$productResultset = Database::search("SELECT * FROM `product` WHERE `id`='".$productId."'");
$productRownumber = $productResultset->num_rows;

if($productRownumber == 1){
    $productData = $productResultset->fetch_assoc();
    $_SESSION["product"] = $productData;

    echo("success");
}
?>