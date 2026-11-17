<?php

session_start();
require "connection.php";

if(isset($_GET["vcode"])){
    
    $verificationCode = $_GET["vcode"];

    $admin = Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$verificationCode."'");
    $rownumber = $admin->num_rows;

    if($rownumber == 1){
        $data = $admin->fetch_assoc();
        $_SESSION["adminUser"] = $data;
        echo("success");
    }else{
        echo("Invalid Verification Code");
    }

}else{
    echo("Please enter your verification code");
}

?>