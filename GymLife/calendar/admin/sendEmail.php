<?php

//----------------------------------------------------------------------------------------------------------------------
// @desc: send a approval email to the user
// @params: $email - email of user to be sent (String)
//----------------------------------------------------------------------------------------------------------------------
function sendDeletionMail($email) {
    $emailContents = new EmailContents();
	sendEmail($email, $emailContents->getDeleteEmailSubject(), $emailContents->getDeleteEmailBody());
}

function sendTraineeMail($email) {
    $emailContents = new EmailContents();
	sendEmail($email, $emailContents->getDeleteTraineeEmailSubject(), $emailContents->getDeleteTraineeEmailBody());
}


//----------------------------------------------------------------------------------------------------------------------
// @desc: builds the PHPMailer configurations and send the email
// @params: $email - email of user to be sent (String)
//          $subject - title of email (String)
//          $body - body contents of email (String)
//----------------------------------------------------------------------------------------------------------------------
function sendEmail($email, $subject, $body) {
    require_once '../../asset/plugins/PHPMailer/PHPMailerAutoload.php';
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

    // Group Training Deletion for Trainer
    public function getDeleteEmailSubject() {
        return 'GymLife Group Training Deletion';
    }

    public function getDeleteEmailBody() {
        return 'Unfortunately, your group training session has been removed. Please contact us if you have any queries.';
    }
	
	// Group Training Deletion for Trainee
    public function getDeleteTraineeEmailSubject() {
        return 'GymLife Group Training Removal';
    }

    public function getDeleteTraineeEmailBody() {
        return 'Unfortunately, your group training session has been removed. Please contact us if you have any queries.';
    }
}
