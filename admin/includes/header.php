<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Ostello| Master Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  <link rel="shortcut icon" href="images/fav-icon.png" />
</head>
<body>
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/fav-icon.png" class="m-r-sm"> Ostello </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
       
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="images/avatar.png" class="img-circle">
              </a>
              <div class="clear">
                <a href="#"><span class="text-white font-bold"> @Mike Mcalidek </span></a>
                <small class="block">Art Director</small>
                <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a>
              </div>
            </div>
            <div class="row m-l-none m-r-none m-b-n-xs text-center">
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">245</span>
                  <small class="text-muted">Followers</small>
                </div>
              </div>
              <div class="col-xs-4 dk">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">55</span>
                  <small class="text-muted">Likes</small>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">2,035</span>
                  <small class="text-muted">Photos</small>
                </div>
              </div>
            </div>
          </section>
        </li>
        
      </ul>      
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/avatar.png">
            </span>
            Admin Name<b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            
            <li>
              <a href="profile.php">Profile</a>
            </li>
            
            <li>
              <a href="controller.php?type=logout" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>	
