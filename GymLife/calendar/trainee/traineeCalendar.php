<?php
    require_once('../../session/session.php');

    $traineeID = $_SESSION['id'];
    
    include 'getTrainings.php';
    $events = getTrainings($traineeID);
    $userEvents = getUserTrainings($traineeID);
    $groupUserEvents = getGroupUserTrainings($traineeID);

    // get personalTrainerID
    require_once('../../conn.php');
    $result = DB::query("SELECT personalTrainerID FROM user WHERE userID = %d", $traineeID);
    $personalTrainerID = $result[0]["personalTrainerID"];
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

    <head>

        <!-- Basic -->
        <title>GymLife | My Trainer Calendar</title>

        <!-- Define Charset -->
        <meta charset="utf-8">

        <!-- Responsive Metatag -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Page Description and Author -->
        <meta name="description" content="Sulfur - Responsive HTML5 Template">
        <meta name="author" content="Shahriyar Ahmed">

        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.min.css" type="text/css">

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../../asset/font-awesome/css/font-awesome.min.css" type="text/css">

        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="../../asset/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" href="../../asset/css/owl.theme.css" type="text/css">
        <link rel="stylesheet" href="../../asset/css/owl.transitions.css" type="text/css">

        <!-- Css3 Transitions Styles  -->
        <link rel="stylesheet" type="text/css" href="../../asset/css/animate.css">

        <!-- Lightbox CSS -->
        <link rel="stylesheet" type="text/css" href="../../asset/css/lightbox.css">

        <!-- Sulfur CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="../../asset/css/style.css">

        <!-- Responsive CSS Style -->
        <link rel="stylesheet" type="text/css" href="../../asset/css/responsive.css">

        <!-- FullCalendar -->
        <link href='../../asset/plugins/fullCalendar/css/fullcalendar.css' rel='stylesheet' />

        <!-- Timepicker -->
        <link href='../../asset/plugins/fullCalendar/css/jquery.timepicker.css' rel='stylesheet'/>

        <!--SweetAlert-->
        <link rel="stylesheet" href="../../asset/plugins/sweetalert-master/sweet-alert.css">

		<!--SweetAlert-->
        <script src="../../asset/plugins/sweetalert-master/sweet-alert.js"></script>

        <script src="../../asset/js/modernizrr.js"></script>


    </head>

    <body>

        <!--Navigation Section-->
        <?php require_once('../../header.php'); ?>

        <!-- Start Header Section -->
        <div class="page-header">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>My Training Calendar</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->
        
        <div class="container">

            <!-- Legend Calendar -->
            <div class="row">
                <h2>Calendar Legend</h2>
                    <table class="tableLegend">
                        <tbody>
                        <tr>
                        <td class="legend_item indivTraining tdLegend"></td><td>Your Individual Training</td>
                        <td class="legend_item groupTraining tdLegend"></td><td>Your Group Trainings</td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
            </div>

            <div class="row">
            <div class="col-lg-12 text-center">
            <br>
            <button type="button" id="viewUserTrainingsBtn" class="btn btn-success" onclick="viewOnlyUserIndivTrainings()">View your individual trainings only</button>
             <button type="button" id="viewUserGroupTrainingsBtn" class="btn btn-info" onclick="viewOnlyUserGroupTrainings()">View your group trainings only</button>
                <br>
                <br>
                <br>
                <div id="calendar" class="col-centered">
                </div>
                <br>
            </div>
        </div>
            

        <!-- Confirm Individual Training Modal -->
        <?php require_once('./modal/modalIndivTraining.php'); ?>

        <!-- Confirm Group Training Modal -->
        <?php require_once('./modal/modalGroupTraining.php'); ?>
        

    </div>


        <!-- jQuery Version 1.11.1 -->
    <script src="../../asset/plugins/fullCalendar/js/jquery.js"></script>
    
    <!-- FullCalendar -->
        <script src='../../asset/plugins/fullCalendar/js/moment.min.js'></script>
        <script src='../../asset/plugins/fullCalendar/js/fullcalendar.min.js'></script>

        <script src="initializeTraineeCalendar.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(initializeTraineeCalendar(<?php echo json_encode(array_merge($userEvents, $groupUserEvents)) ?> ));
        </script>

        <!-- Timepicker  -->
        <script src="../../asset/plugins/fullCalendar/js/jquery.timepicker.js"></script>

    <!-- Bootstrap -->
    <script src="../../asset/bootstrap/js/bootstrap.min.js"></script>

    <!-- Sulfur JS File -->
    <!-- <script src="../asset/js /jquery-2.1.3.min.js"></script> -->
    <script src="../../asset/js/jquery-migrate-1.2.1.min.js"></script>

    <script src="../../asset/js/owl.carousel.min.js"></script>
    <script src="../../asset/js/jquery.appear.js"></script>
    <script src="../../asset/js/jquery.fitvids.js"></script>
    <script src="../../asset/js/jquery.nicescroll.min.js"></script>
    <script src="../../asset/js/lightbox.min.js"></script>
    <script src="../../asset/js/count-to.js"></script>
    <script src="../../asset/js/styleswitcher.js"></script>

    <!-- Render HTML elements in modal depending on use case -->
    <script>

        initModalHandlers();

        //---------------------------------------------------------------------------------------
        //  desc: initialize event handlers when modal (indiv/group) is shown or hidden
        //---------------------------------------------------------------------------------------
        function initModalHandlers(){
            indivModalHandler();
            groupModalHandler();
        }

        //---------------------------------------------------------------------------------------
        //  desc: For the INDIVIDUAL modal, depending on whether Trainee has already booked that 
        // training or when Trainee selects a training that clashes with an existing training,
        //  pops up alert depending on the scenario mentioned
        //---------------------------------------------------------------------------------------
        function indivModalHandler(){

            // event handler when INDIV modal is opened
            $('#ModalIndivConfirm').on('shown.bs.modal', function () {

                let personalTrainerID = <?php echo $personalTrainerID  ?>;

                // retrieve the datetimes before and after 30 mins of the original date...
                let dateTimeStringArray = getTimingsToBeTested($("#ModalIndivConfirm #startTime").val());

                // if Trainee selects an indiv training that is already booked
                if ($("#ModalIndivConfirm #confirmedTraineeID").val() != ""){
                    $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                    swal("Reminder", "You have already booked this training!", "info");
                }

                // when Trainee selects an indiv training that clashes with any of their existing training (indiv || group)
                else if (doesTrainingClash(dateTimeStringArray[0]) || doesTrainingClash(dateTimeStringArray[1]) || doesTrainingClash(dateTimeStringArray[2])) {
                    $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                    swal("Alert!", "Training clashes with existing training!", "error");
                }

                // if Trainee has a personal Trainer
                else if (personalTrainerID != "0"){

                    // if the selected training is not from the Trainee's personal Trainer
                    if (!isTrainingByThePersonalTrainer("indiv", $("#ModalIndivConfirm #sessionID").val(), personalTrainerID)){
                        $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                        swal("Alert!", "This training is not from your personal trainer!", "error");
                    }
                }
            });

            // event handler when INDIV modal is closed
            $('#ModalIndivConfirm').on('hidden.bs.modal', function () {
                $("#ModalIndivConfirm #confirmButtonIndiv").show();
            }); 
        }

        //---------------------------------------------------------------------------------------
        //  desc: For the GROUP modal, depending on whether Trainee has already booked that 
        // training or when Trainee selects a training that clashes with an existing training,
        //  pops up alert depending on the scenario mentioned
        //---------------------------------------------------------------------------------------
        function groupModalHandler(){

            // event handler when GROUP modal is opened
            $('#ModalGroupConfirm').on('shown.bs.modal', function (e) {

                let personalTrainerID = <?php echo $personalTrainerID  ?>;

                // retrieve the datetimes before and after 30 mins of the original date...
                let dateTimeStringArray = getTimingsToBeTested($("#ModalGroupConfirm #startTime").val());

                // if Trainee selects group training that is already booked
                if (isGroupTrainingBooked()){
                    $("#ModalGroupConfirm #confirmButtonGroup").hide();
                    swal("Alert", "Training is already booked!", "info");
                }

                // when Trainee selects a group training that clashes with any of their existing training (indiv || group)
                else if (doesTrainingClash(dateTimeStringArray[0]) || doesTrainingClash(dateTimeStringArray[1]) || doesTrainingClash(dateTimeStringArray[2])) {
                    $("#ModalGroupConfirm #confirmButtonGroup").hide();
                    swal("Alert!", "Training clashes with existing training!", "error");
                }

                
                // if Trainee has a personal Trainer
                else if (personalTrainerID != "0"){

                    // if the selected training is not from the Trainee's personal Trainer
                    if (!isTrainingByThePersonalTrainer("grp", $("#ModalGroupConfirm #groupSessionID").val(), personalTrainerID)){
                        $("#ModalGroupConfirm #confirmButtonGroup").hide();
                        swal("Alert!", "This training is not from your personal trainer!", "error");
                    }
                }
            });

            // event handler when group modal is closed
            $('#ModalGroupConfirm').on('hidden.bs.modal', function () {
                $("#ModalGroupConfirm #confirmButtonGroup").show();
            }); 
        }

        //---------------------------------------------------------------------------------------
        // desc: For a given dateTimeString, determine its dateTime 30 mins before and after 
        // and returns all three dateTime Strings in an array
        // params: dateTimeString (string)
        // returns: dateTimeStringArray (Array of Strings)
        //---------------------------------------------------------------------------------------
        function getTimingsToBeTested(dateTimeString){

            // convert dateTimeString to Moment DateTime object 
            let dateTimeObject = moment(dateTimeString, "YYYY-MM-DD HH:mm:ss");

            // add and subtract 30 mins from the original time
            let dateTimeObject30MinsBefore = moment(dateTimeObject).subtract(30, 'm').toDate();
            let dateTimeObject30MinsAfter = moment(dateTimeObject).add(30, 'm').toDate();

            // convert the before and after time into strings
            var dateTimeBeforeString = moment(dateTimeObject30MinsBefore).format("YYYY-MM-DD HH:mm:ss");
            var dateTimeAfterString = moment(dateTimeObject30MinsAfter).format("YYYY-MM-DD HH:mm:ss");

            // place the times into an array
            let dateTimeStringArray = [dateTimeBeforeString, dateTimeString, dateTimeAfterString]

            return dateTimeStringArray;

        }

        //---------------------------------------------------------------------------------------
        // desc: Determine if the selected is training is from the Trainee's personal Trainer
        // params: training (string), trainingID (String), personalTrainerID (int)
        // returns: boolean 
        //---------------------------------------------------------------------------------------
        function isTrainingByThePersonalTrainer(training, trainingID ,personalTrainerID){

            let events = <?php echo json_encode($events) ?>;

            // retrieve the training based on its trainingID
            let filtered = events.filter((event) => {
                // determine if training is indiv or group training
                if (training === "indiv"){
                    return event.sessionID === trainingID
                }
                else if (training === "grp"){
                    return event.groupSessionID === trainingID;
                }  
            });

            if (filtered.length > 0){
                // since the Training is from the personal Trainer, return true
                if (filtered[0].trainerID == personalTrainerID){
                    return true;
                }

                // since the Training is not from the personal Trainer, return false
                else {
                    return false;
                }
            }

            // return false if training can't be found
            return false;
        }
        
        //---------------------------------------------------------------------------------------
        // desc: to check whether the group training the Trainee has selected is already
        // booked by the Trainee. If it is, return true. Else, return false.
        // return: (boolean)
        //---------------------------------------------------------------------------------------
        function isGroupTrainingBooked(){
            let groupEvents = <?php echo json_encode($groupUserEvents) ?>;

            // if any of the Trainee's group events consists of the groupSessionID, that 
            // training is already booked by the Trainee
            let filtered = groupEvents.filter((event) => {
                return event.groupSessionID === $("#ModalGroupConfirm #groupSessionID").val();
            });

            if (filtered.length === 0){
                return false;
            }
            else{
                return true;
            }
        }


        //---------------------------------------------------------------------------------------
        // desc: to check whether the training the Trainee has selected clashes with any of 
        // their existing trainings (indiv || grp) . If clashes, show return true. Else, return false
        // params: startTime (String)
        // return: (boolean)
        //---------------------------------------------------------------------------------------
        function doesTrainingClash(startTime){

            let userEvents = <?php echo json_encode($userEvents) ?>;
            let groupEvents = <?php echo json_encode($groupUserEvents) ?>;

            let filtered = userEvents.concat(groupEvents).filter((event) => {
                return event.startSession === startTime;
            });

            if (filtered.length === 0){
                return false;
            }
            else{
                return true;
            }
        }

        //---------------------------------------------------------------------------------------
        // desc: retrieve indiv. trainings that the trainee has only booked and display on calendar
        //---------------------------------------------------------------------------------------
        function viewOnlyUserIndivTrainings(){

            // clear calendar
            $('#calendar').fullCalendar('removeEvents');    

            // add trainee-only trainings to calendar
            $('#calendar').fullCalendar('addEventSource',            
                <?php echo json_encode($userEvents) ?>.map(function(oneTraining) {

                return {
                    id: oneTraining.sessionID,
                    title: oneTraining.title,
                    trainerName: oneTraining.trainerName,
                    trainingType: oneTraining.trainingType,
                    cost: oneTraining.cost,
                    start: oneTraining.startSession,
                    end: oneTraining.endSession,
                    locationName: oneTraining.locationName,
                    roomName: oneTraining.roomName,
                    description: oneTraining.description,
                    color:oneTraining.color,
                    traineeID: oneTraining.traineeID
                    };
                })    
            );
        }
        
         //---------------------------------------------------------------------------------------
        // desc: retrieve group. trainings that the trainee has only booked and display on calendar
        //---------------------------------------------------------------------------------------
        function viewOnlyUserGroupTrainings(){

            // clear calendar
            $('#calendar').fullCalendar('removeEvents');    

            // add trainee-only trainings to calendar
            $('#calendar').fullCalendar('addEventSource',            
                <?php echo json_encode($groupUserEvents) ?>.map(function(oneTraining) {

                return {
                        id: oneTraining.groupSessionID,
                        title: oneTraining.title,
                        trainerName: oneTraining.trainerName,
                        trainingType: oneTraining.trainingType,
                        cost: oneTraining.cost,
                        room: oneTraining.roomName,
                        locationName: oneTraining.locationName,
                        numberOfParticipants: oneTraining.numberOfParticipants,
                        start: oneTraining.startSession,
                        end: oneTraining.endSession,
                        maxCapacity: oneTraining.maxCapacity,
                        color:oneTraining.color
                    };
                })    
            );
        }
        
    </script>
        </body>
</html>
