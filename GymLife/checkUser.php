<?php
//Config for database
require_once('conn.php');

//DB class prevent SQL injection
$id=htmlspecialchars(post("id"), ENT_QUOTES);
$pass=hashPassword(post("pass"));

//Query to select username
$record = DB::queryFirstRow("SELECT userID FROM user WHERE userName=%s AND password=%s AND status=2", $id, $pass);


//Check if account is valid
if($record)
	echo "exist";
else
	echo "no";
?>