<?php
require_once('../conn.php');
require_once('../session/adminSession.php'); 
$id = $_GET['id'];

$record = DB::delete('user',"userid=%s", $id);


if ($record) {
   header("Location:approveUser.php");
}
?>