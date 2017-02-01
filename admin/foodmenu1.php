<?php
	session_start();
	
	/*if(!empty($_POST) && isset($_POST["hid"]))
	{
		//echo "HOSTEL ID ===> ".$_POST["hid"];
	}*/
	
	if(!empty($_GET) && isset($_GET["hid"]) && $_GET["hid"] > 0 && $_GET["hid"]!="")
	{
		$hid = addslashes(strip_tags(trim($_GET["hid"])));
	}
	
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
								<!--<a href="javascript:void(0)" onclick="getHostelDetails(<?php echo $hostelfetch['id_hostel']; ?>)"  data-toggle="tab">-->
                                <a href="foodmenu1.php?hid=<?php echo $hostelfetch['id_hostel'];?>">
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
				//$get_food_orders = $conn->query("SELECT ordered_items,COUNT(ordered_items) as order_cnt,order_list_status,ordered_date FROM `os_order_items` WHERE hostel_id = '30' GROUP BY ordered_items,ordered_date");
				$get_food_orders = $conn->query("SELECT ordered_items,COUNT(ordered_items) as order_cnt,order_list_status,ordered_date FROM `os_order_items` WHERE hostel_id = '".$hid."' GROUP BY ordered_items,ordered_date");
				
				$dates = array();
				$food = array();
				
				while($food_orders = mysqli_fetch_assoc($get_food_orders))
				{
					$food[$food_orders["ordered_date"]]["Item"][] = $food_orders["ordered_items"];
					$food[$food_orders["ordered_date"]]["Count"][] = $food_orders["order_cnt"];
					$food[$food_orders["ordered_date"]]["Status"][] = $food_orders["order_list_status"];
				}
			?>
				<section class="scrollable wrapper w-f">
                      <section class="panel panel-default">
                      	<div class="tab-content table-responsive" id="hosteldetails"> 
                        <?php
							foreach($food as $key => $value)
							{
						?>
                              <table class="table table-striped m-b-none text-center">
                                    <thead>
                                      <tr>
                                      	<th colspan="4" class="text-center"><?php echo $key;?></th>
                                      </tr>
                                      <tr>
                                        <th class="text-center"> Breakfast </th>
                                        <th class="text-center">Lunch</th>
                                        <th class="text-center">Dinner</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                      	<td>
                                        	<ul class='list-unstyled list-inline'>
                                            	<!--<li>-->
											<?php
                                               if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "1")
                                                        {
                                                            echo "<li>".ucwords($v)." <b class='badge bg-warning'>".$value["Count"][$k]."</b>"."</li>";
                                                        }
                                                    }
                                                }
                                            ?>
                                             <!--</li>-->
                                            </ul>
                                        </td>
                                        <td>
                                        <ul class='list-unstyled list-inline'>
                                          <!--<li>-->
                                            <?php
                                                if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "2")
                                                        {
                                                            echo "<li>".ucwords($v)." <b class='badge bg-warning'>".$value["Count"][$k]."</b>"."</li>";
                                                        }
                                                    }
                                                }
                                            ?>
                                              <!--</li>-->
                                            </ul>
                                        </td>
                                        <td>
                                        	<ul class="list-unstyled list-inline">
                                             <!--<li>-->
                                            <?php
                                                if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "3")
                                                        {
                                                            echo "<li>".ucwords($v)." <b class='badge bg-warning'>".$value["Count"][$k]."</b>"."</li>";
                                                        }
                                                    }
                                                }
                                            ?>
                                            	<!--</li>-->
                                            </ul>
                                        </td>
                                      </tr>
                                      
                                    </tbody>
                                  </table>
							<?php
								}
							?> 
                              
                          </div>
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
<?php 
 //function getHostelDetails('hostelId') {
//		$hostel_id='hostelId';

//	}
?>
</body>
</html>

<!--<script type="text/javascript" language="JavaScript">
	function getHostelDetails(hostelId)
	{
		$.ajax({
			type:"POST",
			url:"foodmenu1.php",
			data:{"hid":hostelId},
			success:function(response)
			{
				console.log(response);
				//alert("Success");
				alert(response);
			},
			error:function(response)
			{
				alert("Error");
			}
		});
	}
</script>-->