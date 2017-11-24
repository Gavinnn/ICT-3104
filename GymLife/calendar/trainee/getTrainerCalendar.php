<?php
    require_once('../../session/session.php');
	
    include 'getTrainerTrainings.php';
	
	$traineeID = $_SESSION['id'];
	$getids = $_GET['id'];
	$allids = explode( ',', $getids );
	$allEvents = []; //Array to hold all events
	$eventforsingletrainer; //Array to get events of single trainer
	
	
	for($i=0; $i<count($allids); $i++){
	  $eventforsingletrainer = [];
	  $eventforsingletrainer = getTrainings($allids[$i]);
	  $allEvents = array_merge($allEvents,$eventforsingletrainer);
    }
    
    // REMOVE ANY DUPLICATE TRAININGS IF ANY
    $allEvents = array_unique($allEvents, SORT_REGULAR);
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
                <br>
                <br>
                <div id="calendar" class="col-centered">
                </div>
                <br>
            </div>
        </div>

    </div>

	 <!-- Confirm Individual Training Modal -->
        <?php require_once('./modal/modalIndivTraining.php'); ?>

        <!-- Confirm Group Training Modal -->
        <?php require_once('./modal/modalGroupTraining.php'); ?>

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
        
        // when modal is opened
        $('#ModalIndivConfirm').on('shown.bs.modal', function () {
            doesTrainingClash();
        });

        // when modal closes
        $('#ModalIndivConfirm').on('hidden.bs.modal', function () {

            // if traiing is already booked, show the confirm button again so it appears in other training modals
            if ($("#ModalIndivConfirm #confirmedTraineeID").val() != ""){
                $("#ModalIndivConfirm #confirmButton").show();
            }

            // if alert is shown, hide it so it won't appear in other training modals
            if ($("#ModalIndivConfirm #alert")){
                $("#ModalIndivConfirm #alert").hide();
            }
        });

        //---------------------------------------------------------------------------------------
        // desc: to check whether the training the Trainee has selected clashes with any of 
        // their existing trainings. If clashes, show alert and remove confirm button
        //---------------------------------------------------------------------------------------
        function doesTrainingClash(){

            var traineeID = $("#ModalIndivConfirm #traineeID").val();
            var startTime = $("#ModalIndivConfirm #startTime").val();

            // ajax call to determine if there any clashes
            $.ajax({
                url: "doesTrainingClash.php",
                data: {'traineeID' : traineeID, 'startTime': startTime},
                type: 'POST',
                async: false,
                success: function (results) {

                    // there is a clash...
                    if (results == "true"){

                        // the  training that was booked by the Trainee
                        if ($("#ModalIndivConfirm #confirmedTraineeID").val() != ""){
                            $("#ModalIndivConfirm #alert").hide();
                            $("#ModalIndivConfirm #confirmButton").hide();
                        }
                        // the new training that the Trainee intends to book but clashes with a previos training
                        else{
                            $("#ModalIndivConfirm #alert").show();
                            $("#ModalIndivConfirm #confirmButton").hide();
                        }
                    }
                }
            });
        }
    </script>
        </body>
</html>
