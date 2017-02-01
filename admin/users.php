<?php
	session_start();
	include_once("includes/config.php");
	ob_start();
	include_once('./includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:signin.php');
	}
	include_once("includes/header.php");
	include_once("includes/menu.php");
	
?>
  <link rel="stylesheet" href="js/nestable/nestable.css" type="text/css" />

        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header"><strong>USERS PANEL</strong></div>
              <ul class="nav nav-pills nav-stacked">
 			      <li class="b-b b-light active"><a href="#userlist" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> User List </a></li>
                 <li class="b-b b-light"><a href="#userorders" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Users Orders </a></li>
                  <li class="b-b b-light"><a href="#manageusers" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Manage Users</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                  <header class="header bg-white b-b clearfix">
                      <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                          <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                            <button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-sm btn-default" title="Filter" data-toggle="dropdown"><i class="fa fa-filter"></i> <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                          <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                              <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </header>
                  <section class="scrollable wrapper w-f">
                    <section class="panel panel-default tab-content">
                          <div class="tab-pane active" id="userlist">
                                <div class="table-responsive"> 
                                        <table class="table table-striped m-b-none text-center">
                                            <thead>
                                              <tr>
                                                <th width="20"><input type="checkbox"></th>
                                                <th class="text-center" data-toggle="class">Hostel Name
                                                </th>
                                                <th class="text-center">User</th>
                                                <th class="text-center">Date</th>
                                              </tr>
                                            </thead>
                                            <tbody>
											  <?php 
										  $userlist=$conn->query("SELECT `user_name`,`user_hostel`,`user_date` FROM `os_user` ORDER by user_date DESC") or die(mysqli_error());
 										  while($userListResult=$userlist->fetch_assoc())
										  {
										  ?>
										 	<tr>
                                                <td><input type="checkbox" name="post[]" value="2"></td>
                                                <td><?php echo $userListResult['user_hostel'] ?></td>
                                                <td><?php echo $userListResult['user_name'] ?></td>
                                                <td><?php echo $userListResult['user_date'] ?></td>
                                              </tr>
										   <?php }?>
                                              
                                            </tbody>
                                          </table>
                                </div>   
                          </div> 
                          <div class="tab-pane" id="userorders">
                         	<div class="table-responsive"> 
                                <table class="table table-striped m-b-none text-center">
                                        <thead>
                                          <tr>
                                            <th width="20"><input type="checkbox"></th>
                                            <th class="text-center">Orders</th>
                                            <th class="th-sortable text-center" data-toggle="class">Dish Name
                                              <span class="th-sort">
                                                <i class="fa fa-sort-down text"></i>
                                                <i class="fa fa-sort-up text-active"></i>
                                                <i class="fa fa-sort"></i>
                                              </span>
                                            </th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Wallet</th>
                                          </tr>
                                        </thead>
                                        <tbody>
										  <?php 
										  $userorder=$conn->query("select * from os_order") or die(mysqli_error());
										  
										  while($userOrderResult=$userorder->fetch_assoc())
										  {
										  ?>
										  <tr>
                                            <td><input type="checkbox" name="post[]" value="2"></td>
                                            <td><a href="#userorder" data-toggle="modal"><i class="fa fa-search-plus"></i></a></td>
                                            <td><?php echo $userOrderResult['order_dishname'] ?></td>
                                            <td><?php echo $userOrderResult['order_user'] ?></td>
                                            <td><?php echo $userOrderResult['order_date'] ?></td>
                                            <td><i class="fa fa-inr"></i><?php echo $userOrderResult['order_wallet'] ?></td>
                                          </tr>
										   <?php }?>
                                        </tbody>
                                      </table>
                            </div>
              			  </div> 
                          <div class="tab-pane" id="manageusers">
                          	<div class="table-responsive"> 
                                 <table class="table table-striped m-b-none text-center">
                                        <thead>
                                          <tr>
                                            <th width="20"><input type="checkbox"></th>
                                            <th class="text-center">Profile</th>
                                            <th class="th-sortable text-center" data-toggle="class">Hostel Name
                                              <span class="th-sort">
                                                <i class="fa fa-sort-down text"></i>
                                                <i class="fa fa-sort-up text-active"></i>
                                                <i class="fa fa-sort"></i>
                                              </span>
                                            </th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Date</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
										  $userQuery=$conn->query("select * from os_user") or die(mysqli_error());
										  
										  while($userResult=$userQuery->fetch_assoc())
										  {
										  ?>
										  <tr>
                                            <td><input type="checkbox" name="post[]" value="3"></td>
                                            <td><a name="open_modal" id="open_modal" class="open_modal" href="#modal" data-toggle="modal" data-id="<?php echo $userResult['id_user'];?>"><i class="fa fa-search-plus"></i></a></td>
                                            <td><?php echo $userResult['user_hostel']; ?></td>
                                            <td><?php echo $userResult['user_name']; ?></td>
                                            <td><?php echo $userResult['user_date']; ?></td>
                                          </tr>
										  
										  <?php }?>
                                        </tbody>
                                      </table>
                        	</div>
                          </div>     
                          </section>
                    </section>
              
                <footer class="footer bg-white b-t">
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/nestable/jquery.nestable.js"></script>
<script src="js/nestable/demo.js"></script>
     
      <div class="modal fade" id="modal">
        <div class="modal-dialog">
		<div class="modal-body">
			<iframe src="http://amerytech.net/ostello/admin/user_manage_profile.php" name="user_details_frame" id="user_details_frame" ></iframe>
            <div class="pull-right">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
		</div>
        </div><!-- /.modal-dialog -->
      </div>

	  <script type="text/javascript">
		$(document).ready(function(){
			$(document).on("click", "#open_modal", function(){
				var userid = $(this).data('id');
				 $('#user_details_frame').attr('src', 'http://amerytech.net/ostello/admin/user_manage_profile.php?uid='+userid);
			});
		});
	  </script>

</body>
</html>