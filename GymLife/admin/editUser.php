<?php require_once('../conn.php'); ?>
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
            function ValidateEmail(mail)
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
                {
                    return (true);
                }
                return (false);
            }
            function check() {
                var check = false;
                var userid = $('#account').val();
                var username = $('#userName').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var contact = $('#contactNumber').val();
                var status = $('#status').val();
                var role = $('#role').val();

                if (name == "" || name == null)
                    displayErrorMsg("Please fill in the \"Name\" field.");
                else if (email == "" || email == null)
                    displayErrorMsg("Please fill in the \"Email\" field.");
                else if (!ValidateEmail(email))
                    displayErrorMsg("Please fill in a valid email");
                else {
                    $.ajax({
                        url: "editUserProcess.php",
                        data: {'userid': userid, 'username': username, 'name': name, 'email': email, 'contact': contact, 'status': status, 'role': role},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "success") {
                                check = true;
                                successModal("Updated Successfully", "editUser.php?id=" + userid);
                            } else if (data == "email") {
                                displayErrorMsg("The email has been used.");
                                check = false;
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
                            <h1>Edit My Particulars</h1>
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
                    <form action='editUserProcess.php' method='post'  enctype='multipart/form-data' name='createreq-form' id='createreq-form'> 
                        <input type="hidden" id="account" name="account" value="<?php print $id; ?>"/>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Username: </label>
                            <input type="text" id="userName" name="userName" class="form-control input-md" value="<?php echo $username; ?>"  readonly/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Name: </label>
                            <input type="text" id="name" name="name" class="form-control input-md" value="<?php echo $name; ?>" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Email: </label>
                            <input type="email" id="email" name="email" class="form-control input-md" value="<?php echo $email; ?>" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Contact Number: </label>
                            <input type="text" id="contactNumber" name="contactNumber" class="form-control input-md" value="<?php echo $contact; ?>" />
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Role: </label>
                            <select class="form-control input-lg" id="role" name="role"> 
                                <?php
                                $record = DB::query("SELECT * FROM roles");

                                foreach ($record as $row) {
                                    echo "<option value = \"" . $row['roleID'] . "\"";
                                    if ($role == $row['roleID']) {
                                        echo "selected=\"selected\"";
                                    }
                                    echo ">" . $row['roleName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Status: </label>
                            <select class="form-control input-lg" id="status" name="status"> 
                                <?php
                                $record = DB::query("SELECT * FROM status");

                                foreach ($record as $row) {
                                    echo "<option value = \"" . $row['statusID'] . "\"";
                                    if ($status == $row['statusID']) {
                                        echo "selected=\"selected\"";
                                    }
                                    echo ">" . $row['statusName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
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
                        Copyright � 2017. ICT3104 Software Management - Gym Booking System</a>
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