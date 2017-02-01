<?php
	error_reporting(0);
	$servername = 	"localhost";
    $username 	= 	"root";
    $password	= 	"";
    $dbname 	= 	"amerytec_ostello";
	
	define ( SITE_ADMIN_URL , 'http://amerytech.net/ostello/admin/');
	
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
	} 
	?>