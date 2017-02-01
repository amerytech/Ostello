<?php

ob_start();
session_start();
include_once('../admin/includes/config.php');
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//    exit;

if ($_POST['action'] == 'passwordchange') {

//    echo 'hiii';
//exit;

    $newpassword = md5($_POST['newpassword']);
    $user_id = $_SESSION['id_user'];
    if ($_FILES['photo']['name'] != '') {
//                    echo "hii";
//                    exit;
        $temp = explode(".", $_FILES["photo"]["name"]);
        $pic = $user_id . $name . '.' . end($temp);
//        echo "";
//        exit;

        $rows = $conn->query("update os_user SET user_image='$pic' where id_user=$user_id")or die(mysql_error());

        $moved = move_uploaded_file($_FILES["photo"]["tmp_name"], "../images/user/" . $pic);
    }
    if ($newpassword != '') {
        $insertQuery = $conn->query("update os_user SET user_password='$newpassword' where id_user='$user_id' ")or die(mysql_error());
    }
    if ($insertQuery || $rows) {

        $response = "Updated Sucessfully";
        header("Location: http://amerytech.net/ostello/user/index.php?message=$response");
    } else {
        $response = "OOPS! Something Went Wrong Please Try After Sometime!";
        header("Location: http://amerytech.net/ostello/user/index.php?messagedanger=$response");
    }
}

if ($holder == user) {
    $LoginQuery1 = $conn->query("SELECT * FROM os_user where user_email='" . $Email . "' and user_password='" . $Password . "'");

    $user = $LoginQuery1->fetch_assoc();

    $_SESSION['id_user'] = $user['id_user'];
    // echo count($LoginQuery);
    // exit;
    if (mysqli_num_rows($LoginQuery1) == 1) {

        $response1['message'] = "Login User sucess";
        $response1['success'] = true;
    } else {
        $response1['message'] = "Invalide username or password";
        $response1['success'] = false;
    }
    echo json_encode($response1);
    exit;
}
 // echo "<pre>";
	// print_r($_GET);
    // exit;
if ($_GET['action'] == 'passwordcheck') {
   
 $password =mysqli_real_escape_string($conn,md5($_GET['data']));
   
    $user_id = $_SESSION['id_user'];
	
	
    $passwordcheckquery = $conn->query("SELECT * FROM os_user where id_user=" . $user_id . " and user_password='".$password."' ");
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

if ($_POST['action'] == 'addorder') {
    $user_id = $_POST['user_id'];

    parse_str($_POST['FoodData'], $FoodData);

    preg_match('/([0-9]+\.[0-9]+)/', $FoodData['total'], $matches);
    $totalamount = $matches[1];


    $walletquery = $conn->query("SELECT *,(os_wallet_admin+os_wallet_user)as totalwallet FROM os_user where id_user='" . $user_id . "'");
    $fetchwalletquery = $walletquery->fetch_assoc();
    $walletamount = $fetchwalletquery['totalwallet'];

    if ($totalamount > $walletamount) {
        $response['success'] = false;
        $response['message'] = "You dont have enough amount in your wallet";

        echo json_encode($response);
        exit;
    } else if ($fetchwalletquery['os_wallet_admin'] >= $totalamount) {

        $amountsubtract = $fetchwalletquery['os_wallet_admin'] - $totalamount;
        $insertwaQuery = $conn->query("update os_user SET os_wallet_admin='$amountsubtract' where  id_user='" . $user_id . "' ")or die(mysql_error());
//    echo $amountsubtract ;
    } else {
        $tosubtract = $totalamount - $fetchwalletquery['os_wallet_admin'];
        $toupdate = $fetchwalletquery['os_wallet_user'] - $tosubtract;

//    echo "update os_user SET os_wallet_admin='0',os_wallet_user='".$toupdate."' where  id_user='".$user_id."' ";
//    exit;
        $insertQuery = $conn->query("update os_user SET os_wallet_admin='0',os_wallet_user='" . $toupdate . "' where  id_user='" . $user_id . "' ")or die(mysql_error());
    }


    $i=0;
    foreach ($FoodData as $key => $value) {
        $exp_key = explode('_', $key);
        if ($exp_key[0] == 'w3ls') {
            $arr_result[] = $value;
            $i++;
        }
    }
//    echo $i;
    if ($i==0) {
//        echo "hii";
        $response['message'] = "Please add atleast one item to cart";
        $response['success'] = false;
        echo json_encode($response);
        exit;
    }
    foreach ($FoodData as $key => $value) {
        $exp_key = explode('_', $key);
        if ($exp_key[0] == 'w3ls') {
//        echo "SELECT * FROM os_item where item_name='".$value."'" ;
            $foodstatus = $conn->query("SELECT * FROM os_item where item_name='" . $value . "'");
            $fetchfoodstatus = $foodstatus->fetch_assoc();
            $arritemstatus_result[] = $fetchfoodstatus['item_status'];
        }
    }

//if(isset($arr_result)){
//    print_r($arr_result);
//}

    foreach ($FoodData as $key => $value) {
        $exp_key = explode('_', $key);
        if ($exp_key[0] == 'quantity') {
            $arrquantity_result[] = $value;
        }
    }
    $countarr = count($arr_result);


//if(isset($arrquantity_result)){
//    print_r($arritemstatus_result);
//}
//echo $countarr;
// echo "$user_id";
    $user_id = $_POST['user_id'];
//echo "SELECT * FROM os_user where id_user='".$user_id ;
    $userdata = $conn->query("SELECT * FROM os_user where id_user=" . $user_id);
    $fetchuserdata = $userdata->fetch_assoc();
//    $numrows = $fetchquery->num_rows();


    for ($i = 0; $i < $countarr; $i++) {
//     echo "hi";
//     echo "insert into os_order_items (ordered_items,quantity,user_id,hostel_id,order_list_status) values ('".$arr_result[$i]."',".$arrquantity_result[$i].",".$user_id.",".$fetchuserdata['user_hostel_id'].",".$arritemstatus_result[$i].")";
        nl2br;
        $insertorder = $conn->query("insert into os_order_items (ordered_items,quantity,user_id,hostel_id,order_list_status,ordered_date) values ('" . $arr_result[$i] . "'," . $arrquantity_result[$i] . "," . $user_id . "," . $fetchuserdata['user_hostel_id'] . "," . $arritemstatus_result[$i] . ",'21')");
    }
//if($insertorder){
//    echo "hiii";
//}

    if ($insertorder) {
        $response['success'] = true;
        $response['message'] = "Order placed sucessfully";
    } else {
        $response['message'] = "OOPS! Something Went Wrong Please Try After Sometime!";
        $response['success'] = false;
    }

    echo json_encode($response);
    exit;
}
?>