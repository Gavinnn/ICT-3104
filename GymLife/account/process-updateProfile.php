<?php require_once('../conn.php'); ?>
<?php require_once('../session/session.php'); ?>

<?php

$id = $_SESSION['id'];
$username = $_POST["userName"];
$name = $_POST["name"];
$email = $_POST["email"];
$contact = $_POST["contactNumber"];
$record = DB::update('user', array(
            'userName' => $username,
            'name' => $name,
            'email' => $email,
            'contactNumber' => $contact,
                ), "userID=%s", $id);

if ($record === TRUE) {
     echo'<p>Updated Course Request Succesfully!</p>';
    header("Location:http://" . $_SERVER["SERVER_NAME"] . "/GymLife/account/editProfile.php");
   
 }
 else{
     echo "ERROR";
 }
?>