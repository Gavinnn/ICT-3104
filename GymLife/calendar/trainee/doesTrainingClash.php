<?php

    // TODO: To be deprecated. Need to ensure no other components is dependent on this before removal

    // desc: to check whether the training the Trainee has selected clashes with any of their existing trainings

    //Config for database
    require_once('../../conn.php');

    //DB class prevent SQL injection
    $traineeID = htmlspecialchars(post("traineeID"), ENT_QUOTES);
    $startTime = post("startTime");

    // retrieve any trainings that clashes with the training that the Trainee intends to book
    $record = DB::query("SELECT * FROM trainersessions WHERE traineeID = %s AND startSession = %s", $traineeID, $startTime);

    // if there are trainings, does clashes. Return true
    if ($record) {
        echo "true";
    } 
    // if there are no trainings, does not clash. Return false
    else{
        echo "false";
    }
    
?>