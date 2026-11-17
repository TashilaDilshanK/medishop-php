<?php

require "connection.php";

if(isset($_GET["brand"])){
    $brandID = $_GET["brand"];
    $modelResultset = Database::search("SELECT * FROM `model` WHERE `brand_id`='".$brandID."'");
    $modelRownumber = $modelResultset->num_rows;

    if($modelRownumber > 0){
        for($x = 0; $x < $modelRownumber; $x++){
            $modelData = $modelResultset->fetch_assoc();
            ?>
            <option value="<?php echo($modelData["id"]); ?>"><?php echo($modelData["name"]); ?></option>
            <?php
        }
    }else{
        $allModel = Database::search("SELECT * FROM `model`");
        $allModelrownumber = $allModel->num_rows;

        for($y = 0; $y < $allModelrownumber; $y++){
            $allModelData = $allModel->fetch_assoc();
            ?>
            <option value="<?php echo($allModelData["id"]); ?>"><?php echo($allModelData["name"]); ?></option>
            <?php
        }
    }
}
?>