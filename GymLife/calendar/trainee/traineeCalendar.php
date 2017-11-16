<?php
    require_once('../../session/session.php');

    $traineeID = $_SESSION['id'];
    
    include 'getTrainings.php';
    $events = getTrainings($traineeID);
    $userEvents = getUserTrainings($traineeID);
    $groupUserEvents = getGroupUserTrainings($traineeID);
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

    <head>

        <!-- Basic -->
        <title>GymLife | Trainer Calendar</title>

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
                            <h1>Training Calendar</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->
        
        <div class="container">
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
            $(document).ready(initializeTraineeCalendar(<?php echo json_encode($events) ?> ));
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

                // if Trainee selects an indiv training that is already booked
                if ($("#ModalIndivConfirm #confirmedTraineeID").val() != ""){
                    $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                    swal("Alert", "Training is already booked!", "info");
                }

                // when Trainee selects an indiv training that clashes with any of their existing training (indiv || group)
                else if (doesTrainingClash($("#ModalIndivConfirm #startTime").val())) {
                    $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                    swal("Alert!", "Training clashes with existing training!", "error");
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

                // if Trainee selects group training that is already booked
                if (isGroupTrainingBooked()){
                    $("#ModalGroupConfirm #confirmButtonGroup").hide();
                    swal("Alert", "Training is already booked!", "info");
                }

                // when Trainee selects a group training that clashes with any of their existing training (indiv || group)
                else if (doesTrainingClash($("#ModalGroupConfirm #startTime").val())) {
                    $("#ModalGroupConfirm #confirmButtonGroup").hide();
                    swal("Alert!", "Training clashes with existing training!", "error");
                }
            });

            // event handler when group modal is closed
            $('#ModalGroupConfirm').on('hidden.bs.modal', function () {
                $("#ModalGroupConfirm #confirmButtonGroup").show();
            }); 
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
