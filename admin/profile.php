<?php
	session_start();
	include_once("includes/config.php");
	include_once("includes/header.php");
	include_once("includes/menu.php");
?>
<?php
	error_reporting(1);
	$pQuery 	= $conn->query("select * from os_admin where id_user=" . $_SESSION['id']);
	$adminData	= mysqli_fetch_assoc($pQuery);
?>
<section id="content">
	<section class="vbox">
		<header class="header bg-white b-b b-light">
			<p>Master Admin profile</p>
		</header>
		<section class="scrollable">
			<section class="hbox stretch">
				<aside class="bg-white col-lg-12">
					<?php if($_GET['msg']!=''){?>
					<div class="alert alert-success">
						<strong>Success!</strong><?php echo $_GET['msg']; ?>
						</div>
					<?php }?>
					<section class="vbox">
							<h3>Your Personal Information </h3> 
							
							<form action="profilecontroller.php" method="post" id="profileForm" class="form-horizontal" enctype="multipart/form-data">
								<input type="hidden" name="action" value="edit"/>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="glyphicon glyphicon-user" ></i>
											<input type="text"  name="name" id="name"  class="form-control" placeholder="Enter Your Name" value="<?php echo  $adminData['name'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="glyphicon glyphicon-user" ></i>
											<input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email Address" value="<?php echo  $adminData['email'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="glyphicon glyphicon-phone" ></i>
											<input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your Phone Number" value="<?php echo  $adminData['phone'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="fa fa-flag" ></i>
											<input type="text" name="country" id="country" class="form-control" placeholder="Enter Your country" value="<?php echo  $adminData['country'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="glyphicon glyphicon-send" ></i>
											<input type="text" name="state" id="state" class="form-control" placeholder="Enter Your State" value="<?php echo  $adminData['state'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12">
										<div class="form-group inner-addon right-addon">
											<i class="fa fa-map-marker" ></i>
											<input type="text" name="city" id="city" class="form-control" placeholder="Enter Your City" value="<?php echo  $adminData['city'];?>">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-6 col-sm-6">
										<h3>Overview</h3>
										<div class="form-group">
											<textarea id="overview" name="overview" placeholder="Please Enter Overview" rows="8" class="form-control"><?php echo  $adminData['overview'];?></textarea>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<h3>Profile Picture</h3>
										<div class="col-md-6 col-sm-6">
											<img src="images/admin/<?php echo  $adminData['profile_picture'];?>" width="100%" class="img img-responsive">
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<input type="file" name="profile_picture" id="profile_picture" class="form-control">
												<input type="hidden" name="preview_image" value="<?php echo $adminData['profile_picture'];?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="btn-group pull-right">
										<input type="submit" id="profile"  value="SUBMIT" class="btn btn-success" >
										<div> &nbsp; </div>
									</div>
								</div>
							</form> 
						</section>
					</aside>
				</section>
			</section>
		</section>
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
	<aside class="bg-light lter b-l aside-md hide" id="notes">
		<div class="wrapper">Notification</div>
	</aside>
</section>
</section>
</section>
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.js"></script>
<!-- App -->
<script src="js/app.js"></script>
<script src="js/app.plugin.js"></script>
<script src="js/slimscroll/jquery.slimscroll.min.js"></script>


<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript" language="JavaScript">
	$("#profile").click(function()
	{	
		
		$("#showMessage").html("");
		if($("#name").val()=='')
		{
			$("#name").css({"border-style": "solid", "border-color": "red"});
			$("#showMessage").html('Please Enter Name');
			$("#name").focus();
			return false;
			}else{
			$("#name").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		//lastname
		var email = $("#email").val();
		if(email=='')
		{
			$("#email").css({"border-style": "solid", "border-color": "red"});
			$("#showMessage").html('Please Enter Email');
			$("#email").focus();
			return false;
			}else{
			$("#email").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		//phone
		var regex = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
		var phone = $("#phone").val();
		if((phone=='') || (!regex.test(phone)))
		{
			$("#phone").css({"border-style": "solid", "border-color": "red" });
			$("#showMessage").html('Please Enter Valid Phone Number');
			$("#phone").focus();
			return false;
		} 
		else{
			$("#phone").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		
		//pincode
		var country = $("#country").val();
		if(country=='')
		{
			$("#country").css({"border-style": "solid", "border-color": "red" });
			$("#showMessage").html('Please Enter country');
			$("#country").focus();
			return false;
		} 
		else{
			$("#country").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		//pincode
		var state = $("#state").val();
		if(state=='')
		{
			$("#state").css({"border-style": "solid", "border-color": "red" });
			$("#showMessage").html('Please Enter state');
			$("#state").focus();
			return false;
		} 
		else{
			$("#state").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		//pincode
		var city = $("#city").val();
		if(city=='')
		{
			$("#city").css({"border-style": "solid", "border-color": "red" });
			$("#showMessage").html('Please Enter city');
			$("#city").focus();
			return false;
		} 
		else{
			$("#city").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		
		//overview		
		if($("#overview").val() =='') 
		{
			$("#overview").css({"border-style": "solid", "border-color": "red" });
			$("#showMessage").html('Please Write In Overview');
			$("#overview").focus();
			return false;
		} 
		else{
			$("#overview").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
	});
	
	
	
	
	</script>									