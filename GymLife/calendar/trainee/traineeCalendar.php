<?php
    require_once('../../session/session.php');

    $traineeID = $_SESSION['id'];
    
    include 'getTrainings.php';
    $events = getTrainings($traineeID);
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

                <!-- Confirm Training Modal -->
                <div class="modal fade" id="ModalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="confirmTraining.php">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Training</h4>
                      </div>
                      <div class="modal-body">

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

                          <input type="hidden" name="sessionID" class="form-control" id="sessionID">

                          <input type="hidden" name="traineeID" class="form-control" id="traineeID">


                      </div>
                      <div class="modal-footer">
                        <button type="button" id="closeButton" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="confirmButton" type="submit" class="btn btn-success">Confirm</button>
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

    <!-- Render  HTML button for modal depending on availability of training -->
    <script>
        // display a confirm button if the training is available. Else, do not display it
        $('#ModalConfirm').on('shown.bs.modal', function () {
            if ($("#traineeID").val() != ""){
                $("#confirmButton").hide();
            }
        });

    </script>

        </body>
</html>
