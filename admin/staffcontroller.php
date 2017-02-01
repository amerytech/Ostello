<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
session_start();
include_once("includes/config.php");
if (!isset($_SESSION['id'])) {
    header('location:signin.php');
}
//add staff ends
if ($_POST['action'] == 'addstaff') {

    parse_str($_POST['staffData'], $staffData);
    // echo "<pre>";
    // print_r($staffData);
    // exit;
    $staff_name = $conn->real_escape_string($staffData['staff_name']);
    $staff_email = $conn->real_escape_string($staffData['staff_email']);
    $staff_phone = $conn->real_escape_string($staffData['staff_phone']);
    $staff_password = $conn->real_escape_string($staffData['staff_password']);
    $ChecMailQuery = $conn->query("SELECT * FROM os_staff where staff_email='" . $staff_email . "'");
    $emailCount = mysqli_num_rows($ChecMailQuery);
    if ($emailCount >= 1) {
        $response['message'] = "Email Already Exist!";
        $response['success'] = false;
    }
    $CheckPhoneQuery = $conn->query("SELECT * FROM os_staff where staff_phone='" . $staff_phone . "'");
    $phoneCount = mysqli_num_rows($CheckPhoneQuery);
    if ($phoneCount >= 1) {
        $response['message'] = "Phone Number Already Exist!";
        $response['success'] = false;
    }
    if ($emailCount == 0) {
        $addStaff = $conn->query("INSERT INTO os_staff (staff_name,staff_email,staff_phone,staff_password) VALUES ('" . $staff_name . "','" . $staff_email . "','" . $staff_phone . "','" . md5($staff_password) . "')") or die(mysqli_error());

        $staffQuery = $conn->query("select * from os_staff order by id_staff DESC");
        $staff = array();
        while ($staffData = $staffQuery->fetch_assoc()) {
            $staff[$staffData['id_staff']] = $staffData;
        }
        if ($addStaff) {

            $response['message'] = "<strong>Success!</strong> Staff Added Successfully.";
            $response['success'] = true;
            $response['staffList'] = $staff;
        } else {
            $response['message'] = "<strong>Warning!</strong> Staff Not Added.Please check Carefully..";
            $response['success'] = false;
            $response['staffList'] = $staff;
        }
    }
    echo json_encode($response);
    exit;
}
//add staff ends
//add hostel
elseif ($_POST['action'] == 'addhostel') {
    parse_str($_POST['hostelData'], $hostelData);
    // echo "</pre>";
    // print_r($hostelData);
    // exit;
    $hostel_name = $conn->real_escape_string($hostelData['hostel_name']);
    // $hostel_email = $conn->real_escape_string($hostelData['hostel_email']);
    $hostel_address = $conn->real_escape_string($hostelData['hostel_address']);
    $hostel_latitude = $conn->real_escape_string($hostelData['hostel_latitude']);
    $hostel_longitude = $conn->real_escape_string($hostelData['hostel_longitude']);
    // $hostel_phone = $conn->real_escape_string($hostelData['hostel_phone']);
    // $CheckHostelMail = $conn->query("SELECT * FROM os_hostel where hostel_email='" . $hostel_email . "'");
    // $hostelemailCount = mysqli_num_rows($CheckHostelMail);
    // if ($hostelemailCount >= 1) {
    //      $response['message'] = "Hostel Email Already Exist!";
    //      $response['success'] = false;
    //  }
    if ($hostelemailCount == 0) {
        $addHostel = $conn->query("INSERT INTO os_hostel (hostel_name,hostel_address,hostel_latitude,hostel_longitude) VALUES ('" . $hostel_name . "','" . $hostel_address . "','" . $hostel_latitude . "','" . $hostel_longitude . "')") or die(mysqli_error());
        $hostelId = $conn->insert_id;
        if ($addHostel) {
            foreach ($hostelData['hostel_facility'] as $key => $facility) {
                $conn->query("INSERT INTO os_hostel_facility (id_hostel,id_facility) values ('" . $hostelId . "','" . $facility . "')");
            }
            // store building start
            // foreach ($hostelData["hostel"] as $k => $hbi) {
            //               $conn->query("INSERT INTO os_hostel_building (id_hostel,building,floor,flat,room,bed) values ('" . $hostelId . "','" . $hbi["building"] . "','" . $hbi["floor"] . "','" . $hbi["flat"] . "','" . $hbi["room"] . "','" . $hbi["bed"] . "')");
            //   }
            // exit;
            $response['message'] = "<strong>Success!</strong> Hostel Added Successfully.";
            $response['success'] = true;
        } else {
            $response['message'] = "<strong>Warning!</strong> Hostel Not Added.Please Check Carefully..";
            $response['success'] = false;
        }
    }
    echo json_encode($response);
    exit;
}//add hostel ends here
//View staff Starts //
if ($_POST['action'] == 'viewstaff') {
    $staffSearch = $conn->query("SELECT * From os_staff WHERE id_staff='" . $_POST['staffId'] . "'") or die(mysql_error());
    $viewStaff = $staffSearch->fetch_assoc();
    $response['staff'] = $viewStaff;
    if ($viewStaff) {
        $response['message'] = "Staff View Successful";
        $response['success'] = true;
    } else {
        $response['message'] = "OOPS! Staff View Not Successful";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
//	View staff Ends here. //
//Update staff starts//
if ($_POST['action'] == 'updatestaff') {
    parse_str($_POST['updateData'], $updateData);
    $staff_name = $conn->real_escape_string($updateData['staff_name']);
    // $staff_email = $conn->real_escape_string($updateData['staff_email']);
    //  $staff_phone = $conn->real_escape_string($updateData['staff_phone']);
    $staff_password = $conn->real_escape_string($updateData['staff_password']);
    $updateStaffQuery = $conn->query("UPDATE os_staff SET staff_name='" . $staff_name . "',staff_password='" . md5($staff_password) . "' WHERE id_staff='" . $updateData['staffid'] . "' ") or die(mysqli_error());
    if ($updateStaffQuery) {
        $response['message'] = "<strong>Success!</strong> Staff Updated Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Staff Not updated.Please check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
//Update staff ends//
//View Hostel Starts //
if ($_POST['action'] == 'viewhostel') {
    $hostelSearch = $conn->query("SELECT * From os_hostel WHERE id_hostel='" . $_POST['hostelId'] . "'") or die(mysql_error());
    $viewHostel = $hostelSearch->fetch_assoc();

    $facilitysearch = $conn->query("SELECT id_facility From os_hostel_facility WHERE id_hostel='" . $_POST['hostelId'] . "'") or die(mysql_error());

    $viewfacility = array();
    while ($facilitydata = $facilitysearch->fetch_array()) {
        $viewfacility[$facilitydata['id_facility']] = $facilitydata;
    }
    // echo "<pre>";
    // print_r($viewfacility);
    // exit;
    $response['facility'] = $viewfacility;
    $response['hostel'] = $viewHostel;
    if ($viewStaff) {
        $response['message'] = "Hostel View Successful";
        $response['success'] = true;
    } else {
        $response['message'] = "OOPS! Hostel View Not Successful";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
//	View Hostel Ends here. //
//Update Hostel starts//
if ($_POST['action'] == 'updatehostel') {
    parse_str($_POST['hostelupdateData'], $hd);
    // echo "<pre/>";
    // print_r($hd);
    // exit;
    $hostel_name = $conn->real_escape_string($hd['hostel_name']);
    $hostel_email = $conn->real_escape_string($hd['hostel_email']);
    $hostel_address = $conn->real_escape_string($hd['hostel_address']);
    $hostel_latitude = $conn->real_escape_string($hd['hostel_latitude']);
    $hostel_longitude = $conn->real_escape_string($hd['hostel_longitude']);
    // $hostel_building = $conn->real_escape_string($hd['hostel_building']);	
    // $hostel_floor = $conn->real_escape_string($hd['hostel_floor']);	
    // $hostel_flat = $conn->real_escape_string($hd['hostel_flat']);	
    // $hostel_room = $conn->real_escape_string($hd['hostel_room']);	
    // $hostel_bed = $conn->real_escape_string($hd['hostel_bed']);	
    // $hostel_phone = $conn->real_escape_string($hd['hostel_phone']);	
    // $updateHostel = $conn->query("UPDATE os_hostel SET hostel_name='".$hostel_name."',hostel_email='".$hostel_email."',hostel_address='".$hostel_address."',hostel_latitude='".$hostel_latitude."',hostel_longitude='".$hostel_longitude."',hostel_building='".$hostel_building."',hostel_floor='".$hostel_floor."',hostel_flat='".$hostel_flat."',hostel_room='".$hostel_room."',hostel_bed='".$hostel_bed."',hostel_phone='".$hostel_phone."' WHERE id_hostel='".$hd['hostelid']."' ") or die(mysqli_error());
    $updateHostel = $conn->query("UPDATE os_hostel SET hostel_name='" . $hostel_name . "',hostel_email='" . $hostel_email . "',hostel_address='" . $hostel_address . "',hostel_latitude='" . $hostel_latitude . "',hostel_longitude='" . $hostel_longitude . "',hostel_phone='" . $hostel_phone . "' WHERE id_hostel='" . $hd['hostelid'] . "' ") or die(mysqli_error());

    if ($updateHostel) {

        $conn->query("DELETE FROM os_hostel_facility WHERE id_hostel='" . $hd['hostelid'] . "' ");

        foreach ($hd['hostel_facility'] as $key => $facility) {
            $conn->query("INSERT INTO os_hostel_facility (id_hostel,id_facility) values ('" . $hd['hostelid'] . "','" . $facility . "')");
        }

        $response['message'] = "<strong>Success!</strong> Hostel Updated Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Hostel Not Updated.Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
//Update Hostel ends//
//Delete Staff
if ($_POST['action'] == 'delete') {
    $delids = explode(",", $_POST["delData"]);
    $count = count($delids);
    for ($i = 0; $i < $count; $i++) {
        $delQuery = $conn->query("DELETE FROM os_staff WHERE id_staff=" . $delids[$i]);
    }
    if ($delQuery) {
        $response['message'] = "<strong>Success!</strong>Staff Deleted Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Staff Not Deleted.Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
//Delete Staff Ends here
//Delete Hostel
if ($_POST['action'] == 'deletehostel') {
    $delhstlids = explode(",", $_POST["delhstlData"]);
    $counthstl = count($delhstlids);
    for ($i = 0; $i < $counthstl; $i++) {
        $delhstlQuery = $conn->query("DELETE FROM os_hostel WHERE id_hostel=" . $delhstlids[$i]);
    }
    if ($delhstlQuery) {
        $response['message'] = "<strong>Success!</strong>Hostel Deleted Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Hostel Not Deleted. Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
if ($_POST['action'] == 'addbedtype') {


    parse_str($_POST['bedtype'], $hd);

    $hostel_id = $conn->real_escape_string($hd['hosteltype']);
    $bed_code = $conn->real_escape_string($hd['bedcode']);
    $bedprice = $conn->real_escape_string($hd['bedprice']);
    //echo "$hostel_id";
    //  echo "$bed_code";
    //echo "$bedprice";
    //  exit;
    $insertbedtype = $conn->query("insert into os_bedtype (id_hostel,bedtype_name,bedtype_price) values  ('" . $hostel_id . "','" . $bed_code . "','" . $bedprice . "') ") or die(mysqli_error());

    if ($insertbedtype) {
        $response['message'] = "<strong>Success!</strong>Bed type added.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Not Added.Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
if ($_POST['action'] == 'addbedno') {
//    echo "hiii";
//    exit;
    parse_str($_POST['bedno'], $bedno);
    $hostel_id = $bedno['hostel_id'];
//     echo "$hostel_id";
//     exit;

    if ($hostel_id == "0") {
        $response['message'] = "<strong>Warning!</strong> please select Hostel.";
        $response['success'] = false;
        echo json_encode($response);
        exit;
    } else {
        $response['message'] = "";
        foreach ($bedno["hostel"] as $key => $hbn) {
            $BEDTYPECHECK = $hbn["bed_type"];
//            echo "$BEDTYPECHECK";
//            exit;
            $checkbednoinsrt2 = '' . $hbn["floor"] . '/' . $hbn["flat"] . '/' . $hbn["room"] . '/' . $hbn["bed"] . '';
            if ($BEDTYPECHECK == "" || $BEDTYPECHECK == "0") {
                $response['message'] .= "$checkbednoinsrt2 <br />";
            }
        }
        if ($response['message'] != "") {
            $response['message'] .= "please select bed price <br />";
            $response['success'] = false;
            echo json_encode($response);
            exit;
        }
        if ($response['message2'] == "") {
            $response['message'] = "";
            foreach ($bedno["hostel"] as $key => $hbn) {
                $checkbednoinsrt = '' . $hbn["floor"] . '/' . $hbn["flat"] . '/' . $hbn["room"] . '/' . $hbn["bed"] . '';
//        echo "$checkbednoinsrt";
//        $sql="select * from os_bed_no where bed_no='".$checkbednoinsrt."' and id_hostel=".$$hostel_id;
//        echo "$sql";
//exit;
                $checkbednoquery = $conn->query("select * from os_bed_no where bed_no='" . $checkbednoinsrt . "' and id_hostel=" . $hostel_id)or die(mysqli_error());
                if ($checkbednoquery->num_rows > 0) {
                    $response['message'] .= "$checkbednoinsrt <br />";
                }
            }
            if ($response['message'] != "") {
                $response['message'] .= "Already exsist <br />";
                $response['success'] = false;
            }


            if ($response['message'] == "") {
                foreach ($bedno["hostel"] as $key => $hbn) {
                    $bednoinsrt = '' . $hbn["floor"] . '/' . $hbn["flat"] . '/' . $hbn["room"] . '/' . $hbn["bed"] . '';
//        echo "$bednoinsrt";

                    $bednoquery = $conn->query("INSERT INTO os_bed_no (id_hostel,bed_status,bed_floor,bed_flat,bed_room,bed_type,bed_no) values ('" . $hostel_id . "','0','" . $hbn["floor"] . "','" . $hbn["flat"] . "','" . $hbn["room"] . "','" . $hbn["bed_type"] . "','" . $bednoinsrt . "')")or die(mysqli_error());
                }
//   exit ;
                if ($bednoquery) {
                    $response['message'] = "<strong>Success!</strong>Bed Added sucessfully.";
                    $response['success'] = true;
                } else {
                    $response['message'] = "<strong>Warning!</strong> Bed Not Added.Please Check Carefully..";
                    $response['success'] = false;
                }
            }
        }
        echo json_encode($response);
        exit;
    }
}
if ($_POST['action'] == 'getbedtype') {
    //echo "SELECT * FROM r_city where id_state=".$_POST['id_state'];
    //exit;
    $bedtypeList = $conn->query("SELECT * FROM os_bedtype where id_hostel=" . $_POST['id_hostel']);
    $bedtypeResponse = '';
    $bedtypeResponse .= '<option value="0" >Select Bed Type</option>';
    while ($bedtypefetch = $bedtypeList->fetch_assoc()) {
        $bedtypeResponse .= "<option value='" .  $bedtypefetch['bedtype_name'] . "'>" . $bedtypefetch['bedtype_name'] . "</option>";
    }
    echo $bedtypeResponse;
    exit;
}
if ($_POST['action'] == 'getbedlist') {
    //echo "SELECT * FROM r_city where id_state=".$_POST['id_state'];
    //exit;

    $hostel_id = $_POST['id_hostel'];
//    $sql="select a.*,b.bedtype_price as prize ,c.user_name as name from os_bed_no a left JOIN os_bedtype b on a.bed_type=b.bedtype_name left JOIN os_user c on a.bed_no=c.user_bedcode AND a.id_hostel=c.user_hostel_id where a.id_hostel='$hostel_id'";


    $bedList = $conn->query("select a.*,b.bedtype_price as prize ,c.user_name as name from os_bed_no a left JOIN os_bedtype b on a.bed_type=b.bedtype_name AND a.id_hostel=b.id_hostel left JOIN os_user c on a.bed_no=c.user_bedcode AND a.id_hostel=c.user_hostel_id where a.id_hostel='$hostel_id'");
    
//    $sql="select a.*,b.bedtype_price as prize ,c.user_name as name from os_bed_no a left JOIN os_bedtype b on a.bed_type=b.bedtype_name left JOIN os_user c on a.bed_no=c.user_bedcode AND a.id_hostel=c.user_hostel_id where a.id_hostel='$hostel_id'";
//    echo "$sql";
//    exit;
    $bedtypeResponse = '';


    $bedtypeResponse .= "<table class='table table-striped m-b-none text-center'>
                                                            <thead>

                                                                <tr>
                                                                     <th width='50' class='text-center'><input type='checkbox'></th>
                                                                    <th class='text-center'>Bed type</th>
                                                                    <th class='text-center'>Bed Prize</th>
                                                                    <th class='text-center'>Bed Code</th>
                                                                    <th class='text-center'>User Alloted</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";

    while ($bedListfetch = $bedList->fetch_assoc()) {
        $bedtypeResponse .= " <tr><td><input type='checkbox' class='Bed-list' name='checked' value='";
        $bedtypeResponse .= $bedListfetch['id_bedno'];
        $bedtypeResponse .= "'></td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>
                                                                        ";
        $bedtypeResponse .= $bedListfetch['bed_type'];
        $bedtypeResponse .= "
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>";
        $bedtypeResponse .= $bedListfetch['prize'];
        $bedtypeResponse .= "

                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>";
        $bedtypeResponse .= $bedListfetch['bed_no'];
        $bedtypeResponse .= "
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>";
        $bedtypeResponse .= $bedListfetch['name'];
        $bedtypeResponse .= "
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            </tr>";
    }
    $bedtypeResponse .= "</tbody>
                                                        </table>";

    echo $bedtypeResponse;
    exit;
}
if ($_POST['action'] == 'getTypebedlist') {


    //echo "SELECT * FROM r_city where id_state=".$_POST['id_state'];
    //exit;

    $hostel_id = $_POST['id_hostel'];
//    $sql="select a.*,b.bedtype_price as prize ,c.user_name as name from os_bed_no a left JOIN os_bedtype b on a.bed_type=b.bedtype_name left JOIN os_user c on a.bed_no=c.user_bedcode AND a.id_hostel=c.user_hostel_id where a.id_hostel='$hostel_id'";
//$sql="select * from os_bedtype where hostel_id=".$hostel_id;
//    echo "$sql";
//    exit;

    $bedtype2List = $conn->query("select * from os_bedtype where id_hostel=" . $hostel_id);
    $bedtypeResponse = '';


    $bedtypeResponse .= "<table class='table table-striped m-b-none text-center'>
                                                            <thead>

                                                                <tr>
                                                                     <th width='50' class='text-center'><input type='checkbox'></th>
                                                                    <th class='text-center'>Bed Type</th>
                                                                    <th class='text-center'>Bed Price</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>";

    while ($bedtype2fetch = $bedtype2List->fetch_assoc()) {
        $bedtypeResponse .= " <tr><td><input type='checkbox' class='Bed-type-list' name='checked' value='";
        $bedtypeResponse .= $bedtype2fetch['id_bedtype'];
        $bedtypeResponse .= "'></td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>
                                                                        ";
        $bedtypeResponse .= $bedtype2fetch['bedtype_name'];
        $bedtypeResponse .= "
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <ul class='list-unstyled list-inline'>
                                                                    <li>
                                                                        ";
        $bedtypeResponse .= $bedtype2fetch['bedtype_price'];
        $bedtypeResponse .= "
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                          
                                                            </tr>";
    }
    $bedtypeResponse .= "</tbody>
                                                        </table>";

    echo $bedtypeResponse;
    exit;
}
if ($_POST['action'] == 'deletebedlist') {
    $delids = explode(",", $_POST["delData"]);
    $hostelno = $_POST["bedlisthostel"];
    $count = count($delids);
    for ($i = 0; $i < $count; $i++) {
        $delQuery = $conn->query("DELETE FROM os_bed_no WHERE id_bedno=" . $delids[$i] . " and id_hostel=" . $hostelno);
    }
    if ($delQuery) {
        $response['message'] = "<strong>Success!</strong>Staff Deleted Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Staff Not Deleted.Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
if ($_POST['action'] == 'deletebedtypelist') {
    $delids = explode(",", $_POST["delData"]);
    $hostelno = $_POST["bedtyephostel"];
    $count = count($delids);
    for ($i = 0; $i < $count; $i++) {
        $delQuery = $conn->query("DELETE FROM os_bedtype WHERE id_bedtype=" . $delids[$i] . " and id_hostel=" . $hostelno);
    }
    if ($delQuery) {
        $response['message'] = "<strong>Success!</strong>Staff Deleted Successfully.";
        $response['success'] = true;
    } else {
        $response['message'] = "<strong>Warning!</strong> Staff Not Deleted.Please Check Carefully..";
        $response['success'] = false;
    }
    echo json_encode($response);
    exit;
}
?>		