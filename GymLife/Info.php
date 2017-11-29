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
                    echo "<h3>$description</h3>";
                    ?>
                </div>
                
                        <div class="about-list">
                            <h4>What do we provide?</h4>
                            <ul>
                                <li><i class="fa fa-check-square"></i>Top notch trainers.</li> 
                                <li><i class="fa fa-check-square"></i>Training services variety.</li>
                                 <li><i class="fa fa-check-square"></i>Accessible gym locations.</li>
                                <li><i class="fa fa-check-square"></i>Helpful training tips.</li>
                            </ul>
                        </div>
            </div>
        </section>
          
             <!-- Start Trainers bio Section -->
        <section id="service-section">
            <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>Our Trainers</h2>
                        </div>                        
                    </div>
                </div>
                  <?php
                $record = DB::query("SELECT name FROM user WHERE roleID = 2");
                foreach ($record as $locationRow) {
                    echo ' <div class="col-md-3">';
                    echo ' <div class="services-post">';
                    echo '<a><i class="fa fa-user"></i></a>';
                    echo "<h2>" . $locationRow['name'] . "</h2>";
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
    </section>
    <!-- End Trainers bio  Section -->
    
                 <!-- Start Service Section -->
        <section id="service-section">
            <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>Our Services</h2>
                        </div>                        
                    </div>
                </div>
                <?php
                $record = DB::query("SELECT * FROM trainings ORDER BY trainingID");
                foreach ($record as $locationRow) {
                    echo ' <div class="col-md-3">';
                    echo ' <div class="services-post">';
                    echo '<a><i class="fa fa-skyatlas"></i></a>';
                    echo "<h2>Training Type: " . $locationRow['trainingType'] . "</h2>";
                    echo "<p>Description: " . $locationRow['description'] . "</p>";
                    echo "<p>Cost: " . $locationRow['cost'] . "</p>";
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
    </section>
    <!-- End Service Section -->
    
     <!-- Start Gym Section -->
        <section id="service-section">
            <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>Our Gyms</h2>
                        </div>                        
                    </div>
                </div>
                <?php
                $record = DB::query("SELECT locationName,locationAddress FROM gyms ORDER BY locationName");
                foreach ($record as $locationRow) {
                    echo ' <div class="col-md-3">';
                    echo ' <div class="services-post">';
                    echo '<a><i class="fa fa-subway"></i></a>';
                    echo "<h2> " . $locationRow['locationName'] . "</h2>";
                    echo "<p>" . $locationRow['locationAddress'] . "</p>";
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
    </section>
    <!-- End Gym Section -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                    <h2>Training Tips</h2>
                </div>                        
            </div>
        </div>
        <div class="col-md-6">
                <h2>Cardio Tips:</h2>
                <ul>
                    <li><i class="fa fa-circle"></i>For fat loss, cardio should be done on an empty stomach.</li>
                    <li><i class="fa fa-circle"></i>Start small with cardio, and increase gradually (weekly).</li>
                    <li><i class="fa fa-circle"></i>Know your target heart rate(THR).</li>
                </ul>
        </div>
        <div class="col-md-6">
                 <h2>Crossfit Tips:</h2>
                <ul>
                    <li><i class="fa fa-circle"></i>Do not overdo the training! Ask your trainer if you're able to do more sets</li>
                    <li><i class="fa fa-circle"></i>Shorter the workout, the lonegr your warm ups should be.</li>
                    <li><i class="fa fa-circle"></i>Breakfast is important!</li>
                </ul>
        </div>
    </div>
    
     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                    <h2>Promotions</h2>
                </div>
                <div class="col-md-6">
                <h2>Group trainings:</h2>
                <ul>
                    <li><i class="fa fa-circle"></i>Fabulous Fridays: 10% off for any group trainings!</li>
                    <li><i class="fa fa-circle"></i>OT Mondays: 5% off any group trainings!</li>
                    <li><i class="fa fa-circle"></i>2 for 1 weekends: Any group trainings for the price of 1!<li>
                </ul>
        </div>
        <div class="col-md-6">
                 <h2>Individual trainings:</h2>
                <ul>
                    <li><i class="fa fa-circle"></i>New found partner: 5% off for the first month!</li>
                    <li><i class="fa fa-circle"></i>Loyalty over royalty: 10% off for members over a year! </li>
                    <li><i class="fa fa-circle"></i>2 for 1 weekends: Any group trainings for the price of 1!</li>
                </ul>
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