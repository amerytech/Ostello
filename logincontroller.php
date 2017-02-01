<?php
	ob_start();
	session_start();
include_once('./admin/includes/config.php');
if($_POST['action']=='login'){
parse_str($_POST['loginData'], $loginData);

$Email = $conn->real_escape_string($loginData['Email']);
$Password = $conn->real_escape_string(md5($loginData['Password']));
$holder = $conn->real_escape_string($loginData['holder']);

if($holder==user)
{
	$LoginQuery1 = $conn->query("SELECT * FROM os_user where user_email='".$Email."' and user_password='".$Password."'");
	
	$user = $LoginQuery1->fetch_assoc();
	
	$_SESSION['id_user']= $user['id_user'];
	// echo count($LoginQuery);
	// exit;
	if(mysqli_num_rows($LoginQuery1)==1){
		
		$response1['message'] = "Login User sucess";
		$response1['success'] = true;
	}
	else
	{
		$response1['message'] = "Invalide username or password";
		$response1['success'] = false;
	}
	echo json_encode($response1);
	exit;
}	
else if($holder==staff)
{
	$LoginQuery = $conn->query("SELECT * FROM os_staff where staff_email='".$Email."' and staff_password='".$Password."'");
	
	$user = $LoginQuery->fetch_assoc();
	
	$_SESSION['id_staff']= $user['id_staff'];
	// echo count($LoginQuery);
	// exit;
	if(mysqli_num_rows($LoginQuery)==1){
		
		$response['message'] = "login staff sucess";
		$response['success'] = true;
		
	}
	else
	{
		$response['message'] = "Invalide username or password";
		$response['success'] = false;
	
	}
	echo json_encode($response);
	exit;
}

}

else if(isset($_GET['type']) && $_GET['type']== "logout" )
	{
		if (!isset($_SESSION['id_staff'])){
			header('location:index.php');
			} else {
			session_destroy();
			header('location:index.php');
		}
        }

else if(isset($_GET['type']) && $_GET['type']== "logout2" )
	{
		if (!isset($_SESSION['id_user'])){
			header('location:index.php');
			} else {
			session_destroy();
			header('location:index.php');
		}
        }
