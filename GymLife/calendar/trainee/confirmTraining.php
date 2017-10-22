<?php

// When training is confirmed by the Trainee, that training session is updated with that Trainee's ID

// connect to DB
require_once('../../conn.php');

if (isset($_POST['sessionID']) && isset($_POST['traineeID'])){

    $sessionID = $_POST['sessionID'];
    $traineeID = $_POST['traineeID'];
    
	// UPDATE query
	$status = DB::query("UPDATE trainersessions SET  traineeID = %s WHERE sessionID = %d", $traineeID, $sessionID);
}

//Redirect to traineeCalendar page
header('Location: traineeCalendar.php');
?>