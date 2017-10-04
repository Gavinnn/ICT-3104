<?php
include 'sessionLink.php';

session_start();
if (isset($_SESSION["id"]))
{
	if($_SESSION["role"]!='trainer')
		header('Location:'. $link);
}
else
	header('Location:'. $link);
?>