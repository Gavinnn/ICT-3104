<?php require_once('../conn.php'); ?>
<?php require_once('../session/session.php'); ?>
<?php

//Retrieve the info
$id = $_SESSION['id'];
$name = post("name");
$email = post("email");
$contact = post("contact");

//Query to select username
$record = DB::queryFirstRow("SELECT userID FROM user WHERE email=%s and userID!=%s", $email, $id);

//Check if username exist
if ($record) {
    echo "email";
} else {
    $record = DB::update('user', array(
                'name' => $name,
                'email' => $email,
                'contactNumber' => $contact,
                    ), "userID=%s", $id);
    if ($record) {
        echo "success";
    }
}
?>