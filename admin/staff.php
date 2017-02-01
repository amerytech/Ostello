<?php
session_start();
include_once("includes/config.php");
include_once("includes/header.php");
include_once("includes/menu.php");
?>
<?php
$countData = $conn->query("SELECT (SELECT COUNT(*) FROM os_staff) as staffcount ,(SELECT COUNT(*) FROM os_hostel) as hostelcount");
$count = $countData->fetch_assoc();
// print_r($count);
// exit;
?>
<link rel="stylesheet" href="js/slider/slider.css" type="text/css" />
<section id="content">
    <section class="hbox stretch">
        <aside class="aside-md bg-white b-r" id="subNav">
            <div class="wrapper b-b header text-center">STAFF/HOSTEL</div>
            <ul class="nav nav-pills nav-stacked">
                <li class="b-b b-light active"><a href="#stafflist" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Staff List </a></li>
                <li class="b-b b-light"><a href="#hostellist" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Hostel List </a></li>
                <li class="b-b b-light"><a href="#addstaff" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Add Staff </a></li>
                <li class="b-b b-light"><a href="#addhostel" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Add Hostel </a></li>
                <li class="b-b b-light"><a href="#managestaff" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Manage Staff</a></li>
                <li class="b-b b-light"><a href="#managehostel" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Manage Hostel</a></li>
                <li class="b-b b-light"><a href="#managebed" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Manage Bed</a></li>
                <li class="b-b b-light"><a href="#managebedlist" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Beds list</a></li>
                 <li class="b-b b-light"><a href="#managebedtypelist" data-toggle="tab"> <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Bed type list</a></li>
            </ul>
        </aside>
        <aside>
            <section class="vbox">
                <section class="scrollable wrapper w-f">
                    <section class="panel panel-default tab-content">
                        <!--Staff Listing-->
                        <div id="success-message" style="display:none;" class="alert alert-success"></div>
                        <div id="warning-message" style="display:none;" class="alert alert-danger"></div>

                        <div class="tab-pane active" id="stafflist">
                            <header class="header bg-white b-b clearfix">
                                <div class="row m-t-sm">
                                    <div class="col-sm-8 m-b-xs">
                                        <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                                        <div class="btn-group">
                                            <button type="button" onclick="reLoad()"  class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                                            <button type="button" id="deleteStaffList" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" >Total Number Staffs : <?php echo $count['staffcount']; ?></button>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-4 m-b-xs">
                                            <div class="input-group">
                                            <input type="text" class="input-sm form-control" placeholder="Search">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                                            </span>
                                            </div>
                                    </div>-->
                                </div>
                            </header>
                            <?php $staffQuery = $conn->query("select * from os_staff order by staff_registered DESC"); ?>
                            <div class="table-responsive"> 
                                <table class="table table-striped m-b-none text-center">
                                    <thead>
                                        <tr>
                                            <th width="50" class="text-center"><input type="checkbox"></th>
                                            <th class="text-center">Staff Name</th>
                                            <th class="text-center">Staff Email</th>
                                            <th class="text-center">Staff Phone Number</th>
                                            <th class="text-center">Staff Registered Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="staff-list-table">
                                        <?php while ($staffResults = $staffQuery->fetch_assoc()) { ?>
                                            <tr>
                                                <td><input type="checkbox" class="staff-list" name="checked" value="<?php echo $staffResults['id_staff']; ?>"></td>
                                                <td><?php echo $staffResults['staff_name']; ?></td>
                                                <td><?php echo $staffResults['staff_email']; ?></td>
                                                <td><?php echo $staffResults['staff_phone']; ?></td>
                                                <td><?php
                                                    $datetime = $staffResults['staff_registered'];
                                                    echo date("d-m-Y", strtotime($datetime));
                                                    ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody> 
                                </table>
                            </div>
                        </div> 
                        <!--</form>-->
                        <div class="clearfix"></div>
                        <!--Staff Listing End-->
                        <!--Hostel Listing-->
                        <div class="tab-pane" id="hostellist">
                            <header class="header bg-white b-b clearfix">
                                <div class="row m-t-sm">
                                    <div class="col-sm-8 m-b-xs">
                                        <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                                        <div class="btn-group">
                                            <button type="button" onclick="reLoad()"   class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                                            <button type="button"  id="deleteHostelList" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" >Total Number Hostels : <?php echo $count['hostelcount']; ?></button>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-4 m-b-xs">
                                            <div class="input-group">
                                            <input type="text" class="input-sm form-control" placeholder="Search">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                                            </span>
                                            </div>
                                    </div>-->
                                </div>
                            </header>
                            <?php
                            $hstlQuery = $conn->query("select * from os_hostel order by hostel_registered DESC");
                            ?>
                            <div class="table-responsive"> 
                                <table class="table table-striped m-b-none text-center">
                                    <thead>
                                        <tr>
                                            <th width="50" class="text-center"><input type="checkbox"></th>
                                            <th class="text-center">Hostel Name</th>
                                        <!-- <th class="text-center">Hostel Email</th>
                                            <th class="text-center">Hostel Phone Number</th> -->
                                            <th class="text-center">Hostel Registered Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hostel-list-table">
                                        <?php while ($hstlResults = $hstlQuery->fetch_assoc()) { ?>
                                            <tr>
                                                <td><input type="checkbox" class="hostel-list" name="hostelcheck" value="<?php echo $hstlResults['id_hostel']; ?>"></td>
                                                <td><?php echo $hstlResults['hostel_name']; ?></td>
                                               <!-- <td><?php //echo $hstlResults['hostel_email'];     ?></td>
                                                <td><?php //echo $hstlResults['hostel_phone'];     ?></td>-->
                                                <td><?php
                                                    $datetime = $hstlResults['hostel_registered'];
                                                    echo date("d-m-Y", strtotime($datetime));
                                                    ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody> 
                                </table>
                            </div>   
                        </div> 
                        <!--Hostel Listing End-->
                       <!--Add Staff-->
                        <div class="tab-pane" id="addstaff">
                            <div class="col-sm-12">
                                <form class="form-horizontal row" id="StaffForm">
                                    <section class="panel panel-default">
                                        <header class="panel-heading">
                                            <strong>ADD STAFF</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Staff Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control rounded " class="addstaffname" name="staff_name"  id="add_staff_name" placeholder="Please Enter Staff Name" required="">    
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>                  
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Staff Email</label>
                                                <div class="col-sm-9" id="add_email_div">
                                                    <input type="text" class="form-control rounded addstaffemail" name="staff_email"  id="add_staff_email" placeholder="Please enter your Email address">    
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control rounded addstaffphone" name="staff_phone" id="add_staff_phone" value=""  placeholder="Please enter your phone number">
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="staff_password" id="add_staff_password" class="form-control rounded addstaffpassword" placeholder="Please enter password">
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control rounded addstaffcfmpassword" name="staff_cpassword" id="add_staff_cpassword" placeholder="Conform Password">                         
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="panel-footer text-right bg-light lter">
                                            <button id="AddStaff" class="btn btn-success btn-s-xs">Submit</button>
                                        </footer>

                                    </section>
                                </form>
                            </div>
                        </div> 
                        <!--Add Staff End-->
                        <!--Add Hostel-->
                        <div class="tab-pane" id="addhostel">
                            <div class="col-sm-12"> 
                                <form class="form-horizontal row" id="HostelForm">
                                    <section class="panel panel-default">
                                        <header class="panel-heading">
                                            <strong>ADD HOSTEL</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Hostel Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control rounded" name="hostel_name"  id="hostel_name" placeholder="Please Enter Hostel Name">    
                                                </div>
                                            </div>

                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Hostel Address</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="hostel_address" id="hostel_address"  class="form-control rounded" placeholder="Enter Hostel Address">
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Hostel Map Address</label>
                                                <div class="col-sm-9">
                                                    <div class="col-sm-6">
                                                        <input type="number" name="hostel_latitude" id="hostel_latitude" class="form-control rounded" placeholder="Map Latitude Numbers"></div>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="hostel_longitude" id="hostel_longitude" class="form-control rounded" placeholder="Map Longitude Numbers"></div>
                                                    <a style="color:red;" target="_blank" href="http://www.latlong.net/">Clicke here to find Your latitude and longitude</a>
                                                </div>
                                            </div>
                                            <div class="line line-dashed line-lg pull-in"></div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Facilities</label>
                                                <div class="col-sm-9">
                                                    <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle rounded">
                                                        <span class="dropdown-label" data-placeholder="Please select" data-required="true" >Please select</span> 
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul id="hostel_facility" class="dropdown-menu dropdown-select">
                                                        <?php
                                                        $facility = $conn->query("SELECT * FROM os_facilities  ORDER BY id_facility ASC");
                                                        while ($facilityresult = $facility->fetch_assoc()) {
                                                            ?>
                                                            <li><a><input type="checkbox" name="hostel_facility[]" value="<?php echo $facilityresult['id_facility']; ?>" /><?php echo $facilityresult['facility_name']; ?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <footer class="panel-footer text-right bg-light lter">
                                            <button id="AddHostel" class="btn btn-success btn-s-xs">Submit</button>
                                        </footer>
                                    </section>
                                </form>
                            </div>


                        </div>
                        </div>
                        <!--Add Hostel End------------------------------------------------------------------------------------------------------------------>
                        <!--Manage bed-------------------------------------------------------------------------------------------------------------------->
                        <div class="tab-pane" id="managebed">


                            <div class="col-sm-12"> 
                                <form class="form-horizontal row" id="bedForm">
                                    <section class="panel panel-default">
                                        <header class="panel-heading">
                                            <strong>ADD BED</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div id="bedInfo" >
                                                <div class="form-group" >
                                                    <div class="control-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-8 col-sm-offset-2">
                                                                <?php
                                                                $hostelbed = $conn->query('select * from os_hostel ');
                                                                ?>
                                                                <select  name="hostel_id" id="hostel_0_building"  class="form-control rounded"  onChange="getBedtype(this.value);">
                                                                    <option value="0"> Select Hostel</option><br />
                                                                    <?php while ($hostelfetch = $hostelbed->fetch_assoc()) { ?>	
                                                                        <option value="<?php echo $hostelfetch['id_hostel'] ?>"><?php echo $hostelfetch['hostel_name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <div class="line line-dashed line-lg pull-in"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-2">
                                                                <select count="0" name="hostel[0][floor]" id="hostel_0_floor" class="form-control">
                                                                    <option value="0"> Floors</option>
                                                                    <option value="flr1">Floor 1 </option>
                                                                    <option value="flr2">Floor 2 </option>
                                                                    <option value="flr3">Floor 3 </option>
                                                                    <option value="flr4">Floor 4 </option>
                                                                    <option value="flr5">Floor 5 </option>
                                                                    <option value="flr6">Floor 6 </option>
                                                                    <option value="flr7">Floor 7 </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <select  count="0" name="hostel[0][flat]" id="hostel_0_flat" class="form-control">
                                                                    <option value="0"> Flats</option>
                                                                    <option value="flt1">Flat 1 </option>
                                                                    <option value="flt2">Flat 2 </option>
                                                                    <option value="flt3">Flat 3 </option>
                                                                    <option value="flt4">Flat 4 </option>
                                                                    <option value="flt5">Flat 5 </option>
                                                                    <option value="flt6">Flat 6 </option>
                                                                    <option value="flt7">Flat 7 </option>
                                                                    <option value="flt8">Flat 8 </option>
                                                                    <option value="flt9">Flat 9 </option>
                                                                    <option value="flt10">Flat 10 </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <select  count="0" name="hostel[0][room]" id="hostel_0_room" class="form-control">
                                                                    <option value="0"> Rooms</option>
                                                                    <option value="r1">Room 1 </option>
                                                                    <option value="r2">Room 2 </option>
                                                                    <option value="r3">Room 3 </option>
                                                                    <option value="r4">Room 4 </option>
                                                                    <option value="r5">Room 5 </option>
                                                                    <option value="r6">Room 6 </option>
                                                                    <option value="r7">Room 7 </option>
                                                                    <option value="r8">Room 8 </option>
                                                                    <option value="r9">Room 9 </option>
                                                                    <option value="r10">Room 10 </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input type="number" placeholder="Bed Number" required count="0" maxlength="40" min="1" name="hostel[0][bed]" id="hostel_0_bed" class="form-control" placeholder="select Rooms" value="" />
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <?php $bedprice = $conn->query('select * from os_bedtype ');
                                                                ?>
                                                                <select  count="0" name="hostel[0][bed_type]" id="bedtype-list" class="form-control">
                                                                    <option value="0"> Price</option>
                                                                    <?php while ($bedtypefetch = $bedprice->fetch_assoc()) { ?>	
                                                                        <option value="<?php echo $bedtypefetch['bedtype_name'] ?>"><?php echo $bedtypefetch['bedtype_name'] ?></option>
                                                                    <?php } ?>



                                                                </select>
                                                            </div>
                                                            <div class="col-sm-2 text-center" >
                                                                <button type="button" class="btn btn-info addBed" >Add Bed</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="panel-footer text-right bg-light lter">
                                            <button id="addbedno" class="btn btn-success btn-s-xs">Submit</button>
                                        </footer>
                                    </section>
                                </form>
                            </div>
                            <div id="success-message-bedtype" style="display:none;" class="alert alert-success"></div>
                            <div id="warning-message-bedtype" style="display:none;" class="alert alert-danger"></div>
                            <div class="col-sm-12"> 
                                <form class="form-horizontal row" id="bedTypeForm">
                                    <section class="panel panel-default">
                                        <header class="panel-heading">
                                            <strong>ADD BED TYPE</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div id="" >
                                                <div class="form-group" >		
                                                    <div class="control-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-6 col-md-offset-3">
                                                                <label class="col-sm-4 control-label">Hostel </label>
                                                                <div class="col-sm-8">
                                                                    <?php
                                                                    $hostelbed = $conn->query('select * from os_hostel ');
                                                                    ?>
                                                                    <select count="0" name="hosteltype" id="hostel_0_building"  class="form-control rounded">
                                                                        <option value="0"> Select Hostel</option>
                                                                        <?php while ($hostelfetch = $hostelbed->fetch_assoc()) { ?>                                                                <option value="<?php echo $hostelfetch['id_hostel'] ?>"><?php echo $hostelfetch['hostel_name'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="line line-dashed line-lg pull-in"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-6">
                                                                <label class="col-sm-4 control-label">Bed Types</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="bedcode" placeholder="name" class="form-control rounded">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-sm-4 control-label">Bed price</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="bedprice" class="form-control rounded">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="panel-footer text-right bg-light lter">
                                            <button id="addbedtype" class="btn btn-success btn-s-xs">Submit</button>
                                        </footer>
                                    </section>
                                </form>
                            </div>
                        </div>
                        <!--Manage Bed end-------------------------------------------------------------------------------------------------------------------->



                        <!--Bed list star-------------------------------------------------------------------------------------------------------------------->


                        <div class="tab-pane" id="managebedlist">


                            <div class="col-sm-12"> 
                                <form class="form-horizontal row" id="bedlistForm">
                                    <section class="panel panel-default">
                                        <header class='header bg-white b-b clearfix'>
                                            <div class='row m-t-sm'>
                                                <div class='col-sm-8 m-b-xs'>
                                                    <a href='#subNav' data-toggle='class:hide' class='btn btn-sm btn-default active'><i class='fa fa-caret-right text fa-lg'></i><i class='fa fa-caret-left text-active fa-lg'></i></a>
                                                    <div class='btn-group'>
                                                        <button type='button' onclick='reLoad()' class='btn btn-sm btn-default' title='Refresh'><i class='fa fa-refresh'></i></button>
                                                        <button type='button' id='deleteBedList' class='btn btn-sm btn-default' title='Remove'><i class='fa fa-trash-o'></i></button>

                                                    </div>
                                                </div>

                                            </div>
                                        </header>
                                        <header class="panel-heading">
                                            <strong>BED List</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div id="" >
                                                <div class="form-group" >
                                                    <div class="control-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-8 col-sm-offset-2">
                                                                <?php
                                                                $hostelbed = $conn->query('select * from os_hostel ');
                                                                ?>
                                                                <select  name="hostel_id" id="hostel_0_building"  class="form-control rounded bedlisthostel"  onChange="getBedlist(this.value);">
                                                                    <option value="0"> Select Hostel</option><br />
                                                                    <?php while ($hostelfetch = $hostelbed->fetch_assoc()) { ?>	
                                                                        <option value="<?php echo $hostelfetch['id_hostel'] ?>"><?php echo $hostelfetch['hostel_name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <div class="line line-dashed line-lg pull-in"></div>
                                                            </div>
                                                        </div>




                                                        <span id="bedtypeappend">
                                                        </span>






                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                </form>
                            </div>


                        </div>
                        <!--Bed list end-------------------------------------------------------------------------------------------------------------------->

                        
                           <!--Bed type list star-------------------------------------------------------------------------------------------------------------------->


                        <div class="tab-pane" id="managebedtypelist">


                            <div class="col-sm-12"> 
                                <form class="form-horizontal row" id="bedtypeForm">
                                    <section class="panel panel-default">
                                        <header class='header bg-white b-b clearfix'>
                                            <div class='row m-t-sm'>
                                                <div class='col-sm-8 m-b-xs'>
                                                    <a href='#subNav' data-toggle='class:hide' class='btn btn-sm btn-default active'><i class='fa fa-caret-right text fa-lg'></i><i class='fa fa-caret-left text-active fa-lg'></i></a>
                                                    <div class='btn-group'>
                                                        <button type='button' onclick='reLoad()' class='btn btn-sm btn-default' title='Refresh'><i class='fa fa-refresh'></i></button>
                                                        <button type='button' id='deleteTypeBedList' class='btn btn-sm btn-default' title='Remove'><i class='fa fa-trash-o'></i></button>

                                                    </div>
                                                </div>

                                            </div>
                                        </header>
                                        <header class="panel-heading">
                                            <strong>BED Type List</strong>
                                        </header>
                                        <div class="panel-body">  
                                            <div id="" >
                                                <div class="form-group" >
                                                    <div class="control-group">
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-8 col-sm-offset-2">
                                                                <?php
                                                                $hostelbed = $conn->query('select * from os_hostel ');
                                                                ?>
                                                                <select  name="hostel_id" id="hostel_0_building"  class="form-control rounded bedtypelisthostel"  onChange="getBedTypelist(this.value);">
                                                                    <option value="0"> Select Hostel</option><br />
                                                                    <?php while ($hostelfetch = $hostelbed->fetch_assoc()) { ?>	
                                                                        <option value="<?php echo $hostelfetch['id_hostel'] ?>"><?php echo $hostelfetch['hostel_name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <div class="line line-dashed line-lg pull-in"></div>
                                                            </div>
                                                        </div>




                                                        <span id="bedtype2append">
                                                        </span>






                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                </form>
                            </div>


                        </div>
                        <!--Bed type list end-------------------------------------------------------------------------------------------------------------------->


                        <!--Manage Staff-------------------------------------------------------------------------------------------------------------------->
                        <div class="tab-pane" id="managestaff">
                            <header class="header bg-white b-b clearfix">
                                <div class="row m-t-sm">
                                    <div class="col-sm-8 m-b-xs">
                                        <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                                        <div class="btn-group">
                                            <button type="button" onclick="reLoad()" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" >Total Number Staffs : <?php echo $count['staffcount']; ?></button>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-4 m-b-xs">
                                            <div class="input-group">
                                            <input type="text" class="input-sm form-control" placeholder="Search">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                                            </span>
                                            </div>
                                    </div>-->
                                </div>
                            </header>
                            <div class="table-responsive"> 
                                <table class="table table-striped m-b-none text-center">
                                    <thead>
                                        <tr>
                                            <th width="20"><input type="checkbox"></th>
                                            <th class="text-center">View/Update Profile</th>
                                            <th class="th-sortable text-center" data-toggle="class">Staff Name</th>
                                            <th class="text-center">Staff Email</th>
                                            <th class="text-center">Staff Phone Number</th>
                                            <!--<th class="text-center">Staff Registered Date</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $staffManageQuery = $conn->query("select * from os_staff  order by staff_registered DESC");
                                        ?>
                                        <?php while ($staffManage = $staffManageQuery->fetch_assoc()) { ?>
                                            <tr>
                                                <td><input type="checkbox" name="post[]" value="7"></td>
                                                <td><a href="#modal" data-toggle="modal" onClick="getStaffDetails(<?php echo $staffManage['id_staff']; ?>)" ><i class="fa fa-search-plus"></i></a></td>
                                                <td><?php echo $staffManage['staff_name']; ?></td>
                                                <td><?php echo $staffManage['staff_email']; ?></td>
                                                <td><?php echo $staffManage['staff_phone']; ?></td>
                                                <!--<td><?php
                                                $datetime = $staffManage['staff_registered'];
                                                echo date("d-m-Y", strtotime($datetime));
                                                ?></td>-->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Manage Staff End--------------------------------------------------------------------------------------------------------------------------->
                        <!--Manage Hostels----------------------------------------------------------------------------------------------------------------------------->
                        <div class="tab-pane" id="managehostel">
                            <header class="header bg-white b-b clearfix">
                                <div class="row m-t-sm">
                                    <div class="col-sm-8 m-b-xs">
                                        <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                                        <div class="btn-group">
                                            <button type="button" onclick="reLoad()" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-sm btn-default" >Total Number Hostels : <?php echo $count['hostelcount']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="table-responsive"> 
                                <table class="table table-striped m-b-none text-center">
                                    <thead>
                                        <tr>
                                            <th width="20"><input type="checkbox"></th>
                                            <th class="text-center">View/Update Profile</th>
                                            <th class="th-sortable text-center" data-toggle="class">Hostel Name</th>
                                        <!--    <th class="text-center">Hostel Email</th>
                                            <th class="text-center">Hostel Phone Number</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $hostelManageQuery = $conn->query("select * from os_hostel order by hostel_name ");
                                        while ($hostelManage = $hostelManageQuery->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="post[]" value="7"></td>
                                                <td><a href="#hosteldetails" onClick="getHostelDetails(<?php echo $hostelManage['id_hostel']; ?>)" data-toggle="modal"><i class="fa fa-search-plus"></i></a></td>
                                                <td> <?php echo $hostelManage['hostel_name']; ?> </td>
                                               <!--<td> <?php
                                                $hdatetime = $hostelManage['hostel_registered'];
                                                echo date("d-m-Y", strtotime($hdatetime));
                                                ?></td>-->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Manage Hostels End---------------------------------------------------------------------------------------------------------------------->
                    </section>
                </section>
                <footer class="footer bg-white b-t">
                </footer>
            </section>
        </aside>
    </section><a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
<aside class="bg-light lter b-l aside-md hide" id="notes">
    <div class="wrapper">Notification</div>
</aside>
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Staff Profile Detailes</h4>
            </div>
            <form class="form-horizontal row" id="updateForm">
                <input type="hidden" name="staffid" id="ViewstaffID">
                <div class="modal-body">
                    <div class="panel-body">  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Staff Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded" name="staff_name" id="Viewstaffname">    
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>                  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Staff Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded" name="staff_email" id="Viewstaffemail" placeholder="Enter Staff Email Id">    
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded" name="staff_phone" id="Viewstaffphone">
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">New Password (Optional *)</label>
                            <div class="col-sm-9">
                                <input type="password"  class="form-control rounded" name="staff_password" placeholder="Create A New Password">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="updateStaff" class="btn btn-info" data-loading-text="Updating...">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--modal staff End --------------------------------------------------------------------------------------------------------------------------->
<!--modal hostel 	--------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="hosteldetails">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Hostel Profile Detailes</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row" id="updateHostelForm">
                    <input type="hidden" name="hostelid" id="ViewhostelID">
                    <div class="panel-body">  
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hostel Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded" name="hostel_name" placeholder="Please Enter Hostel Name" id="viewhostelname">    
                            </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hostel Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="hostel_address" class="form-control rounded" placeholder="Enter Hostel Address" id="viewhosteladdress">
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Map Address</label>
                            <div class="col-sm-9">
                                <div class="col-sm-6">
                                    <input type="number" name="hostel_latitude" class="form-control rounded" placeholder="Map Latitude Numbers" id="viewhostellatitude"></div>
                                <div class="col-sm-6">
                                    <input type="number" name="hostel_longitude" class="form-control rounded" placeholder="Map Longitude Numbers" id="viewhostellongitude"></div>

                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Facilities</label>
                            <div class="col-sm-9">
                                <button data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle rounded">
                                    <span class="dropdown-label" data-placeholder="Please select" data-required="true" >Please select</span> 
                                    <span class="caret"></span>
                                </button>
                                <ul id="hostel_facility" class="dropdown-menu dropdown-select">
                                    <?php
                                    $facility = $conn->query("SELECT * FROM os_facilities  ORDER BY id_facility ASC");
                                    while ($facilityresult = $facility->fetch_assoc()) {
                                        ?>
                                        <li><a><input type="checkbox" name="hostel_facility[]" id="viewhostelfacility" value="<?php echo $facilityresult['id_facility']; ?>" /><?php echo $facilityresult['facility_name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div id="success2-message" style="display:none;" class="alert alert-success"></div>
                        <div id="warning2-message" style="display:none;" class="alert alert-danger"></div>
                        <!--<div class="form-group">
                                <label class="col-sm-3 control-label">Building Name</label>
                                <div class="col-sm-9">
                                <input type="text" name="hostel_building" id="viewhostelbuilding" class="form-control rounded" placeholder="Please Enter Building Name">
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-3 control-label">Building Information</label>
                                <div class="col-sm-9">
                                <div class="col-sm-6">
                                <input type="text" name="hostel_floor" id="viewhostelfloor" class="form-control rounded" placeholder="Please Enter Hostel Floor"></div>
                                <div class="col-sm-6">
                                <input type="text" name="hostel_flat" id="viewhostelflat" class="form-control rounded" placeholder="Please Enter Total Flats In Floor"></div>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-sm-3 control-label">Flat Information</label>
                                <div class="col-sm-9">
                                <div class="col-sm-6">
                                <input type="text" name="hostel_room" id="viewhostelroom" class="form-control rounded" placeholder="Please Enter Total Rooms In Flat"></div>
                                <div class="col-sm-6">
                                <input type="text" name="hostel_bed" id="viewhostelbed" class="form-control rounded" placeholder="Please Enter Total Beds In Room"></div>
                                </div>
                        </div>-->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="updateHostel" class="btn btn-info" data-loading-text="Updating...">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--modal hostel End-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/app.js"></script>
<script src="js/app.plugin.js"></script>
<script src="js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/slider/bootstrap-slider.js"></script>
<script>
                                                function reLoad() {
                                                    location.reload();
                                                }
</script>
<script type="text/javascript" language="JavaScript">


 //Validation for add Staff start
    $(document).ready(function () {


//       console.log('hiii');
        $("#add_staff_name").focusout(function () {
 $("#success-message").hide();
            $("#warning-message").hide();
            console.log($("#add_staff_name").val());

            if ($("#add_staff_name").val() == '')
            {
                $("#add_staff_name").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_name').focus();
                $("#warning-message").show();
                $("#warning-message").html('Enter name');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_name').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_name").css({"border-style": "solid", "border-color": "#8644ca"});
            }
        });

        $("#add_staff_email").focusout(function () {

            console.log($("#add_staff_email").val());

            if ($("#add_staff_email").val() == '')
            {
                $("#add_staff_email").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_email').focus();
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Email');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_email').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_email").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
        });

        $("#add_staff_email").focusout(function () {
            var email = $("#add_staff_email").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if ((email == '') || (!regex.test(email)))
            {
                $("#add_staff_email").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Valid Email');
                $("#add_staff_email").focus();
                return false;
            } else {
                $("#add_staff_email").css({"border-style": "solid", "border-color": "#8644ca"});
            }
        });


        $("#add_staff_phone").focusout(function () {
 $("#success-message").hide();
            $("#warning-message").hide();
            console.log($("#add_staff_phone").val());

            if ($("#add_staff_phone").val() == '')
            {
                $("#add_staff_phone").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_phone').focus();
                $("#warning-message").show();
                $("#warning-message").html('Please Enter phone number');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_phone').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_phone").css({"border-style": "solid", "border-color": "#8644ca"});
            }
        });


        $("#add_staff_password").focusout(function () {
 $("#success-message").hide();
            $("#warning-message").hide();
            console.log($("#add_staff_password").val());

            if ($("#add_staff_password").val() == '')
            {
                $("#add_staff_password").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_password').focus();
                $("#warning-message").show();
                $("#warning-message").html('Please Enter password');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_password').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_password").css({"border-style": "solid", "border-color": "#8644ca"});
            }
        });
        $("#add_staff_cpassword").focusout(function () {
            var password = $("#add_staff_password").val();
            var cpassword = $("#add_staff_cpassword").val();
            if ((cpassword == '') || password != cpassword)
            {
                $("#add_staff_cpassword").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Passwords are Not matching');
//            $("#cpassword").focus();
                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_cpassword").css({"border-style": "solid", "border-color": "#8644ca"});
            }
        });


        $("#AddStaff").click(function () {

 $("#success-message").hide();
            $("#warning-message").hide();
            if ($("#add_staff_name").val() == '')
            {
                $("#add_staff_name").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_name').focus();
                $("#warning-message").show();
                $("#warning-message").html('Enter name');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_name').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_name").css({"border-style": "solid", "border-color": "#8644ca"});
            }

            var email = $("#add_staff_email").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if ((email == '') || (!regex.test(email)))
            {
                $("#add_staff_email").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Valid Email');
                $("#add_staff_email").focus();
                return false;
            } else {
                $("#add_staff_email").css({"border-style": "solid", "border-color": "#8644ca"});
            }

            if ($("#add_staff_phone").val() == '')
            {
                $("#add_staff_phone").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_phone').focus();
                $("#warning-message").show();
                $("#warning-message").html('Please Enter phone number');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_phone').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_phone").css({"border-style": "solid", "border-color": "#8644ca"});
            }

            if ($("#add_staff_password").val() == '')
            {
                $("#add_staff_password").css({"border-style": "solid", "border-color": "red"});
                $('#add_staff_password').focus();
                $("#warning-message").show();
                $("#warning-message").html('Please Enter password');
//                $("#warning-message").fadeOut(3000);
                $('#add_staff_password').focus();

                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_password").css({"border-style": "solid", "border-color": "#8644ca"});
            }

            var password = $("#add_staff_password").val();
            var cpassword = $("#add_staff_cpassword").val();
            if ((cpassword == '') || password != cpassword)
            {
                $("#add_staff_cpassword").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Passwords are Not matching');
//            $("#cpassword").focus();
                return false;
            } else {
                $('#warning-message').hide();
                $("#add_staff_cpassword").css({"border-style": "solid", "border-color": "#8644ca"});
            }

            $("#success-message").hide();
            $("#warning-message").hide();

            // if($("#staff_name").val()=='')
            // {
            // $("#staff_name").css({"border-style": "solid", "border-color": "red" });
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Staff Name');
            // $("#staff_name").focus();
            // return false;
            // } else{
            // $("#staff_name").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            // var staff_email = $("#staff_email").val();
            // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            // if((staff_email=='') || (!regex.test(staff_email)))
            // {
            // $("#staff_email").css({"border-style": "solid", "border-color": "red"});
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Valid Email');
            // $("#staff_email").focus();
            // return false;
            // }else{
            // $("#staff_email").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            // var regex = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
            // var staff_phone = $("#staff_phone").val();
            // if((staff_phone=='') || (!regex.test(staff_phone)))
            // {
            // $("#staff_phone").css({"border-style": "solid", "border-color": "red" });
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Valid Phone Number');
            // $("#staff_phone").focus();
            // return false;
            // } else{
            // $("#staff_phone").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }

            // var staff_password = $("#staff_password").val();	
            // var staff_cpassword = $("#staff_cpassword").val();
            // if( (staff_password=='') || staff_password!=staff_cpassword)
            // {
            // $("#staff_password").css({"border-style": "solid", "border-color": "red" });
            // $("#warning-message").show();
            // $("#warning-message").html('Passwords are Not matching');
            // $("#staff_password").focus();
            // return false;
            // } else{
            // $("#staff_password").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {staffData: $("#StaffForm").serialize(), 'action': 'addstaff'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
                        /*$( "#stafflist" ).addClass( "active");
                         $( "#addstaff" ).removeClass( "active");*/
                        var staffString = '';
                        $.each(response["staffList"], function (key, staff) {
                            staffString += '<tr><td><input class="staff-list" name="checked" value="' + staff.id_staff + '" type="checkbox"></td><td>' + staff.staff_name + '</td><td>' + staff.staff_email + '</td><td>' + staff.staff_phone + '</td><td>' + staff.staff_registered + '</td></tr>'
                        })
                        $("#staff-list-table").html('');
                        $("#staff-list-table").html(staffString);

                    } else {
                        $("#warning-message").show();
                        $("#warning-message").html(response["message"]);
                    }
                    /*setTimeout(function(){// wait for 5 secs(2)
                     location.reload(); // then reload the page.(3)
                     }, 1000);*/
                },
                error: function (request, status, error) {
                    $("#warning-message").show();
                    $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
                }
            });
            return false;


        });

    });
    //Validation for add staff  end

    //Validation for add bed start
    
    
    
    //Validation for add bed end
    //Get Staff details for manage staff form
    function getStaffDetails(staffID) {
        $.ajax({
            url: "staffcontroller.php",
            method: "POST",
            data: {'action': 'viewstaff', 'staffId': +staffID},
            dataType: "json",
            success: function (response) {
                $("#ViewstaffID").val(response['staff']['id_staff']);
                $("#Viewstaffname").val(response['staff']['staff_name']);
                $("#Viewstaffemail").val(response['staff']['staff_email']);

                $("#Viewstaffphone").val(response['staff']['staff_phone']);
                $("#Viewstaffpassword").val(response['staff']['staff_password']);
                console.log(response['staff']['staff_name']);
                console.log(response['staff']['id_staff']);
                $("#success-message").html(response['message']);
            },
            error: function (request, status, error) {
                $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
            }
        });
    }
    //Get Hostel details for manage hostel form
    function getHostelDetails(hostelID) {
        $.ajax({
            url: "staffcontroller.php",
            method: "POST",
            data: {'action': 'viewhostel', 'hostelId': +hostelID},
            dataType: "json",
            success: function (response) {
                $("#ViewhostelID").val(response['hostel']['id_hostel']);
                $("#viewhostelname").val(response['hostel']['hostel_name']);
                $("#viewhostelemail").val(response['hostel']['hostel_email']);
                $("#viewhosteladdress").val(response['hostel']['hostel_address']);
                $("#viewhostellatitude").val(response['hostel']['hostel_latitude']);
                $("#viewhostellongitude").val(response['hostel']['hostel_longitude']);
                $("#viewhostelbuilding").val(response['hostel']['hostel_building']);
                $("#viewhostelfloor").val(response['hostel']['hostel_floor']);
                $("#viewhostelflat").val(response['hostel']['hostel_flat']);
                $("#viewhostelroom").val(response['hostel']['hostel_room']);
                $("#viewhostelbed").val(response['hostel']['hostel_bed']);
                $("#viewhostelphone").val(response['hostel']['hostel_phone']);
                //	$("#viewhostelfacility").val(response['facility']['id_facility']);
                //	console.log(response['facility']['id_facility']);	


                console.log(response['hostel']['id_hostel']);
                $("#success-message").html(response['message']);
            },
            error: function (request, status, error) {
                $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
            }
        });
    }
    $(document).ready(function () {
        var buildingCount = 1;
        $(".addBuilding").click(function () {
            //alert(coming here);
            $('#buildingInfo').append('<div class="line line-dashed line-lg pull-in"></div><div class="form-group"><div class="control-group" ><div class="col-sm-6"><label class="col-sm-4 control-label">Buildings </label><div class="col-sm-8"><select count="' + buildingCount + '" name="hostel[' + buildingCount + '][building]" id="hostel_' + buildingCount + '_building" class="form-control rounded"><option> Select Buildings</option><option>Building 1 </option><option>Building 2 </option><option>Building 3 </option></select></div></div><div class="col-sm-6"><label class="col-sm-4 control-label">Floors </label><div class="col-sm-8"><select count="' + buildingCount + '" name="hostel[' + buildingCount + '][floor]" id="hostel_' + buildingCount + 'floor" class="form-control rounded"><option> Select Floors</option><option>Floor 1 </option><option>Floor 2 </option><option>Floor 3 </option></select></div></div><div >&nbsp;</div><div class="col-sm-6"><label class="col-sm-4 control-label">Flats</label><div class="col-sm-8"><select count="' + buildingCount + '" name="hostel[' + buildingCount + '][flat]" id="hostel_' + buildingCount + 'flat" class="form-control rounded"><option> Select Flats</option><option>Flat 1 </option><option>Flat 2 </option><option>Flat 3 </option><option>Flat 4 </option></select></div></div><div class="col-sm-6"><label class="col-sm-4 control-label">Rooms </label><div class="col-sm-8"><select count="' + buildingCount + '" name="hostel[' + buildingCount + '][room]" id="hostel_' + buildingCount + 'room" class="form-control rounded"><option> Select Rooms</option><option >Room 1 </option><option>Room 2 </option></select></div></div><div>&nbsp;</div><div class="col-sm-6"><label class="col-sm-4 control-label">Beds </label><div class="col-sm-8"><input type="number" required="required" min="1" max="40"  count="' + buildingCount + '" name="hostel[' + buildingCount + '][bed]" id="hostel_' + buildingCount + 'bed" class="form-control rounded" placeholder="select Rooms" value="" /></div></div><div class="col-sm-6 text-center"><button type="button" class="btn btn-info btn-s-xs removeBuilding" id="' + buildingCount + '" >- Remove Building</button></div></div></div>');
            buildingCount++;
            console.log(buildingCount);
        });

        $("#buildingInfo").on('click', '.removeBuilding', function () {
            console.log($(this).parent());
            $(this).parent().parent().remove();
        });

        var bedCount = 1;


        $(".addBed").click(function () {
            //alert(coming here);
            var hostel = $("#hostel_0_building").attr('value');
            $('#bedInfo').append(' <div class = "form-group"> <div class="control-group" > <div class="col-sm-12"> <div class="col-sm-2"> <select count="' + bedCount + '" name="hostel[' + bedCount + '][floor]" id="hostel_' + bedCount + 'floor" class="form-control"> <option value="">Select Floors < /option> <option value="flr1">Floor 1 </option   > <option value="flr2">Floor 2 </option> <option value="flr3">Floor 3 </option> <option value="flr4">Floor 4 </option> <option value="flr5">Floor 5 </option> </select> </div> <div class="col-sm-2"> <select count="' + bedCount + '" name="hostel[' + bedCount + '][flat]" id="hostel_' + bedCount + 'flat" class="form-control"> <option value=""> Select Flats</option> <option value="flt1">Flat 1 </option> <option value="flt2">Flat 2 </option> <option value="flt3">Flat 3 </option> <option value="flt4">Flat 4 </option> </select> </div> <div class="col-sm-2"> <select count="' + bedCount + '" name="hostel[' + bedCount + '][room]" id="hostel_' + bedCount + 'room" class="form-control"> <option> Select Rooms</option><option value="r1">Room 1 </option> <option value="r2">Room 2 </option> <option value="r3">Room 3 </option> <option value="r4">Room 4 </option> <option value="r5">Room 5 </option> <option value="r6">Room 6 </option> </select> </div> <div class="col-sm-2"> <input type="number" placeholder="Bed Number" required="required" min="1" max="40" count="' + bedCount + '" name="hostel[' + bedCount + '][bed]" id="hostel_' + bedCount + 'bed" class="form-control" placeholder="select Rooms" value="" /> </div> <div class="col-sm-2"> <select count="' + bedCount + '" name="hostel[' + bedCount + '][bed_type]" id="bedtype2-list"  class="bedtype2-list" class="form-control"> <option>price </option><?php while ($bedtypefetch = $bedprice->fetch_assoc()) { ?>	<option value="<?php echo $bedtypefetch['bedtype_name'] ?>"><?php echo $bedtypefetch['bedtype_name'] ?></option> <?php } ?></select> </div> <div class="col-sm-2 text-center"> <button type="button" class="btn btn-info btn-s-xs removeBed" id="' + bedCount + '" > Remove bed </button> </div> </div> </div> </div>');
            bedCount++;
            console.log(bedCount);
            var hostelname = $("#hostel_0_building").val();

            console.log(hostelname);
            $.ajax({
                type: "POST",
                url: "staffcontroller.php",
                data: {'action': 'getbedtype', 'id_hostel': hostelname},
                success: function (data) {
                    console.log(data)

                    $("#bedtype2-list").html(data);



                }
            });
        });
        $("#bedInfo").on('click', '.removeBed', function () {
            console.log($(this).parent());
            $(this).parent().parent().parent().parent().remove();
        });
        //Add Staff
//        $("#AddStaff").click(function ()
//        {
//            $("#success-message").hide();
//            $("#warning-message").hide();
//
//            // if($("#staff_name").val()=='')
//            // {
//            // $("#staff_name").css({"border-style": "solid", "border-color": "red" });
//            // $("#warning-message").show();
//            // $("#warning-message").html('Please Enter Staff Name');
//            // $("#staff_name").focus();
//            // return false;
//            // } else{
//            // $("#staff_name").css({"border-style": "solid","border-color": "#E9E9E9"});
//            // }
//            // var staff_email = $("#staff_email").val();
//            // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//            // if((staff_email=='') || (!regex.test(staff_email)))
//            // {
//            // $("#staff_email").css({"border-style": "solid", "border-color": "red"});
//            // $("#warning-message").show();
//            // $("#warning-message").html('Please Enter Valid Email');
//            // $("#staff_email").focus();
//            // return false;
//            // }else{
//            // $("#staff_email").css({"border-style": "solid","border-color": "#E9E9E9"});
//            // }
//            // var regex = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
//            // var staff_phone = $("#staff_phone").val();
//            // if((staff_phone=='') || (!regex.test(staff_phone)))
//            // {
//            // $("#staff_phone").css({"border-style": "solid", "border-color": "red" });
//            // $("#warning-message").show();
//            // $("#warning-message").html('Please Enter Valid Phone Number');
//            // $("#staff_phone").focus();
//            // return false;
//            // } else{
//            // $("#staff_phone").css({"border-style": "solid","border-color": "#E9E9E9"});
//            // }
//
//            // var staff_password = $("#staff_password").val();	
//            // var staff_cpassword = $("#staff_cpassword").val();
//            // if( (staff_password=='') || staff_password!=staff_cpassword)
//            // {
//            // $("#staff_password").css({"border-style": "solid", "border-color": "red" });
//            // $("#warning-message").show();
//            // $("#warning-message").html('Passwords are Not matching');
//            // $("#staff_password").focus();
//            // return false;
//            // } else{
//            // $("#staff_password").css({"border-style": "solid","border-color": "#E9E9E9"});
//            // }
//            $.ajax({
//                url: "staffcontroller.php",
//                method: "POST",
//                data: {staffData: $("#StaffForm").serialize(), 'action': 'addstaff'},
//                dataType: "json",
//                success: function (response) {
//                    if (response["success"] == true)
//                    {
//                        $("#success-message").show();
//                        $("#success-message").html(response["message"]);
//                        /*$( "#stafflist" ).addClass( "active");
//                         $( "#addstaff" ).removeClass( "active");*/
//                        var staffString = '';
//                        $.each(response["staffList"], function (key, staff) {
//                            staffString += '<tr><td><input class="staff-list" name="checked" value="' + staff.id_staff + '" type="checkbox"></td><td>' + staff.staff_name + '</td><td>' + staff.staff_email + '</td><td>' + staff.staff_phone + '</td><td>' + staff.staff_registered + '</td></tr>'
//                        })
//                        $("#staff-list-table").html('');
//                        $("#staff-list-table").html(staffString);
//
//                    } else {
//                        $("#warning-message").show();
//                        $("#warning-message").html(response["message"]);
//                    }
//                    /*setTimeout(function(){// wait for 5 secs(2)
//                     location.reload(); // then reload the page.(3)
//                     }, 1000);*/
//                },
//                error: function (request, status, error) {
//                    $("#warning-message").show();
//                    $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
//                }
//            });
//            return false;
//        });

        //Add Staff End..........................................................................................
        //Update Staff
        $("#updateStaff").click(function ()
        {
            $("#warning-message").hide();
            $("#success-message").hide();
            // if($("#Viewstaffname").val()=='')
            // {
            // $("#Viewstaffname").css({"border-style": "solid", "border-color": "red" });
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Staff Name');
            // $("#Viewstaffname").focus();
            // return false;
            // } else{
            // $("#Viewstaffname").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            // var staff_email = $("#Viewstaffemail").val();
            // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            // if((staff_email=='') || (!regex.test(staff_email)))
            // {
            // $("#Viewstaffemail").css({"border-style": "solid", "border-color": "red"});
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Valid Email');
            // $("#Viewstaffemail").focus();
            // return false;
            // }else{
            // $("#Viewstaffemail").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            // var regex = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
            // var staff_phone = $("#Viewstaffphone").val();
            // if((staff_phone=='') || (!regex.test(staff_phone)))
            // {
            // $("#Viewstaffphone").css({"border-style": "solid", "border-color": "red" });
            // $("#warning-message").show();
            // $("#warning-message").html('Please Enter Valid Phone Number');
            // $("#Viewstaffphone").focus();
            // return false;
            // } else{
            // $("#Viewstaffphone").css({"border-style": "solid","border-color": "#E9E9E9"});
            // }
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {updateData: $("#updateForm").serialize(), 'action': 'updatestaff'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {

                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
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
        });
        //Update Staff Ends......................................................................................
        //Delete Staff List Start
        $("#deleteStaffList").click(function ()
        {
            $("#success-message").hide();
            $("#warning-message").hide();
            var deleteStaffList = $('.staff-list:checkbox:checked').map(function () {
                return $(this).attr('value');
            }).get().join(",");
            //console.log(deleteStaffList); 
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {delData: deleteStaffList, 'action': 'delete'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
                        $('.staff-list:checkbox:checked').each(function (i, e) {
                            $(this).parents('tr').remove();
                        })
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
        });
        //Delete Staff List End..................................................................................
//Delete Bed List Start..................................................................................

        $("#deleteBedList").click(function ()
        {
            $("#success-message").hide();
            $("#warning-message").hide();

            var bedlisthostel = $(".bedlisthostel").val();
            var deleteBedList = $('.Bed-list:checkbox:checked').map(function () {
                return $(this).attr('value');
            }).get().join(",");
            //console.log(deleteStaffList); 
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {delData: deleteBedList, bedlisthostel: bedlisthostel, 'action': 'deletebedlist'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
                        $('.Bed-list:checkbox:checked').each(function (i, e) {
                            $(this).parents('tr').remove();
                        })
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
        });

        //Delete Bed List End..................................................................................
        //Delete Bed type List Start..................................................................................

        $("#deleteTypeBedList").click(function ()
        {
            $("#success-message").hide();
            $("#warning-message").hide();

            var bedtyephostel = $(".bedtypelisthostel").val();
            var deleteTypeBedList = $('.Bed-type-list:checkbox:checked').map(function () {
                return $(this).attr('value');
            }).get().join(",");
            //console.log(deleteStaffList); 
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {delData: deleteTypeBedList, bedtyephostel: bedtyephostel, 'action': 'deletebedtypelist'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
                        $('.Bed-type-list:checkbox:checked').each(function (i, e) {
                            $(this).parents('tr').remove();
                        })
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
        });
        //Delete Bed type List End..................................................................................

        //Add Hostel
        $("#AddHostel").click(function () {
            $("#success-message").hide();
            $("#warning-message").hide();
            if ($("#hostel_name").val() == '') {
                $("#hostel_name").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Name');
                $("#hostel_name").focus();
                return false;
            } else {
                $("#hostel_name").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }


            if ($("#hostel_address").val() == '') {
                $("#hostel_address").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#hostel_address").focus();
                return false;
            } else {
                $("#hostel_address").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#hostel_latitude").val() == '') {
                $("#hostel_latitude").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#hostel_latitude").focus();
                return false;
            } else {
                $("#hostel_latitude").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#hostel_longitude").val() == '') {
                $("#hostel_longitude").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#hostel_longitude").focus();
                return false;
            } else {
                $("#hostel_longitude").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }


            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {hostelData: $("#HostelForm").serialize(), 'action': 'addhostel'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {

                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
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
        });
        //Update Hostel--------------------------------------------------------------------------------------------------------------------------------
        $("#updateHostel").click(function ()
        {
             $("#success-message").hide();
            $("#warning-message").hide();
            
            $("#warning-message").html('');

            if ($("#viewhostelname").val() == '')
            {
                $("#viewhostelname").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Name');
                $("#viewhostelname").focus();
                return false;
            } else {
                $("#viewhostelname").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }


            if ($("#viewhosteladdress").val() == '')
            {
                $("#viewhosteladdress").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhosteladdress").focus();
                return false;
            } else {
                $("#viewhosteladdress").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#viewhostellatitude").val() == '')
            {
                $("#viewhostellatitude").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostellatitude").focus();
                return false;
            } else {
                $("#viewhostellatitude").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#viewhostellongitude").val() == '')
            {
                $("#viewhostellongitude").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostellongitude").focus();
                return false;
            } else {
                $("#viewhostellongitude").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#viewhostelbuilding").val() == '')
            {
                $("#viewhostelbuilding").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostelbuilding").focus();
                return false;
            } else {
                $("#viewhostelbuilding").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#viewhostelfloor").val() == '')
            {
                $("#viewhostelfloor").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostelfloor").focus();
                return false;
            } else {
                $("#viewhostelfloor").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }

            if ($("#viewhostelflat").val() == '')
            {
                $("#viewhostelflat").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostelflat").focus();
                return false;
            } else {
                $("#viewhostelflat").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }
            if ($("#viewhostelroom").val() == '')
            {
                $("#viewhostelroom").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostelroom").focus();
                return false;

            } else {
                $("#viewhostelroom").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }

            if ($("#viewhostelbed").val() == '')
            {
                $("#viewhostelbed").css({"border-style": "solid", "border-color": "red"});
                $("#warning-message").show();
                $("#warning-message").html('Please Enter Hostel Address');
                $("#viewhostelbed").focus();
                return false;
            } else {
                $("#viewhostelbed").css({"border-style": "solid", "border-color": "#E9E9E9"});
            }

            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {hostelupdateData: $("#updateHostelForm").serialize(), 'action': 'updatehostel'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success2-message").show();
                        $("#success2-message").html(response["message"]);
                    } else {
                        $("#warning2-message").show();
                        $("#warning2-message").html(response["message"]);
                    }
                },
                error: function (request, status, error) {
                    $("#warning2-message").show();
                    $("#warning2-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
                }
            });
            return false;
        });

        //	Update Hostel--------------------------------------------------------------------------------------------------------------------------------
        // $("#updateHostel").click(function()
        // {
        // $("#success-message").hide();
        // $("#warning-message").hide();

        // if($("#hostel_name").val()=='')
        // {
        // $("#hostel_name").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Name');
        // $("#hostel_name").focus();
        // return false;
        // } else{
        // $("#hostel_name").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // var hostel_email = $("#hostel_email").val();
        // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        // if((hostel_email=='') || (!regex.test(hostel_email)))
        // {
        // $("#hostel_email").css({"border-style": "solid", "border-color": "red"});
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Valid Hostel Email');
        // $("#hostel_email").focus();
        // return false;
        // }else{
        // $("#hostel_email").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }

        // if($("#hostel_address").val()=='')
        // {
        // $("#hostel_address").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_address").focus();
        // return false;
        // } else{
        // $("#hostel_address").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // if($("#hostel_latitude").val()=='')
        // {
        // $("#hostel_latitude").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_latitude").focus();
        // return false;
        // } else{
        // $("#hostel_latitude").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // if($("#hostel_longitude").val()=='')
        // {
        // $("#hostel_longitude").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_longitude").focus();
        // return false;
        // } else{
        // $("#hostel_longitude").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // if($("#hostel_building").val()=='')
        // {
        // $("#hostel_building").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_building").focus();
        // return false;
        // } else{
        // $("#hostel_building").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // if($("#hostel_floor").val()=='')
        // {
        // $("#hostel_floor").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_floor").focus();
        // return false;
        // } else{
        // $("#hostel_floor").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }

        // if($("#hostel_flat").val()=='')
        // {
        // $("#hostel_flat").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_flat").focus();
        // return false;
        // } else{
        // $("#hostel_flat").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // if($("#hostel_room").val()=='')
        // {
        // $("#hostel_room").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_room").focus();
        // return false;
        // } else{
        // $("#hostel_room").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }

        // if($("#hostel_bed").val()=='')
        // {
        // $("#hostel_bed").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Hostel Address');
        // $("#hostel_bed").focus();
        // return false;
        // } else{
        // $("#hostel_bed").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // var regex = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
        // var hostel_phone = $("#hostel_phone").val();
        // if((hostel_phone=='') || (!regex.test(hostel_phone)))
        // {
        // $("#hostel_phone").css({"border-style": "solid", "border-color": "red" });
        // $("#warning-message").show();
        // $("#warning-message").html('Please Enter Valid Phone Number');
        // $("#hostel_phone").focus();
        // return false;
        // } else{
        // $("#hostel_phone").css({"border-style": "solid","border-color": "#E9E9E9"});
        // }
        // $.ajax({
        // url: "staffcontroller.php",
        // method: "POST",
        // data: { hostelData : $("#HostelForm").serialize(), 'action':'addhostel'},
        // dataType: "json",
        // success: function (response) {
        // if(response["success"]==true)
        // {
        // $("#success-message").show();
        // $("#success-message").html(response["message"]);
        // }else{
        // $("#warning-message").show();
        // $("#warning-message").html(response["message"]);
        // }	
        // },
        // error: function (request, status, error) {
        // $("#warning-message").show();
        // $("#warning-message").html("OOPS! Something Went Wrong Please Try After Sometime!");
        // }
        // });
        // return false;
        // });	


        //Delete Hostel List Start
        $("#deleteHostelList").click(function ()
        {
            $("#success-message").hide();
            $("#warning-message").hide();
            var deleteHostelList = $('.hostel-list:checkbox:checked').map(function () {
                return $(this).attr('value');
            }).get().join(",");
            console.log(deleteHostelList);
            $.ajax({
                url: "staffcontroller.php",
                method: "POST",
                data: {delhstlData: deleteHostelList, 'action': 'deletehostel'},
                dataType: "json",
                success: function (response) {
                    if (response["success"] == true)
                    {
                        $("#success-message").show();
                        $("#success-message").html(response["message"]);
                        $('.hostel-list:checkbox:checked').each(function (i, e) {
                            $(this).parents('tr').remove();
                        })
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
        });
        //Delete Hostel List End
    });
    $("#addbedtype").click(function ()
    {
 $("#success-message").hide();
            $("#warning-message").hide();

        $.ajax({
            url: "staffcontroller.php",
            method: "POST",
            data: {bedtype: $("#bedTypeForm").serialize(), 'action': 'addbedtype'},
            dataType: "json",
            success: function (response) {
                if (response["success"] == true)
                {
                     $("#success-message").show();
                    $("#success-message").html(response["message"]);


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
    });
    $("#addbedno").click(function ()
    {

 $("#success-message").hide();
            $("#warning-message").hide();
        $.ajax({
            url: "staffcontroller.php",
            method: "POST",
            data: {bedno: $("#bedForm").serialize(), 'action': 'addbedno'},
            dataType: "json",
            success: function (response) {
                if (response["success"] == true)
                {
                     $("#success-message").show();
                    $("#success-message").html(response["message"]);


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
    });
    /*get bedType script start*/
    function getBedtype(val) {
        $.ajax({
            type: "POST",
            url: "staffcontroller.php",
            data: {'action': 'getbedtype', 'id_hostel': val},
            success: function (data) {
                console.log(data)
                $("#bedtype-list").html(data);
                $("#bedtype2-list").html(data);



            }
        });
    }

    function getBedlist(val) {
        $.ajax({
            type: "POST",
            url: "staffcontroller.php",
            data: {'action': 'getbedlist', 'id_hostel': val},
            success: function (data) {
                console.log(data)
                $("#bedtypeappend").html(data);
            }
        });
    }
    
     function getBedTypelist(val) {
        $.ajax({
            type: "POST",
            url: "staffcontroller.php",
            data: {'action': 'getTypebedlist', 'id_hostel': val},
            success: function (data) {
                console.log(data)
                $("#bedtype2append").html(data);
            }
        });
    }
    /*get Bed type script end*/
    // function getBedtypeadd() {
    // var val=$("#hostel_0_building").attr(val);
    // $.ajax({
    // type: "POST",
    // url: "staffcontroller.php",
    // data: { 'action' : 'getbedtype', 'id_hostel':val},
    // success: function(data){
    // console.log(data)

    // $(".bedtype2-list").html(data);



    // }
    // });
    // }

</script>																									