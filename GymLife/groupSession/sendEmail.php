<?php

//----------------------------------------------------------------------------------------------------------------------
// @desc: send a approval email to the user
// @params: $email - email of user to be sent (String)
// @params: $approve - 1= true 0= false, action of mail (Integer)
//----------------------------------------------------------------------------------------------------------------------
function sendApproveEmail($email,$approve) {
    $emailContents = new EmailContents();
    if ($approve == 2)
        sendEmail($email, $emailContents->getApproveEmailSubject(), $emailContents->getApproveEmailBody());
    if ($approve == 3)
        sendEmail($email, $emailContents->getRejectEmailSubject(), $emailContents->getRejectEmailBody());
}

//----------------------------------------------------------------------------------------------------------------------
// @desc: builds the PHPMailer configurations and send the email
// @params: $email - email of user to be sent (String)
//          $subject - title of email (String)
//          $body - body contents of email (String)
//----------------------------------------------------------------------------------------------------------------------
function sendEmail($email, $subject, $body) {
    require '../asset/plugins/PHPMailer/PHPMailerAutoload.php';
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
    $mail->Subject = $subject;
    $mail->Body = $body;

// send email
    if (!$mail->send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }
}

//----------------------------------------------------------------------------------------------------------------------
// @desc: contain the different subjects and body contents of differnet kinds of emails
//----------------------------------------------------------------------------------------------------------------------
class EmailContents {

    // APPROVE email contents
    public function getApproveEmailSubject() {
        return 'Congratulations, GymLife group training proposal has been approved!';
    }

    public function getApproveEmailBody() {
        return "Congratulations, your group training proposal has been approved!";
    }

    // REJECT email contents
    public function getRejectEmailSubject() {
        return 'Our humblest apologies';
    }

    public function getRejectEmailBody() {
        return 'Unfortunately, your group training proposal at GymLife has been rejected. Please try again.';
    }
}
