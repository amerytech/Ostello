<?php
ob_start();
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (isset($_SESSION['id_staff'])) {
    header('location:staff/index.php');
} else {
    if (isset($_SESSION['id_user'])) {
        header('location:user/index.php');
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <title>Ostello | Book hostel online </title>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="shortcut icon" href="img/fav-icon.png">

        <!-- Bootstrap 3.3.2 -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="js/rs-plugin/css/settings.css">

        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="js/modernizr.custom.32033.js"></script>
    </head>

    <body>

        <header>

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="fa fa-bars fa-lg"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">
                            <img src="img/ost.png" alt="" class="logo">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="getApp"  href="#" data-toggle="modal" data-target="#myModal">Sign In &frasl; Sign Up </a>
                            </li>
                             <li><a href="termsandconditions.php">Terms and Conditions</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-->
            </nav>

            <!--RevSlider-->
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <ul class="list-unstyled">
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                            <div class="tp-caption large_white_light sft" data-x="center" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1200" data-easing="Power4.easeOut">
                                It All Starts with Your 
                            </div>
                            <div class="tp-caption large_white_light sfb" data-x="center" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1500" data-easing="Power4.easeOut">
                                Stunning Website
                            </div>
                        </li>
                        <!-- SLIDE 2 -->
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                            <div class="tp-caption large_white_light sft" data-x="center" data-y="250" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1400" data-easing="Power4.easeOut">
                                It All Starts with Your <br> Stunning Website
                            </div>
                        </li>

                        <!-- SLIDE 3 -->
                        <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1000" >
                            <div class="tp-caption large_white_light sfl" data-x="center" data-y="center" data-hoffset="0" data-voffset="-50" data-speed="1000" data-start="1000" data-easing="Power4.easeOut">
                                It All Starts with Your Stunning Website
                            </div>
                            <div class="tp-caption small_light_white sfb hidden-xs" data-x="center" data-y="center" data-hoffset="0" data-voffset="50" data-speed="1000" data-start="1600" data-easing="Power4.easeOut">
                                <p>It All Starts with Your Stunning Website</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="climate-icons-right">
                            <div class="sap_tabs text-center">	
                                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                    <ul>
                                        <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Sign in</span></li>
                                    </ul>		
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                        <div class="facts">
                                            <div class="register">
                                                <div id="showSuccessMessageDiv" <?php if (!isset($response)) { ?> style="display:none;"<?php } ?> class="alert alert-success">
                                                    <span id="showSuccessMessage" >	</span>

                                                </div>
                                                <div id="showMessageDiv" <?php if (!isset($response)) { ?> style="display:none;"<?php } ?> class="alert alert-danger">
                                                    <span id="showMessage" >	</span>

                                                </div>
                                                <form id="loginForm"  action="#" method="post">										
                                                    <input placeholder="Email Address" class="mail" type="text" name="Email" required>									
                                                    <input placeholder="Password" class="lock" type="password" name="Password" required>
                                                    <input type="radio" name="holder" value="user" checked="checked" > User
                                                    <input type="radio" name="holder" value="staff"> Staff								
                                                    <div class="sign-up">
                                                        <input id="loginSubmit" type="submit" value="Sign in"/>
                                                    </div>
                                                </form>

                                                <h3><a href="#"> Forgot Password</a> <a href="Signin-Signup.php"> Sign Up</a> </h3>
                                            </div>
                                        </div> 
                                    </div>     					            	      
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/waypoints.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/placeholdem.min.js"></script>
        <script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>

        <!--<script src="admin/js/jquery.min.js"></script>
        <script src="admin/js/bootstrap.js"></script>
        <script src="admin/js/app.js"></script>
        <script src="admin/js/app.plugin.js"></script>
        <script src="admin/js/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="admin/js/slider/bootstrap-slider.js"></script>
        -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#horizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion           
                    width: 'auto', //auto or any width like 600px
                    fit: true   // 100% fit in a container
                });
            });

            $("#loginSubmit").click(function ()
            {
                $("#showSuccessMessageDiv").hide();
                $("#showMessageDiv").hide();
                $("#showMessage").html('');
                $("#showSuccessMessage").html('');

                $.ajax({
                    url: "logincontroller.php",
                    method: "POST",
                    data: {loginData: $("#loginForm").serialize(), 'action': 'login'},
                    dataType: "json",
                    success: function (response) {
                        if (response["success"] == true && response["message"] == "login staff sucess")
                        {
                            $("#showMessageDiv").hide();
                            $("#showSuccessMessageDiv").show();
                            $("#showSuccessMessage").html(response["message"]);
                            location = 'staff/index.php';

                        } else if (response["success"] == true && response["message"] == "Login User sucess")
                        {
                            $("#showMessageDiv").hide();
                            $("#showSuccessMessageDiv").show();
                            $("#showSuccessMessage").html(response["message"]);
                            location = 'user/index.php';

                        } else {
                            $("#showMessageDiv").show();
                            $("#showMessage").html(response["message"]);
                        }

                    },
                    error: function (request, status, error) {
                        $("#showMessageDiv").show();
                        $("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
                    }
                });
                return false;
            });
        </script>
    </body>
</html>
