<?php

// desc: check if the training that the Trainer created coincides with any of their existing training

// Connect to DB
require_once('../../conn.php');

// DB class prevent SQL injection
$trainerID = htmlspecialchars(post("trainerID"), ENT_QUOTES);
$startDate = post("startDate");
	
$record = DB::query("SELECT sessionID FROM trainerSessions WHERE startSession = %s AND trainerID = %d", $startDate, $trainerID);

// if traiing coincides, echoes true
if ($record){
    echo "true";
}

?>