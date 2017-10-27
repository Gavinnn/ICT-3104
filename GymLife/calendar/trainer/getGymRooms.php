<?php
    // desc: to get all the gym rooms based on the locationID (gymID)

    //Config for database
    require_once('../../conn.php');

    // DB class prevent SQL injection
    $locationID = htmlspecialchars(post("locationID"), ENT_QUOTES);

    // retrieve gym rooms
    $record = DB::query("SELECT * FROM rooms WHERE locationID = %s", $locationID);

    // ensure that the record is not empty, echo the options for the rooms of the gym
    if (!empty($record)){
        $returnVal = '';
        foreach ($record as $room){
            $returnVal .= "<option value='" . $room['roomID']  . "' data-roomid='" . $room['roomID'] . "'>" . $room['roomName'] . "</option>";
        }
        echo $returnVal;
    }
?>