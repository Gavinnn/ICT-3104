<?php
require_once('../../session/session.php');
$trainerID = $_SESSION['id'];

// TODO
include 'getTrainings.php';
$events = getAllGroupTrainings();
$events = colorUserTraining($events, $trainerID);
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
    <head>
        <!-- Basic -->
        <title>GymLife | Group Trainer Calendar</title>

        <!-- Define Charset -->
        <meta charset="utf-8">

        <!-- Responsive Metatag -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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

        <!-- Datepicker -->
        <link rel="stylesheet" href="../../asset/plugins/fullCalendar/css/jquery-ui.css">

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
                            <h1>Group Training Calendar</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->

        <!--Error Message when Trainer intends to create a training on a date that is passed-->
        <div id='alert'></div>

        <div class="container">

            <!-- Legend Calendar -->
            <div class="row">
                <h2>Group Calendar Legend</h2>
                    <table class="tableLegend">
                        <tbody>
                        <tr>
                        <td class="legend_item yourTraining tdLegend"></td><td>Your Training</td>
                        <td class="legend_item groupTraining tdLegend"></td><td>Group Training</td>
                        <td class="legend_item traineeTraining tdLegend"></td><td>Full Trainings</td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <div id="calendar" class="col-centered">
                    </div>
                    <br>
                </div>
            </div>
        
        <!-- Edit  GroupTraining Modal -->
            <div class="modal fade" id="GroupModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="editTrainingTitle.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Group Event</h4>
                            </div>
                            <div class="modal-body">

                                   <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Training Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" readonly>
                                    </div>
                                   </div>

                                <div class="form-group">
                                    <label for="maxCapacity" class="col-sm-2 control-label">Maximum Capacity</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="maxCapacity" class="form-control" id="maxCapacity" readonly>
                                    </div>
                                </div>
                                
                                   <div class="form-group">
                                    <label for="numberOfParticipants" class="col-sm-2 control-label">Number of Participants</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="numberOfParticipants" class="form-control" id="numberOfParticipants" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="gym" class="col-sm-2 control-label">Gym</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="gym" name="gym" class="form-control" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="room" class="col-sm-2 control-label">Room</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="room" name="room" class="form-control" readonly required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="startSession" class="col-sm-2 control-label">Start Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="startSession" class="form-control" id="startSession" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="endSession" class="col-sm-2 control-label">End Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="endSession" class="form-control" id="endSession" readonly>
                                    </div>
                                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery Version 1.11.1 -->
        <script src="../../asset/plugins/fullCalendar/js/jquery.js"></script>

        <!-- Timepicker JS  -->
        <script src="../../asset/plugins/fullCalendar/js/jquery.timepicker.js"></script>

        <!-- Datepicker JS  -->
        <script src="../../asset/plugins/fullCalendar/js/jquery-ui.js"></script>

        <!-- FullCalendar -->
        <script src='../../asset/plugins/fullCalendar/js/moment.min.js'></script>
        <script src='../../asset/plugins/fullCalendar/js/fullcalendar.min.js'></script>

        <script src="initializeTrainerCalendar.js" type="text/javascript"></script>
        <script type="text/javascript">$(document).ready(initializeTrainerCalendar(<?php echo json_encode($events) ?>));</script>

        <!-- Bootstrap -->
        <script src="../../asset/bootstrap/js/bootstrap.min.js"></script>

        <!-- Sulfur JS File -->
        <!-- <script src="../asset/js/jquery-2.1.3.min.js"></script> -->
        <script src="../../asset/js/jquery-migrate-1.2.1.min.js"></script>

        <script src="../../asset/js/owl.carousel.min.js"></script>
        <script src="../../asset/js/jquery.appear.js"></script>
        <script src="../../asset/js/jquery.fitvids.js"></script>
        <script src="../../asset/js/jquery.nicescroll.min.js"></script>
        <script src="../../asset/js/lightbox.min.js"></script>
        <script src="../../asset/js/count-to.js"></script>
        <script src="../../asset/js/styleswitcher.js"></script>

    </body>
</html>