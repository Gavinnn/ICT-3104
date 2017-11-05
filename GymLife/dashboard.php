<?php require_once('conn.php'); ?>
<?php require_once('session/session.php'); ?>
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
        <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.min.css" type="text/css">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="asset/css/owl.carousel.css" type="text/css">
        <link rel="stylesheet" href="asset/css/owl.theme.css" type="text/css">
        <link rel="stylesheet" href="asset/css/owl.transitions.css" type="text/css">
        <!-- Css3 Transitions Styles  -->
        <link rel="stylesheet" type="text/css" href="asset/css/animate.css">
        <!-- Lightbox CSS -->
        <link rel="stylesheet" type="text/css" href="asset/css/lightbox.css">
        <!-- Sulfur CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="asset/css/style.css">
        <!-- Responsive CSS Style -->
        <link rel="stylesheet" type="text/css" href="asset/css/responsive.css">
        <!-- jQuery -->
        <script src="asset/js/jquery-2.1.3.min.js"></script>
        <!-- Table CSS Style -->
        <link rel="stylesheet" type="text/css" href="asset/css/table.css">
        <!--SweetAlert-->
        <link rel="stylesheet" href="asset/plugins/sweetalert-master/sweet-alert.css">
		<!--SweetAlert-->
        <script src="asset/plugins/sweetalert-master/sweet-alert.js"></script>

        <!-- Modernizr JS -->
        <script src="asset/js/modernizrr.js"></script>
    </head>
    <body>
		<?php
		$id = $_SESSION["id"];
		$record = DB::queryFirstRow("SELECT * FROM user WHERE userID=%s", $id);
		$change = $record["passwordChange"];
		if($change==1)
			echo '<script>swal("Welcome to GymLife!", "New user should change password upon first login!", "info");</script>';
		?>
		<!--Navigation Section-->
		<?php require_once('header.php'); ?>
        <!-- Start Header Section -->
        <div class="banner">
            <div class="overlay">
                <div class="container">
                    <div class="intro-text">
                        <h1>Welcome To <span>GYM LIFE</span></h1>
                        <p>Push beyond your limits to discover your true capabilities.</p>
                        <a href="#feature" class="page-scroll btn btn-primary">Find Out More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->
		
       <!-- Sulfur JS File -->
        <script src="asset/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="asset/bootstrap/js/bootstrap.min.js"></script>
        <script src="asset/js/owl.carousel.min.js"></script>
        <script src="asset/js/jquery.appear.js"></script>
        <script src="asset/js/jquery.fitvids.js"></script>
        <script src="asset/js/jquery.nicescroll.min.js"></script>
        <script src="asset/js/lightbox.min.js"></script>
        <script src="asset/js/count-to.js"></script>
        <script src="asset/js/styleswitcher.js"></script>
    </body>
</html>