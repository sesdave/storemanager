<!DOCTYPE html>
<html>
    
<!-- Mirrored from moltran.coderthemes.com/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 14 Jul 2016 12:16:29 GMT -->
<head>
        <meta charset="utf-8">
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
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
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
                                    <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                        <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
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

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
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
                            
                            <p class="text-muted m-0">Administrator</p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
						
                            <li>
                                <a href="index.html" class="waves-effect waves-light active"><i class="md md-home"></i><span> Dashboard </span></a>
                            </li>
							<?php
	foreach($allowed_modules->result() as $module)
	{
	?>
	<?php if($this->lang->line("module_".$module->module_id)=="Reports"){?>
						
							<li class="has_sub">
                                <a href="#" class="waves-effect waves-light"><i class="md md-mail"></i><span><?php echo $this->lang->line("module_".$module->module_id) ?> </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo site_url("$module->module_id");?>">Detailed Report</a></li>
                                    
                                </ul>
                            </li>
							
			<?php }elseif($this->lang->line("module_".$module->module_id)=="Employees"){?>
										
														<li>
															<a href="<?php echo site_url("$module->module_id");?>" class="waves-effect waves-light"><i class="md md-mail"></i><span><?php echo $this->lang->line("module_".$module->module_id) ?></span></a>
														</li>
														
				<?php }else{?>
		<li class="has_sub">
			
			<a href="<?php echo site_url("$module->module_id");?>" class="waves-effect waves-light"><i class="md md-mail"></i><span><?php echo $this->lang->line("module_".$module->module_id) ?> </span><span class="pull-right"><i class="md md-add"></i></span></a>
				
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
                                <h4 class="pull-left page-title">Welcome !</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Moltran</a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Start Widget -->
                        <div class="row">
						<div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bg-success bx-shadow">
                                    <a href="<?php echo site_url("items");?>"><span class="mini-stat-icon"><i class="ion-eye"></i></span></a>
                                    <div class="mini-stat-info text-right">
                                        <span></span>
                                       Product Inventory  
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0">History<span class="pull-right">0</span></h5>
                                        </div>
                                    </div>
                                </div>
                           </div>
						<?php $i=1; ?>
						 <?php foreach($sale_stuff as $row=>$value){ ?>
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="mini-stat clearfix bx-shadow bg-info">
                                    <span class="mini-stat-icon"><img src="<?php echo base_url().'images/images.ico';?>" width="30" height="30"/></span>
                                    <div class="mini-stat-info text-right">
                                        <span class="counter"><?php echo $value['sales_amount']; ?></span>
                                        Today's Sales
                                    </div>
                                    <div class="tiles-progress">
                                        <div class="m-t-20">
                                            <h5 class="text-uppercase text-white m-0"><?php echo $value['location_name']; ?> <span class="pull-right"><?php echo $i?></span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php $i++;?>
						 <?php } ?>
                            
                            
                        </div> 
                        <!-- End row-->


                        


                        

                    </div> <!-- container -->
                               
                </div> <!-- content -->

                <footer class="footer text-right">
                    <?php echo date('Y')?> © Infostrategy.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


           

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