<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="css/style.css">
		<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<!-- For-Mobile-Apps-and-Meta-Tags -->
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="Book My Ticket Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
			<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //For-Mobile-Apps-and-Meta-Tags -->
	</head>
	<body class="inner">
	<a class="back" href="main.html">BACK TO HOME</a>
	<div class="total">
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
						$sCalTblRows .= '<td class="'.$sClass.'"><a href="">'.$iCurrentDay.'</a>';
				
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
				$sCalendarItself = strtr(file_get_contents('templates/calendar.html'), $aKeys);
				
				// AJAX requests - return the calendar
				if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
					header('Content-Type: text/html; charset=utf-8');
					echo $sCalendarItself;
					exit;
				}
				
				$aVariables = array(	
					'__calendar__' => $sCalendarItself,
				);
				echo strtr(file_get_contents('templates/index.html'), $aVariables);
								?>
        
    
	</div>


	</body>
</html>