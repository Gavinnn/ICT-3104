<?php

// When training is confirmed by the Trainee, that training session is updated with that Trainee's ID

// connect to DB
require_once('../../conn.php');

// Confirm INDIVIDUAL trainings
if (isset($_POST['sessionID']) && isset($_POST['traineeID'])){

    $sessionID = $_POST['sessionID'];
    $traineeID = $_POST['traineeID'];
    
	// UPDATE query
	$status = DB::query("UPDATE trainersessions SET  traineeID = %s WHERE sessionID = %d", $traineeID, $sessionID);
}

// Confirm GROUP trainings
else if (isset($_POST['groupSessionID']) && isset($_POST['traineeID'])){
    
        $groupSessionID = $_POST['groupSessionID'];
        $traineeID = $_POST['traineeID'];
        
        // UPDATE query
        $statusGS = DB::query("UPDATE groupsessions SET numberOfParticipants = numberOfParticipants + 1 WHERE groupSessionID = %d", $groupSessionID);
        $statusTGS = DB::query("INSERT INTO `traineegroupsession`(`groupSessionID`, `traineeID`) VALUES (%d, %d)", $groupSessionID, $traineeID);
    }

//Redirect to traineeCalendar page
header('Location: traineeCalendar.php');
?>