
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Signin/Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="img/fav-icon.png">
    
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="js/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/fuelux.css" type="text/css" />
    <script type="text/javascript" src="js/modernizr.custom.32033.js"></script>

</head>
<body class="climate-icons-right">
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
                            <li class="active"><a href="#" class="getApp">Sign In &frasl; Sign Up </a>
                            </li>
                            
                            <li><a href="#support">support</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
        </nav>
    </header>
    
    <div class="clearfix"> &nbsp; <br><br><br><br></div>
    
	<div class="sap_tabs col-md-12">
		<div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default"> 
                    <div class="wizard clearfix">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Step 1</li>
                        <li data-target="#step2"><span class="badge">2</span>Step 2</li>
                        <li data-target="#step3"><span class="badge">3</span>Step 3</li>
                      </ul>
                      <div class="actions">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                    </div>
                    <div class="step-content">
                      <div class="step-pane active" id="step1">
                        <div class="register">
                          <form action="#" method="post">	
                            <input name="Name" placeholder="Name" type="text" required>
                            <input name="Email Address" placeholder="Email Address" type="text" required>									
                            <input name="mobile" placeholder="Mobile Number" type="tel" required>	
                            <div class="form-group">
                                <input type="radio" name="radio"> <i class="fa fa-user"></i>Male   &nbsp;
                                <input type="radio" name="radio"> <i class="fa fa-female"></i>Female 
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-danger" type="button" value="">BED-1</button>
                                <button class="btn btn-success" type="button" value="">BED-2</button>
                                <button class="btn btn-info" type="button" value="">BED-3</button>
                            </div>
                            <div class="col-md-6 col-md-offset-3" >
                 				<a class="btn btn-primary" data-toggle="modal" href="#" data-target="#myModal" > <h4><i class="fa fa-map-marker"></i> Location</h4> </a>
                            </div>
                           <!-- <div class="col-md-8 col-md-offset-2" >
                                <button type="button" class="btn btn-success" data-last="Finish" > Next  </button>
                            </div> -->
                 		</form> 
                 <div>
                                </div><div class="clearfix"></div>
                      </div>
                     		<div class="clearfix"></div>
                      </div>
                        <div class="clearfix"></div>
                      <div class="step-pane" id="step2">
                          <div class="clearfix"></div>
                          
                          <div class="pricing-grids">

                                    <div class="pricing-grid1">

                                        <div class="price-value">

                                                <h4><a href="#"> BASIC</a></h4>

                                                <h4><span>$ 0.99</span></h4>

                                                <h5><span> 236</span><lable> / month</lable></h5>

                                        </div>

                                        <div class="price-bg">

                                        <ul>

                                            <li class="whyt"><a href="#">Daily Post 10 </a></li>

                                            <li><a href="#">Ad Per Month 240</a></li>

                                            <li class="whyt"><a href="#">Six days In Week </a></li>

                                            <li><a href="#">Sub area Included </a></li>

                                        </ul>

                                        <div class="cart1">

                                            <a class="popup-with-zoom-anim" href="#small-dialog">ORDER</a>

                                        </div>

                                        </div>

                                    </div>
                          </div>
                          
                          <div class="pricing-grids">

                                    <div class="pricing-grid2">

                                        <div class="price-value two">

                                                <h4><a href="#"> STANDARD</a></h4>

                                                <h4><span>$ 0.99</span></h4>

                                                <h5><span> 236</span><lable> / month</lable></h5>

                                        </div>

                                        <div class="price-bg">

                                        <ul>

                                            <li class="whyt"><a href="#">Daily Post 10 </a></li>

                                            <li><a href="#">Ad Per Month 240</a></li>

                                            <li class="whyt"><a href="#">Six days In Week </a></li>

                                            <li><a href="#">Sub area Included </a></li>

                                        </ul>

                                        <div class="cart2">

                                            <a class="popup-with-zoom-anim" href="#small-dialog">ORDER</a>

                                        </div>

                                        </div>

                                    </div>
                          </div>
                          
                          <div class="pricing-grids">

                                    <div class="pricing-grid3">

                                        <div class="price-value three">

                                                <h4><a href="#"> PREMIUM</a></h4>

                                                <h4><span>$ 0.99</span></h4>

                                                <h5><span> 236</span><lable> / month</lable></h5>

                                        </div>

                                        <div class="price-bg">

                                        <ul>

                                            <li class="whyt"><a href="#">Daily Post 10 </a></li>

                                            <li><a href="#">Ad Per Month 240</a></li>

                                            <li class="whyt"><a href="#">Six days In Week </a></li>

                                            <li><a href="#">Sub area Included </a></li>

                                        </ul>

                                        <div class="cart3">

                                            <a class="popup-with-zoom-anim" href="#small-dialog">ORDER</a>

                                        </div>

                                        </div>

                                    </div>
                          </div>
                      
                      
                      <div class="clearfix"></div>
                      
                      </div>
                      <div class="step-pane" id="step3">This is step 3</div>
                    </div>
	            </div>
		</div>
    </div>
    
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
        	<div class="col-md-12">
        		<iframe src="http://amerytech.net/ostello/index1.php" width="520" height="320"></iframe>
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
    <script src="js/fuelux.js"></script>
    <script type="text/javascript">
					$(document).ready(function () {
						$('#horizontalTab').easyResponsiveTabs({
							type: 'default', //Types: default, vertical, accordion           
							width: 'auto', //auto or any width like 600px
							fit: true   // 100% fit in a container
						});
					});
	</script>
</body>
</html>
