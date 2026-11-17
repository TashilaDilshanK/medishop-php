<?php
session_start();
require "connection.php";

if($_GET["id"]){
    $productID = $_GET["id"];
    $recycleBinResultset = Database::search("SELECT * FROM `product` WHERE `user_email`='".$_SESSION["adminUser"]["email"]."' AND `id`='".$productID."'");
    $recycleBinRownumber = $recycleBinResultset->num_rows;

    if($recycleBinRownumber == 1){
        Database::insertUpdateDelete("UPDATE `product` SET `recycle_bin_id`='1' WHERE `id`='".$productID."'");
        echo("Product restored");
    }else{
        echo("Product already restored");
    }
}else{
    echo("Something went wrong");
}
?>