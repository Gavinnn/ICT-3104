<?php require_once('../conn.php'); ?>
<?php require_once('../session/AdminSession.php'); ?>
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
            function check() {
                var check = false;
                var username = $('#username').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var contact = $('#contactNumber').val();
                var role = $('#role').val();

                if (username == "" || username == null)
                    displayErrorMsg("Please fill in the \"Username\" field.");
                else if (name == "" || name == null)
                    displayErrorMsg("Please fill in the \"Name\" field.");
                else if (email == "" || email == null)
                    displayErrorMsg("Please fill in the \"Email\" field.");
                else if (contact == "" || contact == null)
                    displayErrorMsg("Please fill in the \"Contact\" field.");
                else if (role == "" || name == null)
                    displayErrorMsg("Please fill in the \"Role\" field.");
                else {
                    $.ajax({
                        url: "addUserProcess.php",
                        data: {'username': username, 'name': name, 'email': email, 'contact': contact, 'role': role},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "Message has been sent.success") {
                                check = true;
                                successModal("Updated Successfully", "user.php");
                            } else if (data == "email") {
                                displayErrorMsg("The email has been used.");
                                check = false;
                            } else if (data == "username") {
                                displayErrorMsg("The username has been used.");
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
                            <h1>Add User</h1>
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
                    <form action='addUserProcess.php' method='post'  enctype='multipart/form-data' name='createreq-form' id='createreq-form'> 
                        <div class="form-group">
                            <label class="control-label" for="textinput">Username: </label>
                            <input type="text" id="username" name="username" class="form-control input-md"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Name: </label>
                            <input type="text" id="name" name="name" class="form-control input-md"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Email: </label>
                            <input type="email" id="email" name="email" class="form-control input-md"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Contact Number: </label>
                            <input type="text" id="contactNumber" name="contactNumber" class="form-control input-md"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textinput">Role: </label>
                            <select id="role" name="role" class="form-control input-md" > 
                                <option value="2" label="Trainer">Trainer</option>
                                <option value="3" label="Trainee">Trainee</option>
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
                    <button onClick="check();" type="button" class="btn btn-default">Add</button>
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