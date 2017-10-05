<?php
require_once('../conn.php');
require_once('../session/adminSession.php'); 
$id = $_GET['id'];
$email = $_GET['email'];

$record = DB::delete('user',"userid=%s", $id);


if ($record) {

    include "sendEmail.php";
    sendRejectEmail($email);

   header("Location:approveUser.php");
}
?>