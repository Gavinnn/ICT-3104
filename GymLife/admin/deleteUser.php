<?php
require_once('../conn.php');
require_once('../session/adminSession.php');

//Retrieve User ID and email 
$id = $_GET['id'];
$email = $_GET['email'];

//Query to remove User
$record = DB::update('user', array(
  'status' => 4,
), "userid=%s", $id);

if ($record) {
    include "sendEmail.php";
    sendRejectEmail($email);
	header("Location:user.php");
}
?>