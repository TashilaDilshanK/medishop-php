<?php
session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $line1 = $_POST["line1"];
    $line2 = $_POST["line2"];
    $province = $_POST["province"];
    $district = $_POST["district"];
    $city = $_POST["city"];
    $postalcode = $_POST["postalcode"];
    $mobile = $_POST["mobile"];

    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];
        $allowedImageExtention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $fileExtention = $image["type"];

        if (!in_array($fileExtention, $allowedImageExtention)) {
            echo ("Please select a valied image");
        } else {
            $newFileExtention;
            if ($fileExtention == "image/jpg") {
                $newFileExtention = ".jpg";
            } else if ($fileExtention == "image/jpeg") {
                $newFileExtention = ".jpeg";
            } else if ($fileExtention == "image/png") {
                $newFileExtention = ".png";
            } else if ($fileExtention == "image/svg+xml") {
                $newFileExtention = ".svg";
            }

            $fileName = "resource/profileImages/" . $_SESSION["user"]["fname"] . "_" . uniqid() . $newFileExtention;
            move_uploaded_file($image["tmp_name"],$fileName);

            $imageResultset = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$_SESSION["user"]["email"]."'");
            $imagerownumber = $imageResultset->num_rows;

            if($imagerownumber == 1){
                Database::insertUpdateDelete("UPDATE `profile_image` SET `path`='".$fileName."' WHERE `user_email`='".$_SESSION["user"]["email"]."'");
            }else{
                Database::insertUpdateDelete("INSERT INTO `profile_image` (`path`,`user_email`) VALUES ('".$fileName."','".$_SESSION["user"]["email"]."')");
            }
        }
    }

    Database::insertUpdateDelete("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`mobile`='".$mobile."' WHERE `email`='".$_SESSION["user"]["email"]."'");

    $addressResultset = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["user"]["email"]."'");
    $addressRownumber = $addressResultset->num_rows;

    if($addressRownumber == 1){
        Database::insertUpdateDelete("UPDATE `user_has_address` SET `line1`='".$line1."',`line2`='".$line2."',`city_id`='".$city."',`postal_code`='".$postalcode."' WHERE `user_email`='".$_SESSION["user"]["email"]."'");
    }else{
        Database::insertUpdateDelete("INSERT INTO `user_has_address` (`line1`,`line2`,`user_email`,`city_id`,`postal_code`) VALUES ('".$line1."','".$line2."','".$_SESSION["user"]["email"]."','".$city."','".$postalcode."')");
    }

    echo("Profile updated");
} else {
    header("Location:home.php");
}
