<?php
	session_start();
	ob_start();
	include_once('./includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:signin.php');
	}
	include_once("includes/header.php");
	include_once("includes/menu.php");
?>

<section id="content">
	<section class="vbox">          
		<section class="scrollable padder">
			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
				
			</ul>
			<div class="m-b-md">
                <h3 class="m-b-none">Dashboard</h3>
                <small>Welcome back, Admin</small>
			</div>
			<section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
					<div class="col-sm-6 col-md-3 padder-v b-r b-light">
						<span class="fa-stack fa-2x pull-left m-r-sm">
							<i class="fa fa-circle fa-stack-2x text-info"></i>
							<i class="fa fa-male fa-stack-1x text-white"></i>
						</span>
						<a class="clear" href="#">
                                                 <?php $userscount=$conn->query('select count(*) as count from os_user') ;
                                                         $userscountfetch=$userscount->fetch_assoc();
                                                         ?>
                                                    
							<span class="h3 block m-t-xs"><strong><?php echo $userscountfetch['count'] ?></strong></span>
							<small class="text-muted text-uc">Users</small>
						</a>
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
						<span class="fa-stack fa-2x pull-left m-r-sm">
							<i class="fa fa-circle fa-stack-2x text-warning"></i>
							<i class="fa fa-hospital-o  fa-stack-1x text-white"></i>
                                                       
						</span>
						<a class="clear" href="#">
                                                     <?php $hostelscount=$conn->query('select count(*) as count2 from os_hostel') ;
                                                         $hostelcountfetch=$hostelscount->fetch_assoc();
                                                         ?>
							<span class="h3 block m-t-xs"><strong id="bugs"><?php echo $hostelcountfetch['count2'] ?></strong></span>
							<small class="text-muted text-uc">Hostels</small>
						</a>
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
						<span class="fa-stack fa-2x pull-left m-r-sm">
							<i class="fa fa-circle fa-stack-2x text-danger"></i>
							<i class="fa fa-cutlery fa-stack-1x text-white"></i>
							
						</span>
						<a class="clear" href="#">
							<span class="h3 block m-t-xs"><strong id="firers">359</strong></span>
							<small class="text-muted text-uc">Food</small>
						</a>
					</div>
					<div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
						<span class="fa-stack fa-2x pull-left m-r-sm">
							<i class="fa fa-circle fa-stack-2x icon-muted"></i>
							<i class="fa fa-users fa-stack-1x text-white"></i>
						</span>
						<a class="clear" href="#">
                                                     <?php $staffscount=$conn->query('select count(*) as count from os_staff') ;
                                                         $staffcountfetch=$staffscount->fetch_assoc();
                                                         ?>
							<span class="h3 block m-t-xs"><strong><?php echo $staffcountfetch['count'] ?></strong></span>
							<small class="text-muted text-uc">Staff</small>
						</a>
					</div>
				</div>
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
<script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="js/charts/sparkline/jquery.sparkline.min.js"></script>
<script src="js/charts/flot/jquery.flot.min.js"></script>
<script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/charts/flot/jquery.flot.resize.js"></script>
<script src="js/charts/flot/jquery.flot.grow.js"></script>
<script src="js/charts/flot/demo.js"></script>

<script src="js/calendar/bootstrap_calendar.js"></script>
<script src="js/calendar/demo.js"></script>

<script src="js/sortable/jquery.sortable.js"></script>

</body>
</html>