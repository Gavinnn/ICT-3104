<?php
require_once('../conn.php');
require_once('../session/adminSession.php'); 
$id = $_GET['id'];
$email = $_GET['email'];

$record = DB::update('user', array(
  'status' => 2,
), "userid=%s", $id);


if ($record) {
	//Mail Function
    include 'sendEmail.php';
    sendApproveEmail($email);
	//Redirection
	header("Location:approveUser.php");
}
?>