<?php
require_once('../conn.php');
$id = $_GET['id'];

$record = DB::update('user', array(
  'status' => 2,
), "userid=%s", $id);


if ($record) {
   header("Location:approveUser.php");
}
?>