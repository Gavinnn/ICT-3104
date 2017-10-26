<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
<?php

//Retrieve the info
$username = post("username");
$name = post("name");
$email = post("email");
$contact = post("contact");
$role = post("role");
$pass = "password";
$hashedpass = hashPassword($pass);

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
                    'password' => $hashedpass,
                    'status' => 2,
					'passwordChange' =>1
        ));
        if ($record) {
			include 'sendEmail.php';
			sendPasswordEmail($email,$username);
            echo "success";
        }
    }
}
?>