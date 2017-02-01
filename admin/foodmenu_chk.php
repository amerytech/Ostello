<?php
	session_start();
	//include_once("includes/config.php");
	ob_start();
	include_once('./includes/config.php');
?>


<html>
<body>
			<?php	
				$get_food_orders = $conn->query("SELECT ordered_items,COUNT(ordered_items) as order_cnt,order_list_status,ordered_date FROM `os_order_items` WHERE hostel_id = '30' GROUP BY ordered_date,ordered_items");
				
				$dates = array();
				$food = array();
				
				while($food_orders = mysqli_fetch_assoc($get_food_orders))
				{
					$food[$food_orders["ordered_date"]]["Item"][] = $food_orders["ordered_items"];
					$food[$food_orders["ordered_date"]]["Count"][] = $food_orders["order_cnt"];
					$food[$food_orders["ordered_date"]]["Status"][] = $food_orders["order_list_status"];
				}
				
				foreach($food as $key => $value)
				{
				
			?>
				<section class="scrollable wrapper w-f">
                      <section class="panel panel-default">
                      	<div class="tab-content table-responsive" id="hosteldetails"> 
                             
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
											<?php
                                                if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "1")
                                                        {
                                                            echo $v;
                                                            echo "<b class='badge bg-warning pull-right'>".$value["Count"][$k]."</b>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "2")
                                                        {
                                                            echo $v;
                                                        }
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($value["Item"]))
                                                {
                                                    foreach($value["Item"] as $k => $v)
                                                    {
                                                        if($value["Status"][$k] == "3")
                                                        {
                                                            echo $v;
                                                        }
                                                    }
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
			?>
</body>
</html>