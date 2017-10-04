<?php
//Config for database
require_once('conn.php');

//Post data from page
$id=post("user");

//Retrieve user info
$record = DB::queryFirstRow("SELECT * FROM user WHERE email=%s", $id);

//Check if record exist
if($record)
{
	//Successfully login and store user session
	session_start();
	$_SESSION["id"] = $record['userID'];
	$_SESSION["name"] = $record['name'];
	$_SESSION["role"] = $record['roleID'];
	//Redirect to page
	header('Location: index.php');
}
?>