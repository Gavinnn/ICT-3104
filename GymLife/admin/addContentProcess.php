<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$description = post("description");

//add the record into db
$record = DB::insert('info', array(
            'description' => $description,
        ));
//return message
echo "success";
?>