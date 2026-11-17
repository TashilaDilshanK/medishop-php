<?php

require "connection.php";

if(isset($_GET["category"])){
    $categoryID = $_GET["category"];
    $brandResultset = Database::search("SELECT * FROM `brand` WHERE `category_id`='".$categoryID."'");
    $brandRownumber = $brandResultset->num_rows;

    if($brandRownumber > 0){
        for($x = 0; $x < $brandRownumber; $x++){
            $brandData = $brandResultset->fetch_assoc();
            ?>
            <option value="<?php echo($brandData["id"]); ?>"><?php echo($brandData["name"]); ?></option>
            <?php
        }
    }else{
        $allBrand = Database::search("SELECT * FROM `brnad`");
        $allBrandrownumber = $allBrand->num_rows;

        for($y = 0; $y < $allBrandrownumber; $y++){
            $allBrandData = $allBrand->fetch_assoc();
            ?>
            <option value="<?php echo($allBrandData["id"]); ?>"><?php echo($allBrandData["name"]); ?></option>
            <?php
        }
    }
}
?>