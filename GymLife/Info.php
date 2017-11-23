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
        
         <!--Navigation Section-->
        <?php require_once('header.php'); ?>

        <!-- Start Header Section -->
        <div class="page-header">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>View information</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->
        
          <!-- Start About Us Section -->
        <section id="about-section" class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>About Us</h2>
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <?php
                    $id = $_SESSION["id"];
                    $record = DB::queryFirstRow("SELECT description FROM info");
                    $description = $record["description"];
                    echo "<p>$description</p>";
                    ?>
                </div>
            </div>
        </section>
          
             <!-- Start Service Section -->
        <section id="service-section">
            <div class="container">
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="#"><i class="fa fa-skyatlas"></i></a>
                        <h2>Personal Training</h2>
                        <p>Lose fat and keep it off for good. Specifically designed to tone up your entire body, boost your health and confidence.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="#"><i class="fa fa-magic"></i></a>
                        <h2>Yoga Classes</h2>
                        <p>Helps in detoxify, de-stress and boost one's energy for good health and vitality.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="#"><i class="fa fa-gift"></i></a>
                        <h2>Group Training</h2>
                        <p>Train with other members to build both a healthy lifestyle and relationships.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services-post">
                        <a href="#"><i class="fa fa-foursquare"></i></a>
                        <h2>Crossfit Training</h2>
                        <p>Varied high intensity functional movements to improve physical well-being and cardiovascular fitness.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Service Section -->
        
        
     
		
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