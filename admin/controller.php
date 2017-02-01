<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
	ob_start();
	session_start();
	include_once('./includes/config.php');
	
	if($_GET['action']=='login'){ 
		parse_str($_GET['loginData'], $loginData);
		$email		=	$loginData['email'];
		$password	=	$loginData['password'];	
		$LoginQuery = $conn->query("SELECT * FROM os_admin where email='".$email."'");
		$checkparticipentCount	=  mysqli_num_rows($LoginQuery);
		if($checkparticipentCount==1){
			$user = $LoginQuery->fetch_assoc();
			if($user['status']!=1)
			{
				$response['message'] = "Your Account is Not Activated";
				$response['success'] = false;
			}
			
			if($user['password']!=$password)
			{
				$response['message'] = "Wrong password. Try again.";
				$response['success'] = false;
			}
			if($user['status']==1 && $user['password']==$password)
			{
				$response['message'] = "Welcome".$_SESSION['name'];
				$response['id'] = $user['id_user'];
				$response['success'] = true;
			} 
			}else{
			$response['message'] = "Invalid Credentials. Try again.";
			$response['success'] = false;
		}
		echo json_encode($response);
		exit;
		}elseif($_GET['action']=='checkLogin'){
		$loginId = $_GET['loginid'];
		$LoginQuery = $conn->query("SELECT * FROM os_admin where id_user='".$loginId."'");
		$user = $LoginQuery->fetch_assoc();
		$_SESSION['name'] 	= ($user['name']!='')?$user['name']:'New User';
		//$_SESSION['image'] 	= ($user['image']!='')?$user['image']:'no-user-image.png';
		$_SESSION['id'] 	= $user['id_user'];
		header('Location:'.SITE_ADMIN_URL.'index.php');
		
		
	}elseif(isset($_GET['type']) && $_GET['type']== "logout" )
	{
		if (!isset($_SESSION['id'])) {
			header('location:'.SITE_ADMIN_URL.'signin.php');
			} else {
			session_destroy();
			header('location:'.SITE_ADMIN_URL.'signin.php');
		}
	}
	
	elseif( isset($_GET['activate_link'])&& ($_GET['activate_link']!='') )
	{	
		$activate_link=$_GET['activate_link'];
		$activateUser=$conn->query("SELECT status FROM r_user WHERE activate_link='".$activate_link."'");
		if(mysqli_num_rows($activateUser) > 0)
		{
			$ChangeStatus=$conn->query("SELECT * FROM r_user WHERE activate_link='".$activate_link."' and status='0'");
			$i=	$ChangeStatus->fetch_assoc();
			$id=$i['id_user'];
			if(mysqli_num_rows($ChangeStatus) == 1)
			{
				$updateStatus=$conn->query("UPDATE r_user SET status='1',activate_link='' WHERE id_user='".$id."' ");
				$_SESSION['message'] = "Your Account is Actived, Login Now!";
				header('location:'.SITE_ADMIN_URL.'index.php');
			}else
			{
				$_SESSION['message'] = "Your account is already active, no need to activate again";
				header('location:'.SITE_ADMIN_URL.'index.php');
				exit;
			}
		}
		else
		{
			$_SESSION['message'] = "Wrong activation code.";
			header('location:'.SITE_ADMIN_URL.'index.php');
		}
	}
      	if($_POST['action']=='hosteldetails'){ 
			
		$hostelid=$_POST['hostelid'];
		echo '<pre>';
		echo $hostelid;
		
		$response['hostelid'] = $hostelid;
		
		
		echo json_encode($response);
		exit;

}

if($_POST['action']=='imagemenu'){ 
    
    ini_set('display_errors',1); 
error_reporting(E_ALL);

    $menu=$_POST['Menu'];
    $foodname=$_POST['foodname'];
//    $SQL="insert into os_item (item_name,item_status) values ('".$foodname."','".$menu."')";
//    echo "$SQL";
//print_r($_POST);
//echo "</pre>";
// exit;
    
     $userorder=$conn->query("insert into os_item (item_name,item_status) values ('".$foodname."',".$menu.") ")or die('failed!' . mysql_error());
   
      $last_id = $userorder->$conn->insert_id;
       echo "hiiii";
        exit;
     if( $userorder ){
       
        echo "hiii";
        exit;
     if ($_FILES['photo']['name'] != '') {
         $photoname=str_replace(' ', '_', $foodname);
//                    echo "hii";
//                    exit;
        $temp = explode(".", $_FILES["photo"]["name"]);
        $pic = $id.$photoname . '.' . end($temp);
        $rows = $conn->query("update os_item SET item_image='$pic' where id_item=$last_id") or die($conn->error());

        $moved = move_uploaded_file($_FILES["photo"]["tmp_name"], "../staff/img/itemsmenu/" . $pic);
           header('location:gallery.php');
    }
    }
    
     
        
    
}
?>