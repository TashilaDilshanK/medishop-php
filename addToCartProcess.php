<?php

    session_start();
    require "connection.php";

    if(isset($_SESSION["user"])){
        if(isset($_GET["id"])){
            $email = $_SESSION["user"]["email"];
            $pid = $_GET["id"];

            $cartResultset = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
            $cartRownumber = $cartResultset->num_rows;

            $productResultset = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
            $productData = $productResultset->fetch_assoc();
            $productQty = $productData["qty"];

            if($cartRownumber == 1){
                $cartData = $cartResultset->fetch_assoc();
                $currentQty = $cartData["qty"];
                $newQty = (int)$currentQty + 1;

                if($productQty >= $newQty){
                    Database::insertUpdateDelete("UPDATE `cart` SET `qty`='".$newQty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                    echo("Product Updated");
                }else{
                    echo("Invalid Quantity");
                }
            }else{

                Database::insertUpdateDelete("INSERT INTO `cart`(`product_id`,`user_email`,`qty`) VALUES ('".$pid."','".$email."','1')");
                echo ("Added To Cart");
        
            }

        }else{
            echo("Something Went Wrong");
        }

    }else{
        echo("Please sign In or Register");
    }

?>