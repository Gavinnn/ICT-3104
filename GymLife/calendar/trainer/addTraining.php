<?php

// To add a Training to DB

// Connect to DB
require_once('../../conn.php');

// ADD INDIVIDUAL TRAINING
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

// ADD GROUP TRAINING
// ensure all variables are set
else if (isset($_POST['titleAG']) && isset($_POST['categoryAG']) && isset($_POST['gymAG']) && isset($_POST['roomAG']) && isset($_POST['dateAG']) && isset($_POST['startSessionAG']) && isset($_POST['endSessionAG']) && isset($_POST['maxCapacityAG']) && isset($_POST['trainerIdAG'])){
	
		// retrieve the data
		$trainerID = $_POST['trainerIdAG'];
		$title = $_POST['titleAG'];
		$locationID = $_POST['gymAG'];
		$roomID = $_POST['roomAG'];
		$maxCapacity = $_POST['maxCapacityAG'];
		$trainingID = $_POST['categoryAG'];
		
		// transform the data into a datetime string
		$startSession = $_POST['dateAG'] . " " . $_POST['startSessionAG'] . ":00";	// add :00 to match DateTime format as seconds are missing
		$endSession = $_POST['dateAG'] . " " . $_POST['endSessionAG'] . ":00";	// add :00 to match DateTime format as seconds are missing
	
	
		// INSERT query
		// sessionStatus is 1 as this group training is pending approval by admin
		$status = DB::query("INSERT INTO groupsessions(trainerID, trainingID, title, startSession, endSession, roomID, maxCapacity, locationID, sessionStatus)
		 values (%d, %d, %s, %s, %s, %d, %d, %d, %d)", $trainerID, $trainingID, $title, $startSession, $endSession, $roomID, $maxCapacity, $locationID, 1);
	}

//Redirect to trainerCalendar page
header('Location: trainerCalendar.php');
?>
