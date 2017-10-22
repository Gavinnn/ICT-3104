<?php

// To add a Training to DB

// Connect to DB
require_once('../../conn.php');

// ensure all variables are set
if (isset($_POST['title']) && isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['date']) && isset($_POST['trainerID'])){

	// retrieve the data
	$title = $_POST['title'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$trainerID = $_POST['trainerID'];
	
	// transform the data into a datetime string
	$startDate = $_POST['date'] . " " . $startTime . ":00";	// add :00 to match DateTime format as seconds are missing
	$endDate = $_POST['date'] . " " . $endTime . ":00";	// add :00 to match DateTime format as seconds are missing


	// INSERT query
	$status = DB::query("INSERT INTO trainersessions(title, startSession, endSession, trainerID)
	 values (%s, %s, %s, %d)", $title, $startDate, $endDate, $trainerID);
}
//Redirect to trainerCalendar page
header('Location: trainerCalendar.php');
?>
