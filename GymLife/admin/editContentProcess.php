<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php

//Retrieve the info
$description = post("description");
$id = post("infoID");

//Query to select username
$record = DB::queryFirstRow("SELECT infoID FROM info WHERE infoID=%s", $id);

//Check if username exist
if ($record) {

    $record = DB::update('info', array(
                'description' => $description,
                    ), "infoID=%s", $id);
    if ($record) {
        echo "success";
    }
}
?>