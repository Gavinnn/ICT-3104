<?php

// To add a Training to DB

// Connect to DB
require_once('../../conn.php');

// ensure all variables are set
if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['gym']) && isset($_POST['rooms']) && isset($_POST['date']) && isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['description']) && isset($_POST['trainerID'])){

	// retrieve the data
	$trainerID = $_POST['trainerID'];
	$title = $_POST['title'];
	$locationID = $_POST['gym'];
	$roomID = $_POST['rooms'];
	$description = $_POST['description'];
	$trainingID = $_POST['category'];
	
	// transform the data into a datetime string
	$startSession = $_POST['date'] . " " . $_POST['startTime'] . ":00";	// add :00 to match DateTime format as seconds are missing
	$endSession = $_POST['date'] . " " . $_POST['endTime'] . ":00";	// add :00 to match DateTime format as seconds are missing


	// INSERT query
	$status = DB::query("INSERT INTO trainersessions(trainerID, title, locationID, roomID, description, trainingID, startSession, endSession)
	 values (%d, %s, %d, %d, %s, %d, %s, %s)", $trainerID, $title, $locationID, $roomID, $description, $trainingID, $startSession, $endSession);
}
//Redirect to trainerCalendar page
header('Location: trainerCalendar.php');
?>
