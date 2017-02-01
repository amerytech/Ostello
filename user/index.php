<?php
	ob_start();
	session_start();
	include_once('../admin/includes/config.php');
	// if ($conn) {
	// echo 'conected';
	// } else {
	// echo 'not conected';
	// exit;
	// }
	if (!isset($_SESSION['id_user'])) {
		header('location:../index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ostello | Hostel-User </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="stylesheets/base.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/media.queries.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/tipsy.css" />
        <link rel="stylesheet" type="text/css" href="javascripts/fancybox/jquery.fancybox-1.3.4.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
        <link rel="shortcut icon" href="../img/fav-icon.png" />
		
		
		
		
		
        <!--calendar css & js -->
        <link href="javascripts/fullcalendar.min.css" rel="stylesheet" />
        <link href="javascripts/fullcalendar.print.min.css" rel="stylesheet" media="print" />
        <link href="javascripts/scheduler.min.css" rel="stylesheet" />
		<!--<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script>-->
        <script type="text/javascript" src="javascripts/jquery.min.js"></script>
        <script type="text/javascript" src="javascripts/moment.min.js"></script>
        <script type="text/javascript" src="javascripts/fullcalendar.min.js"></script>
        <script language="JavaScript" type="text/javascript" >
			
			
			//   $("#loadcalendar").click(function ()
			//    {
			
			//         });
			////          console.log( "hiii!" );
            $(function () { // document ready
                $("#loadcalendar").click(function ()
                {
                    console.log("hiii!");
                    $('#calendar').fullCalendar({
                        now: '2016-12-07',
                        editable: true, // enable draggable events
                        aspectRatio: 1.8,
                        scrollTime: '00:00', // undo default 6am scrollTime
                        header: {
                            left: 'prev',
                            center: 'title',
                            right: 'next'
						},
                        defaultView: 'month',
                        views: {
                            timelineThreeDays: {
                                type: 'timeline',
                                duration: {days: 3}
							}
						},
                        resourceLabelText: 'Rooms',
                        resources: [
						{id: 'a', title: 'Auditorium A'},
						{id: 'b', title: 'Auditorium B', eventColor: 'green'},
						{id: 'c', title: 'Auditorium C', eventColor: 'orange'},
						{id: 'd', title: 'Auditorium D', children: [
							{id: 'd1', title: 'Room D1'},
							{id: 'd2', title: 'Room D2'}
						]},
						{id: 'e', title: 'Auditorium E'},
						{id: 'f', title: 'Auditorium F', eventColor: 'red'},
						{id: 'g', title: 'Auditorium G'},
						{id: 'h', title: 'Auditorium H'},
						{id: 'i', title: 'Auditorium I'},
						{id: 'j', title: 'Auditorium J'},
						{id: 'k', title: 'Auditorium K'},
						{id: 'l', title: 'Auditorium L'},
						{id: 'm', title: 'Auditorium M'},
						{id: 'n', title: 'Auditorium N'},
						{id: 'o', title: 'Auditorium O'},
						{id: 'p', title: 'Auditorium P'},
						{id: 'q', title: 'Auditorium Q'},
						{id: 'r', title: 'Auditorium R'},
						{id: 's', title: 'Auditorium S'},
						{id: 't', title: 'Auditorium T'},
						{id: 'u', title: 'Auditorium U'},
						{id: 'v', title: 'Auditorium V'},
						{id: 'w', title: 'Auditorium W'},
						{id: 'x', title: 'Auditorium X'},
						{id: 'y', title: 'Auditorium Y'},
						{id: 'z', title: 'Auditorium Z'}
                        ],
                        
                        events: [
						{id: '1', resourceId: 'b', start: '2016-12-06T02:00:00', end: '2016-12-06T07:00:00', title: 'event 1'},
						{id: '2', resourceId: 'c', start: '2016-12-06T05:00:00', end: '2016-12-06T22:00:00', title: 'event 2'},
						{id: '3', resourceId: 'd', start: '2016-12-06', end: '2016-12-08', title: 'event 3'},
						{id: '4', resourceId: 'e', start: '2016-12-06T03:00:00', end: '2016-12-06T08:00:00', title: 'event 4'},
						{id: '5', resourceId: 'f', start: '2016-12-06T00:30:00', end: '2016-12-06T02:30:00', title: 'event 5'}
                        ],
                        dayClick: function(date, jsEvent, view) {
							
							// alert('Clicked on: ' + date.format());
							//var fine=date.format();
							var userDate = date.format();
							var date_string = moment(userDate, "YYYY-MM-DD").format("DD-MM-YYYY");
							
							window.location = '../user/foodorder.php?ordereddate=' + date_string;
							
							
							
							//        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
							//
							//        alert('Current view: ' + view.name);
							
							// change the day's background color just for fun
							//        $(this).css('background-color', 'red');
							
						}
					});
					
					//    $('#calendar').fullCalendar({
					//
					//        dayClick: function(date, jsEvent, view) { 
					//            alert('Clicked on: ' + date.getDate()+"/"+date.getMonth()+"/"+date.getFullYear());  
					//        },
					//
					   });
				});
				
				
				// $('#msg').load('confpwd.php').hide();
				
				// $('#cpwd').keyup(function(){
					// $.post('confpwd.php',{passwordc:data.currentpassword.value} , 
					// function(result)
					// {
// $('#msg').load('confpwd.php').show();
						// $('#msg').html(result).show();
					// });
					// });
				
				
					// $('#pwd, #pwdc').on('keyup', function () {
// $('#msg').load('confpwd.php').show();

						// if ($('#pwd').val() == $('#pwdc').val()) {
							// $('#msg').html('').css('color', 'green');
						// } else {
							// $('#msg').html('Not Matching').css('color', 'red');
							// return false;
					// });
			// });
		</script>
		
		
		
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
                        <!-- End Social Icons -->
						
                        <!-- Start Navigation -->
                        <nav>
                            <ul>
                                <li><a href="#home">User Home</a></li>
                                <li><a href="#food" id="loadcalendar">Food</a></li>
                                <li><a href="#userprofile" >Profile</a></li>
                                <li><a href="../logincontroller.php?type=logout2" class="button gray"> Logout </a></li>
							</ul>
                            <span class="arrow"></span>
						</nav>
                        <!-- End Navigation -->
					</div>
				</div>
			</header>
            <!-- End Header -->
			
            <section class="containeer">
                <!-- Start left-home Info -->
                <div id="app_info">
                    <!-- Start Logo -->
                    <a href="#home" class="logo">
                        <img src="img/ost.png" alt="Ostello" />
					</a>
                    <!-- End Logo -->
                    <span class="tagline">The greatest Hostel Online Booking site.</span>
                    <p> Ostello is a fully-responcible, Hostel Management website site you can use in iPhone, iPad, Android and more. </p>
                    <div class="text-center">
                        <a href="#food" class="large_button order-btn" id="apple">
                            <em>Order Now</em> ORDER FOOD
						</a>
					</div>
                    <div class="price centered">
                        <p><i ></i>Order before 36 hours!</p>
					</div>
				</div>
                <!-- End Left-home Info -->		
				
                <!-- Start Pages -->
                <div id="pages" >
                    <div class="top_shadow"></div>
                    <!-- Start Home -->
                    <div id="home" class="page">
						
                        <div id="slider">
							
                            <div class="slide" data-effect-out="slide">
								
                                <div class="background iphone-white">
                                    <img src="img/slider/iphone-back.jpg" alt="iphone-back" />
								</div>
								
                                <div class="foreground iphone-white">
                                    <img src="img/slider/iphone-front.jpg" alt="iphone-front" />
								</div>
								
							</div>
							
                            <div class="slide" data-effect-in="slide">
								
                                <div class="background iphone-black">
                                    <img src="img/slider/blackberry-back.jpg" alt="blackberry-back" />
								</div>
								
                                <div class="foreground iphone-black">
                                    <img src="img/slider/blackberry-front.jpg" alt="blackberry-front" />
								</div>
								
							</div>
							
                            <div class="slide">
								
                                <div class="background ipad-black">
                                    <img src="img/slider/android-back.jpg" alt="android-back" />
								</div>
								
							</div>
							
                            <div class="slide">
								
                                <div class="background ipad-white">
                                    <img src="img/slider/ipad.jpg"  alt="ipad" />
								</div>
								
							</div>
							
						</div>
						
					</div>
                    <!-- End Home -->
					
                    <!-- Start Food -->
                    <div id="food" class="page" >
						
                        <div id='calendar'></div>
						
					</div>
                    <?php
						$user_id = $_SESSION['id_user'];
						$queryuserdata = $conn->query("SELECT * ,(os_wallet_admin+os_wallet_user)as totalwallet FROM os_user where id_user='" . $user_id . "'");
						$fetchuserdata = $queryuserdata->fetch_assoc();
					?>
					
                    <!-- Start User Profile -->
                    <div id="userprofile" class="page">
						
                        <h1> USER PROFILE</h1>
						<div id="msg"></div>
                        <div id="showMessageDiv" style="display:none;" class="alert alert-danger">
                            <span id="showMessage" class="warning">
                                <?php
									if (isset($_SESSION['message'])) {
										echo $_SESSION['message'];
									}
								?>	
							</span>
						</div>
                        <div id="showSuccessMessageDiv" <?php if (!isset($_SESSION['message'])) { ?> style="display:none;"<?php } ?> class="alert alert-success">
                            <span id="showSuccessMessage" >	</span>
						</div>	
                        <div id="contact_form"> 
							
							
                            <div class="validation">
                                <p>Oops! Please correct the highlighted fields...</p>
							</div>
							
                            <div class="success">
                                <p>Thanks! I'll get back to you shortly.</p>
							</div>
                            <form action="controller.php" method="post" enctype="multipart/form-data" name="data" >
								
                                <div class="row">
                                    <p class="left userprofilepf">
                                        <input type="hidden" name="action" value="passwordchange">
                                        <img id="passage_image_preview" src="../images/user/<?php echo $fetchuserdata['user_image'] ?>" alt="User PRofile Pick" class="center-block" >
                                        <input type="file"  name="photo"   id="uploadImage1"/>
									</p>
                                    <p class="right">
                                        <span class="text-center" ><strong class="center-block"> Money In Your Wallet </strong></span><span>&nbsp;</span>
                                        <input type="text" class="text-center"  name="wallet" id="wallet" value="Rs. <?php echo $fetchuserdata['totalwallet'] ?>" readonly /> <span>&nbsp;</span><br>
                                        <a href="../merchant/" class="button purple">Add Top-up</a>
									</p>
								</div>
                                <div class="row">
                                    <p class="left">
                                        <input type="text" readonly name="name" id="name" value="<?php echo $fetchuserdata['user_name'] ?>"/>
									</p>
                                    <p class="right">
                                        <input type="text" readonly name="email" id="email" value="<?php echo $fetchuserdata['user_email'] ?>" />
									</p>
								</div>
                                <div class="row">
                                    <p class="left">
                                        <input type="text" readonly name="mobile" id="mobile" value="<?php echo $fetchuserdata['user_phone'] ?>"/>
									</p>
                                    <p class="right">
                                        <input type="text" readonly name="location" id="location" value="<?php echo $fetchuserdata['user_hostel'] ?>" />
									</p>
								</div>
                                <div class="row">
                                    <p class="left">
                                        <input type="text" readonly name="userroom" id="userroom" value="Bed code:<?php echo $fetchuserdata['user_bedcode'] ?>"/>
									</p>
                                    <span id="showMessage2"></span>
                                    <p class="right">
                                        <label for="cpwd">Current Password*</label>
                                        <input type="password" name="currentpassword" id="cpwd"  value="" required />
									</p>
								</div>
                                <div class="row">
                                    <p class="left">
                                        <label for="pwd">New Password*</label>
                                        <input type="password" name="newpassword" class="password" id="pwd" required />
									</p>
									<span id="showMessage3"></span>
                                    <p class="right">
                                        <label for="pwdc">Confirm Password*</label>
                                        <input type="password" name="confirmpassword" class="cpassword_field" id="pwdc" class="cpassword"   required />
									</p>
								</div>
                                <input type="submit" id="submitprofile" class="button white" value="Submit" />
							</form>
						</div>
                        <div class="clear"></div>
					</div>
                    <!-- End User Profile -->
                    <div class="bottom_shadow"></div>
				</div>
                <!-- End Pages -->
				
                <div class="clear"></div>
			</section>
			
            <!-- Start Footer -->
            <footer class="containeer">
                <p>Ostello &copy; 2016. All Rights Reserved.</p>
			</footer>
            <!-- End Footer -->
			
		</div>
        <!-- End Wrapper -->
        <script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src='javascripts/calendar/lib/fullcalendar.min.js'></script>
        <!--<script type="text/javascript" src='javascripts/calendar/scheduler.min.js'></script>-->
        <!--<script type="text/javascript" src="javascripts/fullcalendar.min.js"></script>-->
        <!--<script type="text/javascript" src="javascripts/fullcalendar.mjs"></script>-->
        <script type="text/javascript" src="javascripts/moment.min.js"></script>
		
        <script type="text/javascript" src="javascripts/html5shiv.js"></script>
        <script type="text/javascript" src="javascripts/fancybox/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="javascripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="javascripts/jquery.touchSwipe.js"></script>
        <script type="text/javascript" src="javascripts/jquery.mobilemenu.js"></script>
        <script type="text/javascript" src="javascripts/jquery.infieldlabel.js"></script>
        <script type="text/javascript" src="javascripts/jquery.echoslider.js"></script>
        <script type="text/javascript" src="javascripts/fluidapp.js"></script>
		
		
		
		
		
        <script type="text/javascript" language="JavaScript">
		
		$(window).load(function () {
		
                $("#cpwd").focusout(function () {
				$("#showMessage2").hide();
                    var password = $("#cpwd").val();

 $.ajax({
                    url: "controller.php",
                    method: "GET",
                    data: {data : password, 'action': 'passwordcheck'},
                    dataType: "json",
                   success: function (response) {
				if(response["success"]==false)
				{
			console.log("hii");
							$("#showMessage2").show();
                            $("#showMessage2").html(response['message']);
                            


                        } 
                    },
                    error: function (request, status, error) {
							 $("#showMessageDiv").show();
                            $("#showMessageDiv").html("OOPS! Something Went Wrong Please Try After Sometime!");
                    }
                });
				  });
				  $("#pwdc").focusout(function () {
					  console.log('hii') ;
				  if ($('#pwd').val() == $('#pwdc').val()) {
							// $('#msg').html('').css('color', 'green');
						} else {
							$('#showMessage3').html('Password Not Matching');
							// return false;
					};
				  });
				  // function readURL(input) {
					// if (input.files && input.files[0]) {
						// var reader = new FileReader();
						// reader.onload = function (e) {
							// $('#passage_image_preview').attr('src', e.target.result);
						// }
						// reader.readAsDataURL(input.files[0]);
					// }
				// }
				// $("#uploadImage1").change(function () {
					// readURL(this);
				// });
				$("#submitprofile").click(function () {
				$("#showMessage2").hide();
                    var password = $("#cpwd").val();

				$.ajax({
                    url: "controller.php",
                    method: "GET",
                    data: {data : password, 'action': 'passwordcheck'},
                    dataType: "json",
                   success: function (response) {
				if(response["success"]==false)
				{
			console.log("hii");
							$("#showMessage2").show();
                            $("#showMessage2").html(response['message']);
                            return false;


                        } 
                    },
                    error: function (request, status, error) {
							 $("#showMessageDiv").show();
                            $("#showMessageDiv").html("OOPS! Something Went Wrong Please Try After Sometime!");
                    }
                });
				
				if ($('#pwd').val() == $('#pwdc').val()) {
							// $('#msg').html('').css('color', 'green');
						} else {
							$('#showMessage3').html('Password Not Matching');
							return false;
					};
				
				   });
				     });
			// $(window).load(function () {
			
			// console.log("hiii");
       // $("#showMessage").hide();
                // $("#cpwd").focusout(function () {
                    // var password = $("#cpwd").val();
					// console.log(password);
                    // $.ajax({
                        // url: "controller.php",
                        // method: "POST",
                        // type: "json",
                        // data: { password: password, 'action': 'passwordcheck'},
                        // dataType: "json",
                        // success: function (response) {
                            // if (response["success"] == false)
                            // {
								
                                // $("#showMessage").show();
                                // $("#showMessage").html(response["message"]);
								                               // location = 'staff/index.php';
								
							// }
							
						// },
                        // error: function (request, status, error) {
                            // $("#showMessageDiv").show();
                            // $("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
						// }
					// });
					
					
					
				// });
			
			
                
				//                $('#calendar').fullCalendar({
				//
				//        dayClick: function(date, jsEvent, view) { 
				//            alert('Clicked on: ' + date.getDate()+"/"+date.getMonth()+"/"+date.getFullYear());  
				//        },
				//
				//    });
				//                $(".fc-day").click(function () {
				//                    var date = $(this).attr('date-date');
				//                    alert(date);
				////                    $.ajax({
				////                        type: "POST",
				////                        contentType: "application/json; charset=utf-8",
				////                        url: "LinkTagOut.aspx",
				////                        dataType: "json",
				////                        data: "{id=1}",
				////                        complete:
				////                                function () {
				////                                    window.location = "LinkTagOut.aspx";
				////                                }
				////
				////                    });
				//                });
				//            });
				//image preview of choose file start
				
				// function readURL(input) {
					// if (input.files && input.files[0]) {
						// var reader = new FileReader();
						// reader.onload = function (e) {
							// $('#passage_image_preview').attr('src', e.target.result);
						// }
						// reader.readAsDataURL(input.files[0]);
					// }
				// }
				// $("#uploadImage1").change(function () {
					// readURL(this);
				// });
				
				//image preview of choose file end
				//
				//            $("#submit").click(function ()
				//            {
				//                var password = $(".password").val();
				//                var cpassword = $(".cpassword").val();
				//                if ((cpassword == '') || password != cpassword)
				//                {
				//                    $(".cpassword_field").css({"border-style": "solid", "border-color": "red"});
				//                    $("#showMessageDiv").show();
				//                    $("#showMessage").html('Passwords are Not matching');
				//                    $(".cpassword").focus();
				//                    return false;
				//                } else {
				//                    $(".cpassword_field").css({"border-style": "solid", "border-color": "#E9E9E9"});
				//                }
				//
				//
				
				
				//            $(function () { // document ready
				//
				//                $('#calendar').fullCalendar({
				//                    now: '2016-12-07',
				//                    editable: true, // enable draggable events
				//                    aspectRatio: 1.8,
				//                    scrollTime: '00:00', // undo default 6am scrollTime
				//                    header: {
				//                        left: 'today prev,next',
				//                        center: 'title',
				//                        right: 'month,timelineDay,timelineThreeDays,agendaWeek,listWeek'
				//                    },
				//                    defaultView: 'month',
				//                    views: {
				//                        timelineThreeDays: {
				//                            type: 'timeline',
				//                            duration: {days: 3}
				//                        }
				//                    },
				//                    resourceLabelText: 'Rooms',
				//                    resources: [
				//                        {id: 'a', title: 'Auditorium A'},
				//                        {id: 'b', title: 'Auditorium B', eventColor: 'green'},
				//                        {id: 'c', title: 'Auditorium C', eventColor: 'orange'},
				//                        {id: 'd', title: 'Auditorium D', children: [
				//                                {id: 'd1', title: 'Room D1'},
				//                                {id: 'd2', title: 'Room D2'}
				//                            ]},
				//                        {id: 'e', title: 'Auditorium E'},
				//                        {id: 'f', title: 'Auditorium F', eventColor: 'red'},
				//                        {id: 'g', title: 'Auditorium G'},
				//                        {id: 'h', title: 'Auditorium H'},
				//                        {id: 'i', title: 'Auditorium I'},
				//                        {id: 'j', title: 'Auditorium J'},
				//                        {id: 'k', title: 'Auditorium K'},
				//                        {id: 'l', title: 'Auditorium L'},
				//                        {id: 'm', title: 'Auditorium M'},
				//                        {id: 'n', title: 'Auditorium N'},
				//                        {id: 'o', title: 'Auditorium O'},
				//                        {id: 'p', title: 'Auditorium P'},
				//                        {id: 'q', title: 'Auditorium Q'},
				//                        {id: 'r', title: 'Auditorium R'},
				//                        {id: 's', title: 'Auditorium S'},
				//                        {id: 't', title: 'Auditorium T'},
				//                        {id: 'u', title: 'Auditorium U'},
				//                        {id: 'v', title: 'Auditorium V'},
				//                        {id: 'w', title: 'Auditorium W'},
				//                        {id: 'x', title: 'Auditorium X'},
				//                        {id: 'y', title: 'Auditorium Y'},
				//                        {id: 'z', title: 'Auditorium Z'}
				//                    ],
				//                    events: [
				//                        {id: '1', resourceId: 'b', start: '2016-12-07T02:00:00', end: '2016-12-07T07:00:00', title: 'event 1'},
				//                        {id: '2', resourceId: 'c', start: '2016-12-07T05:00:00', end: '2016-12-07T22:00:00', title: 'event 2'},
				//                        {id: '3', resourceId: 'd', start: '2016-12-06', end: '2016-12-08', title: 'event 3'},
				//                        {id: '4', resourceId: 'e', start: '2016-12-07T03:00:00', end: '2016-12-07T08:00:00', title: 'event 4'},
				//                        {id: '5', resourceId: 'f', start: '2016-12-07T00:30:00', end: '2016-12-07T02:30:00', title: 'event 5'}
				//                    ]
				//                });
				//
				//            });
				
				//password validation end
				
			</script>
			<script type="text/javascript">
				
			</script>
		</body>
	</html>						