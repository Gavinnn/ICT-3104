<?php
require_once('../../session/session.php');
// HARDCODED USER DATA
$trainerID = $_SESSION['id'];

include 'getTrainings.php';
$events = getTrainings();
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

        <script>
            function setCostValue() {
                var cost = $("#category").children('option:selected').data('cost');
                $("#cost").val(cost);
            }
        </script>
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

        <!--Error Message when Trainer intends to create a training on a date that is passed-->
        <div id='alert'></div>

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

            <!-- Add Training Modal -->
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="addTraining.php" onsubmit = "return doesTrainingCoincides();">

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
                                    <label for="title" class="col-sm-2 control-label">Training Category</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <select id="category" name="category" class="dropdown" onchange="setCostValue()" required>
                                        <option selected disabled hidden>Select a Training</option>
                                            <?php
                                            $record = DB::query("SELECT * FROM trainings");

                                            foreach ($record as $row) {
                                                echo "<option value='" . $row['trainingID'] . "' data-cost='" . $row['cost'] . "'>" . $row['trainingType'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Cost</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="cost" class="form-control" id="title" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gym" class="col-sm-2 control-label">Gym</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <!--  Since each Gym has their own unique rooms, once gym is selected, show only those rooms  -->
                                        <select id="gym" name="gym" class="dropdown" onchange="setRoomsValue()" required>
                                            <option selected disabled hidden>Select a gym</option>
                                            <?php
                                            $record = DB::query("SELECT * FROM gyms");

                                            foreach ($record as $row) {
                                                echo "<option value='" . $row['locationID'] . "' data-locationid='" . $row['locationID'] . "'>" . $row['locationName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="room" class="col-sm-2 control-label">Room</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <select id="roomDropdown" name="rooms" class="dropdown" required>
                                            <option selected disabled>Select a gym first</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="date" class="form-control" id="date" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="start" class="col-sm-2 control-label">Start Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="startTime" class="form-control timepicker" id="startTime" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="end" class="col-sm-2 control-label">End Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="endTime" class="form-control" id="endTime" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="trainingDesc" class="col-sm-2 control-label">Training Description</label>
                                    <div class="col-sm-10">
                                        <textarea placeholder="Max characters are 255" maxlength="255" name="description" required></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="trainerID" class="form-control" id="trainerID" value=<?php echo $trainerID ?>>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit  Individual Training Modal -->
            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="editTrainingTitle.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Individual Event</h4>
                            </div>
                            <div class="modal-body">

                                   <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Training Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="traineeName" class="col-sm-2 control-label">Trainee Name</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="traineeName" class="form-control" id="traineeName" readonly>
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
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
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

        <!-- FullCalendar -->
        <script src='../../asset/plugins/fullCalendar/js/moment.min.js'></script>
        <script src='../../asset/plugins/fullCalendar/js/fullcalendar.min.js'></script>

        <script src="initializeTrainerCalendar.js" type="text/javascript"></script>
        <script type="text/javascript">$(document).ready(initializeTrainerCalendar(<?php echo json_encode($events) ?>));</script>

        <!-- Timepicker  -->
        <script src="../../asset/plugins/fullCalendar/js/jquery.timepicker.js"></script>

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

        <script>
            //---------------------------------------------------------------------------------------
            // desc: send an AJAX request to check if the training coincides with any of the Trainer's
            // existing training. If training coincides, shows alert. Else, carry on to add training
            //---------------------------------------------------------------------------------------
            function doesTrainingCoincides(){

                var startDate = $('#date').val() + " " + $('#startTime').val() + ":00";
                var success = false;

                $.ajax({
                    url: "doesTrainingCoincide.php",
                    data: {'trainerID' : $('#trainerID').val(), 'startDate': startDate},
                    type: 'POST',
                    async: false,
                    success: function (results) {
                        if (results == "true") {
                            alert("You already have a training at the same time slot. Please select another start time!")
                        }
                        else{
                            success = true;
                        }
                    }
                })

                return success;
            }

            //---------------------------------------------------------------------------------------
            // desc: dynamically add rooms to the dropdown based on the selected gym
            //---------------------------------------------------------------------------------------
            function setRoomsValue(){

                $("#roomDropdown").empty();

                var gymID = $("#gym").children('option:selected').data('locationid');
                    
                // ajax call to retrive all the rooms of the gym
                $.ajax({
                    url: "getGymRooms.php",
                    data: {'locationID' : gymID},
                    type: 'POST',
                    async: false,
                    success: function (results) {

                        // if there are rooms
                        if (results){
                            
                            $("#roomDropdown").append(results);
                        }
                    }
                });
            }

        </script>

    </body>
</html>