<?php
// Update training date and save changes to DB

// Connect to DB
require_once('../conn.php');

// ensure that all required variables are set
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){

	// retrieve variables
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	// UPDATE query
	$status = DB::query("UPDATE trainersessions 
	SET  startSession = %s, endSession = %s
	WHERE sessionID = %d", $start, $end, $id);
	
	// error handling
	if (!$status){
		die ('Error in preventing query');
	}
	else{
		die ('OK');
	}
}
//Redirect to trainerCalendar page
header('Location: trainerCalendar.php');
?>
