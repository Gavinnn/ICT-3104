<?php include '../conn.php'; ?>
<?php require_once('../session/adminSession.php'); ?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Basic -->
        <title>GymLife | Home</title>
        <!-- Define Charset -->
        <meta charset="utf-8">
        <!-- Responsive Metatag -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
        <!-- jQuery -->
        <script src="../asset/js/jquery-2.1.3.min.js"></script>
        <!-- Table CSS Style -->
        <link rel="stylesheet" type="text/css" href="../asset/css/table.css">
        <!--SweetAlert-->
        <link rel="stylesheet" href="../asset/plugins/sweetalert-master/sweet-alert.css">

        <!--Datatable-->
        <link rel="stylesheet" href="../asset/plugins/DataTables/css/jquery.dataTables.css">
        <script src="../asset/plugins/DataTables/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

        <!-- Modernizr JS -->
        <script src="../asset/js/modernizrr.js"></script>
        <script>
            $(document).ready(function () {
                $('#groupSession').DataTable();
            });
        </script>
    </head>

    <body>
        <!--Navigation Section-->
        <?php require_once('../header.php'); ?>

        <!-- Start Header Section -->
        <div class="page-header">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>View Pending Group Sessions</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->

        <section id="about-section" class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default panel-table">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">
                                <table id="groupSession" class="table table-striped table-bordered table-list" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Session Date</th>
                                            <th>Trainer</th>
                                            <th>Training Type</th>
                                            <th>Title</th>
                                            <th>Location</th>
                                            <th>Max Capacity</th>
                                            <th data-sortable="false"><em class="fa fa-cog"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $record = DB::query("SELECT * FROM `groupsessions` INNER JOIN user ON groupsessions.trainerID = user.userID
                                                            INNER JOIN trainings ON groupsessions.trainingID = trainings.trainingID
                                                            INNER JOIN rooms ON groupsessions.roomID = rooms.roomID
                                                            INNER JOIN gyms ON rooms.locationID = gyms.locationID WHERE `sessionStatus` =%i", 1);

                                        foreach ($record as $row) {
                                            $startSession = $row['startSession'];
                                            $trainerName = $row['name'];
                                            $trainingType = $row['trainingType'];
                                            $title = $row['title'];
                                            $location = $row['locationName'];
                                            $max = $row['maxCapacity'];

                                            echo "<tr>";
                                            echo "<td>" . $startSession . "</td>";
                                            echo "<td>" . $trainerName . "</td>";
                                            echo "<td>" . $trainingType . "</td>";
                                            echo "<td>" . $title . "</td>";
                                            echo "<td>" . $location . "</td>";
                                            echo "<td>" . $max . "</td>";
                                            echo "<td>";
                                            //echo "<button class='btn btn-warning' onclick=\"location.href ='viewGroupSessionDetail.php?id=" . $row['trainingID'] . "' \">View</button> &nbsp;";
                                            echo "<button class='btn btn-success' onclick=\"location.href ='approveSession.php?id=" . $row['trainingID'] . "&approve=2' \">Approve</button> &nbsp;";
                                            echo "<button class='btn btn-danger' onclick=\"location.href ='approveSession.php?id=" . $row['trainingID'] . "&approve=3' \">Reject</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table><!-- /userTable -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Copyright Section -->
        <div id="copyright-section" class="copyright-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="copyright">
                            Copyright © 2017. ICT3104 Software Management - Gym Booking System</a>
                        </div>
                    </div>
                </div><!--/.row -->
            </div><!-- /.container -->
        </div>
        <!-- End Copyright Section -->
        <!-- Sulfur JS File -->
        <script src="../asset/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="../asset/bootstrap/js/bootstrap.min.js"></script>
        <script src="../asset/js/owl.carousel.min.js"></script>
        <script src="../asset/js/jquery.appear.js"></script>
        <script src="../asset/js/jquery.fitvids.js"></script>
        <script src="../asset/js/jquery.nicescroll.min.js"></script>
        <script src="../asset/js/lightbox.min.js"></script>
        <script src="../asset/js/count-to.js"></script>
        <script src="../asset/js/styleswitcher.js"></script>
        <!--SweetAlert-->
        <script src="../asset/plugins/sweetalert-master/sweet-alert.js"></script>
</body>
</html>