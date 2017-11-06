<?php 

// desc: delete trainings OR updates title and description of individual trainings

// connect to DB
require_once('../../conn.php');

// DELETE
// ensure all relevant fields are set
if (isset($_POST['delete']) && isset($_POST['groupSessionID'])){
    $id = $_POST['groupSessionID'];
    
    // DELETE query
    $status = DB::query("DELETE FROM groupsessions WHERE groupSessionID = %d", $id);
}

// UPDATE 
// ensure all relevant fields are set
else if (isset($_POST['title']) && isset($_POST['groupSessionID'])){

    $id = $_POST['groupSessionID'];
    $title = $_POST['title'];

	// UPDATE query
	$status = DB::query("UPDATE groupsessions SET title = %s WHERE groupSessionID = %d", $title, $id);
}

//Redirect to adminCalendar page
header('Location: adminCalendar.php');
?>