<?php include '../conn.php'; ?>
<?php include '../session/adminSession.php'; ?>
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
        <!--SweetAlert-->
        <link rel="stylesheet" href="../assets/plugins/sweetalert-master/sweet-alert.css">
        <!-- jQuery -->
        <script src="../assets/js/jquery.min.js"></script>
        <!--Datatable-->
        <link rel="stylesheet" href="../assets/plugins/DataTables/css/jquery.dataTables.css">
        <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>
        <!-- Modernizr JS -->
        <script src="../assets/js/modernizr-2.6.2.min.js"></script>
        <script src="../assets/js/custom.js"></script>
        <script>
            $(document).ready(function () {
                $('#users').DataTable();
            });
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
                            Account Management
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
                        <table id="users" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $record = DB::query("SELECT * FROM user");

                                foreach ($record as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['role'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-primary' onclick=\"location.href='viewUser.php?id=" . $row['userid'] . "'\">View</button>";
                                    echo "<button class='btn btn-success' onclick=\"location.href='edituser.php?id=" . $row['userid'] . "'\">Edit</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table><!-- /userTable -->
                    </div>
                </div>
            </div>
        </div>

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