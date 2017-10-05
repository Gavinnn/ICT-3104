<?php

//Config for database
require_once('conn.php');

//Post from form
$username = post("username");
$name = post("name");
$email = post("email");
$contact = post("contact");
$role = post("role");
$pass = hashPassword(post("password"));

//Query to select username
$record = DB::queryFirstRow("SELECT userID FROM user WHERE username=%s", $username);

//Check if username exist
if ($record)
    echo "username";
else {
    //Query to select email
    $record = DB::queryFirstRow("SELECT userID FROM user WHERE email=%s", $email);
    if ($record) {
        echo "email";
    } else {
        $record = DB::insert('user', array(
                    'username' => $username,
                    'name' => $name,
                    'email' => $email,
					'contactNumber' => $contact,
                    'roleID' => $role,
                    'password' => $pass,
                    'status' => 1
        ));
        if ($record) {
            echo "success";
        }
    }
}
?>