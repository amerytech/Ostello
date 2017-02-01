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
if (!isset($_SESSION['id_staff']))
 {
    header('location:../index.php');
}

$fixdate=date('Y-m-d');
//echo "$fixdate";
//exit;
 			   $staff_id = $_SESSION['id_staff'];
						$querystaffdata = $conn->query("SELECT *  FROM os_staff where id_staff=".$staff_id);
						$fetchstaffdata = $querystaffdata->fetch_assoc();
					

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ostello | Hostel-Staff </title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="stylesheets/base.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/media.queries.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/tipsy.css" />
        <link rel="stylesheet" type="text/css" href="javascripts/fancybox/jquery.fancybox-1.3.4.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
        <link rel="shortcut icon" href="../img/fav-icon.png" />
        <link rel="stylesheet" href="stylesheets/fullcalendar.css">
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
//        console.log( "hiii!" );
//         });
////          console.log( "hiii!" );
            $(function() { // document ready
   $("#loadcalendar").click(function ()
    {
            $('#calendar').fullCalendar({
            now: '<?php echo "$fixdate"?>',
                    editable: true, // enable draggable events
                    aspectRatio: 1.8,
                    scrollTime: '00:00', // undo default 6am scrollTime
                    header: {
                    left: 'prev',
                            center: 'title',
                            right: 'next'
                    },
                    defaultView: 'month',
//                    views: {
//                    timelineThreeDays: {
//                    type: 'timeline',
//                            duration: { days: 3 }
//                    }
//                    },
//                    resourceLabelText: 'Rooms',
//                    resources: [
//                    { id: 'a', title: 'Auditorium A' },
//                    { id: 'b', title: 'Auditorium B', eventColor: 'green' },
//                    { id: 'c', title: 'Auditorium C', eventColor: 'orange' },
//                    { id: 'd', title: 'Auditorium D', children: [
//                    { id: 'd1', title: 'Room D1' },
//                    { id: 'd2', title: 'Room D2' }
//                    ] },
//                    { id: 'e', title: 'Auditorium E' },
//                    { id: 'f', title: 'Auditorium F', eventColor: 'red' },
//                    { id: 'g', title: 'Auditorium G' },
//                    { id: 'h', title: 'Auditorium H' },
//                    { id: 'i', title: 'Auditorium I' },
//                    { id: 'j', title: 'Auditorium J' },
//                    { id: 'k', title: 'Auditorium K' },
//                    { id: 'l', title: 'Auditorium L' },
//                    { id: 'm', title: 'Auditorium M' },
//                    { id: 'n', title: 'Auditorium N' },
//                    { id: 'o', title: 'Auditorium O' },
//                    { id: 'p', title: 'Auditorium P' },
//                    { id: 'q', title: 'Auditorium Q' },
//                    { id: 'r', title: 'Auditorium R' },
//                    { id: 's', title: 'Auditorium S' },
//                    { id: 't', title: 'Auditorium T' },
//                    { id: 'u', title: 'Auditorium U' },
//                    { id: 'v', title: 'Auditorium V' },
//                    { id: 'w', title: 'Auditorium W' },
//                    { id: 'x', title: 'Auditorium X' },
//                    { id: 'y', title: 'Auditorium Y' },
//                    { id: 'z', title: 'Auditorium Z' }
//                    ],
//                    events: [
//                    { id: '1', resourceId: 'b', start: '2016-12-07T02:00:00', end: '2016-12-07T07:00:00', title: 'event 1' },
//                    { id: '2', resourceId: 'c', start: '2016-12-07T05:00:00', end: '2016-12-07T22:00:00', title: 'event 2' },
//                    { id: '3', resourceId: 'd', start: '2016-12-06', end: '2016-12-08', title: 'event 3' },
//                    { id: '4', resourceId: 'e', start: '2016-12-07T03:00:00', end: '2016-12-07T08:00:00', title: 'event 4' },
//                    { id: '5', resourceId: 'f', start: '2016-12-07T00:30:00', end: '2016-12-07T02:30:00', title: 'event 5' }
//                    ],
                     dayClick: function (date, jsEvent, view) {

//                            alert('Clicked on: ' + date.format());
                            var fine = date.format();
                             var date_string = moment(fine, "YYYY-MM-DD").format("DD-MM-YYYY");
                            var url = "foodmenu.php?hostelid=" + encodeURIComponent($("#Selecthostel").val()) + "&today=" + encodeURIComponent(date_string);
                            window.location.href = url;

//$.ajax({  
//    type: 'POST',  
//    url: 'foodorder.php', 
//    data: { ordereddate: this.fine },
//    success: function(response) {
//        content.html(response);
//    }
//});
//        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//
//        alert('Current view: ' + view.name);

                            // change the day's background color just for fun
//        $(this).css('background-color', 'red');

                        }
            });
            
            });
             });
        </script>

        <style>
            #calendar {
                /*                max-width: 900px;
                                margin: 0 auto;*/
                /*                max-width: 900px;
                                margin: 50px auto;*/
            }
        </style>
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
                                <li><a href="#home">Staff Home</a></li>
                                <li><a href="#stafffood" id="loadcalendar">Food Menu</a></li>

                                <li><a href="#userorders">User orders</a></li>
                                <li><a href="#facility">Facility</a></li>
                                <li><a href="#staffprofile">Profile</a></li>
                                <li><a href="../logincontroller.php?type=logout" class="button gray"> Logout </a></li>
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
                        <a href="#userorders" class="large_button" id="android">
                            <em>Check Orders</em> User Orders
                        </a>
                        <a href="#stafffood"  class="large_button" id="apple">
                            <em>Upload Menu</em> Food Menu
                        </a>
                    </div>
                </div>
                <!-- End Left-home Info -->		

                <!-- Start Pages -->
                <div id="pages" >
                    <div class="top_shadow"></div>
                    <!-- Start Food -->
                    <div id="stafffood" class="page active "> 
                            <span id="showMessage"></span>
                            <form action="foodcalendar.php" method="post">
                                <select name="Selecthostel" id="Selecthostel">
                                    
                                    <?php
                                    $hostelQuery = $conn->query("SELECT * FROM os_hostel ORDER BY id_hostel ASC") or die(mysqli_error);
                                    while ($hostelFetch = $hostelQuery->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $hostelFetch['id_hostel'] ?>" onChange="getHostel(this.value);"> <?php echo $hostelFetch['hostel_name'] ?> </option>
                                    <?php } ?>


                                </select>
                                <div> &nbsp;</div>
                                <!--<input type="submit" id="hostel_submit" class="button white" value="submit &rarr;">-->
                            </form>
                            <br>
                        <div id='calendar'></div>
                        <!--                        <div id="calendar">
                                                    <span id="showMessage"></span>
                                                    <form action="foodcalendar.php" method="post">
                                                        <select name="Selecthostel" id="Selecthostel">
                                                            <option value="">Select Hostel</option>
                        <?php
//                                    $hostelQuery = $conn->query("SELECT * FROM os_hostel ORDER BY id_hostel ASC") or die(mysqli_error);
//                                    while ($hostelFetch = $hostelQuery->fetch_assoc()) {
                        ?>
                                                                <option value="<?php // echo $hostelFetch['id_hostel']  ?>" onChange="getHostel(this.value);"> <?php echo $hostelFetch['hostel_name'] ?> </option>
                        <?php // } ?>
                        
                        
                                                        </select>
                                                        <div> &nbsp;</div>
                                                        <input type="submit" id="hostel_submit" class="button white" value="submit &rarr;">
                                                    </form>
                                                    <br>
                        <?php
//                            // Get current year, month and day
//                            list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));
//
//                            // Get current year and month depending on possible GET parameters
//                            if (isset($_GET['month'])) {
//                                list($iMonth, $iYear) = explode('-', $_GET['month']);
//                                $iMonth = (int) $iMonth;
//                                $iYear = (int) $iYear;
//                            } else {
//                                list($iMonth, $iYear) = explode('-', date('n-Y'));
//                            }
//
//                            // Get name and number of days of specified month
//                            $iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
//                            list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));
//
//                            // Get previous year and month
//                            $iPrevYear = $iYear;
//                            $iPrevMonth = $iMonth - 1;
//                            if ($iPrevMonth <= 0) {
//                                $iPrevYear--;
//                                $iPrevMonth = 12; // set to December
//                            }
//
//                            // Get next year and month
//                            $iNextYear = $iYear;
//                            $iNextMonth = $iMonth + 1;
//                            if ($iNextMonth > 12) {
//                                $iNextYear++;
//                                $iNextMonth = 1;
//                            }
//
//                            // Get number of days of previous month
//                            $iPrevDaysInMonth = (int) date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));
//
//                            // Get numeric representation of the day of the week of the first day of specified (current) month
//                            $iFirstDayDow = (int) date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));
//
//                            // On what day the previous month begins
//                            $iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;
//
//                            // If previous month
//                            $bPreviousMonth = ($iFirstDayDow > 0);
//
//                            // Initial day
//                            $iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;
//
//                            $bNextMonth = false;
//                            $sCalTblRows = '';
//                            // echo "select * from os_staff_prepared where staff_prepared_date='".$iCurrentDay."-".$iMonth."-".$iYear."' and staff_prepared_status='1' ";
//                            // exit;
//                            // Generate rows for the calendar
//                            for ($i = 0; $i < 6; $i++) { // 6-weeks range
//                                $sCalTblRows .= '<tr>';
//                                for ($j = 0; $j < 7; $j++) { // 7 days a week
//                                    $sClass = '';
//                                    if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
//                                        $sClass = 'today';
//                                    } elseif (!$bPreviousMonth && !$bNextMonth) {
//                                        $sClass = 'current';
//                                    }
//
//                                    $preparedfood1 = $conn->query(" select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and  type='1'  ")or die(mysqli_error);
//
//                                    $preparedtiffin = $preparedfood1->fetch_assoc();
//                                    if (mysqli_num_rows($preparedfood1) > 0) {
//                                        $sVisible = 'unset';
//                                    } else {
//                                        $sVisible = 'none';
//                                    }
//                                    $preparedfood2 = $conn->query("select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and  type='2'  ")or die(mysqli_error);
//
//                                    $preparedlunch = $preparedfood2->fetch_assoc();
//                                    if (mysqli_num_rows($preparedfood2) > 0) {
//                                        $sVisible2 = 'unset';
//                                    } else {
//                                        $sVisible2 = 'none';
//                                    }
//                                    $preparedfood3 = $conn->query("select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and  type='3'  ")or die(mysqli_error);
//
//                                    $prepareddinner = $preparedfood3->fetch_assoc();
//                                    if (mysqli_num_rows($preparedfood3) > 0) {
//                                        $sVisible3 = 'unset';
//                                    } else {
//                                        $sVisible3 = 'none';
//                                    }
//                                    if ($sClass == "") {
//                                        $sVisible = 'none';
//                                        $sVisible2 = 'none';
//                                        $sVisible3 = 'none';
//                                    }
//
//                                    $sCalTblRows .= '<td class="' . $sClass . '"><a href="">' . $iCurrentDay . '</a>  <div class="calbreakfast" style="display: ' . $sVisible . '" > <a href="#" class="calbreakfasttext" /> tiffin </a> </div>  
//		                                                                          <div class="callunch" style="display: ' . $sVisible2 . '"> <a href="#" class="callunchtext" /> lunch </a> </div>
//											  <div class="caldinner" style="display: ' . $sVisible3 . '"> <a href="#" class="caldinnertext" /> dinner </a> </div> </td>';
//
//                                    // Next day
//                                    $iCurrentDay++;
//                                    if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
//                                        $bPreviousMonth = false;
//                                        $iCurrentDay = 1;
//                                    }
//                                    if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
//                                        $bNextMonth = true;
//                                        $iCurrentDay = 1;
//                                    }
//                                }
//                                $sCalTblRows .= '</tr>';
//                            }
//
//                            // Prepare replacement keys and generate the calendar
//                            $aKeys = array(
//                                '__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
//                                '__next_month__' => "{$iNextMonth}-{$iNextYear}",
//                                '__cal_caption__' => $sMonthName . ', ' . $iYear,
//                                '__cal_rows__' => $sCalTblRows,
//                            );
//                            $sCalendarItself = strtr(file_get_contents('templates/calendar.php'), $aKeys);
//
//                            // AJAX requests - return the calendar
//                            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
//                                header('Content-Type: text/html; charset=utf-8');
//                                echo $sCalendarItself;
//                                exit;
//                            }
//
//                            $aVariables = array(
//                                '__calendar__' => $sCalendarItself,
//                            );
//                            echo strtr(file_get_contents('templates/index.php'), $aVariables);
                        ?>
                        
                                                </div>			-->
                    </div>
                    <!-- End Food -->
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



                    <!-- Start Request -->
                    <div id="userorders" class="page">

                        <form action="#" method="post">
                            <select name="Selecthostelorders">

                                <option>Hostel 1</option>
                                <option>Hostel 2</option>
                                <option>Hostel 3</option>
                                <option>Hostel 4</option>
                                <option>Hostel 5</option>
                                <option>Hostel 6</option>

                            </select>
                            <div> &nbsp;</div>
                            <input type="submit" class="button white" value="submit &rarr;">
                        </form>

                        <h1>User Orders</h1>

                        <div class="releases userorder">
                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>

                            <article class="release">
                                <h2>SANDY</h2>
                                <span class="date">Order For sep 30th, 2016</span>
                                <ul>
                                    <li class="Break"><span><b>Break Fast</b></span>  <b>Idli,</b> <b>Dosa,</b> <b>Idli,</b> </li>
                                    <li class="Lunch"><span><b>Lunch</b></span> <b>Rice + Dal,</b> <b>Rice + Dal</b></li>
                                    <li class="Dinner"><span><b>Dinner</b></span>  <b>Rice + Dal,</b> <b>Rice + Dal</b> </li>
                                </ul>
                            </article>
                        </div>

                    </div>
                    
                    <!-- End Request -->

                    <!-- Start Staff Profile -->
                    <div id="staffprofile" class="page">

                        <h1>PROFILE</h1>

                        <div id="contact_form">

                            <div class="validation">
                                <p>Oops! Please correct the highlighted fields...</p>
                            </div>

                            <div class="success">
                                <p>Thanks! I'll get back to you shortly.</p>
                            </div>
                            <form action="javascript:;" method="post">
                                <div class="row">
                                    <p class="left userprofilepf">
                                        <img src="img/ostello-kitchen/screen_1.jpg" alt="User PRofile Pick" class="center-block" id="pf">
                                    </p>
                                    <p class="right text-center center-block">
                                        <input type="file"  name="pf" id="pf" value=""/>
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <input type="text" readonly name="sfname" id="sfname" value="<?php echo $fetchstaffdata['staff_name'] ?>"/>
                                    </p>
                                    <p class="right">
                                        <input type="text" readonly name="sfemail" id="sfemail" value="<?php echo $fetchstaffdata['staff_email'] ?>" />
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <input type="text" readonly name="mobile" id="mobile" value="<?php echo $fetchstaffdata['staff_phone'] ?>"/>
                                    </p>
                                    <p class="right">
                                        <input type="text" readonly name="location" id="location" value="<?php echo $fetchstaffdata['staff_location'] ?>" />
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <label for="cpwd">Current Password*</label>
                                        <input type="password" name="cpwd" id="cpwd" value="" required />
                                    </p>
                                    <p class="right">
                                        <label for="pwd">New Password*</label>
                                        <input type="password" name="pwd" id="pwd" value=""  required />
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <label for="cpwd">Confirm Password*</label>
                                        <input type="password" name="cpwd" id="cpwd" value="" required />
                                    </p>
                                   
                                </div>
                                <input type="submit" class="button white" value="Send &#x2192;" />
                            </form>
                        </div>

                    </div>
                    <!-- End Staff Profile -->

                    <!-- Start Staff Profile -->
                    <div id="facility" class="page">

                        <h1>User</h1>

                        <div id="contact_form">

                            <div class="validation">
                                <p>Oops! Please correct the highlighted fields...</p>
                            </div>

                            <div class="success">
                                <p>Thanks! I'll get back to you shortly.</p>
                            </div>
                            <form action="javascript:;" method="post">
                                <div class="row">
                                    <p class="row">
                                        <label for="scuser_name">Search User Name</label>
                                        <input type="text" name="scuser_name" id="scuser_name" value="" />
                                       <div id='searchresult'></div>

                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <label for="usermobile"> Mobile </label>
                                        <input type="text" name="usermobile" id="usermobile" value=""/>
                                    </p>
                                    <p class="right">
                                        <label for="usemail">Email id</label>
                                        <input type="text" name="usemail" id="usemail" value="" />
                                    </p>
                                </div>

                                <div class="row">
                                    <p class="left">
                                        <label for="Hostelname"> Hostel Name </label>
                                        <input type="text" name="Hostelname" id="Hostelname" value="" required />
                                    </p>
                                    <p class="right">
                                        <select name="Bulding" id="Bulding">
                                            <option>Select Buldings</option>
                                            <option>Bulding 1</option>
                                            <option>Bulding 2</option>
                                            <option>Bulding 3</option>
                                            <option>Bulding 4</option>
                                            <option>Bulding 5</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <select name="Floor" id="Floor">
                                            <option>Select Floors</option>
                                            <option>Floor 1</option>
                                            <option>Floor 2</option>
                                            <option>Floor 3</option>
                                            <option>Floor 4</option>
                                            <option>Floor 5</option>
                                            <option>Floor 6</option>
                                            <option>Floor 7</option>
                                            <option>Floor 8</option>
                                            <option>Floor 9</option>
                                            <option>Floor 10</option>
                                        </select>
                                    </p>
                                    <p class="right">
                                        <select name="Flat" id="Flat">
                                            <option>Select Flats</option>
                                            <option>Flat 1</option>
                                            <option>Flat 2</option>
                                            <option>Flat 3</option>
                                            <option>Flat 4</option>
                                            <option>Flat 5</option>
                                            <option>Flat 6</option>
                                            <option>Flat 7</option>
                                            <option>Flat 8</option>
                                            <option>Flat 9</option>
                                            <option>Flat 10</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="left">
                                        <select name="Rooms" id="Rooms">
                                            <option>Select Rooms</option>
                                            <option>Room 1</option>
                                            <option>Room 2</option>
                                            <option>Room 3</option>
                                            <option>Room 4</option>
                                            <option>Room 5</option>
                                            <option>Room 6</option>
                                            <option>Room 7</option>
                                            <option>Room 8</option>
                                            <option>Room 9</option>
                                            <option>Room 10</option>
                                        </select>
                                    </p>
                                    <p class="right">
                                        <input type="number" min="1" max="40" name="Bednumbe" id="Bednumbe" placeholder="Select Bed number" value="" required />
                                    </p>
                                </div>
                                <input type="submit" class="button" value="Send &#x2192;" />
                            </form>
                        </div>

                    </div>
                    <!-- End Staff Profile -->
                    <div class="bottom_shadow"></div>
                </div>

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
        <script type="text/javascript" src="javascripts/fullcalendar.min.js"></script>
        <!--<script type="text/javascript" src="javascripts/fullcalendar.mjs"></script>-->
        <script type="text/javascript" src="javascripts/moment.min.js"></script>


<!--<script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script>-->
<!--<script type="text/javascript" src="javascripts/jquery.min.js"></script>-->
<!--        <script type="text/javascript" src="javascripts/moment.min.js"></script>
<script type="text/javascript" src="javascripts/fullcalendar.min.js"></script>-->

<!--<script type="text/javascript" src="javascripts/scheduler.min.js"></script>-->


        <script type="text/javascript" src="javascripts/html5shiv.js"></script>
        <script type="text/javascript" src="javascripts/fancybox/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="javascripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="javascripts/jquery.touchSwipe.js"></script>
        <script type="text/javascript" src="javascripts/jquery.mobilemenu.js"></script>
        <script type="text/javascript" src="javascripts/jquery.infieldlabel.js"></script>
        <script type="text/javascript" src="javascripts/jquery.echoslider.js"></script>
        <script type="text/javascript" src="javascripts/fluidapp.js"></script>
        <script>
console.log( "ready!" );
//    $(function () { // document ready

//        $('#calendar').fullCalendar({
//            now: '2016-12-07',
//            editable: true, // enable draggable events
//            aspectRatio: 1.8,
//            scrollTime: '00:00', // undo default 6am scrollTime
//            header: {
//                left: 'today prev,next',
//                center: 'title',
//                right: 'month,timelineDay,timelineThreeDays,agendaWeek,listWeek'
//            },
//            defaultView: 'month',
//            views: {
//                timelineThreeDays: {
//                    type: 'timeline',
//                    duration: {days: 3}
//                }
//            },
//            resourceLabelText: 'Rooms',
//            resources: [
//                {id: 'a', title: 'Auditorium A'},
//                {id: 'b', title: 'Auditorium B', eventColor: 'green'},
//                {id: 'c', title: 'Auditorium C', eventColor: 'orange'},
//                {id: 'd', title: 'Auditorium D', children: [
//                        {id: 'd1', title: 'Room D1'},
//                        {id: 'd2', title: 'Room D2'}
//                    ]},
//                {id: 'e', title: 'Auditorium E'},
//                {id: 'f', title: 'Auditorium F', eventColor: 'red'},
//                {id: 'g', title: 'Auditorium G'},
//                {id: 'h', title: 'Auditorium H'},
//                {id: 'i', title: 'Auditorium I'},
//                {id: 'j', title: 'Auditorium J'},
//                {id: 'k', title: 'Auditorium K'},
//                {id: 'l', title: 'Auditorium L'},
//                {id: 'm', title: 'Auditorium M'},
//                {id: 'n', title: 'Auditorium N'},
//                {id: 'o', title: 'Auditorium O'},
//                {id: 'p', title: 'Auditorium P'},
//                {id: 'q', title: 'Auditorium Q'},
//                {id: 'r', title: 'Auditorium R'},
//                {id: 's', title: 'Auditorium S'},
//                {id: 't', title: 'Auditorium T'},
//                {id: 'u', title: 'Auditorium U'},
//                {id: 'v', title: 'Auditorium V'},
//                {id: 'w', title: 'Auditorium W'},
//                {id: 'x', title: 'Auditorium X'},
//                {id: 'y', title: 'Auditorium Y'},
//                {id: 'z', title: 'Auditorium Z'}
//            ],
//            events: [
//                {id: '1', resourceId: 'b', start: '2016-12-07T02:00:00', end: '2016-12-07T07:00:00', title: 'event 1'},
//                {id: '2', resourceId: 'c', start: '2016-12-07T05:00:00', end: '2016-12-07T22:00:00', title: 'event 2'},
//                {id: '3', resourceId: 'd', start: '2016-12-06', end: '2016-12-08', title: 'event 3'},
//                {id: '4', resourceId: 'e', start: '2016-12-07T03:00:00', end: '2016-12-07T08:00:00', title: 'event 4'},
//                {id: '5', resourceId: 'f', start: '2016-12-07T00:30:00', end: '2016-12-07T02:30:00', title: 'event 5'}
//            ]
//        });
//
//    });

//                                        $(document).ready(function () {
//                                            $('#calendar').fullCalendar({
//                                                header: {
//                                                    left: 'prev,next today',
//                                                    center: 'title',
//                                                    right: 'month,agendaWeek,agendaDay,listWeek'
//                                                },
//                                                defaultDate: '2016-09-12',
//                                                navLinks: true, // can click day/week names to navigate views
//                                                editable: true,
//                                                eventLimit: true, // allow "more" link when too many events
//                                                events: [
//                                                    {
//                                                        title: 'Tiffin',
//                                                        start: '2016-09-01'
//                                                    },
//                                                    {
//                                                        title: 'Long Event',
//                                                        start: '2016-09-07',
//                                                        end: '2016-09-10'
//                                                    },
//                                                    {
//                                                        id: 999,
//                                                        title: 'Repeating Event',
//                                                        start: '2016-09-09T16:00:00'
//                                                    },
//                                                    {
//                                                        id: 999,
//                                                        title: 'Repeating Event',
//                                                        start: '2016-09-16T16:00:00'
//                                                    },
//                                                    {
//                                                        title: 'Conference',
//                                                        start: '2016-09-11',
//                                                        end: '2016-09-13'
//                                                    },
//                                                    {
//                                                        title: 'Meeting',
//                                                        start: '2016-09-12T10:30:00',
//                                                        end: '2016-09-12T12:30:00'
//                                                    },
//                                                    {
//                                                        title: 'Lunch',
//                                                        start: '2016-09-12T12:00:00'
//                                                    },
//                                                    {
//                                                        title: 'Meeting',
//                                                        start: '2016-09-12T14:30:00'
//                                                    },
//                                                    {
//                                                        title: 'Happy Hour',
//                                                        start: '2016-09-12T17:30:00'
//                                                    },
//                                                    {
//                                                        title: 'Dinner',
//                                                        start: '2016-09-12T20:00:00'
//                                                    },
//                                                    {
//                                                        title: 'Birthday Party',
//                                                        start: '2016-09-13T07:00:00'
//                                                    },
//                                                    {
//                                                        title: 'Click for Google',
//                                                        url: 'http://google.com/',
//                                                        start: '2016-09-28'
//                                                    }
//                                                ]
//                                            });
//
//                                        });

    function getHostel(hostelid) {

    }
    $("#hostel_submit").click(function ()
    {
        $("#showMessage").html("");
        if ($("#Selecthostel").val() == '')
        {
            $("#showMessage").css({"text": "solid", "color": "red"});
            $("#showMessage").html('Please Select Hostel');

            return false;
        }

    });
        </script>

<script>
			$('#scuser_name').on("input",function()
			{
			
				$search=$('#scuser_name').val();
					//alert($search);
					if($search.length>0)
					{
						
						$.get("foodcontroller.php",{"data":$search,'action': 'searchuser'},function($data)
						{
                                                        if($data!='')
                                                           {
$("#searchresult").css('background-color','green');
							$("#searchresult").html($data);
                                                           } 
                                                         else{ $("#searchresult").css('background-color','red');$("#searchresult").html('name not found'); }

							
						})
					}
			}); 
			</script>

    </body>
</html>