<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php

//Retrieve the info
$trainingType = post("trainingType");
$description = post("description");
$cost = post("cost");
$id = post("trainingID");

//Query to select username
$record = DB::queryFirstRow("SELECT trainingID FROM trainings WHERE trainingID=%s", $id);

//Check if username exist
if ($record) {

    $record = DB::update('trainings', array(
                'trainingType' => $trainingType,
                'description' => $description,
                'cost' => $cost
                    ), "trainingID=%s", $id);
    if ($record) {
        echo "success";
    }
}
?>