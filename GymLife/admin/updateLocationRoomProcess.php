<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$locationID = $_POST("locationID");
$locationName = $_POST("locationName");
$capacity = $_POST("capacity");

//Query to select training type
$record = DB::queryFirstRow("SELECT locationName FROM gyms WHERE locationID=%s", $locationID);

$roomRecord = "";

//Check if training type exist
if ($record)
//return training type exist
    echo "locationName";
else {
		$record = DB::update('gyms', array(
                'locationName' => $locationName,
                'capacity' => $capacity
                    ), "locationID=%s", $locationID);
				
	}
    //return message
    echo "success";
}
?>