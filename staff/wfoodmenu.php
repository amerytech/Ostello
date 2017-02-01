<?php 
	include_once('../admin/includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ostello | Hostel-User </title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
		<!-- Stylesheets -->
		<link href="stylesheets/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="stylesheets/style.css" rel="stylesheet" type="text/css" media="all" /> 
		<link href="stylesheets/animate.min.css" rel="stylesheet" type="text/css" media="all" />  
		<link rel="stylesheet" type="text/css" href="stylesheets/base.css" /> 
		<link href="stylesheets/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
		<link rel="shortcut icon" href="img/fav-icon.png" />
	</head>
	<body>
		<!-- Start Wrapper -->
		<div id="page_wrapper">
			
			<!-- Start Header -->
			<header>
				<div class="container-fluid">
					<div class="containeer">
						<!-- Start Social Icons -->
						<aside>
							<ul class="social">
								<li class="facebook"><a href="#">Facebook</a></li>
								<li class="twitter"><a href="#">Twitter</a></li>
								<li class="email"><a href="#">Email</a></li>
								<li class="rss"><a href="#">RSS</a></li>
							</ul>
						</aside>
						
						<nav>
							<ul>
								<li><a href="index.php"><i class="fa fa-arrow-circle-left"></i> User Home</a></li>
								<li> Food Order </li>
							</ul>
							<span class="arrow"></span>
						</nav>
						<!-- End Social Icons -->
					</div>
				</div>
			</header>
			<!-- End Header -->
			
			<section>
				<div class="products">
					<div class="container">
						<div class="col-md-3 rsidebar">
							<div class="related-row">
								<h4 class="text-center">Food Menu</h4> 
								<ul class="nav nav-pills nav-justified">
									<li role="presentation" class="active" ><a href="#tiffin" aria-controls="home" role="tab" data-toggle="tab"> Tiffin </a></li>
									<li role="presentation"  ><a href="#lunch" aria-controls="profile" role="tab" data-toggle="tab"> <i></i> Lunch </a></li>
									<li role="presentation"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab"> Dinner </a></li>
								</ul>       
							</div>
							<div class="related-row" id="FoodSelected">
								<h4 class="text-center">Food Selected</h4> 
								<ul class="nav nav-pills nav-justified">
									<li class="active"><a id="selectedfood"></a></li>
								</ul>    
							</div>
							</div><form id="FoodForm">
							<div class="col-md-9 product-w3ls-right">
								<div class="clearfix"></div>
								<div class="tab-content">
									
									<div class="tab-pane active" id="tiffin">
										<div class="product-top">
											<h4>Tiffin Menu</h4>
											<ul> 
												<li class="dropdown head-dpdn">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
													<ul class="dropdown-menu">
														<li><a href="#">Oil</a></li> 
														<li><a href="#">idli</a></li>
													</ul> 
												</li>
											</ul> 
											<div class="clearfix"> </div>
										</div>
										
										<div class="products-row">
											<?php $tq=$conn->query("select * from os_tiffen where tiffen_status=1 order by id_tiffen ASC");
												while ($tiffen = $tq->fetch_assoc()) {
												?>	
												<div class="col-md-3"> 
													<div class="foodmenuform row text-center">
														<input type="checkbox" id="<?php echo $tiffen['tiffen_name'];?>" class="Foodmenu" value="<?php echo $tiffen['tiffen_name'];?>" name="tifeen[]" hidden>
														<label for="<?php echo $tiffen['tiffen_name'];?>"><img src="img/tiffen/<?php echo $tiffen['tiffen_image']; ?>" class="img img-responsive" /></label>
														<h3><?php echo $tiffen['tiffen_name'];?></h3>
													</div>
												</div>
											<?php }  ?>
										</div>
									</div>    
									<div class="tab-pane " id="lunch">
										<div class="product-top">
											<h4>Lunch Menu</h4>
											<ul> 
												<li class="dropdown head-dpdn">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
													<ul class="dropdown-menu">
														<li><a href="#">Rice</a></li> 
														<li><a href="#">Curry</a></li>
													</ul> 
												</li>
											</ul> 
											<div class="clearfix"> </div>
										</div>
										<div class="products-row">
											<?php $lq=$conn->query("select * from os_lunch where lunch_status=1 order by id_lunch ASC");
												while ($lunch = $lq->fetch_assoc()) {
												?>	
												<div class="col-md-3"> 
													<div class="foodmenuform row text-center">
														<input type="checkbox"  id="<?php echo $lunch['lunch_name'];?>" class="Foodmenu" value="<?php  echo $lunch['lunch_name'];?>" name="lunch[]" hidden>
														<label for="<?php echo $lunch['lunch_name'];?>"><img src="img/lunch/<?php echo $lunch['lunch_image']; ?>" class="img img-responsive" /></label>
														<h3><?php echo $lunch['lunch_name'];?></h3>
													</div>
												</div>
											<?php }  ?>
										</div>
									</div>
									<div class="tab-pane" id="dinner">
										<div class="product-top">
											<h4>Dinner Menu</h4>
											<ul> 
												<li class="dropdown head-dpdn">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
													<ul class="dropdown-menu">
														<li><a href="#">Currys</a></li> 
														<li><a href="#">Rice</a></li>
													</ul> 
												</li>
											</ul> 
											<div class="clearfix"> </div>
										</div>
										<div class="products-row">
											<?php $dq=$conn->query("select * from os_dinner where dinner_status=1 order by id_dinner desc");
												while ($dinner = $dq->fetch_assoc()) {
												?>	
												<div class="col-md-3"> 
													<div class="foodmenuform row text-center">
														<input type="checkbox"  id="<?php echo $dinner['dinner_name'];?>"  value="<?php  echo $dinner['dinner_name'];?>" name="dinner[]" class="Foodmenu" hidden>
														<label for="<?php echo $dinner['dinner_name'];?>"><img src="img/dinner/<?php echo $dinner['dinner_image']; ?>" class="img img-responsive" /></label>
														<h3><?php echo $dinner['dinner_name'];?></h3>
													</div>
												</div>
											<?php }  ?>
										</div>
									</div>
									<button id="FoodSubmit" class="btn btn-primary btn-lg btn-block">Submit Food Menu</button>
									
									<div class="clearfix"> </div>
								</div>
							</div>
						</form>
						<div class="">
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</section>
			
			<!-- footer-top -->
			<div class="w3agile-ftr-top">
				<div class="container">
					<div class="ftr-toprow">
						<div class="col-md-4 ftr-top-grids">
							<div class="ftr-top-left">
								<i class="fa fa-truck" aria-hidden="true"></i>
							</div> 
							<div class="ftr-top-right">
								<h4>FRESH FOOD</h4>
								<p>Fresh food we provide, in Time</p>
							</div> 
							<div class="clearfix"> </div>
						</div> 
						<div class="col-md-4 ftr-top-grids">
							<div class="ftr-top-left">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div> 
							<div class="ftr-top-right">
								<h4>CUSTOMER CHOICE</h4>
								<p>Customer Choice Food We provide</p>
							</div> 
							<div class="clearfix"> </div>
						</div>
						<div class="col-md-4 ftr-top-grids">
							<div class="ftr-top-left">
								<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
							</div> 
							<div class="ftr-top-right">
								<h4>GOOD QUALITY</h4>
								<p>Only Good Quality food we provide</p>
							</div>
							<div class="clearfix"> </div>
						</div> 
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			
			<!-- Start Footer -->
			<footer class="containeer">
				<p>Ostello &copy; 2016. All Rights Reserved.</p>
			</footer>
			<!-- End Footer -->
			
		</div>
		<!-- End Wrapper -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="javascripts/jquery-2.2.3.min.js"></script> 
		<script type="text/javascript" src="javascripts/bootstrap.js"></script>
		<script type="text/javascript" src="javascripts/jquery-scrolltofixed-min.js"></script>
		<script type="text/javascript" src="javascripts/easing.js"></script>	
		<script type="text/javascript" src="javascripts/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
		</script>
	</body>
</html>	
<script type="text/javascript" language="JavaScript">
	$(".Foodmenu").click(function(){
		var checkedFood = $('input[type=checkbox]:checked').map(function(){
			console.log($('input[type=checkbox]:checked').serialize());
			return $(this).attr('value');
		}).get().join("<br>");
		$("#selectedfood").html(checkedFood);
	});
	$("#FoodSubmit").click(function(){
		
		$.ajax({
			url: "foodcontroller.php",
			method: "POST",
			data: { FoodData : $("#FoodForm").serialize(), 'action':'addfood'},
			dataType: "json",
			success: function (response) {
				if(response["success"]==true)
				{
					$("#showMessage").html(response['message']);
					

					}else{
					$("#showMessage").html(response['message']);
				}
			},
			error: function (request, status, error) {
				$("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
			}
		});
	});
	
        
        
</script>




