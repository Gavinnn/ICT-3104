<?php
require_once('../conn.php');
require_once('../session/adminSession.php');

//Retrieve User ID and email 
$id = $_GET['id'];

$record = DB::delete('info', "infoID=%s", $id);

if ($record) {
	header("Location:content.php");
}
?>