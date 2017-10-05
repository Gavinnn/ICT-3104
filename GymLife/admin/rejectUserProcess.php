<?php
require_once('../conn.php');
$id = $_GET['id'];

$record = DB::delete('user',"userid=%s", $id);


if ($record) {
   header("Location:approveUser.php");
}
?>