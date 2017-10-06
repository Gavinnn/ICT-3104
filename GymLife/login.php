<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Sign-Up/Login Form</title>
        <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="asset/css/login.css">

        <!--SweetAlert-->
        <link rel="stylesheet" href="asset/plugins/sweetalert-master/sweet-alert.css">
        <script src="asset/plugins/sweetalert-master/sweet-alert.js"></script>
        <!--Custom Javascript-->
        <script src="asset/js/custom.js"></script>
        <script>
            function register() {
                var confirm = false;
                var username = $("#username").val();
                var name = $("#name").val();
                var email = $("#email").val();
                var contact = $("#contact").val();
                var role = $("#role").val();
                var password = $("#pass").val();
				var cfmPassword = $("#cfmpass").val();

                if (username == "")
                    displayErrorMsg("Please fill in the \"username\"field.");
                else if (name == "")
                    displayErrorMsg("Please fill in the \"Name\" field.");
                else if (email == "")
                    displayErrorMsg("Please fill in the \"Email\" field.");
                else if (contact == "")
                    displayErrorMsg("Please fill in the \"Contact Number\" field.");
                else if (role == "" || role == null)
                    displayErrorMsg("Please fill in the \"Role\" field.");
                else if (password == "" || password.length < 8)
                    displayErrorMsg("\"Password\" field is too short.");
                else if (password==cfmPassword && password.length >= 8) {
                    $.ajax({
                        url: "registerProcess.php",
                        data: {'username': username, 'name': name, 'email': email, 'contact': contact, 'role': role, 'password': password},
                        type: 'POST',
                        async: false,
                        success: function (data) {
                            if (data == "success") {
                                confirm = true;
                                successModal("Successfully registered account", "index.php");

                            } else if (data == "username") {
                                displayErrorMsg("The username has been taken.");
                            } else if (data == "email") {
                                displayErrorMsg("The email has been used.");
                            }
                        }
                    });
                }
				else
					displayErrorMsg("The password section is incorrect.");

                return confirm;
            }
            function check()
            {
                var check = false;
                var id = $("#user").val();
                var pass = $("#password").val();
                $.ajax({
                    url: "checkUser.php",
                    data: {'id': id, 'pass': pass},
                    type: 'POST',
                    async: false,
                    success: function (data) {
                        if (data == 'exist')
                        {
                            check = true;
                        } else
                        {
                            $("#password").val('');
                            displayErrorMsg("Invalid username or password.Please try again.");
                        }
                    }
                });
                return check;
            }
        </script>
    </head>

    <body>
        <div class="form">
            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Sign Up</a></li>
                <li class="tab"><a href="#login">Log In</a></li>
            </ul>
            <div class="tab-content">
                <div id="signup">   
                    <h1>Sign Up for Free</h1>
                    <form action="#" method="post">
                        <div class="field-wrap">
                            <label>
                                Username<span class="req">*</span>
                            </label>
                            <input id="username" type="text"required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Name<span class="req">*</span>
                            </label>
                            <input id="name" type="text"required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input id="email" type="email"required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Contact Number<span class="req">*</span>
                            </label>
                            <input id="contact" type="text"required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <select id="role" name="role"> 
                                <option value = '2'>trainer</option>
								<option value = '3' >trainee</option>
                            </select>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Set A Password<span class="req">*</span>
                            </label>
                            <input id="pass" type="password"required autocomplete="off"/>
                        </div>
						<div class="field-wrap">
                            <label>
                                Confirm Password<span class="req">*</span>
                            </label>
                            <input id="cfmpass" type="password"required autocomplete="off"/>
                        </div>
                        <button onClick="register();" type="button" class="button button-block">Get Started</button>
                    </form>
                </div>

                <div id="login">   
                    <h1>Welcome to GymLife!</h1>
                    <form name="login" id="login" class="form-horizontal" action="loginProcess.php" enctype="multipart/form-data" method="POST" onSubmit="return check();">
                        <div class="field-wrap">
                            <label>
                                Username<span class="req">*</span>
                            </label>
                            <input type="email" id="user" name="user"required/>
                        </div>
                        <div class="field-wrap">
                            <label>Password<span class="req">*</span></label>
                            <input type="password" id="password" name="password"required autocomplete="off"/>
                        </div>
                        <button type="submit" class="button button-block">Log In</button>

                    </form>
                </div>
            </div><!-- tab-content -->
            <div class="field-wrap">
                <!--Error Message-->
                <label id="msg" class="text-danger"></label>
            </div>
        </div> <!-- /form -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="asset/js/login.js"></script>
        <script src="asset/js/custom.js"></script>
    </body>
</html>