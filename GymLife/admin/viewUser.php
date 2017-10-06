<?php include '../conn.php'; ?>
<?php require_once('../session/adminSession.php'); ?>
<?php
//Query to select userid
$id = $_GET['id'];
$record = DB::queryFirstRow("SELECT * FROM user WHERE userid=%s", $id);
if (!$record) {
    header('Location: index.php');
}
$username = $record["userName"];
$name = $record["name"];
$email = $record["email"];
$role = $record["roleID"];
if ($role == '1') {
    $role = "Admin";
} elseif ($role == '2') {
    $role = "Trainer ";
} elseif ($role == '3') {
    $role = "Trainee";
}

$contact = $record["contactNumber"];
$status = $record["status"];
if ($status == '1') {
    $status = "Unverified";
} elseif ($status == '2') {
    $status = "Verified ";
}
?>
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
                            <h1>View User Detail</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Section -->
        <!-- Start About Us Section -->
        <section id="about-section" class="about-section">
            <div class="container">
                <div class="row" style="margin-left:10px">
                    <div class="form-group">
                        <label class="control-label" for="textinput">Username:  </label>
                        <label><?php echo $username; ?></label>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="textinput">Name: </label>
                        <label><?php echo $name; ?></label>

                    </div> 
                    <div class="form-group">
                        <label class="control-label" for="textinput">Email: </label>
                        <label><?php echo $email; ?></label>
                    </div
                    <div class="form-group">
                        <label class="control-label" for="textinput">Role: </label>
                        <label><?php echo $role; ?></label>
                    </div
                    <div class="form-group">
                        <label class="control-label" for="textinput">Contact Number: </label>
                        <label><?php echo $contact; ?></label>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="textinput">Status: </label>
                        <label><?php echo $status; ?></label>
                    </div>
                </div>

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
</body>
</html>