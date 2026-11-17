<?php
session_start();
require "connection.php";

if (isset($_SESSION["product"])) {
    $productId = $_SESSION["product"]["id"];

    $title = $_POST["title"];
    $qty = $_POST["qty"];
    $price = $_POST["cost"];
    $description = $_POST["description"];

    if (strlen($title) > 100) {
        echo ("Title should have <100 characters");
    } else if (empty($qty)) {
        echo ("Please enter the quantity");
    } else if ($qty == 0 | $qty == "e" | $qty < 0 | !is_numeric($qty)) {
        echo ("Invalid input for quantity");
    } else if (empty($price)) {
        echo ("Please enter the cost");
    } else if (!is_numeric($price)) {
        echo ("Invalied input for cost");
    } else if (empty($description)) {
        echo ("Please enter a decription");
    } else {
        Database::insertUpdateDelete("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`price`='" . $price . "',`description`='" . $description . "' WHERE `id`='" . $productId . "'");
        $length = sizeof($_FILES);
        $allowedImageExtentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        Database::insertUpdateDelete("DELETE FROM `images` WHERE `product_id`='" . $productId . "'");

        if ($length > 0) {
            for ($x = 0; $x < $length; $x++) {
                if (isset($_FILES["image" . $x])) {
                    $imagefile = $_FILES["image" . $x];
                    $fileExtention = $imagefile["type"];

                    if (in_array($fileExtention, $allowedImageExtentions)) {

                        $newImageExtention;
                        if ($fileExtention == "image/jpg") {
                            $newImageExtention = ".jpg";
                        } else if ($fileExtention == "image/jpeg") {
                            $newImageExtention = ".jpeg";
                        } else if ($fileExtention == "image/png") {
                            $newImageExtention = ".png";
                        } else if ($fileExtention == "image/svg+xml") {
                            $newImageExtention = ".svg";
                        }
                        $fileName = "resource//productImages//" . $title . "_" . $x . "_" . uniqid() . $newImageExtention;
                        move_uploaded_file($imagefile["tmp_name"], $fileName);

                        Database::insertUpdateDelete("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $fileName . "', '" . $productId . "')");
                    } else {
                        echo ("Invalied image type");
                    }
                }
            }
            echo ("Product update successful");
        } else {
            echo ("Invalied image count");
        }
    }
}
