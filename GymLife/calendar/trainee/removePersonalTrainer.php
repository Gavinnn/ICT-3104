<?php
require_once('../../conn.php');
require_once('../../session/session.php');
// DB class prevent SQL injection

if (isset($_SESSION['id'])){
	$traineeID = $_SESSION['id'];

	$status = DB::query("UPDATE user SET personalTrainerID = '' WHERE userID = %d", $traineeID);

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