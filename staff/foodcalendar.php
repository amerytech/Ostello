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
if (!isset($_SESSION['id_staff'])) {
    header('location:../index.php');
}
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
        <style>
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <!-- Start Wrapper -->

        <div id="page_wrapper">

            <!-- Start Header -->

            <section class="containeer">

                

                    <?php
//hostel id in session	
                    if (isset($_POST['Selecthostel'])) {

                        $_SESSION['hostel_id'] = $_POST['Selecthostel'];
                    }
                    // Get current year, month and day
                    list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

                    // Get current year and month depending on possible GET parameters
                    if (isset($_GET['month'])) {
                        list($iMonth, $iYear) = explode('-', $_GET['month']);
                        $iMonth = (int) $iMonth;
                        $iYear = (int) $iYear;
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
                    $iPrevDaysInMonth = (int) date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

                    // Get numeric representation of the day of the week of the first day of specified (current) month
                    $iFirstDayDow = (int) date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

                    // On what day the previous month begins
                    $iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

                    // If previous month
                    $bPreviousMonth = ($iFirstDayDow > 0);

                    // Initial day
                    $iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

                    $bNextMonth = false;
                    $sCalTblRows = '';
                    // echo "select * from os_staff_prepared where staff_prepared_date='".$iCurrentDay."-".$iMonth."-".$iYear."' and staff_prepared_status='1' ";
                    // exit;
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

                            $preparedfood1 = $conn->query(" select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and type='1' and id_hostel='" . $_SESSION['hostel_id'] . "' ")or die(mysqli_error);

                            $preparedtiffin = $preparedfood1->fetch_assoc();
                            if (mysqli_num_rows($preparedfood1) > 0) {
                                $sVisible = 'unset';
                            } else {
                                $sVisible = 'none';
                            }
                            $preparedfood2 = $conn->query("select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and type='2' and id_hostel='" . $_SESSION['hostel_id'] . "' ")or die(mysqli_error);

                            $preparedlunch = $preparedfood2->fetch_assoc();
                            if (mysqli_num_rows($preparedfood2) > 0) {
                                $sVisible2 = 'unset';
                            } else {
                                $sVisible2 = 'none';
                            }
                            $preparedfood3 = $conn->query("select * from os_staff_prepared where prepared_date='" . $iCurrentDay . "-" . $iMonth . "-" . $iYear . "' and type='3' and id_hostel='" . $_SESSION['hostel_id'] . "' ")or die(mysqli_error);

                            $preparedDinner = $preparedfood3->fetch_assoc();
                            if (mysqli_num_rows($preparedfood3) > 0) {
                                $sVisible3 = 'unset';
                            } else {
                                $sVisible3 = 'none';
                            }
                            if ($sClass == "") {
                                $sVisible = 'none';
                                $sVisible2 = 'none';
                                $sVisible3 = 'none';
                            }

                            $sCalTblRows .= '<td class="' . $sClass . '" > ';
                            if (!$sClass == "") {
                                $sCalTblRows .= '<a href="foodmenu.php?hostelid=' . $_SESSION['hostel_id'] . '&today=' . $iCurrentDay . '-' . $iMonth . '-' . $iYear . '"  >' . $iCurrentDay . '</a> ';
                            }
                            $sCalTblRows .= ' <div class="calbreakfast" style="display: ' . $sVisible . '" > <a href="foodmenu.php?hostelid=' . $_SESSION['hostel_id'] . '&today=' . $iCurrentDay . '-' . $iMonth . '-' . $iYear . '" class="calbreakfasttext" /> tiffin </a>  </div>  
		                                                                    <div class="callunch" style="display: ' . $sVisible2 . '">      <a href="foodmenu.php?hostelid=' . $_SESSION['hostel_id'] . '&today=' . $iCurrentDay . '-' . $iMonth . '-' . $iYear . '" class="callunchtext" />   lunch </a></div>
                                                                                      <div class="caldinner"  style="display:' . $sVisible3 . ' ">  <a href="foodmenu.php?hostelid=' . $_SESSION['hostel_id'] . '&today=' . $iCurrentDay . '-' . $iMonth . '-' . $iYear . '" class="caldinnertext" /> dinner  </div></a> </td>';

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
                    $sCalendarItself = strtr(file_get_contents('templates/calendar.php'), $aKeys);

                    // AJAX requests - return the calendar
                    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
                        header('Content-Type: text/html; charset=utf-8');
                        echo $sCalendarItself;
                        exit;
                    }

                    $aVariables = array(
                        '__calendar__' => $sCalendarItself,
                    );
                    echo strtr(file_get_contents('templates/index.php'), $aVariables);
                    ?>

                <div class="calendar">
                </div>

            </section>
        </div>
        <footer class="containeer">
            <p>Ostello &copy; 2016. All Rights Reserved.</p>
        </footer>
        <!-- End Footer -->

    </div>
    <!-- End Wrapper -->
    <script type="text/javascript" src="javascripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="javascripts/fullcalendar.min.js"></script>
    <script type="text/javascript" src="javascripts/fullcalendar.mjs"></script>
    <script type="text/javascript" src="javascripts/moment.min.js"></script>

    <script type="text/javascript" src="javascripts/html5shiv.js"></script>
    <script type="text/javascript" src="javascripts/fancybox/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="javascripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="javascripts/jquery.touchSwipe.js"></script>
    <script type="text/javascript" src="javascripts/jquery.mobilemenu.js"></script>
    <script type="text/javascript" src="javascripts/jquery.infieldlabel.js"></script>
    <script type="text/javascript" src="javascripts/jquery.echoslider.js"></script>
    <script type="text/javascript" src="javascripts/fluidapp.js"></script>
    <script>

    </script>

</body>
</html>