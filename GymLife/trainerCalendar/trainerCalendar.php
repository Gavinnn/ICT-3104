<?php
    require_once('../session/session.php');

    // HARDCODED USER DATA
    $trainerID = $_SESSION['id'];
    
    include 'getTrainings.php';
    $events = getTrainings($trainerID);
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
        <link rel="stylesheet" href="../asset/bootstrap/css/bootstrap.min.css" type="text/css">

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../asset/font-awesome/css/font-awesome.min.css" type="text/css">

        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="../asset/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" href="../asset/css/owl.theme.css" type="text/css">
        <link rel="stylesheet" href="../asset/css/owl.transitions.css" type="text/css">

        <!-- Css3 Transitions Styles  -->
        <link rel="stylesheet" type="text/css" href="../asset/css/animate.css">

        <!-- Lightbox CSS -->
        <link rel="stylesheet" type="text/css" href="../asset/css/lightbox.css">

        <!-- Sulfur CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="../asset/css/style.css">

        <!-- Responsive CSS Style -->
        <link rel="stylesheet" type="text/css" href="../asset/css/responsive.css">

        <!-- FullCalendar -->
        <link href='../asset/css/calendar/fullcalendar.css' rel='stylesheet' />

        <!-- Timepicker -->
        <link href='../asset/css/calendar/jquery.timepicker.css' rel='stylesheet'/>

        <script src="../asset/js/modernizrr.js"></script>


    </head>

    <body>

        <!--Navigation Section-->
        <?php require_once('../header.php'); ?>

                    <!-- Page Content -->
		<div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Training Calendar</h1>
                <p class="lead">Add/Modify/Remove trainings</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
        <!-- /.row -->

                <!-- Add Training Modal -->
                <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addTraining.php">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Training Session</h4>
                      </div>
                      <div class="modal-body">

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                              <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                            </div>
                          </div>

                            <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-3">
                                <input type="text" name="date" class="form-control" id="date" readonly>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Start Time</label>
                            <div class="col-sm-3">
                              <input type="text" name="startTime" class="form-control timepicker" id="startTime" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">End Time</label>
                            <div class="col-sm-3">
                              <input type="text" name="endTime" class="form-control" id="endTime" readonly>
                            </div>
                          </div>

                            

                            <input type="hidden" name="trainerID" class="form-control" id="trainerID" value=<?php echo $trainerID?>>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

                <!-- Edit Training Modal -->
                <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="editTrainingTitle.php">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                      </div>
                      <div class="modal-body">

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Training Title</label>
                            <div class="col-sm-10">
                              <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                            </div>
                          </div>

                            <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-4">
                                <input type="text" name="date" class="form-control" id="date" readonly>
                            </div>
                          </div>

                        
                        <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <div class="checkbox">
                                    <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                                  </div>
                                </div>
                            </div>

                          <input type="hidden" name="sessionID" class="form-control" id="sessionID">


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

    </div>


		<!-- jQuery Version 1.11.1 -->
    <script src="../asset/js/calendar/jquery.js"></script>
    
    <!-- FullCalendar -->
		<script src='../asset/js/calendar/moment.min.js'></script>
		<script src='../asset/js/calendar/fullcalendar.min.js'></script>

		<script src="initializeCalendar.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(initializeCalendar(<?php echo json_encode($events) ?> ));
		</script>

		<!-- Timepicker  -->
		<script src="../asset/js/calendar/jquery.timepicker.js"></script>

    <!-- Bootstrap -->
    <script src="../asset/bootstrap/js/bootstrap.min.js"></script>

    <!-- Sulfur JS File -->
    <!-- <script src="../asset/js/jquery-2.1.3.min.js"></script> -->
    <script src="../asset/js/jquery-migrate-1.2.1.min.js"></script>

    <script src="../asset/js/owl.carousel.min.js"></script>
    <script src="../asset/js/jquery.appear.js"></script>
    <script src="../asset/js/jquery.fitvids.js"></script>
    <script src="../asset/js/jquery.nicescroll.min.js"></script>
    <script src="../asset/js/lightbox.min.js"></script>
    <script src="../asset/js/count-to.js"></script>
    <script src="../asset/js/styleswitcher.js"></script>

    <script src="../asset/js/map.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="../asset/js/script.js"></script> 


        </body>
</html>
