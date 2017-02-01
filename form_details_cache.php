<?php
	session_start();
	if(!empty($_POST))
	{
		$name = addslashes(strip_tags(trim($_POST["name"])));
		$email = addslashes(strip_tags(trim($_POST["email"])));
		$mobile = addslashes(strip_tags(trim($_POST["mobile"])));
		$gender = addslashes(strip_tags(trim($_POST["gender"])));
		$bed_share = addslashes(strip_tags(trim($_POST["bed_share"])));
		$loc = $_SESSION["loc"];
		
		$errors = array();
		if($name == ""){$errors["Name"] = "Please Enter Name";}
		if($email == ""){$errors["Email"] = "Please Enter Email";}
		if($mobile == ""){$errors["Mobile"] = "Please Enter Mobile";}
		if($gender == ""){$errors["Gender"] = "Please Select Gender";}
		if($bed_share == ""){$errors["BedShare"] = "Please Select Bed Sharing";}
		if($loc == ""){$errors["Location"] = "Please Select Location";}

		if(empty($errors))
		{
			$_SESSION["name"] = $name;
			$_SESSION["email"] = $email;
			$_SESSION["mobile"] = $mobile;
			$_SESSION["gender"] = $gender;
			$_SESSION["bed_share"] = $bed_share;
			$_SESSION["loc"] = $loc;
		}
	}
?>