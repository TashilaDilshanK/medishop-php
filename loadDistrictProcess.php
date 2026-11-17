<?php
require "connection.php";

if(isset($_GET["province"])){
    $province = $_GET["province"];
    $districtResultset = Database::search("SELECT * FROM `district` WHERE `province_id`='".$province."'");
    $districtRownumber = $districtResultset->num_rows;
    echo("<option value='0'>Select District</option>");
    for($x = 0; $x < $districtRownumber; $x++){
        $districtData = $districtResultset->fetch_assoc();
        ?>
        <option value="<?php echo($districtData["id"]); ?>"><?php echo($districtData["name"]); ?></option>
        <?php
    }
}
?>