<!--Get the root path of the project-->
<?php $path = basename(__DIR__); ?>
<header class="clearfix">
    <!-- Start  Logo & Naviagtion  -->
    <div class="navbar navbar-default navbar-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Stat Toggle Nav Link For Mobiles -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- End Toggle Nav Link For Mobiles -->
                <a class="navbar-brand" href="/<?php echo $path; ?>/index.php">GymLife</a>
            </div>
            <div class="navbar-collapse collapse">
                <!-- Start Navigation List -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="active" href="/<?php echo $path; ?>/index.php">Home</a>
                    </li>
                    <!--Booking Section-->
                    <li><a href="/<?php echo $path; ?>/trainerCalendar/trainerCalendar.php">Booking</a></li>
                    <!--Account Management Section-->
					<?php
					if($_SESSION['role']==1){
					?>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Management</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="/<?php echo $path; ?>/admin/user.php">View Users</a></li>
                            <li><a href="/<?php echo $path; ?>/admin/addUser.php">Add User</a></li>
                            <li><a href="/<?php echo $path; ?>/admin/approveUser.php">Approve User</a></li>
                        </ul> 
                    </li>
					<?php } ?>
                    <!--Profile Section-->
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="/<?php echo $path; ?>/account/viewProfile.php">View Profile</a></li>
                            <li><a href="/<?php echo $path; ?>/account/editProfile.php">Edit Profile</a></li>
                            <li><a href="/<?php echo $path; ?>/account/changePassword.php">Change Password</a></li>
                            <li><a href="/<?php echo $path; ?>/logout.php">Logout</a></li>
                        </ul> 
                    </li>
                </ul>
                <!-- End Navigation List -->
            </div><!--End of navbar collapse-->
        </div><!--End of container-->
    </div><!--End of navbar-->
    <!-- End Header Logo & Naviagtion -->
</header>