<?php require_once('../conn.php'); ?>
<?php require_once('../session/adminSession.php'); ?>
<?php
//Query to select userid
$id = $_GET['id'];
$record = DB::queryFirstRow("SELECT * FROM gyms WHERE locationID=%s", $id);

if (!$record) {
    header('Location: index.php');
}
$locationName = $record["locationName"];
$locationAddress = $record["locationAddress"];

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
		var capArr = [];
		
		  function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = button.parentNode.parentNode;
            var name = row.getElementsByTagName("TD")[0].innerHTML;
            if (confirm("Do you want to delete: " + name)) {
 
                //Get the reference of the Table.
                var table = document.getElementById("tblRooms");
				
                //Delete the Table row using it's Index.
                table.deleteRow(row.rowIndex);
				delete data[row.rowIndex];
            }
			}
		
		
            function check() {
                var check = false;
                var locationName = $('#locationName').val();
                var locationCapacity = $('#locationCapacity').val();
				var locationID = $('#account').val();
                if (locationName == "" || locationName == null)
                    displayErrorMsg("Please fill in the \"location name\" field.");
                else if (locationCapacity == "" || locationCapacity == null)
                    displayErrorMsg("Please fill in the \"capacity\" field.");
                else {
                    $.ajax({
                        url: "editLocationProcess.php",
                        data: {'locationID': locationID, 'locationName': locationName, 'locationCapacity': locationCapacity},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "success") {
                                check = true;
                                successModal("Updated Successfully", "gymlocation.php");
                            } 
                        },
						error: function (a,b,c) {
							console.log(c);
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
                            <h1>Edit Location Details</h1>
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
                    <form action='editLocationProcess.php' method='post'  enctype='multipart/form-data' name='createreq-form' id='createreq-form'>
						<input type="hidden" id="account" name="account" value="<?php print $id; ?>"/>					
                        <div class="form-group">
                            <label class="control-label" for="textinput">Name of Location: </label>
                            <input type="text" id="locationName" name="locationName" class="form-control input-md" value="<?php echo $locationName; ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Address of Gym:</label>
                            <input type="text" id="locationCapacity" name="locationCapacity" class="form-control input-md" value="<?php echo $locationAddress; ?>"/>
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
                    <button onClick="check();" type="button" class="btn btn-default">Save Changes</button></form>
					 <?php echo "<button class='btn btn-warning' onclick=\"location.href ='viewRooms.php?id=" . $id . "' \">View Rooms</button> &nbsp;";?>
					 
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