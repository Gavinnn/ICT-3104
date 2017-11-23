<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php

//Retrieve the info
$locationID = post("locationID");
$locationName = post("locationName");
$locationCapacity = post("locationCapacity");


//Query to select locationName
$record = DB::queryFirstRow("SELECT locationName FROM gyms WHERE locationID=%s", $locationID);

//Check if locationName exist
if ($record) {
    $record = DB::update('gyms', array(
                'locationName' => $locationName,
                'locationCapacity' => $locationCapacity
                    ), "locationID=%s", $locationID);
					
	echo "success";		
} 
?>