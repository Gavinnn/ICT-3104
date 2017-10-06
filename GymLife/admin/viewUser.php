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
$contact = $record["contactNumber"];
$status = $record["status"];
?>
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Factornator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Webfonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <!-- Animate.css -->
        <link rel="stylesheet" href="../assets/css/animate.css">
        <!-- Icomoon Icon Fonts-->
        <link rel="stylesheet" href="../assets/css/icomoon.css">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <!-- Theme Style -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- Modernizr JS -->

        <!--SweetAlert-->
        <link rel="stylesheet" href="../assets/plugins/sweetalert-master/sweet-alert.css">

        <script src="../assets/js/modernizr-2.6.2.min.js"></script>
        <script src="../assets/js/custom.js"></script>
    </head>
    <body>
        <?php require_once '../header.php'; ?>
        <!-- END .header -->

        <aside class="fh5co-page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="fh5co-page-heading-lead">
                            View User Detail
                            <span class="fh5co-border"></span>
                        </h1>

                    </div>
                </div>
            </div>
        </aside>
        <div id="fh5co-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="table table-responsive">
                            <table class="table table-striped">                    
                                <tbody>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td><?php echo $username; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Role</b></td>
                                        <td>
                                        <?php 
                                        if ($role == '1') {
                                                echo "Admin";
                                            }
                                            elseif ($role=='2'){
                                                echo "Trainer ";
                                            }
                                            elseif ($role=='3'){
                                                echo "Trainee";
                                            }
                                            else{
                                                echo "ERROR";
                                            }
                                         ?>
                                         </td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact</b></td>
                                        <td><?php echo $contact; ?></td>
                                    </tr> 
                                        <td><b>Status</b></td>
                                        <td>
                                        <?php 
                                        if ($status == '1') {
                                                echo "Unverified";
                                            }
                                            elseif ($status=='2'){
                                                echo "Verified ";
                                            }
                                            else{
                                                echo "ERROR";
                                            }
                                         ?>
                                         </td>
                                    <tr>
                                    </tr>		
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jQuery -->
            <script src="../assets/js/jquery.min.js"></script>
            <!-- jQuery Easing -->
            <script src="../assets/js/jquery.easing.1.3.js"></script>
            <!-- Bootstrap -->
            <script src="../assets/js/bootstrap.min.js"></script>
            <!-- Owl carousel -->
            <script src="../assets/js/owl.carousel.min.js"></script>
            <!-- Waypoints -->
            <script src="../assets/js/jquery.waypoints.min.js"></script>
            <!-- Magnific Popup -->
            <script src="../assets/js/jquery.magnific-popup.min.js"></script>
            <!-- Main JS -->
            <script src="../assets/js/main.js"></script>
            <!--SweetAlert-->
            <script src="../assets/plugins/sweetalert-master/sweet-alert.js"></script>
    </body>
</html>