<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>PHP AJAX Calendar</title>

    <!-- add styles and scripts -->
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript">
		$("document").ready(function() {
            $("#calendar").datepicker({
			  maxDate:14,
			  minDate:7
			});
        });
	
	</script>
</head>
<body>
    <div id="calendar">
        __calendar__
    </div>
</body>
</html>