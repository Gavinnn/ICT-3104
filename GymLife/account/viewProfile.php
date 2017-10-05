<?php require_once('../conn.php'); ?>
<?php require_once('../session/session.php'); ?>
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


        <script src="../asset/js/modernizrr.js"></script>
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
                            <h1>View Profile </h1>
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
               <?php
        //Query to select username
        $id = $_SESSION["id"];
        $record = DB::queryFirstRow("SELECT * FROM user WHERE userID=%s", $id);
        $username = $record["userName"];
        $name = $record["name"];
        $email = $record["email"];
        $role = $record["roleID"];
        $contact = $record["contactNumber"];
         
            if ($record)
            {
                                
                             echo '
                                 <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Username:  </label>
                                <input type="text" name="userName" class="form-control input-md" readonly value="' . $username . '" />
                            </div>
                            </div>
                           <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="textinput">Name: </label>
                                 <input type="text" name="name" class="form-control input-md" readonly value="' . $name . '" />
                            </div>
                            </div> 
                            <div class="col-sm-3">
                             <div class="form-group">
                                <label class="control-label" for="textinput">Email: </label>
                                <input type="text" name="email" class="form-control input-md" readonly value="' . $email . '" />
                            </div>
                            </div> 
                              <div class="col-sm-3">
                             <div class="form-group">
                                <label class="control-label" for="textinput">Contact Number: </label>
                                 <input type="text" name="contactNumber" class="form-control input-md" readonly value="' . $contact . '" />
                            </div>
                            </div> 
                            ';
                           
                            
                            echo "</div>";
            }
            else
            {
                echo "error";
            }		
        ?>
                
            </div>
        </div>
    </section>

        
        
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
        <script src="../asset/js/jquery-2.1.3.min.js"></script>
        <script src="../asset/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="../asset/bootstrap/js/bootstrap.min.js"></script>
        <script src="../asset/js/owl.carousel.min.js"></script>
        <script src="../asset/js/jquery.appear.js"></script>
        <script src="../asset/js/jquery.fitvids.js"></script>
        <script src="../asset/js/jquery.nicescroll.min.js"></script>
        <script src="../asset/js/lightbox.min.js"></script>
        <script src="../asset/js/count-to.js"></script>
        <script src="../asset/js/styleswitcher.js"></script>
        
        <script src="../asset/js/map.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="../asset/js/script.js"></script>
    </body>
</html>