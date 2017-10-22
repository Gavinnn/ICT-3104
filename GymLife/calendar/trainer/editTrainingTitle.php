<?php

// Edit training title and save changes to DB


// connect to DB
require_once('../../conn.php');

// DELETE: ensure that the required variables are set
if (isset($_POST['delete']) && isset($_POST['sessionID'])){

	$id = $_POST['sessionID'];

	// DELETE query
	$status = DB::query("DELETE FROM trainersessions WHERE sessionID = %d", $id);
	
	// error handling
	if (!$status){
		print_r("Error in query");
	}
}
// UPDATE: ensure all required fields are set
elseif (isset($_POST['title']) && isset($_POST['sessionID'])){

	$id = $_POST['sessionID'];
	$title = $_POST['title'];

	// UPDATE query
	$status = DB::query("UPDATE trainersessions SET  title = %s WHERE sessionID = %d", $title, $id);
}


//Redirect to trainerCalendar page
header('Location: trainerCalendar.php');
?>
