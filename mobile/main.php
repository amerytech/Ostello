
<!DOCTYPE html>
<html>
	<head>
		<title>Ostello | Mobile</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" /><!--
		<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
		<!-- For-Mobile-Apps-and-Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		
	<!-- //For-Mobile-Apps-and-Meta-Tags -->
	</head>
	<body class="inner">
		<!----- tabs-box ---->
		<div class="tabs-box ">
        	<div ><img src="images/ost.png" class="img img-responsive center-block"></div>
            <hr>
            <ul class="nav nav-pills">
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab">Home</a></li>
				<li><a href="#tab3" role="tab" data-toggle="tab">Calendar</a></li>
				<li><a href="#tab5" role="tab" data-toggle="tab">Profile</a></li>
                <li><a href="#tab4" role="tab" data-toggle="tab">Logout</a></li>
				<div class="clearfix"></div>
			</ul>
			<div class="clearfix"></div>
			<div class="tab-grids tab-content">
				<div id="tab1" role="tabpanel"  class="tab-pane active">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="images/0.jpg" alt="Chania">
                                	<div class="carousel-caption">
                                    	<h1> Ostello </h1>
                                    </div>
							</div>
							<div class="item">
								<img src="images/1.jpg" alt="Flower">
                                	<div class="carousel-caption">
                                    	<h1> Ostello </h1>
                                    </div>
							</div>
						</div>
					</div>
                    <div class="clearfix"><br></div>
					<div class="latest">
					<h3 class="text-white">Orders</h3>
					<div class="center-block">
						<button href="#order" data-toggle="tab" class="btn btn-block btn-lg text-black btn-info">Book Order</button>
                        <div class="price">
                        	<p><i></i>Order before 36 hours!</p>
                    	</div>
					</div>

					<div class="clearfix"></div>
					</div>
				</div>
				<div id="tab3" role="tabpanel" class="tab-pane">
					<!--<table class="table-responsive">
						<tr>
							<th>DAY</th>
							<th>DATE</th>		
							<th>TIME</th>
						</tr>
						<tr>
							<td>Mon</td>
							<td>SCREEN1</td>		
							<td><a href="seatselection.html">11:00 AM</a><a href="seatselection.html">02:00 PM</a><a href="seatselection.html">07:00 PM</a></td>
						</tr>
						<tr>
							<td>BRAVE</td>
							<td>SCREEN2</td>		
							<td><a href="seatselection.html">02:00 PM</a><a href="seatselection.html">07:00 PM</a></td>
						</tr>
						<tr>
							<td>HERCULES</td>
							<td>SCREEN3</td>		
							<td><a href="seatselection.html">11:00 AM</a><a href="seatselection.html">07:00 PM</a><a href="seatselection.html">11:00 PM</a></td>
						</tr>
					
						<tr>
							<td>KI&KA</td>
							<td>SCREEN2</td>		
							<td><a href="seatselection.html">07:30 AM</a><a href="seatselection.html">11:00 AM</a><a href="seatselection.html">11:00 PM</a></td>
						</tr>
					
					</table>-->
					<?php
				// Get current year, month and day
				list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));
				
				// Get current year and month depending on possible GET parameters
				if (isset($_GET['month'])) {
					list($iMonth, $iYear) = explode('-', $_GET['month']);
					$iMonth = (int)$iMonth;
					$iYear = (int)$iYear;
				} else {
					list($iMonth, $iYear) = explode('-', date('n-Y'));
				}
				
				// Get name and number of days of specified month
				$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
				list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));
				
				// Get previous year and month
				$iPrevYear = $iYear;
				$iPrevMonth = $iMonth - 1;
				if ($iPrevMonth <= 0) {
					$iPrevYear--;
					$iPrevMonth = 12; // set to December
				}
				
				// Get next year and month
				$iNextYear = $iYear;
				$iNextMonth = $iMonth + 1;
				if ($iNextMonth > 12) {
					$iNextYear++;
					$iNextMonth = 1;
				}
				
				// Get number of days of previous month
				$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));
				
				// Get numeric representation of the day of the week of the first day of specified (current) month
				$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));
				
				// On what day the previous month begins
				$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;
				
				// If previous month
				$bPreviousMonth = ($iFirstDayDow > 0);
				
				// Initial day
				$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;
				
				$bNextMonth = false;
				$sCalTblRows = '';
				
				// Generate rows for the calendar
				for ($i = 0; $i < 6; $i++) { // 6-weeks range
					$sCalTblRows .= '<tr>';
					for ($j = 0; $j < 7; $j++) { // 7 days a week
				
						$sClass = '';
						if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
							$sClass = 'today';
						} elseif (!$bPreviousMonth && !$bNextMonth) {
							$sClass = 'current';
						}
						$sCalTblRows .= '<td class="'.$sClass.'"><a href="">'.$iCurrentDay.'</a>
						 <div class="calbreakfast"> <a href="#" class="calbreakfasttext" /> hiii </a> </div>  
						 <div class="callunch"> <a href="#" class="callunchtext" /> hiii </a> </div>
						 <div class="caldinner"> <a href="#" class="caldinnertext" /> hiii </a> </div> </td>';
				
						// Next day
						$iCurrentDay++;
						if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
							$bPreviousMonth = false;
							$iCurrentDay = 1;
						}
						if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
							$bNextMonth = true;
							$iCurrentDay = 1;
						} 
					}
					$sCalTblRows .= '</tr>';
				}
				
				// Prepare replacement keys and generate the calendar
				$aKeys = array(
					'__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
					'__next_month__' => "{$iNextMonth}-{$iNextYear}",
					'__cal_caption__' => $sMonthName . ', ' . $iYear,
					'__cal_rows__' => $sCalTblRows,
				);
				$sCalendarItself = strtr(file_get_contents('calendar.html'), $aKeys);
				
				// AJAX requests - return the calendar
				if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
					header('Content-Type: text/html; charset=utf-8');
					echo $sCalendarItself;
					exit;
				}
				
				$aVariables = array(
					'__calendar__' => $sCalendarItself,
				);
				echo strtr(file_get_contents('index.html'), $aVariables);
								?>
				
				</div>
					<div id="tab4" role="tabpanel" class="tab-pane">
						<h4>LOGIN INTO YOUR ACCOUNT</h4>
						 <form>
									<h3> E-MAIL</h3>
									<input type="text" class="name"  required="">
									<h3>PASSWORD</h3>
									<input type="password" class="password"  required=""><br>
									<input type="submit" value="SIGN IN"><br>
									<ul>
										<li>
											<input type="checkbox" id="brand1" value="">
											<label for="brand1"><span></span>Remember me</label>
										</li>
									</ul>

								  </form>
								  <h3>DONT HAVE AN ACCOUNT?</h3>
									<a href="#" data-toggle="modal" data-target="#myModal2">SIGNUP NOW</a>
										<div id="myModal2" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">SIGNUP DETAILS</h4>
								</div>
								<div class="modal-body">
								 <form>
									<h3> E-MAIL</h3>
									<input type="text" class="name"  required=""><br>
									<h3>PASSWORD</h3>
									<input type="password" class="password"  required="">
									<h3>RE-ENTER PASSWORD</h3>
									<input type="password" class="password" required><br>
									<h3>MOBILE NO</h3>
									<input type="text" class="name"  required=""><br>
									<input type="submit" value="SIGN UP"><br>
								  </form>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div id="tab5" role="tabpanel" class="tab-pane">
					<div class="contact">
		

			<h3>CONTACT</h3>
			
		<div class="cbottom">
			<div class="cbl">
				<h4>OUR ADDRESS:</h4>
				<h5>flat no:42/16, <br>GM Chowdhury Road, <br>Khulna.</h5>
				<h4> Phone:</h4>
				<h5>+880 1918 691 601</h5>
				<h4>E-mail:</h4>
				<h5><a href="mailto:info@example.com">mlsbd@live.com</a></h5>
            </div>
			<div class="cbr">
				<form>
                        <input type="text" placeholder="your Name" required>
						<input type="text" placeholder="your Phone" required>
						<input type="text" placeholder="your Email" required>
						<textarea rows="5" cols="50" placeholder="Write Your Comment Here"></textarea><br>
						<input type="submit" value="SEND MESSAGE">
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	
	</div>
					</div>
			</div>
		</div>
		<!----- tabs-box ---->
		<!----- Comman-js-files ----->
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!--<script>
			$(document).ready(function() {
				$("#tab2").hide();
				$("#tab3").hide();
				$("#tab4").hide();
				$("#tab5").hide();
				$(".tabs-menu a").click(function(event){
					event.preventDefault();
					var tab=$(this).attr("href");
					$(".tab-grid").not(tab).css("display","none");
					$(tab).fadeIn("slow");
				});
			});
		</script>-->
		<!----- Comman-js-files ----->
     <script>   $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
	</script>
	</body>
</html>

