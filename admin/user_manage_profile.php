<?php
	session_start();
	include_once("includes/config.php");
	ob_start();
	include_once('./includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:signin.php');
	}
	include_once("includes/head.php");
	

	if(!empty($_GET) && isset($_GET["uid"]))
	{
		$uid = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_GET["uid"]))));

		$get_userdata = mysqli_query($conn,"SELECT `user_name`,`user_email`,`user_hosteladdress`,`user_bednumber`,`user_hosteldetails_building`,`user_hosteldetails_floor`,`user_hosteldetails_flat`,`user_hosteldetails_room`,`user_hosteldetails_bed`,`user_phone`,`user_password`,`user_hostel` FROM `os_user` WHERE id_user='$uid'");
	}
	//Query of join tables 
	/*SELECT os.order_list_status,os.ordered_list_date,os.hostel_id, os.userOrder_list_itemname , oh.hostel_name FROM os_order_items os join os_hostel oh on os.hostel_id=oh.id_hostel ORDER BY os.ordered_list_date DESC */

	if(!empty($_POST) && isset($_POST["save_btn"]) && $_POST["save_btn"] == "Save Changes")
	{
		$uname = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["uname"]))));
		$email = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["email"]))));
		$hostelAddress = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["hostelAddress"]))));
		$beds = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["beds"]))));
		$userphone = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["userphone"]))));
		$userpwd = mysqli_real_escape_string($conn,addslashes(strip_tags(trim($_POST["userpwd"]))));
		

		$chk_uname = mysqli_query($conn,"SELECT COUNT(id_user) as cnt FROM os_user WHERE user_name = '$uname' AND id_user!='$uid'");
		$unamecnt_fetch = mysqli_fetch_assoc($chk_uname);
		$uname_cnt = $unamecnt_fetch["cnt"];

		$chk_email = mysqli_query($conn,"SELECT COUNT(id_user) as cnt FROM os_user WHERE user_email = '$email' AND id_user!='$uid'");
		$emailcnt_fetch = mysqli_fetch_assoc($chk_email);
		$email_cnt = $emailcnt_fetch["cnt"];
		
		$chk_beds = mysqli_query($conn,"SELECT COUNT(id_user) as cnt FROM os_user WHERE user_bednumber = '$beds' AND id_user!='$uid'");
		$bedscnt_fetch = mysqli_fetch_assoc($chk_beds);
		$beds_cnt = $bedscnt_fetch["cnt"];
		
		$chk_userphone = mysqli_query($conn,"SELECT COUNT(id_user) as cnt FROM os_user WHERE user_phone = '$userphone' AND id_user!='$uid'");
		$userphonecnt_fetch = mysqli_fetch_assoc($chk_userphone);
		$userphone_cnt = $userphonecnt_fetch["cnt"];

		$chk_userpwd = mysqli_query($conn,"SELECT COUNT(id_user) as cnt FROM os_user WHERE user_password = '$userpwd' AND id_user!='$uid'");
		$userpwdcnt_fetch = mysqli_fetch_assoc($chk_userpwd);
		$userpwd_cnt = $userpwdcnt_fetch["cnt"];

		if($uname_cnt < 1)
		{
			if($email_cnt < 1)
			{
				if($beds_cnt < 1)
				{
				   if($userphone_cnt < 1)
				  {
					   if($userpwd_cnt < 1)
				  {
				 $update_qry = mysqli_query($conn,"UPDATE os_user SET user_name='$uname',user_email='$email',user_hosteladdress='$hostelAddress',user_bednumber='$beds',user_phone='$userphone',user_password='$userpwd' WHERE id_user='$uid'");
				if($update_qry == TRUE)
				{
					header("location:user_manage_profile.php?uid=$uid&upd_ack=suc");
					exit;
				}
				else
				{
					$upd_ack = "fail";
				}
			}
			else
			{
				$userpwd_err = "Invalid Password.";
			}
		}
			else
			{
				$beds_err = "Mobile Number Already Exists for Another User";
			}
		}
			else
			{
				$beds_err = "Bed Number Already Exists for Another User";
			}
		}
			else
			{
				$email_err = "Email ID Already Exists for Another User";
			}
		}
		else
		{
			$uname_err = "User Name Already Exists for Another User";
		}
	}
	?>		
<link rel="stylesheet" href="js/nestable/nestable.css" type="text/css" />

<?php
	if(mysqli_num_rows($get_userdata)>0)
	{
		$rec = mysqli_fetch_assoc($get_userdata);
?>

		<?php
			if(isset($uname_err)){echo "<div class='alert alert-danger'>$uname_err</div>";}
			if(isset($email_err)){echo "<div class='alert alert-danger'>$email_err</div>";}
			if(isset($beds_err)){echo "<div class='alert alert-danger'>$beds_err</div>";}
			if(isset($userphone_err)){echo "<div class='alert alert-danger'>$beds_err</div>";}
			if(isset($userpwd_err)){echo "<div class='alert alert-danger'>$beds_err</div>";}
			if(isset($upd_ack) && $upd_ack == "fail"){echo "<div class='alert alert-danger'>Sorry, there occured some error while updating the details. Please try again.</div>";}
			if(!empty($_GET) && isset($_GET["upd_ack"]) && $_GET["upd_ack"] == "suc"){echo "<div class='alert alert-success'>Updated Successfully</div>";}
		?>

		<form class="form-horizontal row" name="user_form" id="user_form" method="post" action="">
          <div class="modal-content">
            <div class="modal-header alert alert-info">
              <h4 class="modal-title text-center">User Profile Details</h4>
            </div>
            <div class="modal-body">
                  <div class="panel-body">  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">User Name</label>
                      <div class="col-sm-9">
                       <input type="text" class="form-control rounded" name="uname" data-required="true" placeholder="User Name" value="<?php echo $rec["user_name"];?>">    
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">User Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control rounded" name="email" data-required="true" value="<?php echo $rec["user_email"];?>" >    
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Hostel Address</label>
                      <div class="col-sm-9">
                        <input type="text" name="hostelAddress" class="form-control rounded" value="<?php echo $rec["user_hosteladdress"];?>">
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Bed Number</label>
                      <div class="col-sm-9">
                        <input type="number" name="beds"  class="form-control rounded" value="<?php echo $rec["user_bednumber"];?>">
                      </div>
                      
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      	<label class="col-md-3 col-sm-3 col-xs-2 control-label">Hostel Details</label>
                      <div class="col-md-9 col-sm-9 col-xs-10">
                          <div class="row">
                              <div class="col-xs-12">
                                      <label class="col-sm-3 col-xs-3 control-label">Bulding</label>
                                      <div class="col-sm-9 col-xs-9">
                                        <select name="account" class="form-control m-b rounded">
                                          <option>Select Bulding</option>
                                          <option>Bulding 1</option>
                                          <option>Bulding 2</option>
                                        </select>
                                      </div>
                                  </div>
                              <div class="col-xs-12">
                                  <label class="col-sm-3 col-xs-3 control-label">Floor</label>
                                  <div class="col-sm-9 col-xs-9">
                                    <select name="account" class="form-control m-b rounded">
                                      <option>Select Floor</option>
                                      <option>Floor 1</option>
                                      <option>Floor 2</option>
                                      <option>Floor 3</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-xs-12">
                                  <label class="col-sm-3 col-xs-3 control-label">Flat</label>
                                  <div class="col-sm-9 col-xs-9">
                                    <select name="account" class="form-control m-b rounded">
                                      <option>Select Flat</option>
                                      <option>Flat 1</option>
                                      <option>Flat 2</option>
                                      <option>Flat 3</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-xs-12">
                                  <label class="col-sm-3 col-xs-3 control-label">Room</label>
                                  <div class="col-sm-9 col-xs-9">
                                    <select name="account" class="form-control m-b rounded">
                                      <option>Select Room</option>
                                      <option>Room 1</option>
                                      <option>Room 2</option>
                                      <option>Room 3</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-xs-12">
                                  <label class="col-sm-3 col-xs-3 control-label">Bed</label>
                                  <div class="col-sm-9 col-xs-9">
                                    <select name="account" class="form-control m-b rounded">
                                      <option>Select Bed</option>
                                      <option>Bed 1</option>
                                      <option>Bed 2</option>
                                      <option>Bed 3</option>
                                    </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Phone</label>
                      <div class="col-sm-9">
                        <input type="tel" name="userphone" class="form-control rounded" value="<?php echo $rec["user_phone"];?>">
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-9">
                        <input type="text" name="userpwd" data-minwords="[8,20]" class="form-control rounded" value="<?php echo $rec["user_password"];?>">
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-info" name="save_btn" id="save_btn" value="Save Changes">
                    </div>
                  </div>  
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
		</form>
		</div>
<?php 
	}
?>


  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/nestable/jquery.nestable.js"></script>
<script src="js/nestable/demo.js"></script>