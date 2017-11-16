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
$locationCapacity = $record["locationCapacity"];


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
		function Add() {
            var txtName = document.getElementById("txtName");
			var txtCap = document.getElementById("txtCap");
            AddRow(txtName.value, txtCap.value);
            txtName.value = "";
			txtCap.value = "";
        };
		
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
        };
		
		function AddRow(name, country) {
				//Get the reference of the Table's TBODY element.
				var tBody = document.getElementById("tblRooms").getElementsByTagName("TBODY")[0];
	 
				var name = $("#txtName").val();
				var cap = $("#txtCap").val();
				data.push( $("#txtName").val());
				capArr.push( $("#txtCap").val());
				
				//Add Row.
				row = tBody.insertRow(-1);
	 
				//Add Name cell.
				var cell = row.insertCell(-1);
				cell.innerHTML = name;
				
				//Add Capacity cell.
				var cell = row.insertCell(-1);
				cell.innerHTML = cap;
	 
				//Add Button cell.
				cell = row.insertCell(-1);
				var btnRemove = document.createElement("INPUT");
				btnRemove.type = "button";
				btnRemove.className = "btn btn-danger";
				btnRemove.value = "Remove";
				btnRemove.setAttribute("onclick", "Remove(this);");
				cell.appendChild(btnRemove);
			}
			
		
            function check() {
                var check = false;
                var trainingType = $('#trainingType').val();
                var description = $('#description').val();
                var cost = $('#cost').val();
				var trainingID = $('#trainingID').val();
				
                if (trainingType == "" || trainingType == null)
                    displayErrorMsg("Please fill in the \"Training Type\" field.");
                else if (description == "" || description == null)
                    displayErrorMsg("Please fill in the \"Description\" field.");
               else if (cost == "" || cost == null)
                    displayErrorMsg("Please fill in the \"Cost\" field.");
                else {
                    $.ajax({
                        url: "editTrainingProcess.php",
                        data: {'trainingType': trainingType, 'description': description, 'cost': cost, 'trainingID': trainingID},
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
                            <h1>Edit Training Details</h1>
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
                    <form action='addRoomProcess.php' method='post'  enctype='multipart/form-data' name='createreq-form' id='createreq-form'> 
                        <div class="form-group">
                            <label class="control-label" for="textinput">Name of Location: </label>
                            <input type="text" id="locationName" name="locationName" class="form-control input-md" value="<?php echo $locationName; ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Total Capacity:</label>
                            <input type="text" id="capacity" name="capacity" class="form-control input-md" value="<?php echo $locationCapacity; ?>"/>
                        </div>
                </div>
				
				<div class="container">
				<div class="row col-md-5" style="padding-left: 10px;">
				<table class="table table-striped table-bordered" id="tblRooms" border="1">
					<thead>
						<tr>
							<th class="col-md-3">Room Name</th>
							<th class="col-md-1">Room Capacity</th>
							 <th class="col-md-1" data-sortable="false"><em class="fa fa-cog"></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					<?php
						$newRecord = DB::query("SELECT * FROM rooms WHERE locationID =%s",  $id);
						foreach ($newRecord as $roomRow) {
								echo "<tr>";
								echo "<td class='col-md-3'><div class='input-group'><input class='form-control' type='text' id='txtName' value='" . $roomRow['roomName'] . "'/> </div></td>"; 
								echo "<td class='col-md-1'><div class='input-group'><input class='form-control' type='text' id='txtCap' value='" . $roomRow['roomCapacity'] . "'/> </div></td>";
								echo "<td class='col-md-1'><input type='button' class='btn btn-danger' onclick='Remove(this)'  value=' Remove ' />";
								echo "</tr>";
						}
					
					
					?>
					
					
						<tr>
							<td class="col-md-3"><div class="input-group"><input class="form-control" type="text" id="txtName" /> </div></td>
							<td class="col-md-1"><div class="input-group"><input class="form-control" type="text" id="txtCap"/> </div></td>
							<td class="col-md-1"><input type="button" class="btn btn-success" onclick="Add()"  value=" Add " />
							
							</td>
						</tr>
					</tfoot>
				</table>
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
                    <button onClick="check();" type="button" class="btn btn-default">Save</button>
                </div>
            </div>
        </section>
    </form>
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