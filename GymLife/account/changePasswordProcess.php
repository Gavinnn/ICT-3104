<?php
session_start();
require_once('../conn.php'); //database setting

$id = $_SESSION["id"];
$newPassword = hashPassword(post("newPassword"));
$oldPassword = hashPassword(post("oldpass"));

$record = DB::queryFirstRow("SELECT userID FROM user WHERE userID=%s AND password=%s", $id, $oldPassword);

if ($record) {
    $update = DB::update('user', array(
                'password' => $newPassword
                    ), "userID=%s", $id);
    if ($update)
        echo "success";
} else
    echo "wrongOldPassword";
?>