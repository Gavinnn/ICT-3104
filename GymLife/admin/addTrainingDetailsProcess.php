<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$trainingType = post("trainingType");
$description = post("description");
$cost = post("cost");

//Query to select username
$record = DB::queryFirstRow("SELECT trainingID FROM trainings WHERE trainingType=%s", $trainingType);

//Check if username exist
if ($record)
    echo "trainingType";
else {
    //Query to select email
    $record = DB::queryFirstRow("SELECT trainingID FROM trainings WHERE trainingType=%s", $trainingType);
    if ($record) {
        echo "email";
    } else {
        $record = DB::insert('trainings', array(
                    'trainingType' => $trainingType,
                    'description' => $description,
                    'cost' => $cost
        ));
    }
}
?>