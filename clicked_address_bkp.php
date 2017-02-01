<?php
	error_reporting(1);
	include("config.php");

	// Opens a connection to a MySQL server
	$connection=mysqli($servername, $amerytec_ostello, $admin12345, $amerytec_ostello);
	if (!$connection) {
	  die('Not connected : ' . mysql_error());
	}
	
	// Set the active MySQL database
	$db_selected = mysqli_select_db($amerytec_ostello, $connection);
	if (!$db_selected) {
	  die ('Can\'t use db : ' . mysql_error());
	}
	
	if(!empty($_GET))
	{
		echo "LAT => ".$lat = $_GET["lat"];
		echo "<br>LNG => ".$lng = $_GET["lng"];
		echo "<br>NAME => ".$name = strip_tags($_GET["name"]);
		echo "<br>ADDRESS => ".$address = strip_tags($_GET["address"]);
		
		$insert_qry = mysqli_query("INSERT INTO users(name,address,latitude,longitude) VALUES('$name','$address','$lat','$lng')");
		if($insert_qry == TRUE)
		{
			echo "<hr />INSERTED";
		}
		else
		{
			echo "<hr />NOT INSERTED";
		}
	}
?>