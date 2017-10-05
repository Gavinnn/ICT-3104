<?php include '../conn.php'; ?>
<?php require_once('../session/adminSession.php'); ?>
<?php
//Query to select userid
$id = $_GET['id'];
$record = DB::queryFirstRow("SELECT * FROM user WHERE userid=%s", $id);
if (!$record) {
    header('Location: index.php');
}
$username = $record["username"];
$name = $record["name"];
$email = $record["email"];
$role = $record["role"];
$address = $record["address"];
$cardNo = $record["accessCardNo"];
?>
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Factornator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="favicon.ico">

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
        <script>
            function check() {
                var confirm = false;
                var oldpassword = $("#oldPassword").val();
                var newPassword = $("#newPassword").val();
                var confirmPassword = $("#confirmPassword").val();

                if (newPassword == confirmPassword && newPassword.length >= 8) {
                    $.ajax({
                        url: "changePasswordProcess.php",
                        data: {'oldpass': oldpassword, 'newPassword': newPassword},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "success") {
                                confirm = true;
                                successModal("Password changed successfully", "index.php");

                            } else if (data == "wrongOldPassword") {
                                confirm = false;
                                displayErrorMsg("Old password is wrong. Please try again.");
                            } else {
                                confirm = false;
                            }
                        }
                    });
                } else if (newPassword != confirmPassword)
                    displayErrorMsg("Passwords mismatched.");
                else if (newPassword.length < 8)
                    displayErrorMsg("New password should contain at least 8 characters.");

                return confirm;
            }
        </script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <!-- END .header -->

        <aside class="fh5co-page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="fh5co-page-heading-lead">
                            Edit User
                            <span class="fh5co-border"></span>
                        </h1>

                    </div>
                </div>
            </div>
        </aside>

        <div id="fh5co-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form name="editUser" class="form-horizontal" role="form" action="#" method="POST" ENCTYPE="multipart/form-data">
                            <div class="col-md-3">&nbsp;</div>
							<div class="col-md-2"><label class="input-lg">Username</label></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input placeholder="username" id="username" type="text" class="form-control input-lg" name="username" value="<?php echo $username; ?>" disabled>
                                </div>	
                            </div>
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-3">&nbsp;</div>
							<div class="col-md-2"><label class="input-lg">Name</label></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input placeholder="name" id="name" type="text" class="form-control input-lg" name="name" value="<?php echo $name; ?>" >
                                </div>	
                            </div>
                            <div class="col-md-12">&nbsp;</div>
							<div class="col-md-3">&nbsp;</div>
							<div class="col-md-2"><label class="input-lg">Email</label></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input placeholder="email" id="email" type="text" class="form-control input-lg" name="email"value="<?php echo $email; ?>" >
                                </div>	
                            </div>
                            <div class="col-md-12">&nbsp;</div>
							<div class="col-md-3">&nbsp;</div>
							<div class="col-md-2"><label class="input-lg">Role</label></div>
                            <div class="col-md-4">
                                <div class="form-group">
									<select class="form-control input-lg" id="role" name="role"> 
                                            <option value = 'employee' <?php echo ($role == 'employee') ? 'selected="selected"' : ''; ?>>employee</option>
                                            <option value = 'manager' <?php echo ($role == 'manager') ? 'selected="selected"' : ''; ?>>manager</option>
                                        </select>
                                </div>	
                            </div>
                            <div class="col-md-12">&nbsp;</div>
							<div class="col-md-3">&nbsp;</div>
							<div class="col-md-2"><label class="input-lg">Address</label></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input placeholder="address" id="address" type="text" class="form-control input-lg" name="address" value="<?php echo $address; ?>">
                                </div>	
                            </div>
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="button" onclick="history.back()" class="btn btn-outline " value="Back"></input>
                                    <button onClick="check();" type="button" class="btn btn-primary">Save</button>
                                    <label id="msg" class="text-danger"></label>
                                </div>	
                            </div>
                            <div class="col-md-3">&nbsp;</div>
                        </form>	
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