<?php
	ob_start();
	session_start();
	include_once("includes/config.php");
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if(isset($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['name'] != '') {
		$profile_picture = $_FILES['profile_picture']['name'];
		$path = "images/admin/" . $_FILES['profile_picture']['name'];
		if (copy($_FILES['profile_picture']['tmp_name'], $path)) {
			echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
	}
	else{
		//$pic = $_POST['preview_image'];
	}
	if($_POST['action']=='edit'){ 
	
		if(isset($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['name'] != '') {
			$profile_picture = $_FILES['profile_picture']['name'];
			$path = "images/admin/" . $_FILES['profile_picture']['name'];
			if (copy($_FILES['profile_picture']['tmp_name'], $path)) {
				echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
				} else {
				echo "Sorry, there was a problem uploading your file.";
			}
		}
		else{
			$profile_picture = $_POST['preview_image'];;
			//$pic = $_POST['preview_image'];
		}
	
		/*echo "<pre>";
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		//echo "<pre>";
		//print_r($paticipantData);
		//exit;
		$name	=	$_POST['name'];
		$email	=	$_POST['email'];
		$phone		=	$_POST['phone'];
		$country	=	$_POST['country'];
		$state	    =	$_POST['state'];
		$city		=	$_POST['city'];
		$overview	=	$_POST['overview'];
		
		$participantquery="update os_admin  SET name='".$name."',email='".$email."',phone='".$phone."',country='".$country."',state='".$state."',city='".$city."',profile_picture='".$profile_picture."',overview='".$overview."' where id_user=" . $_SESSION['id'];
		
		$UpdateQuery= $conn->query($participantquery);
		if($UpdateQuery)
		{
		header('Location:profile.php?msg=Profile Updated Successfully');
		}else{
		header('Location:profile.php?msg=Profile Not Updated Successfully');
		}
		exit;
	} 
?>