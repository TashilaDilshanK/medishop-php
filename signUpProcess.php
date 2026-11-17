<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$adres1 = $_POST["adres1"];
$adres2 = $_POST["adres2"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if (empty($fname)) {
    echo ("Please enter first name");
} else if (strlen($fname) > 50) {
    echo ("First name must have <50 characters");
} else if (empty($lname)) {
    echo ("Please enter last name");
} else if (strlen($lname) > 50) {
    echo ("Last name must have <50 characters");
} else if (empty($email)) {
    echo ("Please enter email");
} else if (strlen($email) > 100) {
    echo ("Email must have <100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email");
} else if (empty($password)) {
    echo ("Please enter password");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5-20 characters");
}else if (empty($adres1)) {
    echo ("Please enter Adress Line 1");
} else if (empty($adres2)) {
    echo ("Please enter Adress Line 2");
}  else if (empty($mobile)) {
    echo ("Please enter mobile");
}else if(strlen($mobile) != 10){
    echo("Mobile must have 10 characters");
} else if (!preg_match("/07[1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid mobile");
} else {

    $resultset = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `password`='".$password."'");
    $rownumber = $resultset->num_rows;

    if ($rownumber > 0) {
        echo("User with the same email or mobile already exists");
    } else {
        $date = new DateTime();
        $timeZone = new DateTimeZone("Asia/colombo");
        $date->setTimezone($timeZone);
        $newDate = $date->format("Y-m-d H:i:s");

        Database::insertUpdateDelete("INSERT INTO `user` (`email`,`fname`,`lname`,`password`, `mobile`,`adres1`,`adres2`,`joined_date`,`status`,`gender_id`) VALUES ('".$email."','".$fname."','".$lname."','".$password."', '".$mobile."','".$adres1."','".$adres2."','".$newDate."','1','".$gender."')");

        echo("Sign Up successful");
    }
}
