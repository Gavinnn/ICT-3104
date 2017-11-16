<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$locationName = post("locationName");
$capacity = post("capacity");
$arrData = $_POST['arrData'];
$arrCap = $_POST['arrCap'];
var_dump($arrCap);

//Query to select training type
$record = DB::queryFirstRow("SELECT locationName FROM gyms WHERE locationName=%s", $locationName);

$roomRecord = "";

//Check if training type exist
if ($record)
//return training type exist
    echo "locationName";
else {
    //add the record into db
    /*$record = DB::insert('gyms', array(
                'locationName' => $locationName,
                'locationCapacity' => $capacity
    ));
	*/
	//foreach($arrData as $d){
		//foreach($arrCap as $e){
		foreach (array_combine($arrData, $arrCap) as $data => $cap) {
		$locationID = DB::queryFirstRow("SELECT locationID FROM gyms WHERE locationID = (SELECT MAX(locationID) FROM gyms)");
		  $roomRecord = DB::insert('rooms', array(
                'locationID' => reset($locationID),
                'roomName' => $data,
				'roomCapacity' => $cap
				));
				
	}
    //return message
    echo "success";
}
?>