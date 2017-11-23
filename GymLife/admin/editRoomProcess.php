<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php

//Retrieve the info
$roomID = post("roomID");
$roomName = post("roomName");
$roomCapacity = post("roomCapacity");


//Query to select roomName
$record = DB::queryFirstRow("SELECT roomName FROM rooms WHERE roomID=%s", $roomID);

//Check if roomName exist
if ($record) {
    $record = DB::update('rooms', array(
                'roomName' => $roomName,
                'roomCapacity' => $roomCapacity
                    ), "roomID=%s", $roomID);
					
	echo "success";		
} 
?>