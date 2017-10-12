<?php
//----------------------------------------------------------------------------------------------------------------------
// @desc: send a approval email to the user
// @params: $email - email of user to be sent (String)
//----------------------------------------------------------------------------------------------------------------------
function sendApproveEmail($email)
{
    $emailContents = new EmailContents();
    sendEmail($email, $emailContents->getApproveEmailSubject(), $emailContents->getApproveEmailBody());
}

//----------------------------------------------------------------------------------------------------------------------
// @desc: send a rejection email to the user
// @params: $email - email of user to be sent (String)
//----------------------------------------------------------------------------------------------------------------------
function sendRejectEmail($email)
{
    $emailContents = new EmailContents();
    sendEmail($email, $emailContents->getRejectEmailSubject(), $emailContents->getRejectEmailBody());
}

//----------------------------------------------------------------------------------------------------------------------
// @desc: send a creation email to the user request to change password
// @params: $email - email of user to be sent (String)
//----------------------------------------------------------------------------------------------------------------------
function sendPasswordEmail($email,$id)
{
    $emailContents = new EmailContents();
    sendEmail($email, $emailContents->getPasswordEmailSubject(), $emailContents->getPasswordEmailBody($id));
}

//----------------------------------------------------------------------------------------------------------------------
// @desc: builds the PHPMailer configurations and send the email
// @params: $email - email of user to be sent (String)
//          $subject - title of email (String)
//          $body - body contents of email (String)
//----------------------------------------------------------------------------------------------------------------------
function sendEmail($email, $subject, $body)
{
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
class EmailContents
{
        // APPROVE email contents
    public function getApproveEmailSubject()
    {
        return 'Congratulations on joining GymLife!';
    }
    public function getApproveEmailBody()
    {
        $url = 'http://' . $_SERVER["SERVER_NAME"] . '/GymLife/';
        return "Hey! You are now an esteemed and honorable member of GymLife! Get stared in the link here: <a href='$url'>$url</a>";
    }
    
        // REJECT email contents
    public function getRejectEmailSubject()
    {
        return 'Our humblest apologies';
    }
    public function getRejectEmailBody()
    {
        return 'Unfortunately, your applciation at GymLife has been rejected. Please try again.';
    }
	
	    // Creation email contents
    public function getPasswordEmailSubject()
    {
        return 'Congratulations on joining GymLife!';
    }
    public function getPasswordEmailBody($id)
    {
        $url = 'http://' . $_SERVER["SERVER_NAME"] . '/GymLife/';
        return "Hey! You are now an esteemed and honorable member of GymLife! Get stared in the link here:<a href='$url'>$url</a>		<br>Username:$id<br>Password: Password1<br>Kindly change your password once you have login";
    }
}
