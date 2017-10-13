<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php

//Retrieve the info
$id = post("userid");
$username = post("username");
$name = post("name");
$email = post("email");
$contact = post("contact");
$status = post("status");
$role = post("role");

//Query to select username
$record = DB::queryFirstRow("SELECT userID FROM user WHERE email=%s AND userID!=%s", $email,$id);

//Check if username exist
if ($record) {
    echo "email";
} else {
    $record = DB::update('user', array(
                'name' => $name,
                'email' => $email,
                'contactNumber' => $contact,
				'status' => $status,
				'roleID' => $role
                    ), "userID=%s", $id);
    if ($record) {
        echo "success";
    }
}
?>