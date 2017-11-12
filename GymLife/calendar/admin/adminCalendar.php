<?php
    require_once('../../session/session.php');

    include 'getTrainings.php';
    $events = getTrainings();
?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Basic -->
        <title>GymLife | Admin Calendar</title>

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
                <div id="calendar" class="col-centered"></div>
                <br>
                </div>
            </div>

            <!-- Edit Training Modal - Individual-->
            <div class="modal fade" id="ModalEditIndivTraining" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="editIndivTraining.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Event - Individual Session</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Training Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="trainerName" class="col-sm-2 control-label">Trainer Name</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="trainerName" class="form-control" id="trainerName" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="traineeName" class="col-sm-2 control-label">Trainee Name</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="traineeName" class="form-control" id="traineeName" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="trainingCategory" class="col-sm-2 control-label">Training Category</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="trainingCategory" class="form-control" id="trainingCategory" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cost" class="col-sm-2 control-label">Cost</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="cost" class="form-control" readonly required>
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
                                    <label for="description" class="col-sm-2 control-label">Training Description</label>
                                    <div class="col-sm-10">
                                        <textarea placeholder="Max characters are 255" maxlength="255" id="description" name="description" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label id="dlt" class="text-danger"><input  type="checkbox"  name="delete"> Delete event</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="sessionID" class="form-control" id="sessionID">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="save" type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			
			       <!-- Edit Training Modal - Group -->
            <div class="modal fade" id="ModalEditGroupTraining" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" method="POST" action="editGroupTraining.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Event - Group Session</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Training Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="trainerName" class="col-sm-2 control-label">Trainer Name</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="trainerName" class="form-control" id="trainerName" readonly>
                                    </div>
                                </div>

                               

                               <div class="form-group">
                                    <label for="numberOfParticipants" class="col-sm-2 control-label">No. of Participants</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="numberOfParticipants" name="numberOfParticipants" class="form-control" readonly required>
                                    </div>
                                </div>

								 <div class="form-group">
                                    <label for="traineeName" class="col-sm-2 control-label">Trainee Name</label>
									<?php
									$record = DB::query("select name from groupsessions gs inner join traineegroupsession tr on gs.groupSessionID = tr.groupSessionID inner join user u on u.userID = tr.traineeID");
									
									 foreach ($record as $row) {
                                            echo "&nbsp; &nbsp; &nbsp;" . $row['name'] . "<br>" ;
                                        }
                                     ?>
									
                                </div>
								
                                <div class="form-group">
                                    <label for="trainingCategory" class="col-sm-2 control-label">Training Category</label>
                                    <div class="dropdown col-sm-6" style="padding-top:10px;">
                                        <input type="text" name="trainingCategory" class="form-control" id="trainingCategory" readonly>
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

                                <input type="hidden" name="groupSessionID" class="form-control" id="groupSessionID">

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
        <script src="../../asset/plugins/fullCalendar/js/jquery.js"></script>
        
        <!-- FullCalendar -->
        <script src='../../asset/plugins/fullCalendar/js/moment.min.js'></script>
        <script src='../../asset/plugins/fullCalendar/js/fullcalendar.min.js'></script>

        <script src="initializeAdminCalendar.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(initializeAdminCalendar(<?php echo json_encode($events) ?> ));
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
    </body>
</html>
