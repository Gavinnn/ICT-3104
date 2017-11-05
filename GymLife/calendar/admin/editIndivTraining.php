<?php 

// desc: delete trainings OR updates title and description of individual trainings

// connect to DB
require_once('../../conn.php');

// DELETE
// ensure all relevant fields are set
if (isset($_POST['delete']) && isset($_POST['sessionID'])){
    $id = $_POST['sessionID'];
    
    // DELETE query
    $status = DB::query("DELETE FROM trainersessions WHERE sessionID = %d", $id);
}

// UPDATE 
// ensure all relevant fields are set
else if (isset($_POST['title']) && isset($_POST['description'])  && isset($_POST['sessionID'])){

    $id = $_POST['sessionID'];
    $title = $_POST['title'];
    $description = $_POST['description'];

	// UPDATE query
	$status = DB::query("UPDATE trainerSessions SET title = %s, description = %s WHERE sessionID = %d", $title, $description, $id);
}

//Redirect to adminCalendar page
header('Location: adminCalendar.php');
?>