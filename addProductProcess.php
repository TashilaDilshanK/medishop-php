<?php
session_start();
require "connection.php";

$email = $_SESSION["adminUser"]["email"];
$title = $_POST["title"];
$category = $_POST["category"];
$brand = $_POST["brand"];
$model = $_POST["model"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$condition = $_POST["condition"];
$description = $_POST["description"];

if(empty($title)){
    echo("Please enter a title");
}else if(strlen($title) > 100){
    echo("Title should have <100 characters");
}else if($condition == 0){
    echo("Please select a condition");
}else if($category == 0){
    echo("Please select a category");
}else if($brand == 0){
    echo("Please select a brand");
}else if($model == 0){
    echo("Please select a model");
}else if(empty($qty)){
    echo("Please enter the quantity");
}else if($qty == 0 | $qty == "e" | $qty < 0 | !is_numeric($qty)){
    echo("Invalid input for quantity");
}else if(empty($cost)){
    echo("Please enter the cost");
}else if(!is_numeric($cost)){
    echo("Invalied input for cost");
}else if( $cost == 0 | $cost == "e" | $cost < 0 | !is_numeric($cost)){
    echo("Invalied input for cost");
}else if(empty($description)){
    echo("Please enter a decription");
}else{
    $brandHasModelresultset = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");
    $brandHasModelrownumber = $brandHasModelresultset->num_rows;
    $brandHasModelId;
    if($brandHasModelrownumber == 1){
        $brandHasModelData = $brandHasModelresultset->fetch_assoc();
        $brandHasModelId = $brandHasModelData["id"];
    }else{
        Database::insertUpdateDelete("INSERT INTO `brand_has_model` (`brand_id`,`model_id`) VALUES ('".$brand."','".$model."')");
        $brandHasModelId = Database::$connection->insert_id;
    }

    $date = new DateTime();
    $timeZone = new DateTimeZone("Asia/colombo");
    $date->setTimezone($timeZone);
    $newDate = $date->format("Y-m-d H:i:s");

    $status = 1;
    $delivery_cost_id = 2000;

    $cityResultset = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
    $cityData = $cityResultset->fetch_assoc();

    Database::insertUpdateDelete("INSERT INTO `medishop`.`product` (`price`, `qty`, `description`, `title`, `datetime_added`, `category_id`, `user_email`, `condition_id`, `status_id`, `brand_has_model_id`, `delivery_cost_id`, `recycle_bin_id`)
     VALUES ('".$cost."','".$qty."','".$description."','".$title."','".$newDate."','".$category."','".$email."','".$condition."','".$status."','".$brandHasModelId."','".$delivery_cost_id."','1')");

    echo("Product saved successful");

    $productId = Database::$connection->insert_id;

    $length = sizeof($_FILES);
    $allowedImageExtentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    if($length <= 4 && $length > 0){
        for($x = 0; $x < $length; $x++){
            if(isset($_FILES["image".$x])){
                $imagefile = $_FILES["image".$x];
                $fileExtention = $imagefile["type"];

                if(in_array($fileExtention, $allowedImageExtentions)){

                    $newImageExtention;
                    if($fileExtention == "image/jpg"){
                        $newImageExtention = ".jpg";
                    }else if($fileExtention == "image/jpeg"){
                        $newImageExtention = ".jpeg";
                    }else if($fileExtention == "image/png"){
                        $newImageExtention = ".png";
                    }else if($fileExtention == "image/svg+xml"){
                        $newImageExtention = ".svg";
                    }
                    $fileName = "resource//productImages//".$title."_".$x."_".uniqid().$newImageExtention;
                    move_uploaded_file($imagefile["tmp_name"], $fileName);

                    Database::insertUpdateDelete("INSERT INTO `images` (`code`,`product_id`) VALUES ('".$fileName."', '".$productId."')");
                }else{
                    echo("Invalied image type");
                }
            }
        }
    }else{
        echo("Invalied image count");
    }
}
?>