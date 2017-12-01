<?php
    require_once('../../session/session.php');
	
    include 'getTrainerTrainings.php';
	
	$traineeID = $_SESSION['id'];
	$record = DB::query("SELECT * FROM user WHERE userID=%d",$traineeID);
	foreach ($record as $row) {
		$pTrainerID = $row['personalTrainerID'];
	}

	$getids = $_GET['id'];
	$allids = explode( ',', $getids );
	$allEvents = []; //Array to hold all events
	$eventforsingletrainer; //Array to get events of single trainer

    $trainerName = "Trainer";
    
    // get selected Trainer name
    if(count($allids)==1){
        $record = DB::query("SELECT name FROM user WHERE userID=%d", $allids[0]);
        $trainerName = $record[0]["name"];
    }
	
	for($i=0; $i<count($allids); $i++){
	  $eventforsingletrainer = [];
	  $eventforsingletrainer = getIndividualTrainings($allids[$i]);
	  $allEvents = array_merge($allEvents,$eventforsingletrainer);
    }


    
    // REMOVE ANY DUPLICATE TRAININGS IF ANY
    $allEvents = array_unique($allEvents, SORT_REGULAR);

    $userEvents = getUserTrainings($traineeID);
    $groupUserEvents = getGroupUserTrainings($traineeID);
?>
<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

    <head>

        <!-- Basic -->
        <title>GymLife | <?php echo $trainerName ?>'s Training Calendar</title>

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
                            <h1><?php echo $trainerName?>'s Training Calendar</h1>
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
                <br>
                <br>
                <div id="calendar" class="col-centered">
                </div>
                <br>
            </div>
        </div>

    </div>

    <?php 

			//Confirm Group Training Modal
			require_once('./modal/modalGroupTraining.php');
			//Confirm Individual Training Modal
			require_once('./modal/modalIndivTraining.php');
	?>

        <!-- jQuery Version 1.11.1 -->
    <script src="../../asset/plugins/fullCalendar/js/jquery.js"></script>
    
    <!-- FullCalendar -->
        <script src='../../asset/plugins/fullCalendar/js/moment.min.js'></script>
        <script src='../../asset/plugins/fullCalendar/js/fullcalendar.min.js'></script>

        <script src="initializeTraineeCalendar.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(initializeTraineeCalendar( <?php echo json_encode($allEvents) ?> ));
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

        indivModalHandler();

        //---------------------------------------------------------------------------------------
        //  desc: For the INDIVIDUAL modal, depending on whether Trainee has already booked that 
        // training or when Trainee selects a training that clashes with an existing training,
        //  pops up alert depending on the scenario mentioned
        //---------------------------------------------------------------------------------------
        function indivModalHandler(){

            // event handler when INDIV modal is opened
            $('#ModalIndivConfirm').on('shown.bs.modal', function () {

                let personalTrainerID = <?php echo $pTrainerID  ?>;

                // retrieve the datetimes before and after 30 mins of the original date...
                let dateTimeStringArray = getTimingsToBeTested($("#ModalIndivConfirm #startTime").val());

                // if Trainee selects an indiv training that is already booked
                if ($("#ModalIndivConfirm #confirmedTraineeID").val() != ""){
                    $("#ModalIndivConfirm #confirmButtonIndiv").hide();
                    swal("Alert", "Training is already booked!", "info");
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

            let events = <?php echo json_encode($allEvents) ?>;

            // retrieve the training based on its trainingID
            let filtered = events.filter((event) => {
                // determine if training is indiv or group training
                if (training === "indiv"){
                    return event.sessionID === trainingID;
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
        
    </script>
        </body>
</html>
