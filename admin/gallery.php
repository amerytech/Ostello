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
	
?>

        <section id="content">
          <section class="vbox bg-white">
            <header class="header b-b b-light">
              <p>Banners Uploads</p>
            </header>
            <section class="scrollable">
              <div class="m-t-lg clearfix wrapper-lg animated fadeInLeftBig ">
               	<div class="row">
                  <div class="col-sm-6  animated fadeInRightBig">
                      <section class="panel panel-default">
                        <header class="panel-heading font-bold">Food Menu Images Upload</header>
                            <div class="panel-body">
                                <form class="bs-example form-horizontal" action="controller.php" method="post" enctype="multipart/form-data" >
                                <div class="form-group">
                                   <label class="col-sm-3 control-label">Select Image</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="action" value="imagemenu">
                                        <input type="file" class="filestyle" data-icon="false" data-classButton="btn btn-default" name="photo" data-classInput="form-control inline input-s">			
                                        <span class="help-block m-b-none">This image Uplode For Food Menu</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Food Menu Title</label>
                                  <div class="col-lg-9">
                                    <input type="text" name="foodname" class="form-control" placeholder="Food Menu Title">
                                    <span class="help-block m-b-none">Food Menu Title</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Select Menu</label>
                                  <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="1"> Break Fast
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="2"> Lunch
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="3"> Dinner
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label">Top-up</label>
                                  <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="4"> Break Fast
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="5"> Lunch
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="6"> Dinner
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-offset-3 col-lg-9">
                                    <button type="submit" class="btn btn-md btn-primary">Upload</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                      </section>
                  </div>
                  <!--<div class="col-sm-6 animated fadeInLeftBig">
                      <section class="panel panel-default">
                        <header class="panel-heading font-bold">Landing Page Banners Upload</header>
                        <div class="panel-body">
                          <form class="bs-example form-horizontal">
                          	<div class="form-group">
                      		   <label class="col-sm-3 control-label">Uplode Image</label>
                      			<div class="col-sm-9">
                        			<input type="file" class="form-control">			
                                    <span class="help-block m-b-none">This image is showin in  Landing Page</span>
                      			</div>
                    		</div>
                            <div class="form-group">
                              <label class="col-lg-3 control-label">Title</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Title">
                                <span class="help-block m-b-none">Slider Title</span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Select Sliders</label>
                              <div class="col-sm-9">
                                <label class="checkbox-inline">
                                  <input type="radio" id="Slider" name="Slider" value="Slider1"> Slider 1
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="Slider" name="Slider" value="Slider2"> Slider 2
                                </label>
                                <label class="checkbox-inline">
                                  <input type="radio" id="Slider" name="Slider" value="Slider3"> Slider 3
                                </label>
                              </div>
                            </div>
                            <div>&nbsp;</div><br />
                            <div class="form-group">
                              <div class="col-lg-offset-3 col-lg-9">
                                <button type="submit" class="btn btn-md btn-primary">Upload</button>
                              </div>
                            </div>
                            
                          </form>
                        </div>
                      </section>
                    </div> -->
                
                    <div class="col-sm-6 animated fadeInRightBig">
                        <section class="panel panel-default">
                            <header class="panel-heading font-bold">Food Menu Image Edite</header>
                            <div class="panel-body">
                              <form class="bs-example form-horizontal">
                              	<div class="form-group">
                                  <label class="col-sm-3 control-label">Select Menu</label>
                                  <div class="col-sm-9">
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="Break-Fast"> Break Fast
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="Lunch"> Lunch
                                    </label>
                                    <label class="checkbox-inline">
                                      <input type="radio" id="Menu" name="Menu" value="Dinner"> Dinner
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">Search Food menu Title</label>
                                  <div class="col-lg-9">
                                  	<div class="input-group">
                                  		<input type="text" class="form-control" placeholder="Search Food menu Title" />
                                        <span class="input-group-btn">
                           					<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                          			  	</span>
                                    </div>  
                                </div>
                                 </div>
                              </form>
                                <div class="line line-dashed line-lg pull-in"></div>
                              <form class="bs-example form-horizontal">
                                <div class="form-group">
                      		   <label class="col-sm-3 control-label">Select Image</label>
                      			<div class="col-sm-9">
                        			<input type="file" class="form-control">			
                                    <span class="help-block m-b-none">This image Uplode For Food Menu</span>
                      			</div>
                    		</div>  
                                <div class="form-group">
                                  <div class="col-lg-offset-3 col-lg-9">
                                    <button type="submit" class="btn btn-md btn-primary">Upload</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </section>
                    </div>
                </div>               
              </div>
            </section>
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
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <script src="js/file-input/bootstrap-filestyle.min.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/libs/underscore-min.js"></script>
<script src="js/prettyphoto/jquery.prettyPhoto.js"></script>  
<script src="js/grid/jquery.grid-a-licious.min.js"></script>
<script src="js/grid/gallery.js"></script>

</body>
</html>