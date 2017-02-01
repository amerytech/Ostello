<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_start();
ob_start();
session_start();
include_once('../admin/includes/config.php');
// echo "hiii";	
if ($_POST['action'] == 'addfood') {

    parse_str($_POST['foodData'], $type);
    $hostel_id = $conn->real_escape_string($type['hostel_id']);
    $date_insert = $conn->real_escape_string($type['date_insert']);
       
        $deleteQuery=$conn->query("DELETE FROM os_staff_prepared WHERE prepared_date = '" . $date_insert . "'" );
        
    // $tiffin = $conn->real_escape_string($type['tiffin']);	
    foreach ($type['tiffin'] as $key => $tiffin) {
        // print_r($tiffin); 
        // nl2br;
        // $insertQuerytiffin = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) VALUES ('" . $tiffin . "','1','".$hostel_id."','".$date_insert."')");
        // echo 
        $insertQuerytiffin = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $tiffin . "','1','" . $hostel_id . "','" . $date_insert . "')");
    }
    foreach ($type['lunch'] as $key => $lunch) {

        $insertQuerylunch = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $lunch . "','2','" . $hostel_id . "','" . $date_insert . "')");
    }
    foreach ($type['dinner'] as $key => $dinner) {

        $insertQuerydinner = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $dinner . "','3','" . $hostel_id . "','" . $date_insert . "')");
    }
    foreach ($type['tiffen_topup'] as $key => $tiffen_topup) {

        $insertQuerytiffintopup = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $tiffen_topup . "','4','" . $hostel_id . "','" . $date_insert . "')");
    }
    foreach ($type['lunch_topup'] as $key => $lunch_topup) {

        $insertQuerylunchtopup = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $lunch_topup . "','5','" . $hostel_id . "','" . $date_insert . "')");
    }
    foreach ($type['dinner_topup'] as $key => $dinner_topup) {

        $insertQuerydinnertopup = $conn->query("INSERT INTO os_staff_prepared (item_name,type,id_hostel,prepared_date) values ('" . $dinner_topup . "','6','" . $hostel_id . "','" . $date_insert . "')");
    }

    if($type['tiffin']=='' & $type['lunch']=='' & $type['dinner']=='' & $type['tiffen_topup']=='' & $type['lunch_topup']=='' & $type['dinner_topup']==''  ){
       $response['message'] = "<strong>Warning!</strong> Please select atlest one item.";
        $response['success'] = true;
        }
   else if ($insertQuerytiffin || $insertQuerylunch || $insertQuerydinner || $insertQuerytiffintopup || $insertQuerylunchtopup || $insertQuerydinnertopup) {

        $response['message'] = "<strong>Success!</strong>  Added Successfully.";
        $response['success'] = true;
    } else {
       $response['warning'] = "<strong>Warning!</strong>Not Added.Please Check Carefully..";
       $response['success'] = false;
    }
    // $response['message'] = "<strong>Success!</strong>  Added Successfully.";
    // $response['success'] = true;
    echo json_encode($response);
    exit;
}
if ($_GET['action'] == 'staffpasswordcheck') {
   
 $password =mysqli_real_escape_string($conn,md5($_GET['data']));
   
    $staff_id = $_SESSION['id_staff'];
	
	
    $passwordcheckquery = $conn->query("SELECT * FROM os_staff where id_staff=" . $staff_id . " and staff_password='".$password."' ");
	// if($passwordcheckquery){
		// echo "asdasd";
		// exit;
		// }
	
    // $fetchquery2 = $passwordcheckquery->fetch_assoc();
	
   $numrows = $passwordcheckquery->num_rows;
    
		
	// echo $numrows";
		// exit;
    if ($numrows == 1) {
        $response['success'] = true;
    } else {
		$response['success'] = false;
        $response['message'] = "Invalide password";
       
    }

    echo json_encode($response);
    exit;
}


 
	if ($_GET['action'] == 'searchuser')
	{
		$user_name =mysqli_real_escape_string($conn,$_GET['data']);
   
               $user_id = $_SESSION['id_user'];
	
	
    $search_user= $conn->query("SELECT user_name FROM os_user where user_name LIKE '$user_name%'");

	
	while($fetchuser = $search_user->fetch_assoc())
	{
		echo $fetchuser['user_name']."<br>";
	}
	}
?>