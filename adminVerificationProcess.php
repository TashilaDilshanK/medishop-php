<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["email"])){
    $email = $_POST["email"];

    $adminResultset = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $adminRownumber = $adminResultset->fetch_assoc();

    if($adminRownumber > 0){
        $code = uniqid();
        Database::insertUpdateDelete("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tashilad.se@gmail.com';
            $mail->Password = 'aetthnfuhlcitcpb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('tashilad.se@gmail.com', 'Admin Verification');
            $mail->addReplyTo('tashilad.se@gmail.com', 'Admin Verification');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin Login Verification Code';
            $bodyContent = '<h2 style="color:blue; ">Your verification code is <b><i>'.$code.'</b></i></h2>';
            $mail->Body = $bodyContent;
            
            if(!$mail->send()){
                echo("Verification Code sending failed");
            }else{
                echo("success");
            }
    }else{
        echo("You are not valid user");
    }
}else{
    echo("Email field should not be empty");
}
