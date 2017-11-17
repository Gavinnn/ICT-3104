<?php

require_once('../../conn.php');
 require_once('../../session/session.php');
if (isset($_SESSION['id']) && isset($_GET['id'])){
	// DB class prevent SQL injection
	$traineeID = $_SESSION['id'];
	$trainerID = $_GET['id'];	

	$status = DB::query("UPDATE user SET personalTrainerID = %d WHERE userID = %d", $trainerID, $traineeID);

	// error handling
		if (!$status){
			echo ('Error in preventing query');
		}
		else{
			echo ('OK');
		}
}
//Redirect to viewAllTrainers page
header('Location: viewAllTrainers.php');
?>