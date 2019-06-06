<!DOCTYPE html>
<html>
    
<!-- Mirrored from moltran.coderthemes.com/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 14 Jul 2016 12:16:29 GMT -->
<head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<base href="<?php echo base_url();?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="dist/assets/images/favicon_1.ico">

       <title><?php echo $this->config->item('company') . ' | ' . $this->lang->line('common_powered_by') . ' IPOS
	' ?></title>

        <link href="dist/assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

        <link href="dist/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="dist/assets/css/responsive.css" rel="stylesheet" type="text/css">

        <script src="dist/assets/js/modernizr.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','http://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65046120-1', 'auto');
  ga('send', 'pageview');

</script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
    </head>


    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo site_url();?>" class="logo"><i class="md md-terrain"></i> <span>IPOS</span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <form class="navbar-form pull-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control search-bar" placeholder="Type here for search...">
                                </div>
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-user-plus fa-2x text-info"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">New user registered</div>
                                                    <p class="m-0">
                                                       <small>You have 10 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                           <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">New settings</div>
                                                    <p class="m-0">
                                                       <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Updates</div>
                                                    <p class="m-0">
                                                       <small>There are
                                                          <span class="text-primary">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small>See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect"><i class="md md-crop-free"></i></a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect"><i class="md md-chat"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                        <li><a href="<?= site_url('home/logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
<?php	$image = NULL;
		if ($user_info->pic_filename != '')
		{
			$ext = pathinfo($user_info->pic_filename, PATHINFO_EXTENSION);
			if($ext == '')
			{
				// legacy
				$images = glob('./uploads/item_pics/' . $user_info->pic_filename . '.*');
			}
			else
			{
				// preferred
				$images = glob('./uploads/item_pics/' . $user_info->pic_filename);
			}

			if (sizeof($images) > 0)
			{
				$image .= '<img src="'. base_url($images[0]) .'"  class="thumb-md img-circle" height="50px" width="50px">';
			}
		}
		?>
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <?php echo $image;?>
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= $user_info->first_name . ' ' . $user_info->last_name;  ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="<?= site_url('home/logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0">Inventory</p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
						
                            <li>
                                <a href="<?php echo site_url();?>" class="waves-effect waves-light active"><i class="md md-home"></i><span> Dashboard </span></a>
                            </li>
							<?php
								foreach($allowed_modules->result() as $module)
								{
								?>
								<?php if($this->lang->line("module_".$module->module_id)=="Items"){?>
										
														
														<li class="has_sub">
															<a href="#" class="waves-effect waves-light"><i class="md md-mail"></i><span>Inventory </span><span class="pull-right"><i class="md md-add"></i></span></a>
															<ul class="list-unstyled">
																<li><a href="<?php echo site_url("$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a></li>
																		<li><a href="<?php echo site_url("items/categories");?>">Categories</a></li>
																		
															</ul>
														</li>
														<li class="has_sub">
															<a href="#" class="waves-effect waves-light"><i class="md md-redeem"></i><span>Receiving </span><span class="pull-right"><i class="md md-add"></i></span></a>
															<ul class="list-unstyled">
																
																		<li><a href="<?php echo site_url("receivings");?>">Update Inventory</a></li>
																		<li><a href="<?php echo site_url("receivings");?>">Returns</a></li>
															</ul>
														</li>
														<li>
															<a href="<?php echo site_url("suppliers");?>" class="waves-effect waves-light"><i class="md md-invert-colors-on"></i><span>Suppliers</span></a>
														</li>
														
					
								
									<?php
									}
										
								}
								?>

                            

                          

                            
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Welcome <?php echo $user_info->first_name ?>!</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Inventory Manager</a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Start Widget -->
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-info">
                                    <span class="mini-stat-icon"><img src="<?php echo base_url().'images/images.ico';?>" width="30" height="30"/></span>
                                    <div class="mini-stat-info text-right">
                                        <span class="counter"><?php echo $inventory_total; ?></span>
                                        Total Inventory
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0"> <span class="pull-right">1</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bg-purple bx-shadow">
                                    <a href="<?php echo site_url("items/link_index/low_inventory");?>"><span class="mini-stat-icon"><i class="ion-ios7-cart"></i></span></a>
                                    <div class="mini-stat-info text-right">
                                        <span class="counter"><?php echo $stock_total; ?>	</span>
                                        Out of Stock
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0"><span class="pull-right">2</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bg-success bx-shadow">
                                    <a href="<?php echo site_url("items/link_index/expiry");?>"><span class="mini-stat-icon"><i class="ion-eye"></i></span></a>
                                    <div class="mini-stat-info text-right">
                                        <span class="counter"><?php echo $expiry_total; ?></span>
                                        Expired Products
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0"> <span class="pull-right">3</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bg-primary bx-shadow">
                                    <a href="<?php echo site_url("items/link_index/reorder_level");?>"><span class="mini-stat-icon"><i class="ion-android-contacts"></i></span></a>
                                    <div class="mini-stat-info text-right">
                                        <span class="counter"><?php echo $reorder_total; ?></span>
                                        ReOrder Level
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0"> <span class="pull-right">4</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- End row-->
						 <div class="row">
                            <div class="col-lg-6">
                               
								  <div class="cal1 cal_2"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div><div class="month">July 2015</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day adjacent-month last-month calendar-day-2015-06-28"><div class="day-contents">28</div></td><td class="day adjacent-month last-month calendar-day-2015-06-29"><div class="day-contents">29</div></td><td class="day adjacent-month last-month calendar-day-2015-06-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-01"><div class="day-contents">1</div></td><td class="day calendar-day-2015-07-02"><div class="day-contents">2</div></td><td class="day calendar-day-2015-07-03"><div class="day-contents">3</div></td><td class="day calendar-day-2015-07-04"><div class="day-contents">4</div></td></tr><tr><td class="day calendar-day-2015-07-05"><div class="day-contents">5</div></td><td class="day calendar-day-2015-07-06"><div class="day-contents">6</div></td><td class="day calendar-day-2015-07-07"><div class="day-contents">7</div></td><td class="day calendar-day-2015-07-08"><div class="day-contents">8</div></td><td class="day calendar-day-2015-07-09"><div class="day-contents">9</div></td><td class="day calendar-day-2015-07-10"><div class="day-contents">10</div></td><td class="day calendar-day-2015-07-11"><div class="day-contents">11</div></td></tr><tr><td class="day calendar-day-2015-07-12"><div class="day-contents">12</div></td><td class="day calendar-day-2015-07-13"><div class="day-contents">13</div></td><td class="day calendar-day-2015-07-14"><div class="day-contents">14</div></td><td class="day calendar-day-2015-07-15"><div class="day-contents">15</div></td><td class="day calendar-day-2015-07-16"><div class="day-contents">16</div></td><td class="day calendar-day-2015-07-17"><div class="day-contents">17</div></td><td class="day calendar-day-2015-07-18"><div class="day-contents">18</div></td></tr><tr><td class="day calendar-day-2015-07-19"><div class="day-contents">19</div></td><td class="day calendar-day-2015-07-20"><div class="day-contents">20</div></td><td class="day calendar-day-2015-07-21"><div class="day-contents">21</div></td><td class="day calendar-day-2015-07-22"><div class="day-contents">22</div></td><td class="day calendar-day-2015-07-23"><div class="day-contents">23</div></td><td class="day calendar-day-2015-07-24"><div class="day-contents">24</div></td><td class="day calendar-day-2015-07-25"><div class="day-contents">25</div></td></tr><tr><td class="day calendar-day-2015-07-26"><div class="day-contents">26</div></td><td class="day calendar-day-2015-07-27"><div class="day-contents">27</div></td><td class="day calendar-day-2015-07-28"><div class="day-contents">28</div></td><td class="day calendar-day-2015-07-29"><div class="day-contents">29</div></td><td class="day calendar-day-2015-07-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-31"><div class="day-contents">31</div></td><td class="day adjacent-month next-month calendar-day-2015-08-01"><div class="day-contents">1</div></td></tr></tbody></table></div></div>
								
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                               
                            </div> <!-- end col -->
                        </div> <!-- End row -->


                        

                        

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer text-right">
                    <?php echo date('Y')?> © InfoStrategy.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


           
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="dist/assets/js/jquery.min.js"></script>
        <script src="dist/assets/js/bootstrap.min.js"></script>
        <script src="dist/assets/js/detect.js"></script>
        <script src="dist/assets/js/fastclick.js"></script>
        <script src="dist/assets/js/jquery.slimscroll.js"></script>
        
        <script src="dist/assets/js/waves.js"></script>
        <script src="dist/assets/js/wow.min.js"></script>
        <script src="dist/assets/js/jquery.nicescroll.js"></script>
        <script src="dist/assets/js/jquery.scrollTo.min.js"></script>

        <script src="dist/assets/js/jquery.app.js"></script>

        <!-- moment js  -->
        <script src="dist/assets/plugins/moment/moment.js"></script>
        
        <!-- counters  -->
        <script src="dist/assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="dist/assets/plugins/counterup/jquery.counterup.min.js"></script>
        
        <!-- sweet alert  -->
        <script src="dist/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
        
        
        <!-- flot Chart -->
        <script src="dist/assets/plugins/flot-chart/jquery.flot.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="dist/assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>
		<link rel="stylesheet" href="dist/assets/css/clndr.css" type="text/css" />
            <script src="dist/assets/js/underscore-min.js" type="text/javascript"></script>
            <script src= "dist/assets/js/moment-2.2.1.js" type="text/javascript"></script>
            <script src="dist/assets/js/clndr.js" type="text/javascript"></script>
            <script src="dist/assets/js/site.js" type="text/javascript"></script>
			<link rel="stylesheet" href="dist/assets/css/clndr.css" type="text/css" />
           
            <script src="dist/assets/js/clndr.js" type="text/javascript"></script>

        <!-- todos app  -->
        <script src="dist/assets/pages/jquery.todo.js"></script>
        
        <!-- chat app  -->
        <script src="dist/assets/pages/jquery.chat.js"></script>
        
        <!-- dashboard  -->
        <script src="dist/assets/pages/jquery.dashboard.js"></script>
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>

    
    </body>

<!-- Mirrored from moltran.coderthemes.com/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 14 Jul 2016 12:23:45 GMT -->
</html>