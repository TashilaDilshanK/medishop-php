<?php

    require "connection.php";

    $email = $_POST["email"];
    $verificationcode = $_POST["code"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    
    if(empty($email)){
        echo("Missing email address");
    }else if(empty($password1)){
        echo("Please insert a new password");
    }else if(strlen($password1) < 5 || strlen($password1) > 20){
        echo("Password must be between 5-20 characters");
    }else if(empty($password2)){
        echo("Please retype a new password");
    }else if($password1 != $password2){
        echo("Password does not matched");
    }else if(empty($verificationcode)){
        echo("Please enter your verification code");
    }else{
        $resultset = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code`='".$verificationcode."'");
        $rownumber = $resultset->num_rows;

        if($rownumber == 1){
            Database::insertUpdateDelete("UPDATE `user` SET `password`='".$password1."' WHERE `email`='".$email."'");
            echo("Password reset successful");
        }else{
            echo("Invalied email or verification code");
        }
    }
?>