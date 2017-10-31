<?php
require_once('../conn.php');
require_once('../session/adminSession.php');
$id = $_GET['id'];
$approve = $_GET['approve'];

$record = DB::update('groupsessions', array(
            'sessionStatus' => $approve,
                ), "groupSessionID=%s", $id);

if ($record) {
    //Mail Function
    include 'sendEmail.php';
    $record = DB::queryFirstRow("SELECT * FROM `groupsessions` INNER JOIN user ON groupsessions.trainerID = user.userID WHERE `groupSessionID` =%s", $id);
    $email = $record["email"];
    sendApproveEmail($email,$approve);
    //Redirection
    header("Location:viewGroupSession.php");
}
?>