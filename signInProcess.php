<?php

session_start();
require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rem"];

if(empty($email)){
    echo("Please enter email");
}else if(strlen($email) > 100){
    echo("Email must have <100 characters");
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo("Invalied email");
}else if(empty($password)){
    echo("Please enter password");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must be between 5-20 characters");
}else{
    $resultset = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."'");
    $rownumber = $resultset->num_rows;

    if($rownumber == 1){
        $userData = $resultset->fetch_assoc();
        $_SESSION["user"] = $userData;

        if($rememberMe == "true"){
            setcookie("email", $email, time()+60*60*24*365);
            setcookie("password", $password, time()+60*60*24*365);
        }else{
            setcookie("email", "", time());
            setcookie("password", "", time());

        }
        echo("Sign In successful");
    }else{
        echo("Invalied email or password");
    }
}

?>