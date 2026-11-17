<?php
require "connection.php";

if(isset($_GET["district"])){
    $district = $_GET["district"];
    $cityResultset = Database::search("SELECT * FROM `city` WHERE `district_id`='".$district."'");
    $cityRownumber = $cityResultset->num_rows;
    echo("<option value='0'>Select City</option>");
    for($x = 0; $x < $cityRownumber; $x++){
        $cityData = $cityResultset->fetch_assoc();
        ?>
        <option value="<?php echo($cityData["id"]); ?>"><?php echo($cityData["name"]); ?></option>
        <?php
    }
}
?>