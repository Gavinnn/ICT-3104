<?php

// @desc: Admin sends a notification email to the user when the admin approves the user
// @params: $email - email of user (String)
function sendAccountIsVerifiedEmail($email)
{
    require '../asset/plugins/PHPMailer/PHPMailerAutoload.php';
        
    $url = 'http://' . $_SERVER["SERVER_NAME"] . '/GymLife/';

    $mail = new PHPMailer;
        
    // SMTP configurations
    $mail->isSMTP();    // Set mailer to use SMTP
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->Username = "gymlife3104@gmail.com";  // SMTP username [default account for gymLife]
    $mail->Password = "scrum3104";  // SMTP password
    $mail->SMTPSecure = 'ssl';  // Enable SSL encryption
        
    // Email data
    $mail->setFrom('gymlife3104@gmail.com', 'Gym Life');    // sender
    $mail->addAddress($email);   // receiver
    $mail->isHTML(true);
    $mail->Subject = 'Congratulations on joining GymLife!';
    $mail->Body = 'Hey! You are now an esteemed and honorable member of GymLife! Get stared in the link here: ' . $url;
        
    // send email
    if (!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }
}
