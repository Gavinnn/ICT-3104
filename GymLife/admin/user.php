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

	<!-- Table CSS Style -->
	<link rel="stylesheet" type="text/css" href="../asset/css/table.css">

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

    <!--Navigation Section-->
		<?php require_once('../header.php'); ?>


<!-- Start Header Section -->
        <div class="page-header">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Account Management</h1>
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
                    <table id="users" class="table table-striped table-bordered table-list" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th data-sortable="false"><em class="fa fa-cog"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = DB::query("SELECT * FROM user WHERE status='2'");

                            foreach ($record as $row) {
                            echo "
                            <tr>
                                ";
                                echo "
                                <td>" . $row['name'] . "</td>";
                                echo "
                                <td>" . $row['userName'] . "</td>";
                                echo "
                                <td>" . $row['email'] . "</td>";
                                if ($row['roleID'] == '1') {
                                echo "
                                <td> Admin </td>";
                                }
                                elseif ($row['roleID']=='2'){
                                echo "
                                <td> Trainer </td>";
                                }
                                elseif ($row['roleID']=='3'){
                                echo "
                                <td> Trainee </td>";
                                }
                                else{
                                echo "
                                <td> ERROR </td>";
                                }
                                echo "
                                <td>
                                    ";
                                    echo "<button class='btn btn-default' onclick=\"location.href ='viewUser.php?id=" . $row['userID'] . "' \">View</button>";
									echo "<button class='btn btn-default' onclick=\"location.href ='editUser.php?id=" . $row['userID'] . "' \">Edit</button>";
                                    echo "<button class='btn btn-default' onclick=\"location.href ='deleteUser.php?id=" . $row['userID'] . "' \">Delete</button>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table><!-- /userTable -->
					</div>
					
					<div class="panel-footer">
                <div class="row">
                  <div class="col col-xs-4">Page 1 of 5
                  </div>
                  <div class="col col-xs-8">
                    <ul class="pagination hidden-xs pull-right">
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                    </ul>
                    <ul class="pagination visible-xs pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div>
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


</body>
</html>

