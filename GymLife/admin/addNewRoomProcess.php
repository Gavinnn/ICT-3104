<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$arrData = $_POST['arrData'];
$arrCap = $_POST['arrCap'];
$locationID = $_POST['locationID'];

//Query to select training type
$record = DB::queryFirstRow("SELECT roomName FROM rooms WHERE locationID=%s", $locationID);

$roomRecord = "";

//Check if training type exist
if ($record){
//return training type exist
    foreach (array_combine($arrData, $arrCap) as $data => $cap) {
		//$locationID = DB::queryFirstRow("SELECT locationID FROM gyms WHERE locationID = (SELECT MAX(locationID) FROM gyms)");
		  $roomRecord = DB::insert('rooms', array(
                'locationID' => $locationID,
                'roomName' => $data,
				'roomCapacity' => $cap
				));
	
	}
	echo "success";
}
else {
	echo "failed";
}
?>