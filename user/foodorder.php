<?php
ob_start();
session_start();
include_once('../admin/includes/config.php');

if (!isset($_SESSION['id_user'])) {
    header('location:../index.php');
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ostello | Hostel-User </title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Stylesheets -->
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
            <input type="hidden" id="user_id" value="<?php echo "$_SESSION[id_user]"; ?>">
            <section>
                <div class="products">
                    <div class="container">
                        <div class="col-md-3 rsidebar">
                            <div class="rsidebar-top">
                                <div class="slider-left">
                                    <h4 class="text-center">View Your Cart Here</h4>            
                                    <div class="row row1">
                                        <div class="cart"> 
                                            <form action="#" method="post" class="last"> 
                                                <input type="hidden" name="cmd" value="_cart" />
                                                <input type="hidden" name="display" value="1" />
                                                <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> CART</button>						                        </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="related-row">
                                <h4 class="text-center">Food Menu</h4> 
                                <ul class="nav nav-pills nav-justified">
                                    <li role="presentation" class="active"><a href="#tiffin" aria-controls="home" role="tab" data-toggle="tab"> Breakfast </a></li>
                                    <li role="presentation"><a href="#launch" aria-controls="profile" role="tab" data-toggle="tab"> <i></i> Launch </a></li>
                                    <li role="presentation"><a href="#dinner" aria-controls="messages" role="tab" data-toggle="tab"> Dinner </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 product-w3ls-right">
                            <div class="clearfix"></div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tiffin">
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
                                        $getdate = $_GET['ordereddate'];
//                                          echo "select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=1  and a.prepared_date='".$getdate."'";
                                        $tq = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=1  and a.prepared_date='" . $getdate . "'");
//                                            $tiffin2 = $tq->fetch_assoc();
//                                              $emailCount = mysqli_num_rows($tiffin2);
//                                              echo "$emailCount";
                                        $n = mysqli_num_rows($tq);
                                        if ($n) {


                                            while ($tiffen = $tq->fetch_assoc()) {
                                                ?>
                                                <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/<?php echo $tiffen['img']; ?>" class="img-responsive" alt="<?php echo $tiffen['item_name']; ?>"></a>
                                                        <div class="agile-product-text">              
                                                            <form action="#" method="post">
                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                <input type="hidden" name="add" value="1" /> 
                                                                <input type="hidden" name="w3ls_item" value="<?php echo $tiffen['item_name']; ?>" /> 
                                                                <input type="hidden" name="amount" value="<?php echo $tiffen['amount']; ?>" />
                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                            </form> 
                                                        </div>
                                                    </div> 
                                                </div>
                                                <?php
                                            }
//                                        $tiffin = $tq->fetch_assoc();
//                                        echo rowCount($tiffen
//                                         $emailCount = mysqli_num_rows($tiffen);
                                        } else {
                                            ?>
                                            <div class="col-md-3 product-grids"> 
                                                <div class="agile-products">
                                                    <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                    <!--                                                <div class="agile-product-text">              
                                                                                                        <form action="#" method="post">
                                                                                                            <input type="hidden" name="cmd" value="_cart" />
                                                                                                            <input type="hidden" name="add" value="1" /> 
                                                                                                            <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                            <input type="hidden" name="amount" value="" />
                                                                                                            <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                        </form> 
                                                                                                    </div>-->
                                                </div> 
                                            </div>

                                        <?php }
                                        ?>

                                        <div class="clearfix"> &nbsp; </div>
                                    </div>
                                    <hr>
                                    <div class="full">
                                        <div class="product-top">
                                            <h4 class="center-block"> Breakfast Top-up Menu </h4>
                                            <div class="clearfix"> </div>
                                        </div> 
                                        <div class="products-row">
                                            <?php
//                                          echo "select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=1  and a.prepared_date='".$getdate."'";
                                            $ttup = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=4  and a.prepared_date='" . $getdate . "'");
                                            $tuc = mysqli_num_rows($ttup);
                                            if ($tuc) {

                                                while ($ttopup = $ttup->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-3 product-grids"> 
                                                        <div class="agile-products">
                                                            <a href="#"><img src="../staff/img/itemsmenu/<?php echo $ttopup['img']; ?>" class="img-responsive" alt="<?php echo $ttopup['item_name']; ?>"></a>
                                                            <div class="agile-product-text">              
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" /> 
                                                                    <input type="hidden" name="w3ls_item" value="<?php echo $ttopup['item_name']; ?>" /> 
                                                                    <input type="hidden" name="amount" value="<?php echo $ttopup['amount']; ?>" />
                                                                    <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                </form> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                        <!--                                                <div class="agile-product-text">              
                                                                                                            <form action="#" method="post">
                                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                                <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                                <input type="hidden" name="amount" value="" />
                                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                            </form> 
                                                                                                        </div>-->
                                                    </div> 
                                                </div><?php }
                                            ?>

                                            <div class="clearfix"> &nbsp; </div>
                                        </div>                       
                                    </div>
                                </div>    
                                <div class="tab-pane" id="launch">
                                    <div class="product-top">
                                        <h4>Launch Menu</h4>
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
//                                          echo "select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=1  and a.prepared_date='".$getdate."'";
                                        $luq = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=2  and a.prepared_date='" . $getdate . "'");
                                        $lu = mysqli_num_rows($luq);
                                        if ($lu) {
                                            while ($lunch = $luq->fetch_assoc()) {
                                                ?>
                                                <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/<?php echo $lunch['img']; ?>" class="img-responsive" alt="<?php echo $lunch['item_name']; ?>"></a>
                                                        <div class="agile-product-text">              
                                                            <form action="#" method="post">
                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                <input type="hidden" name="add" value="1" /> 
                                                                <input type="hidden" name="w3ls_item" value="<?php echo $lunch['item_name']; ?>" /> 
                                                                <input type="hidden" name="amount" value="<?php echo $lunch['amount']; ?>" />
                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                            </form> 
                                                        </div>
                                                    </div> 
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-md-3 product-grids"> 
                                                <div class="agile-products">
                                                    <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                    <!--                                                <div class="agile-product-text">              
                                                                                                        <form action="#" method="post">
                                                                                                            <input type="hidden" name="cmd" value="_cart" />
                                                                                                            <input type="hidden" name="add" value="1" /> 
                                                                                                            <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                            <input type="hidden" name="amount" value="" />
                                                                                                            <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                        </form> 
                                                                                                    </div>-->
                                                </div> 
                                            </div>
                                            <!--                                           
<?php }
?>
                                        <!--                                        <div class="col-md-3 product-grids">
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text"> 
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                <input type="hidden" name="w3ls_item" value="Dosa" /> 
                                                                                                <input type="hidden" name="amount" value="300.00" /> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3 product-grids"> 
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text"> 
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart"/>
                                                                                                <input type="hidden" name="add" value="1"/> 
                                                                                                <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                                <input type="hidden" name="amount" value="70.00"/> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>  
                                                                                </div>
                                                                                <div class="col-md-3 product-grids">
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text">
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart"/>
                                                                                                <input type="hidden" name="add" value="1"/> 
                                                                                                <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                                <input type="hidden" name="amount" value="80.00"/> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-md-3 product-grids">
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text">              
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart"/>
                                                                                                <input type="hidden" name="add" value="1"/> 
                                                                                                <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                                <input type="hidden" name="amount" value="80.00"/> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3 product-grids"> 
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text">              
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart"/>
                                                                                                <input type="hidden" name="add" value="1"/> 
                                                                                                <input type="hidden" name="w3ls_item" value="Dosa"/> 
                                                                                                <input type="hidden" name="amount" value="70.00"/> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>  
                                                                                </div> 
                                                                                <div class="col-md-3 product-grids"> 
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text">              
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                <input type="hidden" name="w3ls_item" value="Dosa" /> 
                                                                                                <input type="hidden" name="amount" value="100.00" /> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form> 
                                                                                        </div>
                                                                                    </div> 
                                                                                </div> 
                                                                                <div class="col-md-3 product-grids">
                                                                                    <div class="agile-products">
                                                                                        <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                        <div class="agile-product-text">              
                                                                                            <form action="#" method="post">
                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                <input type="hidden" name="w3ls_item" value="Idli" /> 
                                                                                                <input type="hidden" name="amount" value="300.00" /> 
                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                        <div class="clearfix"> &nbsp;</div>
                                    </div>
                                    <hr>
                                    <div class="full">
                                        <div class="product-top">
                                            <h4>Launch Top-up Menu</h4>
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="products-row">
                                            <?php
//                                          echo "select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=1  and a.prepared_date='".$getdate."'";
                                            $ltup = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=5  and a.prepared_date='" . $getdate . "'");
                                            $lutup = mysqli_num_rows($ltup);
                                            if ($lutup) {
                                                while ($lunchtopup = $ltup->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-3 product-grids"> 
                                                        <div class="agile-products">
                                                            <a href="#"><img src="../staff/img/itemsmenu/<?php echo $lunchtopup['img']; ?>" class="img-responsive" alt="<?php echo $lunchtopup['item_name']; ?>"></a>
                                                            <div class="agile-product-text">              
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" /> 
                                                                    <input type="hidden" name="w3ls_item" value="<?php echo $lunchtopup['item_name']; ?>" /> 
                                                                    <input type="hidden" name="amount" value="<?php echo $lunchtopup['amount']; ?>" />
                                                                    <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                </form> 
                                                            </div>
                                                        </div> 
                                                    </div>
    <?php }
} else { ?> <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                        <!--                                                <div class="agile-product-text">              
                                                                                                            <form action="#" method="post">
                                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                                <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                                <input type="hidden" name="amount" value="" />
                                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                            </form> 
                                                                                                        </div>-->
                                                    </div> 
                                                </div>
                                                <!--                                           
<?php }
?>
                                            <!--                                            <div class="col-md-3 product-grids">
                                                                                            <div class="agile-products">
                                                                                                <a href="#"><img src="img/ostello-kitchen/screen_8.jpg" class="img-responsive" alt="img"></a>
                                                                                                <div class="agile-product-text"> 
                                                                                                    <form action="#" method="post">
                                                                                                        <input type="hidden" name="cmd" value="_cart" />
                                                                                                        <input type="hidden" name="add" value="1" /> 
                                                                                                        <input type="hidden" name="w3ls_item" value="Topup-Rice" /> 
                                                                                                        <input type="hidden" name="amount" value="300.00" /> 
                                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>-->
                                            <div class="clearfix"> &nbsp;</div>
                                        </div>
                                    </div>        
                                </div>
                                <div class="tab-pane" id="dinner">
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
                                        $diner = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=3  and a.prepared_date='" . $getdate . "'");
                                        $dr = mysqli_num_rows($diner);
                                        if ($dr) {
                                            while ($dinner = $diner->fetch_assoc()) {
                                                ?>
                                                <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/<?php echo $dinner['img']; ?>" class="img-responsive" alt="<?php echo $dinner['item_name']; ?>"></a>
                                                        <div class="agile-product-text">              
                                                            <form action="#" method="post">
                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                <input type="hidden" name="add" value="1" /> 
                                                                <input type="hidden" name="w3ls_item" value="<?php echo $dinner['item_name']; ?>" /> 
                                                                <input type="hidden" name="amount" value="<?php echo $dinner['amount']; ?>" />
                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                            </form> 
                                                        </div>
                                                    </div> 
                                                </div>
    <?php }
} else { ?> <div class="col-md-3 product-grids"> 
                                                <div class="agile-products">
                                                    <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                    <!--                                                <div class="agile-product-text">              
                                                                                                        <form action="#" method="post">
                                                                                                            <input type="hidden" name="cmd" value="_cart" />
                                                                                                            <input type="hidden" name="add" value="1" /> 
                                                                                                            <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                            <input type="hidden" name="amount" value="" />
                                                                                                            <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                        </form> 
                                                                                                    </div>-->
                                                </div> 
                                            </div>
                                            <!--                                           
<?php }
?>
                                        <!--                                <div class="col-md-3 product-grids">
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text"> 
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart" />
                                                                                        <input type="hidden" name="add" value="1" /> 
                                                                                        <input type="hidden" name="w3ls_item" value="Dosa" /> 
                                                                                        <input type="hidden" name="amount" value="300.00" /> 
                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 product-grids"> 
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text"> 
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart"/>
                                                                                        <input type="hidden" name="add" value="1"/> 
                                                                                        <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                        <input type="hidden" name="amount" value="70.00"/> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>  
                                                                        </div>
                                                                        <div class="col-md-3 product-grids">
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text">
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart"/>
                                                                                        <input type="hidden" name="add" value="1"/> 
                                                                                        <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                        <input type="hidden" name="amount" value="80.00"/> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-3 product-grids">
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text">              
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart"/>
                                                                                        <input type="hidden" name="add" value="1"/> 
                                                                                        <input type="hidden" name="w3ls_item" value="Idli"/> 
                                                                                        <input type="hidden" name="amount" value="80.00"/> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 product-grids"> 
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text">              
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart"/>
                                                                                        <input type="hidden" name="add" value="1"/> 
                                                                                        <input type="hidden" name="w3ls_item" value="Dosa"/> 
                                                                                        <input type="hidden" name="amount" value="70.00"/> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                        <div class="col-md-3 product-grids"> 
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text">              
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart" />
                                                                                        <input type="hidden" name="add" value="1" /> 
                                                                                        <input type="hidden" name="w3ls_item" value="Dosa" /> 
                                                                                        <input type="hidden" name="amount" value="100.00" /> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form> 
                                                                                </div>
                                                                            </div> 
                                                                        </div> 
                                                                        <div class="col-md-3 product-grids">
                                                                            <div class="agile-products">
                                                                                <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                <div class="agile-product-text">              
                                                                                    <form action="#" method="post">
                                                                                        <input type="hidden" name="cmd" value="_cart" />
                                                                                        <input type="hidden" name="add" value="1" /> 
                                                                                        <input type="hidden" name="w3ls_item" value="Idli" /> 
                                                                                        <input type="hidden" name="amount" value="300.00" /> 
                                                                                        <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
                                        <div class="clearfix"> </div>
                                    </div>
                                    <hr>
                                    <div class="full">
                                        <div class="product-top">
                                            <h4>Dinner Top-up Menu</h4>
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="products-row">
                                            <?php
                                            $dnrtup = $conn->query("select a.*,b.item_amount as amount,b.item_image as img from os_staff_prepared a left join os_item b on a.item_name=b.item_name where a.type=6  and a.prepared_date='" . $getdate . "'");
                                            $drtup = mysqli_num_rows($dnrtup);
                                            if ($drtup) {
                                                while ($dinnertopup = $dnrtup->fetch_assoc()) {
                                                    ?>
                                                    <div class="col-md-3 product-grids"> 
                                                        <div class="agile-products">
                                                            <a href="#"><img src="../staff/img/itemsmenu/<?php echo $dinnertopup['img']; ?>" class="img-responsive" alt="<?php echo $dinnertopup['item_name']; ?>"></a>
                                                            <div class="agile-product-text">              
                                                                <form action="#" method="post">
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" /> 
                                                                    <input type="hidden" name="w3ls_item" value="<?php echo $dinnertopup['item_name']; ?>" /> 
                                                                    <input type="hidden" name="amount" value="<?php echo $dinnertopup['amount']; ?>" />
                                                                    <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                </form> 
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-md-3 product-grids"> 
                                                    <div class="agile-products">
                                                        <a href="#"><img src="../staff/img/itemsmenu/menuostello.png" class="img-responsive" alt="q"></a>
                                                        <!--                                                <div class="agile-product-text">              
                                                                                                            <form action="#" method="post">
                                                                                                                <input type="hidden" name="cmd" value="_cart" />
                                                                                                                <input type="hidden" name="add" value="1" /> 
                                                                                                                <input type="hidden" name="w3ls_item" value="" /> 
                                                                                                                <input type="hidden" name="amount" value="" />
                                                                                                                <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                                            </form> 
                                                                                                        </div>-->
                                                    </div> 
                                                </div>
                                                <!--                                           
<?php }
?>
                                                                                    
                                            <!--                                <div class="col-md-3 product-grids">
                                                                                <div class="agile-products">
                                                                                    <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                    <div class="agile-product-text"> 
                                                                                        <form action="#" method="post">
                                                                                            <input type="hidden" name="cmd" value="_cart" />
                                                                                            <input type="hidden" name="add" value="1" /> 
                                                                                            <input type="hidden" name="w3ls_item" value="Dinner-topup-chapati" /> 
                                                                                            <input type="hidden" name="amount" value="300.00" /> 
                                                                                    <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 product-grids"> 
                                                                                <div class="agile-products">
                                                                                    <a href="#"><img src="img/ostello-kitchen/screen_5.jpg" class="img-responsive" alt="img"></a>
                                                                                    <div class="agile-product-text"> 
                                                                                        <form action="#" method="post">
                                                                                            <input type="hidden" name="cmd" value="_cart"/>
                                                                                            <input type="hidden" name="add" value="1"/> 
                                                                                            <input type="hidden" name="w3ls_item" value="Dinner-topup-curd"/> 
                                                                                            <input type="hidden" name="amount" value="70.00"/> 
                                                                                            <button type="submit" class="w3ls-cart pw3ls-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>  
                                                                            </div>-->
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>   
                                </div>
                                <div class="clearfix"> </div>
                                <button id="foodorder" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">checkout</button>
                                <!--POPUP FOR MESSAGE-->    
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Your Order</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p id="myshowmessage"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script type="text/javascript" src="javascripts/minicart.js"></script>
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
        <script>
            w3ls.render();

            w3ls.cart.on('w3sb_checkout', function (evt) {
                var items, len, i;

                if (this.subtotal() > 0) {
                    items = this.items();

                    for (i = 0, len = items.length; i < len; i++) {
                        items[i].set('shipping', 0);
                        items[i].set('shipping2', 0);
                    }
                }
            });

            $("#foodorder").click(function () {
                var user_id = $("#user_id").val();
                $.ajax({
                    url: "controller.php",
                    method: "POST",
                    data: {FoodData: $("#frmdata").serialize(), user_id: user_id, 'action': 'addorder'},
                    dataType: "json",
                   success: function (response) {
				if(response["success"]==true)
				{
                            $("#myshowmessage").html(response['message']);
                            


                        } else {
                            $("#myshowmessage").html(response['message']);
                        }
                    },
                    error: function (request, status, error) {
                       
                            $("#myshowmessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
                    }
                });
            });


        </script>
    </body>
</html>