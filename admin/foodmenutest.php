<?php
	session_start();
	//include_once("includes/config.php");
	ob_start();
	include_once('./includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:signin.php');
	}
	include_once("includes/header.php");
	include_once("includes/menu.php");
	if (!isset($_SESSION['id'])) {
		header('location:signin.php');
	}
?>

        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Hostel Food Orders</div>
              <ul class="nav nav-pills nav-stacked">
					<?php 
						
						$hostelsquery=$conn->query("select id_hostel,hostel_name from os_hostel") or die(mysql_error()) ;
						//check for making first div active
							$check=0;
						while($hostelfetch=$hostelsquery->fetch_assoc()){
?>                              
						 <li class="b-b b-light <?php if (($check==0)) {echo "active"; $check++; }; ?>"><button type="button"  data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></button> <?php echo $hostelfetch['hostel_name']; ?></a></li>
    <?php
	}?>
 			    <!--  <li class="b-b b-light active"><a href="#Hostel-1" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Hostel 1 </a></li>
                  <li class="b-b b-light"><a href="#Hostel-2" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Hostel 2 </a></li>
                  <li class="b-b b-light"><a href="#Hostel-3" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Hostel 3 </a></li>-->
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <!--<header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
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
                </header>-->
                <section class="scrollable wrapper w-f">
                      <section class="panel panel-default">
                      	<div class="tab-content table-responsive"> 
                          <div  id="hosteldetails">
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table> 
                              <!--<div> &nbsp; </div>
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                              <div> &nbsp; </div>
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table>-->
                          </div>
                        <!--  <div class="tab-pane" id="Hostel-2">
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table> 
                              <div> &nbsp; </div>
                          </div>-->
                        <!--  <div class="tab-pane" id="Hostel-3">
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table> 
                              <div> &nbsp; </div>
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center">Sep 20, 2016</th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                      <tr>
                                        <td> Idli <b class="badge bg-warning pull-right">369</b> </td>
                                        <td> Rice <b class="badge bg-success pull-right">369</b> </td>
                                        <td> Curd <b class="badge bg-dark pull-right">369</b> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                          </div>-->
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

</body>
</html>
<script type="text/javascript" language="JavaScript">
	
	
	// $("#hosteldetails").hide();
	
	
	// function getHostelDetails(hostelid){
		
		// $.ajax({
			// url: "job-controller.php",
			// method: "POST",
			// data: {'action':'hosteldetails','hostelid' : +hostelid},
			// dataType: "json",
			// success: function (response) {
				
				// $("#ViewjobID").val(response['jobData']['id_job']);
				// $("#Viewhiringevent").val(response['jobData']['hiringevent']);
				// console.log(response['jobData']['hiringevent']);
				
				// $("#ViewTotalInvites").text(response['JobInvitationstatus']['toatalinvites']);
				// $("#ViewYes").text(response['JobInvitationstatus']['yes']);
				// $("#ViewNo").text(response['JobInvitationstatus']['no']);
				// $("#ViewNoresponse").text(response['JobInvitationstatus']['noresponse']);
				// console.log(response['JobInvitationstatus']['noresponse']);
				
				// $("#ViewGdCompleted").text(response['JobGd']['gdcompleted']);
				// $(".ViewGdSelected").text(response['JobGd']['gdselected']);
				// $("#ViewGdInprogress").text(response['JobGd']['gdinprogress']);
				// console.log(response['JobGd']['gdinprogress']);
				
				// $(".ViewStudentsInvited").text(response['JobOnlinetest']['studentsinvited']);
				// $("#ViewTestTakenBy").text(response['JobOnlinetest']['testtakenby']);
				// $(".ViewTestCleared").text(response['JobOnlinetest']['testcleared']);
				// console.log(response['JobOnlinetest']['testcleared']);
				
				// $("#ViewPiCompleted").text(response['JobPI']['piinterviewed']);
				// $(".ViewPiSelected").text(response['JobPI']['piselected']);
				// $("#ViewPiInprogress").text(response['JobPI']['piinprogress']);
				// console.log(response['JobPI']['piinprogress']);
				
				
				
				/*chart scrpit */
				

	
	
	
	
</script>
