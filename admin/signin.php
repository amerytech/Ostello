<?php
	ob_start();
	session_start();
	include_once('./includes/config.php');
	if (isset($_SESSION['id'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
	<head>
		<meta charset="utf-8" />
		<title>Ostello | Master Admin Sigin </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="css/animate.css" type="text/css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
		<link rel="stylesheet" href="css/font.css" type="text/css" />
		<link rel="stylesheet" href="css/app.css" type="text/css" />
		<link rel="shortcut icon" href="images/fav-icon.png" />
	</head>
	<body>
		<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
			<div class="container aside-xxl">
				<a class="navbar-brand block" href="index.php">Ostello</a>
				<section class="panel panel-default bg-white m-t-lg">
					<header class="panel-heading text-center">
						<strong>Sign in</strong>
					</header>
					<div id="showMessageDiv" style="display:none;" class="alert alert-danger">
						<span id="showMessage" class="warning">
						</span>
						
					</div>
					<div id="showSuccessMessageDiv" <?php if(!isset($_SESSION['message'])){?> style="display:none;"<?php }?> class="alert alert-success">
						<span id="showSuccessMessage" >	</span>
						<?php if(isset($_SESSION['message'])){
							echo $_SESSION['message'];
							unset($_SESSION['message']);
						}?>	
					</div>	
					<form id="loginForm" class="panel-body wrapper-lg">
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="text" placeholder="test@example.com" name="email" id="email" class="form-control input-lg">
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" placeholder="Password" id="password" name="password" class="form-control input-lg">
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox"> Keep me logged in
							</label>
						</div>
						<!--<a href="#" class="pull-right m-t-xs"><small>Forgot password?</small></a>-->
						<button id="LogIn" class="btn btn-primary">Sign in</button>
					</form>
				</section>
			</div>
		</section>
		<!-- footer -->
		<footer id="footer">
			<div class="text-center padder">
				<p>
					<small>Ostello &copy; 2016</small>
				</p>
			</div>
		</footer>
		<!-- / footer -->
		<script src="js/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.js"></script>
		<!-- App -->
		<script src="js/app.js"></script>
		<script src="js/app.plugin.js"></script>
		<script src="js/slimscroll/jquery.slimscroll.min.js"></script>
	</body>
</html>

<script type="text/javascript" language="JavaScript">
	$("#LogIn").click(function()
	{
		$("#showSuccessMessageDiv").hide();
		$("#showMessageDiv").hide();
		$("#showMessage").html('');
		$("#showSuccessMessage").html('');
		var email = $("#email").val();
		if(email=='')
		{
			$("#email").css({"border-style": "solid", "border-color": "red"});
			$("#showMessageDiv").show();
			$("#showMessage").html('<strong>Warning! </strong> Please enter your email.');
			$("#email").focus();
			return false;
			}else{
			$("#email").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		var password = $("#password").val();
		if(password=='') 
		{
			$("#password").css({"border-style": "solid", "border-color": "red" });
			$("#showMessageDiv").show();
			$("#showMessage").html('<strong>Warning! </strong> Please enter your password.');
			$("#password").focus();
			return false;
		}
		else{
			$("#password").css({"border-style": "solid","border-color": "#E9E9E9"});
		}	
		$.ajax({
			url: "controller.php",
			method: "GET",
			data: { loginData : $("#loginForm").serialize(), 'action':'login'},
			dataType: "json",
			success: function (response) {
				if(response["success"]==true)
				{
					$("#showMessageDiv").hide();
					$("#showSuccessMessageDiv").show();
					$("#showSuccessMessage").html("<strong>Success! </strong> Please Wait...!");
					location = '<?php echo SITE_ADMIN_URL;?>controller.php?action=checkLogin&loginid='+response["id"];
					window.open(location);
					}else{
					$("#showMessageDiv").show();
					$("#showMessage").html(response["message"]);
				}
			},
			error: function (request, status, error) {
				$("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
			}
		});
		return false;
	});
</script>
