<?php
include 'conn.php';

$userid = mysqli_real_escape_string($conn, $_POST['userid']);
$name =mysqli_real_escape_string($conn, $_POST['name']);
$password = md5('password' . 'LRMS');
$email =mysqli_real_escape_string($conn, $_POST['email']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
(isset($_POST['faculty'])) ? $faculty = mysqli_real_escape_string($conn, $_POST['faculty']) : $faculty = $_SESSION['faculty'];    
(isset($_POST['course'])) ? $course = mysqli_real_escape_string($conn,$_POST['course']) : $course = NULL;
(isset($_POST['expertiseLevel'])) ? $expertiseLevel = mysqli_real_escape_string($conn,$_POST['expertiseLevel']) : $expertiseLevel = NULL;
(isset($_POST['hoursClocked'])) ? $hoursClocked = mysqli_real_escape_string($conn,$_POST['hoursClocked']) : $hoursClocked = NULL;
(isset($_POST['labSafetyTest'])) ? $labSafetyTest = mysqli_real_escape_string($conn,$_POST['labSafetyTest']) : $labSafetyTest = NULL;
$lab = $_POST['lab'];

$queryCheckUnicityOfUserid = "SELECT * FROM `user` WHERE `userid` = '$userid'";
$resultCheckUnicityOfUserid = $conn->query($queryCheckUnicityOfUserid);

if($resultCheckUnicityOfUserid->fetch_assoc()){
    echo "notUnique";
}
else{
	$conn->begin_transaction();	
    $query = "INSERT INTO `user` (`userid`, `password`, `name`, `email`, `role`, `faculty`, `courses`, `labSafetyTest`, `expertiseLevel`, `hoursClocked`) VALUES ('$userid', '$password', '$name', '$email', '$role', '$faculty', '$course', '$labSafetyTest', '$expertiseLevel', '$hoursClocked');";
    $result = $conn->query($query);
    
    if($lab!=NULL && sizeof($lab) > 0){
    	for($i = 0; $i < sizeof($lab); $i++){
    		$labId = $lab[$i];
    		$queryUserLab = "INSERT INTO userLab (userid, labId) VALUES ('$userid', '$labId');";
    		$resultUserLab = $conn->query($queryUserLab);
    	}
    }

   if(($result && ($lab != null && $resultUserLab)) || ($result && $lab == null)){
   		$conn->commit(); 
    	echo "success";
    }
    else{    
    	$conn->rollback();     
 	   echo "failed";
    } 
}
?>
