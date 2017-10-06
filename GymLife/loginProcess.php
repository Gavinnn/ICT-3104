<?php
//Config for database
require_once('conn.php');

//Post data from page
$id=post("user");

//Retrieve user info
$record = DB::queryFirstRow("SELECT * FROM user WHERE userName=%s", $id);

//Check if record exist
if($record)
{
	//Successfully login and store user session
	session_start();
	$_SESSION["id"] = $record['userID'];
	$_SESSION["name"] = $record['name'];
	//Store role of user
	if($record['roleID'] ==1)
		$_SESSION["role"] = "admin";
	if($record['roleID'] ==2)
		$_SESSION["role"] = "trainer";
	if($record['roleID'] ==3)
		$_SESSION["role"] = "trainee";
	//Redirect to page
	header('Location: index.php');
}
?>