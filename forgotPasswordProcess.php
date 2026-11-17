<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["email"])){
    $email = $_GET["email"];
    $resultset = Database::search("SELECT * FROM `user` WHERE email='".$email."'");
    $rownumber = $resultset->num_rows;

    if($rownumber == 1){
        $verificationCode = uniqid();
        Database::insertUpdateDelete("UPDATE `user` SET `verification_code`='".$verificationCode."' WHERE `email`='".$email."'"); 

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dulanjayaedu@gmail.com';
            $mail->Password = 'kutwgcxdoczbdlcu';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('dulanjayaedu@gmail.com', 'Salpila');
            $mail->addReplyTo('dulanjayaedu@gmail.com', 'Salpila');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Forgot Password Verification Code';
            $bodyContent = '<div style="width: auto;height: auto;border-radius: 15px;background-color: #f1cc28;padding-left: 20px;padding-right: 20px;padding-bottom: 20px;">

            <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <h2 style="color: #9e3228;font-family: "Arial";font-size: 30px;">Verification Code Is</h2>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <div style="width: auto;height: auto;border-radius: 10px;font-size: 21px;padding: 10px;background-color: rgb(88, 247, 88);box-shadow: 0px 3px 5px 1px rgba(0, 0, 0, 0.1);font-family: "Arial";"><h3>'.$verificationCode.'</h3></div>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;text-align: center;padding-top: 30px;font-size: 17px;font-family: "Arial";opacity: 0.8;">
                <span>Please enter verification code in Sign In page.Thank You.</span>
            </div>

        </div>';
            $mail->Body = $bodyContent;
            
            if(!$mail->send()){
                echo("Verification code sending failed");
            }else{
                echo("Verification code sent to your email. Please check your email.");
            }
    }
}else{
    echo("Invalied email address");
}
