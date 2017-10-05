<?php include '../conn.php'; ?>
<?php require_once('../session/adminSession.php'); ?>
<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

    <head>

        <!-- Basic -->
        <title>GymLife | Home</title>

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

		<!-- jQuery -->
        <script src="../asset/js/jquery-2.1.3.min.js"></script>

		<!--Datatable-->
        <link rel="stylesheet" href="../asset/plugins/DataTables/css/jquery.dataTables.css">
        <script src="../asset/plugins/DataTables/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

        <!-- Modernizr JS -->
        <script src="../asset/js/modernizrr.js"></script>
        <script>
            $(document).ready(function () {
                $('#users').DataTable();
            });
        </script>



    </head>

    <body>
    
        <header class="clearfix">
        
            <!-- Start  Logo & Naviagtion  -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <a class="navbar-brand" href="index.html">GymLife</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        
                        <!-- Start Navigation List -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="active" href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="index.html">About Us</a>
                            </li>
                            <li>
                                <a href="service.html">Services</a>
                            </li>
                            <li>
                                <a href="index.html">Trainers Portfolio</a>
                            </li>
                            <li><a href="../login.php">Login</a>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
            </div>
            <!-- End Header Logo & Naviagtion -->
        </header>
        
        
		<div id="fh5co-main">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<table id="users" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Username</th>
									<th>Email</th>
									<th>Role</th>
									<th data-sortable="false">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$record = DB::query("SELECT * FROM user WHERE status=%i",1);

								foreach ($record as $row) {
									echo "<tr>";
									echo "<td>" . $row['name'] . "</td>";
									echo "<td>" . $row['userName'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									if ($row['roleID'] == '1') {
										echo "<td> Admin </td>";
									}
									elseif ($row['roleID']=='2'){
										echo "<td> Trainer </td>";
									}
									elseif ($row['roleID']=='3'){
										echo "<td> Trainee </td>";
									}
									else{
										echo "<td> ERROR </td>";
									}
									echo "<td>";
                                    echo "<button class='btn btn-primary' onclick=\"location.href='approveUserProcess.php?id=" . $row['userID'] . "' \">Approve</button>";
                                    echo "<button class='btn btn-success' onclick=\"location.href='rejectUserProcess.php?id=" . $row['userID'] . "' \">Reject</button>";
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
        
    
    </body>
</html>

