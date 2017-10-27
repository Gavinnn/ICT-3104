<?php
    require_once('../../session/session.php');

    $traineeID = $_SESSION['id'];
    
    include 'getTrainings.php';
    $events = getTrainings($traineeID);
    $userEvents = getUserTrainings($traineeID);
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
            <button type="button" id="viewUserTrainingsBtn" class="btn btn-success" onclick="viewOnlyUserTrainings()">View your trainings only</button>
                <br>
                <br>
                <div id="calendar" class="col-centered">
                </div>
                <br>
            </div>
        </div>

                <!-- Confirm Training Modal -->
                <div class="modal fade" id="ModalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="confirmTraining.php">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Training</h4>
                      </div>
                      <div class="modal-body" id="modal-body">

                        <div class="alert alert-warning" role="alert" style="display:none;" id="alert">
                            You already have a training in this time slot!
                        </div>

                          <div class="form-group">
                            <label for="trainingTitle" class="col-sm-2 control-label">Training Title</label>
                            <div class="col-sm-10">
                              <input type="text" name="title" class="form-control" id="title" placeholder="Title" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="trainerName" class="col-sm-2 control-label">Trainer Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="trainerName" class="form-control" id="trainerName" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="trainingType" class="col-sm-2 control-label">Training Category</label>
                            <div class="col-sm-4">
                                <input type="text" name="trainingType" class="form-control" id="trainingType" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="cost" class="col-sm-2 control-label">Cost</label>
                            <div class="col-sm-4">
                                <input type="text" name="cost" class="form-control" id="cost" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Start Time</label>
                            <div class="col-sm-4">
                                <input type="text" name="date" class="form-control" id="startTime" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">End Time</label>
                            <div class="col-sm-4">
                                <input type="text" name="date" class="form-control" id="endTime" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="gym" class="col-sm-2 control-label">Gym</label>
                            <div class="col-sm-4">
                                <input type="text" name="gym" class="form-control" id="gym" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="room" class="col-sm-2 control-label">Room</label>
                            <div class="col-sm-4">
                                <input type="text" name="room" class="form-control" id="room" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="trainingDesc" class="col-sm-2 control-label">Training Description</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Max characters are 255" maxlength="255" name="trainingDesc" id="trainingDesc" readonly></textarea>
                            </div>
                          </div>

                          <input type="hidden" name="sessionID" class="form-control" id="sessionID">
                          <input type="hidden" name="traineeID" class="form-control" id="traineeID" value=<?php echo $traineeID ?>>

                          <input type="hidden" name="confirmedTraineeID" class="form-control" id="confirmedTraineeID">


                      </div>
                      <div class="modal-footer">
                        <button type="button" id="closeButton" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="confirmButton" type="submit" class="btn btn-success" onClick="doesTrainingClash()">Confirm</button>
                      </div>
                    </form>                    
                    </div>
                  </div>
                </div>

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
        
        // when modal is opened
        $('#ModalConfirm').on('shown.bs.modal', function () {
            doesTrainingClash();
        });

        // when modal closes
        $('#ModalConfirm').on('hidden.bs.modal', function () {

            // if traiing is already booked, show the confirm button again so it appears in other training modals
            if ($("#confirmedTraineeID").val() != ""){
                $("#confirmButton").show();
            }

            // if alert is shown, hide it so it won't appear in other training modals
            if ($("#alert")){
                $("#alert").hide();
            }
        });

        //---------------------------------------------------------------------------------------
        // desc: to check whether the training the Trainee has selected clashes with any of 
        // their existing trainings. If clashes, show alert and remove confirm button
        //---------------------------------------------------------------------------------------
        function doesTrainingClash(){

            var traineeID = $("#traineeID").val();
            var startTime = $("#startTime").val();

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
                        if ($("#confirmedTraineeID").val() != ""){
                            $("#alert").hide();
                            $("#confirmButton").hide();
                        }
                        // the new training that the Trainee intends to book but clashes with a previos training
                        else{
                            $("#alert").show();
                            $("#confirmButton").hide();
                        }
                    }
                }
            });
        }

        //---------------------------------------------------------------------------------------
        // desc: retrieve trainings that the trainee has only booked and display on calendar
        //---------------------------------------------------------------------------------------
        function viewOnlyUserTrainings(){

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
                    }
                })    
            );
        }
    </script>
        </body>
</html>
