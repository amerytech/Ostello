<?php
session_start();
ob_start();

include_once('../admin/includes/config.php');
if (!isset($_SESSION['id_staff'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include_once('../admin/includes/config.php');
        $dateToInsert = $_GET['today'];
        $hostelid = $_GET['hostelid'];
        //  to store/edit only the existing dates
        $var = $_GET['today'];
        $storetoday = date('Y-m-d', strtotime($date));
       /* $now = date('Y-m-d'); // or your date as well
        
        $now1=date('Y-m-d', strtotime($now));
       
        $diff = $now1 - $storetoday;
        $days =floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));*/
        $dateToInsert2 =date('Y-m-d',  strtotime($_GET['today']));
        $fixdate=date('Y-m-d', strtotime("+2 days"));
//        $fixdate=date('Y-m-d', strtotime("+2 days"));
        
//        echo "Today is " . date("Y/m/d", strtotime("+2 days")) . "<br>";
//       echo "$fixdate"."<br>";
//       echo "$dateToInsert2" ;
//       exit;
        
        $fetchprepared = $conn->query("select * from os_staff_prepared where prepared_date='" . $dateToInsert . "' and id_hostel='" . $hostelid . "' ");
        $preparedresult = $fetchprepared->fetch_assoc();
        $countresult = mysqli_num_rows($fetchprepared);
        ?>
        <title>Ostello | Hostel-User </title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Stylesheets -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href="stylesheets/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css" media="all" /> 
        <link href="stylesheets/animate.min.css" rel="stylesheet" type="text/css" media="all" />  
        <link rel="stylesheet" type="text/css" href="stylesheets/base.css" /> 
        <link href="stylesheets/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Quicksand:400,700,300">
        <link rel="shortcut icon" href="img/fav-icon.png" />
    </head>
    <body>
        <!-- Start Wrapper -->
        <div id="page_wrapper">

            <!-- Start Header -->
            <header>
                <div class="container-fluid">
                    <div class="containeer">
                        <!-- Start Social Icons -->
                        <aside>
                            <ul class="social">
                                <li class="facebook"><a href="#">Facebook</a></li>
                                <li class="twitter"><a href="#">Twitter</a></li>
                                <li class="email"><a href="#">Email</a></li>
                                <li class="rss"><a href="#">RSS</a></li>
                            </ul>
                        </aside>

                        <nav>
                            <ul>
                                <li><a href="index.php"><i class="fa fa-arrow-circle-left"></i> User Home</a></li>
                                <li> Food Order </li>
                            </ul>
                            <span class="arrow"></span>
                        </nav>
                        <!-- End Social Icons -->
                    </div>
                </div>
            </header>
            <!-- End Header -->

            <section>
                <div class="products">
                    <div class="container">
                        <div class="col-md-3 rsidebar">
                            <div class="related-row">
                                <h4 class="text-center">Food Menu</h4> 
                                <ul class="nav nav-pills nav-justified">
                                    <li role="presentation" class="active"><a href="foodmenu.php#tiffin" aria-controls="home" role="tab" data-toggle="tab"> Breakfast </a></li>
                                    <li role="presentation"><a href="foodmenu.php#lunch" aria-controls="profile" role="tab" data-toggle="tab"> <i></i> Lunch </a></li>
                                    <li role="presentation"><a href="foodmenu.php#dinner" aria-controls="messages" role="tab" data-toggle="tab"> Dinner </a></li>
                                </ul>       
                            </div>
                            <div class="related-row">
                                <h4 class="text-center">Breakfast</h4> 
                                <ul class="nav nav-pills nav-justified" id="selectedBreakfast"></ul>
                                <h4 class="text-center">Lunch</h4> 
                                <ul class="nav nav-pills nav-justified" id="selectedLunch"></ul>
                                <h4 class="text-center">Dinner</h4> 
                                <ul class="nav nav-pills nav-justified" id="selectedDinner"></ul>

                            </div>
                        </div>
                        <div id="showMessage" style="display:none;" class="alert-sucess">
                            <span id="showMessage" class="sucess">
                                <?php
                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                }
                                ?>	
                            </span>
                        </div>	
                        <form id="foodForm">        
                            <?php $_SESSION['today'] = $_GET['today']; ?>
                            <input type="hidden" name="hostel_id" value="<?php echo $_SESSION['hostel_id']; ?>">
                            <input type="hidden" name="date_insert" value="<?php echo $_SESSION['today']; ?>">

                            <div class="col-md-9 product-w3ls-right">
                                <div class="clearfix"></div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tiffin">
                                        <input type="hidden" name="hostel_id" value="<?php echo $_SESSION['hostel_id']; ?>">
                                        <input type="hidden" name="date_insert" value="<?php echo $_GET['today']; ?>">
                                        <div class="product-top">
                                            <h4>Breakfast Menu</h4>
                                            <ul> 
                                                <li class="dropdown head-dpdn">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Oil</a></li> 
                                                        <li><a href="#">idli</a></li>
                                                    </ul> 
                                                </li>
                                            </ul> 
                                            <div class="clearfix"> </div>
                                        </div>



                                        <div class="products-row">
                                            <?php
                                            $tq = $conn->query("select * from os_item where item_status=1 order by id_item ASC");
                                            while ($tiffen = $tq->fetch_assoc()) {
                                                ?>	
                                                <div class="col-md-3"> 
                                                    <div class="foodmenuform row text-center">
                                                        <input type="checkbox" id="<?php echo $tiffen['item_name']; ?>" class="breakfastmenu" class="tiffinmenu" name="tiffin[]" value="<?php echo $tiffen['item_name']; ?>"  <?php
                                                        $tiffincheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $tiffen['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                        if (mysqli_num_rows($tiffincheck) > 0) {
                                                            ?> checked <?php
                                                               }
                                                               ?>  hidden="">
                                                        <label for="<?php echo $tiffen['item_name']; ?>"><img src="img/itemsmenu/<?php echo $tiffen['item_image']; ?>" class="img img-responsive" /></label>
                                                        <h3><?php echo $tiffen['item_name']; ?></h3>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="clearfix"></div>
                                        </div>

                                        <hr>
                                        <div class="full">
                                            <div class="product-top">
                                                <h4>Breakfast Top-up Menu</h4>
                                                <div class="clearfix"> </div>
                                            </div>


                                            <div class="products-row">
                                                <?php
                                                $top = $conn->query("select * from  os_item where item_status=4 ");
                                                while ($tiffen_topup = $top->fetch_assoc()) {
                                                    ?>	
                                                    <div class="col-md-3"> 
                                                        <div class="foodmenuform row text-center">
                                                            <input type="checkbox" id="<?php echo $tiffen_topup['item_name']; ?>" class="breakfastmenu" value="<?php echo $tiffen_topup['item_name']; ?>" name="tiffen_topup[]"  <?php
                                                            $tiffintopcheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $tiffen_topup['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                            if (mysqli_num_rows($tiffintopcheck) > 0) {
                                                                ?> checked <?php
                                                                   }
                                                                   ?>  hidden="">
                                                            <label for="<?php echo $tiffen_topup['item_name']; ?>"><img src="img/itemsmenu/<?php echo $tiffen_topup['item_image']; ?>" class="img img-responsive" /></label>
                                                            <h3><?php echo $tiffen_topup['item_name']; ?></h3>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="tab-pane" id="lunch">
                                        <input type="hidden" name="hostel_id" value="<?php echo $_SESSION['hostel_id']; ?>">
                                        <input type="hidden" name="date_insert" value="<?php echo $_GET['today']; ?>">
                                        <div class="product-top">
                                            <h4>Lunch Menu</h4>
                                            <ul> 
                                                <li class="dropdown head-dpdn">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Rice</a></li> 
                                                        <li><a href="#">Curry</a></li>
                                                    </ul> 
                                                </li>
                                            </ul> 
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="products-row">
                                            <?php
                                            $lunch = $conn->query("select * from os_item where item_status=2 order by id_item ASC")or die(mysql_error());
                                            while ($lunchresult = $lunch->fetch_assoc()) {
                                                ?>	
                                                <div class="col-md-3"> 
                                                    <div class="foodmenuform row text-center">
                                                        <input type="checkbox" id="<?php echo $lunchresult['item_name']; ?>" class="lunchmenu"  value="<?php echo $lunchresult['item_name']; ?>" name="lunch[]"   <?php
                                                        $lunchcheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $lunchresult['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                        if (mysqli_num_rows($lunchcheck) > 0) {
                                                            ?> checked <?php
                                                               }
                                                               ?> hidden>
                                                        <label for="<?php echo $lunchresult['item_name']; ?>"><img src="img/itemsmenu/<?php echo $lunchresult['item_image']; ?>" class="img img-responsive" /></label>
                                                        <h3><?php echo $lunchresult['item_name']; ?></h3>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="clearfix"></div>
                                        </div>
                                        <hr>
                                        <div class="full">
                                            <div class="product-top">
                                                <h4>Lunch Top-up Menu</h4>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="products-row">
                                                <?php
                                                $toplunch = $conn->query("select * from os_item where item_status=5 ")or die(mysqli_error);
                                                while ($lunch_topup = $toplunch->fetch_assoc()) {
                                                    ?>	
                                                    <div class="col-md-3"> 
                                                        <div class="foodmenuform row text-center">
                                                            <input type="checkbox" id="<?php echo $lunch_topup['item_name']; ?>" class="lunchmenu" value="<?php echo $lunch_topup['item_name']; ?>" name="lunch_topup[]"   <?php
                                                            $lunchtopcheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $lunch_topup['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                            if (mysqli_num_rows($lunchtopcheck) > 0) {
                                                                ?> checked <?php
                                                                   }
                                                                   ?>  hidden>
                                                            <label for="<?php echo $lunch_topup['item_name']; ?>"><img src="img/itemsmenu/<?php echo $lunch_topup['item_image']; ?>" class="img img-responsive" /></label>
                                                            <h3><?php echo $lunch_topup['item_name']; ?></h3>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="tab-pane" id="dinner">
                                        <input type="hidden" name="hostel_id" value="<?php echo $_SESSION['hostel_id']; ?>">
                                        <input type="hidden" name="date_insert" value="<?php echo $_GET['today']; ?>">
                                        <div class="product-top">
                                            <h4>Dinner Menu</h4>
                                            <ul> 
                                                <li class="dropdown head-dpdn">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter By<span class="caret"></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">Currys</a></li> 
                                                        <li><a href="#">Rice</a></li>
                                                    </ul> 
                                                </li>
                                            </ul> 
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="products-row">
                                            <?php
                                            $dinner = $conn->query("select * from os_item where item_status=3 order by id_item ASC")or die(mysql_error());
                                            while ($dinnerresult = $dinner->fetch_assoc()) {
                                                ?>	
                                                <div class="col-md-3"> 
                                                    <div class="foodmenuform row text-center">
                                                        <input type="checkbox" id="<?php echo $dinnerresult['item_name']; ?>" class="dinnermenu" value="<?php echo $dinnerresult['item_name']; ?>" name="dinner[]"   <?php
                                                        $dinnercheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $dinnerresult['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                        if (mysqli_num_rows($dinnercheck) > 0) {
                                                            ?> checked <?php
                                                               }
                                                               ?>  hidden>
                                                        <label for="<?php echo $dinnerresult['item_name']; ?>"><img src="img/itemsmenu/<?php echo $dinnerresult['item_image']; ?>" class="img img-responsive" /></label>
                                                        <h3><?php echo $dinnerresult['item_name']; ?></h3>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="clearfix"></div>
                                        </div>
                                        <hr>
                                        <div class="full">
                                            <div class="product-top">
                                                <h4>Dinner Top-up Menu</h4>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="products-row">
                                                <?php
                                                $topdinner = $conn->query("select * from os_item where item_status=6 ")or die(mysqli_error);
                                                while ($dinner_topup = $topdinner->fetch_assoc()) {
                                                    ?>	
                                                    <div class="col-md-3"> 
                                                        <div class="foodmenuform row text-center">
                                                            <input type="checkbox" id="<?php echo $dinner_topup['item_name']; ?>" class="dinnermenu"  value="<?php echo $dinner_topup['item_name']; ?>" name="dinner_topup[]"   <?php
                                                            $dinnertopcheck = $conn->query("select item_name from os_staff_prepared where item_name='" . $dinner_topup['item_name'] . "' and prepared_date='" . $_GET['today'] . "' ");
                                                            if (mysqli_num_rows($dinnertopcheck) > 0) {
                                                                ?> checked <?php
                                                                   }
                                                                   ?>  hidden>
                                                            <label for="<?php echo $dinner_topup['item_name']; ?>"><img src="img/itemsmenu/<?php echo $dinner_topup['item_image']; ?>" class="img img-responsive" /></label>
                                                            <h3><?php echo $dinner_topup['item_name']; ?></h3>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- only to enter existing dates -->
                                    <?php  if($dateToInsert2>$fixdate){ ?>
                                    <button id="foodSubmit"  class="btn btn-primary btn-lg btn-block">Submit Food Menu</button>
                                    <?php  }
                                    else{?>
                                     <button  class="btn btn-primary btn-lg btn-block">Cannot add or edit this day</button>
                                     <?php  }
                                    ?>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </section>

            <!-- footer-top -->
            <div class="w3agile-ftr-top">
                <div class="container">
                    <div class="ftr-toprow">
                        <div class="col-md-4 ftr-top-grids">
                            <div class="ftr-top-left">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </div> 
                            <div class="ftr-top-right">
                                <h4>FRESH FOOD</h4>
                                <p>Fresh food we provide, in Time</p>
                            </div> 
                            <div class="clearfix"> </div>
                        </div> 
                        <div class="col-md-4 ftr-top-grids">
                            <div class="ftr-top-left">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div> 
                            <div class="ftr-top-right">
                                <h4>CUSTOMER CHOICE</h4>
                                <p>Customer Choice Food We provide</p>
                            </div> 
                            <div class="clearfix"> </div>
                        </div>
                        <div class="col-md-4 ftr-top-grids">
                            <div class="ftr-top-left">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </div> 
                            <div class="ftr-top-right">
                                <h4>GOOD QUALITY</h4>
                                <p>Only Good Quality food we provide</p>
                            </div>
                            <div class="clearfix"> </div>
                        </div> 
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>

            <!-- Start Footer -->
            <footer class="containeer">
                <p>Ostello &copy; 2016. All Rights Reserved.</p>
            </footer>
            <!-- End Footer -->

        </div>
        <!-- End Wrapper -->

        <script type="text/javascript" src="javascripts/jquery-2.2.3.min.js"></script> 
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <script type="text/javascript" src="javascripts/jquery-scrolltofixed-min.js"></script>
        <script type="text/javascript" src="javascripts/easing.js"></script>	
        <script type="text/javascript" src="javascripts/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
        <script type="text/javascript" id="sourcecode">
            $(function ()
            {
                $('.scroll-pane').jScrollPane();
            });
        </script>
    </body>
</html>
<script type="text/javascript" language="JavaScript">
    $(document).ready(function () {
         $("#showMessage").hide();
        
        $(".breakfastmenu").ready(function () {
            var checkedTiffen = $('.breakfastmenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join("<br>");
            $("#selectedBreakfast").html(checkedTiffen);
        }).click(function () {
            var checkedTiffen = $('.breakfastmenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join("<br>");
            $("#selectedBreakfast").html(checkedTiffen);
        });

        $(".lunchmenu").ready(function () {
            var checkedlunch = $('.lunchmenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join(" ");
            $("#selectedLunch").html(checkedlunch);
        }).click(function () {
            var checkedlunch = $('.lunchmenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join(" ");
            $("#selectedLunch").html(checkedlunch);
        });

        $(".dinnermenu").ready(function () {
            var checkeddinner = $('.dinnermenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join("<br>");

            $("#selectedDinner").html(checkeddinner);
        }).click(function () {
            var checkeddinner = $('.dinnermenu:checkbox:checked').map(function () {
                return '<li role="presentation" class="active"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true"> ' + $(this).attr('value') + ' </a></li>';
            }).get().join("<br>");

            $("#selectedDinner").html(checkeddinner);
        });

    });
    $("#foodSubmit").click(function () {
        $.ajax({
            url: "foodcontroller.php",
            method: "POST",
            data: {foodData: $("#foodForm").serialize(), 'action': 'addfood'},
            dataType: "json",
            success: function (response) {
                if (response["success"] == true)
                {
                    $("#showMessage").show();
                    $("#showMessage").html(response["message"]);
                } else {
                    $("#warning-message").show();
                    $("#warning-message").html(response["message"]);
                }
            },
            error: function (request, status, error) {
                $("#warning-message").show();
                $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
            }
        });
        return false;













        // $.ajax({
        // url: "foodcontroller.php",
        // method: "POST",
        // data: { foodData : $("#FoodForm").serialize(), 'action':'addfood'},
        // dataType: "json",
        // success: function (response) {
        // if(response["success"]==true)
        // {
        // $("#showMessage").html(response['message']);
        // console.log(1);
        // return false;
        // }
        // else
        // {
        // $("#showMessage").html(response['message']);
        // console.log(2);
        // return false;
        // }
        // },
        // error: function (request, status, error) {
        // $("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
        // return false;
// console.log(3);
        // }
        // });
    });
</script>