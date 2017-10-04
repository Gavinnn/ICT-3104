<?php
include 'sessionLink.php';

session_start();
if (isset($_SESSION["id"]))
{
	if($_SESSION["role"]!='admin')
		header('Location:'. $link);
}
else
	header('Location:'. $link);
?>