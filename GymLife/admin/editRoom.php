<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php
//Query to select userid
$id = $_GET['id'];
$record = DB::queryFirstRow("SELECT * FROM rooms WHERE roomID=%s", $id);

if (!$record) {
    header('Location: index.php');
}
$roomName = $record["roomName"];
$roomCapacity = $record["roomCapacity"];
$roomID = $record["roomID"];

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
        <!--SweetAlert-->
        <link rel="stylesheet" href="../asset/plugins/sweetalert-master/sweet-alert.css">
        <script src="../asset/plugins/sweetalert-master/sweet-alert.js"></script>
        <!--Custom Javascript-->
        <script src="../asset/js/custom.js"></script>
        <script>
		var data = [];
		
            function check() {
                var check = false;
                var roomName = $('#roomName').val();
                var roomCapacity = $('#roomCapacity').val();
				var roomID = $('#roomID').val();
                if (roomName == "" || roomName == null)
                    displayErrorMsg("Please fill in the \"room name\" field.");
                else if (roomCapacity == "" || roomCapacity == null)
                    displayErrorMsg("Please fill in the \"room capacity\" field.");
                else {
                    $.ajax({
                        url: "editRoomProcess.php",
                        data: {'roomID': roomID, 'roomName': roomName, 'roomCapacity': roomCapacity},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "success") {
                                check = true;
                                successModal("Updated Successfully", "gymlocation.php");
                            } 
                        }
                    });
                }//end else

                return check;
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
                            <h1>Edit Room</h1>
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
				<input type="hidden" id="roomID" name="roomID" value="<?php print $roomID; ?>"/>		
                    <form action='editRoomProcess.php' method='post'  enctype='multipart/form-data' name='createreq-form' id='createreq-form'> 
                        <div class="form-group">
                            <label class="control-label" for="textinput">Name of Room: </label>
                            <input type="text" id="roomName" name="roomName" class="form-control input-md" value="<?php echo $roomName; ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Room Capacity:</label>
                            <input type="text" id="roomCapacity" name="roomCapacity" class="form-control input-md" value="<?php echo $roomCapacity; ?>"/>
                        </div>
                </div>
				
		
			<div class="row"><div class="form-group">
                 <!--Error Message-->
                 <label id="msg" class="text-danger"></label>
                 </div>	
			</div>
                        		
            </div>
            <div class="container">
                <div class="row" style="margin-left:10px">
                    <input type="button" onclick="history.back()" class="btn btn-default " value="Back"></input>
                    <button onClick="check();" type="button" class="btn btn-default">Save</button></form>
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