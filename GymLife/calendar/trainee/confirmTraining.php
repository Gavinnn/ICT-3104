<?php

// When training is confirmed by the Trainee, that training session is updated with that Trainee's ID

// connect to DB
require_once('../../conn.php');

// Confirm INDIVIDUAL trainings
if (isset($_POST['sessionID']) && isset($_POST['traineeID'])){

    $sessionID = $_POST['sessionID'];
    $traineeID = $_POST['traineeID'];
    
	// UPDATE query
    $status = DB::query("UPDATE trainersessions SET  traineeID = %s WHERE sessionID = %d", $traineeID, $sessionID);
    
    //Redirect to traineeCalendar page
    header('Location: traineeCalendar.php');
}

// Confirm GROUP trainings
else if (isset($_POST['groupSessionID']) && isset($_POST['traineeID'])){
    
        $groupSessionID = $_POST['groupSessionID'];
        $traineeID = $_POST['traineeID'];
        
        // check whether that group training does not exceed its max capacity before updating Trainee into the group training
        $validateGS = DB::query("SELECT groupSessionID FROM groupsessions WHERE groupSessionID = %d AND numberOfParticipants < maxCapacity", $groupSessionID);
        
        // group training has NOT reached max capacity
        if (!empty($validateGS)){
            $statusGS = DB::query("UPDATE groupsessions SET numberOfParticipants = numberOfParticipants + 1 WHERE groupSessionID = %d", $groupSessionID);
            $statusTGS = DB::query("INSERT INTO `traineegroupsession`(`groupSessionID`, `traineeID`) VALUES (%d, %d)", $groupSessionID, $traineeID);

            // show success message
            echo "
            <link rel='stylesheet' href='../../asset/plugins/sweetalert-master/sweet-alert.css'>
            <script src='../../asset/plugins/sweetalert-master/sweet-alert.js'></script>
            <body>
            <script>
            swal({title: 'Congratulations!', text: 'The training is sucessfully booked!', type: 'success'}, function() {
                window.location.href = '/GymLife/calendar/trainee/traineeCalendar.php';
            });
            </script></body>";
        }
        // group training has reached max capacity, show errror message
        else{
            echo "
            <link rel='stylesheet' href='../../asset/plugins/sweetalert-master/sweet-alert.css'>
            <script src='../../asset/plugins/sweetalert-master/sweet-alert.js'></script>
            <body>
            <script>
            swal({title: 'Alert!', text: 'The training is fully booked!', type: 'error'}, function() {
                window.location.href = '/GymLife/calendar/trainee/traineeCalendar.php';
            });
            </script></body>";
        }
       
    }
?>