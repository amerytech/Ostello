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
						
						$hostelsquery=$conn->query("SELECT id_hostel,hostel_name FROM os_hostel WHERE hostel_name!='' ORDER BY hostel_name ASC") or die(mysql_error()) ;
						//check for making first div active
							$check=0;
						while($hostelfetch=$hostelsquery->fetch_assoc()){
?>                              
							<li class="b-b b-light <?php if (($check==0)) {echo "active"; $check++; }; ?>">
								<a onclick="getHostelDetails(<?php echo $hostelfetch['id_hostel']; ?>)"  data-toggle="tab">
								<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>
								<?php echo $hostelfetch['hostel_name']; ?> </a>
							</li>

    <?php
	}
	?>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <!--<header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i>
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


			<?php	
				$get_food_orders = $conn->query("SELECT ordered_items,COUNT(ordered_items) as order_cnt,order_list_status,ordered_date FROM `os_order_items` WHERE hostel_id = '30' GROUP BY ordered_items,ordered_date");
				
				$brkfst = array();
				$lunch = array();
				$dinner = array();
				while($food_orders = mysqli_fetch_assoc($get_food_orders))
				{
					if($food_orders["order_list_status"] == "1"){array_push($brkfst,$food_orders["ordered_items"]);}
					if($food_orders["order_list_status"] == "2"){array_push($lunch,$food_orders["ordered_items"]);}
					if($food_orders["order_list_status"] == "3"){array_push($dinner,$food_orders["ordered_items"]);}


					//echo "<pre>";print_r($food_orders);echo "</pre>";
			?>
				<section class="scrollable wrapper w-f">
                      <section class="panel panel-default">
                      	<div class="tab-content table-responsive" id="hosteldetails"> 
                             
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center"><?php echo $food_orders["ordered_date"];?></th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Break Fast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
											<?php
												if($food_orders["order_list_status"] == "1")
												{
													echo $food_orders["ordered_items"];?> <b class="badge bg-warning pull-right"><?php echo $food_orders["order_cnt"];?></b>
											<?php
												}
											?>
										</td>
										<td>
											<?php
												if($food_orders["order_list_status"] == "2")
												{
													echo $food_orders["ordered_items"];?> <b class="badge bg-warning pull-right"><?php echo $food_orders["order_cnt"];?></b>
											<?php
												}
											?>
										</td>
										<td>
											<?php
												if($food_orders["order_list_status"] == "3")
												{
													echo $food_orders["ordered_items"];?> <b class="badge bg-warning pull-right"><?php echo $food_orders["order_cnt"];?></b>
											<?php
												}
											?>
										</td>
                                        
                                      </tr>
                                      
                                    </tbody>
                                  </table> 
                              
                          </div>
                          </div>
                        </div>
                      </section>
                </section>
			<?php
				}
				echo "<hr /><hr /><hr /><hr />";
				echo "<pre>";print_r($brkfst);print_r($lunch);print_r($dinner);echo "</pre>";
			?>
                
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
<?php 
 //function getHostelDetails('hostelId') {
//		$hostel_id='hostelId';

//	}
?>
</body>
</html>

<script type="text/javascript" language="JavaScript">

	function getHostelDetails(hostelId) {
		
		
	}
	
	
</script>