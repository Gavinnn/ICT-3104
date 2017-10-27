<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$trainingType = post("trainingType");
$description = post("description");
$cost = post("cost");

//Query to select training type
$record = DB::queryFirstRow("SELECT trainingID FROM trainings WHERE trainingType=%s", $trainingType);

//Check if training type exist
if ($record)
//return training type exist
    echo "trainingType";
else {
    //add the record into db
    $record = DB::insert('trainings', array(
                'trainingType' => $trainingType,
                'description' => $description,
                'cost' => $cost
    ));
    //return message
    echo "success";
}
?>