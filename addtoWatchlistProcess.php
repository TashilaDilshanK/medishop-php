<?php
    session_start();
    require "connection.php";

    if(isset($_SESSION["user"])){
        if(isset($_GET["id"])){
            $email = $_SESSION["user"]["email"];
            $pid = $_GET["id"];
            $watchlistResultset = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
            $watchlistRownumber = $watchlistResultset->num_rows;

            if($watchlistRownumber == 1){
                $watchlistData = $watchlistResultset->fetch_assoc();
                $listId = $watchlistData["id"];
                Database::insertUpdateDelete("DELETE FROM `watchlist` WHERE `id`='".$listId."'");
                echo("Item removed");
            }else{
                Database::insertUpdateDelete("INSERT INTO `watchlist` (`user_email`,`product_id`) VALUES ('".$email."','".$pid."')");
                echo("Item Added");
            }
        }else{
            echo("Something went wrong");
        }
    }else{
        echo("Please login first");
    }

?>