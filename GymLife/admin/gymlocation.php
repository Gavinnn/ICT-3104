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
                $('#locations').DataTable();
            });
            function dlt(id)
            {
                swal({
                    title: "Do you want to delete ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true},
                        function (isConfirm) {
                            if (isConfirm) {
                                location.href = 'deleteDetails.php?id=' + id;
                            }
                        });
            }
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
                            <h1>View Gym Location</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->

        <section id="about-section" class="about-section">
            <div class="container">
                <div class="row">
				&nbsp;&nbsp;&nbsp;<button type="button" class="btn" onclick="location.href='addLocation.php'"><span class="glyphicon glyphicon-plus"></span>  Add Location</button>
				<br><br>				   
				<div class="col-md-12">
                        <div class="panel panel-default panel-table">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body">
                                <table id="locations" class="table table-striped table-bordered table-list" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Location Name</th>
                                            <th class="col-md-6">Rooms</th>
                                            <th class="col-md-2">Location Capacity</th>
                                            <!--<th class="col-md-2" data-sortable="false"><em class="fa fa-cog"></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $record = DB::query("SELECT * FROM gyms ORDER BY locationName");

                                        foreach ($record as $locationRow) {
                                            echo "<tr>";
                                            echo "<td>" . $locationRow['locationName'] . "</td>";
											$newRecord = DB::query("SELECT roomName FROM rooms WHERE locationID =%s", $locationRow['locationID']);
											echo "<td>";
											foreach ($newRecord as $roomRow) {
												echo $roomRow['roomName'] ." | "; 
											}
											echo "</td>";
											echo "<td>" . $locationRow['locationCapacity'] . "</td>";
                                            //echo "<td></td>";
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