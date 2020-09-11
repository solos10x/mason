<?php
include_once('db.php');
include_once('session.php');
class html {
    private $db;
	private $session;
	
    public function __construct($db){
        $this->db = $db;
		$this->session = new session(db);
    }
 
    public function loginHead($css, $title, $desc, $keywords){
		
		if ($desc === "") {
			$desc = siteDesc;
			}
		if ($keywords === "") {
			$keywords = siteKeywords;
			}	
		
       $loginHead = '
<!DOCTYPE html>
<html>
<head>
	<title>'.$title.'</title>
	 
	
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="'.$desc.'" />
		<meta name="keywords" content="'.$keywords.'" />
		<link rel="shortcut icon" href="'.URL.'images/favicon.png" />
	<link rel="stylesheet" href="'.URL.'css/login-style.css"  type="text/css">
	<link href="'.URL.'css/popup-box.css" rel="stylesheet" type="text/css" media="all" />
	 
	   
	   <script src="'.URL.'script/jquery.min.js"></script>
	    
		'.$css.'
</head>
<body>';
	
	return $loginHead;
    }
 
		 
	public function dashboardHead($css, $title, $desc, $keywords){
		if ($desc === "") {
			$desc = siteDesc;
			}
		if ($keywords === "") {
			$keywords = siteKeywords;
			}
		
		$dashboardHead = '<!DOCTYPE html>
				<html lang="en">
					<!-- BEGIN HEAD -->
					<head>
        <meta charset="utf-8" />
        <title>'.$title.'</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
		
        <meta content="'.$desc.'" name="description" />
        <meta content="'.$keywords.'" name="keywords" />
		
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="'.URL.'plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="'.URL.'plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="'.URL.'plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="'.URL.'plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
		
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="'.URL.'plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
		
		 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="'.URL.'plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="'.URL.'plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
		
		 <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="'.URL.'css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="'.URL.'css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
		
		 <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="'.URL.'css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="'.URL.'css/themes/blue.css" rel="stylesheet" type="text/css" id="style_color" />
        <!-- END THEME LAYOUT STYLES -->
		
		<link rel="shortcut icon" href="'.URL.'images/favicon.png" />
		
		'.$css.'
		
		<!-- BEGIN MAIN STYLE SHEET -->
		<link rel="stylesheet" type="text/css" href="'.URL.'css/main.css" />  
		<!-- END MAIN STYLE SHEET -->
		</head>
		
		<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <div class="page-wrapper">
		';	
		
		return $dashboardHead;	
		}
		
 
		public function dashboardHeader() {
		
		/** Begin Top Navigation  **/
		$dashboardHeader = '<div class="page-header navbar navbar-fixed-top">
				<!-- BEGIN HEADER INNER -->
                <div class="page-header-inner">';
				
		/**  Logo Output **/		
		$dashboardHeader .= '<!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="'.URL.'">
                            <img src="'.URL.'/images/logo.jpg" alt="logo" class="logo-default site-logo" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->';
					
		/** Responsive Meu Toggler **/			
		$dashboardHeader .= ' <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><span></span></a>
       	<!-- END RESPONSIVE MENU TOGGLER -->';
		
		
		/** Top Navigation Menu **/
		$userSessionID = $this->db->cleanData($this->session->getSession("userSessionID"));
		$this->db->runQuery("SELECT username, level FROM users WHERE id = '$userSessionID'");
		
		$fetch = $this->db->getData();
		$username = $fetch["username"];
		$level = $fetch["level"];
		if ($username === "") {
			$username = 'Not Set';
			}
			else {
				$username = ucfirst($fetch["username"]);
				}
				
		if ($level === "user") {
			$this->db->runQuery("SELECT id FROM support WHERE uid = '$userSessionID' AND username = 'Admin' AND (user_view_status = '0')");
			
			if ($this->db->numRows() > 0) 	{
			$totalUnread = '<span class="badge badge-default">'.$this->db->numRows().'</span>';
			}
			else {
				$totalUnread = '';
				}
				
			$notif = ' <a href="'.URL.'dashboard/support" class="dropdown-toggle" >
                                    <i class="icon-bell"></i>
                                    '.$totalUnread.'
                                </a>';
			
			}
			else {
				$this->db->runQuery("SELECT id FROM support WHERE username != 'Admin' AND admin_view_status = '0'");
				if ($this->db->numRows() > 0) 	{
			$totalUnread = '<span class="badge badge-default">'.$this->db->numRows().'</span>';
			}
			else {
				$totalUnread = '';
				}
				$notif = ' <a href="'.URL.'dashboard/view_support_tickets" class="dropdown-toggle" >
                                    <i class="icon-bell"></i>
                                    '.$totalUnread.'
                                </a>';
				}
			 
		$dashboardHeader .= '<!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                   
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                               '.$notif.'
                            </li>
                             
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                   
                                    <span class="username username-hide-on-mobile">'.ucfirst($fetch["username"]).'</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="'.URL.'dashboard/profile">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li>
                                  
                                    <li>
                                        <a href="'.URL.'dashboard/logout">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="'.URL.'" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->';
					
		
		/** End Top Navigation **/
		$dashboardHeader .= '</div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <div class="clearfix"> </div>
			
			<!-- START PAGE CONTAINER -->
			<div class="page-container">
			';				
		return $dashboardHeader;
		}
		
		public function dashboardSideBar ($userLevel) {
			
		$dashboardSideBar = ' <!-- START PAGE SIDEBAR WRAPPER -->
         
       <div class="page-sidebar-wrapper">
	   <div class="page-sidebar navbar-collapse collapse">
       
       <!-- START LEFT SIDE BAR NAV -->
       <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
              
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON --> <li class="nav-item start active open">
                                <a href="'.URL.'dashboard" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
						 <li class="heading">
                                <h3 class="uppercase">Features</h3>
                            </li>	
						 
							
							 <li class="nav-item  ">
                                <a href="'.URL.'dashboard/profile" class="nav-link nav-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="title">Profile</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
                            <li class="nav-item">
                                <a href="'.URL.'dashboard/options" class="nav-link nav-toggle">
                                    <i class="fa fa-diamond"></i>
                                    <span class="title">Make Donation</span>
                                    <span class=""></span>
                                </a>
								</li>
								
								
								<li class="nav-item  ">
									<a href="'.URL.'dashboard/incoming" class="nav-link ">
									<i class="fa fa-money"></i>
										<span class="title">Incoming Donation</span>
									</a>
								</li>
								
								<li class="nav-item  ">
									<a href="'.URL.'dashboard/outgoing" class="nav-link ">
									<i class="fa fa-send"></i>
										<span class="title">Outgoing Donation</span>
									</a>
								</li>
							
								<li class="nav-item ">
									<a href="'.URL.'dashboard/hold" class="nav-link ">
										<i class="fa fa-circle-o-notch"></i>
										<span class="title"></i>Hold Donation</span>
									</a>
								</li>
                            <li class="nav-item  ">
                                <a href="'.URL.'dashboard/support" class="nav-link nav-toggle">
                                    <i class="fa fa-support"></i>
                                    <span class="title">Support</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>';
                            
         if ($userLevel === "super_admin") {
			 $dashboardSideBar .= ' <li class="heading">
                                <h3 class="uppercase">Super Features</h3>
                            </li>';
			
			  
			 $dashboardSideBar .= '
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/setup" class="nav-link nav-toggle">
                                    <i class="fa fa-cog"></i>
                                    <span class="title">Site Settings</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
							<!--<li class="nav-item  ">
                                <a href="javascript::" class="nav-link nav-toggle">
                                    <i class="fa fa-bar-chart"></i>
                                    <span class="title">Site Statistics</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>-->
							
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/search" class="nav-link nav-toggle">
                                    <i class="fa fa-database"></i>
                                    <span class="title">Search Users</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/allusers" class="nav-link nav-toggle">
                                    <i class="fa fa-database"></i>
                                    <span class="title">All Users</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
							<!--<li class="nav-item  ">
                                <a href="javascript::" class="nav-link nav-toggle">
                                    <i class="fa fa-list-ol"></i>
                                    <span class="title">Ongoing Schedule</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>-->
							
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/broadcast" class="nav-link nav-toggle">
                                    <i class="fa fa-bullhorn"></i>
                                    <span class="title">Broadcast</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/view_support_tickets" class="nav-link nav-toggle">
                                    <i class="fa fa-ticket"></i>
                                    <span class="title">Support Tickets</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							'; 
							
			 }
			 else if ($userLevel === "admin") {
				  $dashboardSideBar .= ' <li class="heading">
                                <h3 class="uppercase">Super Features</h3>
                            </li>';
			
			  
			 $dashboardSideBar .= '
							<li class="nav-item  ">
                                <a href="'.URL.'dashboard/view_support_tickets" class="nav-link nav-toggle">
                                    <i class="fa fa-ticket"></i>
                                    <span class="title">Support Tickets</span>
                                    <span class="selected"></span>
                                    <span class=""></span>
                                </a>
                            </li>
							'; 
				 }
		 
		 
		 $dashboardSideBar .=  '</ul>
             <!-- END LEFT SIDE BAR NAV -->
                        
                    </div>
                    <!-- END PAGE SIDEBAR  NAVBAR COLLAPSE -->
      </div>
         <!-- END PAGE SIDEBAR WRAPPER -->';	
			
		return $dashboardSideBar;	
			}
		
	
	public function dashboardFooter($addScript) {
		
		$dashboardFooter = '
		</div>
		
		<!-- END OF PAGE CONTAINER -->
		 <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner" > &copy; '.date("Y").' '.siteName.'</div>
				<div class="scroll-to-top"> <i class="icon-arrow-up"></i></div>
            </div>
            <!-- END FOOTER -->
        
        <div class="quick-nav-overlay"></div>
        
		</div>
		<!-- END OF WRAPPER -->
		
        <!--[if lt IE 9]>
		<script src="'.URL.'plugins/respond.min.js"></script>
		<script src="'.URL.'plugins/excanvas.min.js"></script> 
		<script src="'.URL.'plugins/ie8.fix.min.js"></script> 
		<![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="'.URL.'plugins/jquery.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
		
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="'.URL.'plugins/moment.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="'.URL.'scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
		
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="'.URL.'scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
		
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="'.URL.'scripts/layout.min.js" type="text/javascript"></script>
        <script src="'.URL.'scripts/demo.min.js" type="text/javascript"></script>
        <script src="'.URL.'scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="'.URL.'scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="'.URL.'scripts/datatable.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="'.URL.'plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
		
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="'.URL.'scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
		
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="'.URL.'scripts/table-datatables-managed.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
		
		'.$addScript.'
		
		<script src="'.URL.'scripts/main.js" type="text/javascript"></script>
 
    	</body></html> ';
		return $dashboardFooter;
		}
		
	public function homepageHeader ($css, $title, $desc, $keywords) {
		
		if ($desc === "") 
		$desc = siteDesc;
		
		if ($keywords === "") 
		$keywords =  siteKeywords;
		
		
		$homepageHeader = '<!DOCTYPE html>
				<html lang="en">
				 <head>
    		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<!-- Title -->
    <title>'.$title.'</title>

	<!-- favicon -->
	<link href="'.URL.'images/favicon.png" rel="shortcut icon"/>
	
    <!-- Bootstrap -->
    <link href="'.URL.'css/bootstrap.css" rel="stylesheet">
	
    <!-- font-awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	
    <!-- chosen.min -->
    <link href="'.URL.'css/chosen.min.css" rel="stylesheet">
	
    <!-- slick-slider -->
    <link href="'.URL.'css/slick-slider.css" rel="stylesheet">
	
    <!-- jquery.bxslider -->
    <link href="'.URL.'css/jquery.bxslider.css" rel="stylesheet">
	
    <!-- prettyPhoto -->
    <link href="'.URL.'css/prettyPhoto.css" rel="stylesheet">
	
     <!-- responsive menu component -->
    <link href="'.URL.'scripts/responsive-menu/component.css" rel="stylesheet">
	
	<!-- svg-icons -->
	<link href="'.URL.'css/svg-icons.css" rel="stylesheet">

	<!-- Typography -->
	<link href="'.URL.'css/typography.css" rel="stylesheet">
	
	<!-- jquery.auto-complete -->
	<link href="'.URL.'css/jquery.auto-complete.css" rel="stylesheet">
	
	<!-- shortcodes -->
	<link href="'.URL.'css/shortcodes.css" rel="stylesheet">

	<!-- Colors -->
	<link href="'.URL.'css/colors.css" rel="stylesheet">
	
	<!-- Style Sheet -->
	<link href="'.URL.'css/homepage-style.css" rel="stylesheet">
	
	<!-- Responsive theme-->
	<link href="'.URL.'css/homepage-responsive.css" rel="stylesheet">

</head>
	<body>
		<div class="eco_wrapper"> 
				';
		
		$homepageHeader .= ' 			
			<!-- header -->
			<header>
				<div class="kode_eco_navigations">
				<!--container-->
				  <div class="container">
			 
					<div class="kode_eco-top_bar">
						<!--Header top row logo-->
						<div class="kode_eco_logo">
							<a href="'.URL.'"><img src="'.URL.'images/logo.jpg" alt="" style="height:51px"></a>
						</div>
					 
						 
					 
						<div class="kode_eco_social_icons">
							<ul class="social-accounts">
								<li><a href="https://facebook.com/earnerfund" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/earnersfund" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
					 
							 
						</div>
					</div>
					 ';
					
			 
			$homepageHeader .= '<!--Header nav row-->
					<div class="kode_navigaion_bar">
						<!--Responsive Menu Start-->
						<div id="kode-responsive-navigation" class="dl-menuwrapper">
							<button class="dl-trigger">Menu</button>
							<ul class="dl-menu">
								
								<li class="active"><a class="active" href="'.URL.'">Home</a></li>
								<li class="menu-item"><a href="#">Terms</a></li>
								<li class="menu-item"><a href="'.URL.'login">Login</a></li>
								<li class="menu-item"><a href="'.URL.'signup">Sign Up</a></li>
							 
							</ul>
						</div>
						<!--Responsive Menu END-->
						

						<!-- Kode navigation starts -->
					 	<nav class="navigation">
					        <!--Header nav use simple dropdown "use-dropdown" class in li -->
					        <!--example <li class="use-dropdown"> in <ul> <li> <a href="your link"></a> <li> </ul> <li> you create dropdown-->
					        <ul class="nav-menu">
					            <li class="use-dropdown">
					                <a href="'.URL.'">Home</a>
					       
					            </li>
					           
					            <li class="use-dropdown">
					                <a href="'.URL.'#">Terms</a>
					            </li>
								
								 <li class="use-dropdown">
					                <a href="'.URL.'login">login</a>
					            </li>
								
								 <li class="use-dropdown">
					                <a href="'.URL.'signup">Sign Up</a>
					            </li>
					     
					        </ul>
				    	</nav>
				    	<!-- Kode navigation End -->  	
				  
					</div>
					<!--Header nav row ends-->		
					
			
				</div>
				<!-- container ends -->
			</div>
			<!-- kode eco navigations ends -->
		</header>
		<!--Header ends-->	
		';
		return $homepageHeader;
		}		
		
		public function mainSlider() {
		
		$mainSlider =  '<div class="eco_banner banner-slider">
			
            <div class="item">
				<figure>
					<img src="'.URL.'images/eco-banner-img01.png" alt=""/>
					<!--Eco Template Banner caption-->
					<div class="kode_eco_captions container">
						<h2><b>Automated</b> System</h2>
						<p>A system you can trust and rely on</p>
					
						<a href="'.URL.'signup" class="btn-mediem">get involved!</a>
					</div>
				</figure>
			</div>
			
            <div class="item">
				<figure>
					<img src="'.URL.'images/eco-banner-img02.png" alt=""/>
					<!--Eco Template Banner caption-->
					<div class="kode_eco_captions container position-center">
						<h2><b>Honest</b> members</h2>
						<p>guided by the principles oflove and honesty  </p>
						<a href="'.URL.'signup" class="btn-mediem">Know More</a>
					</div>
				</figure>
			</div>
			
            <div class="item">
				<figure>
					<img src="'.URL.'images/eco-banner-img03.png" alt=""/>
					<!--Eco Template Banner caption-->
					<div class="kode_eco_captions container position-right">
						<h2><b>Greener</b> returns</h2>
						<p>for every re-recommitment into the system</p>
						<a href="'.URL.'signup" class="btn-mediem">Join Now!</a>
					</div>
				</figure>
			</div>
            
		</div>';
		
		return $mainSlider;
		}
		
		public function homepageFooter($addScript) {
		
		$footer =  '	<!--Eco footer starts-->
		<footer>
			<!--Eco footer content-->
			<div class="eco_footer_content">
				<!--Eco footer container-->
				<div class="container">
			 
					<div class="eco_template_information">
						<p>&copy; '.date("Y").'
						<br/>
						<a href="'.URL.'" style="color:#7abf18; font-weight:700">Earnersfund.net </a></p>
					</div>
    
				</div>
			</div>
		</footer>
		<!--Eco footer ends-->
		
	 
	</div>
	<!--eco content wrapper ends-->

    <!-- jQuery (JavaScript plugins) -->
    <script src="'.URL.'scripts/jquery.js"></script>

    <!-- Bootstrap js -->
	<script src="'.URL.'scripts/bootstrap-lab.js"></script>    
	<script src="'.URL.'scripts/bootstrap.js"></script>
	
    <!--responsive-menu -->
    <script src="'.URL.'scripts/responsive-menu/modernizr.custom.js"></script>
	<script src="'.URL.'scripts/responsive-menu/jquery.dlmenu.js"></script>
	
    <!-- masonry & filterable -->
	<script src="'.URL.'scripts/jquery-filterable.js"></script>
	<script src="'.URL.'scripts/masonry-gallery.js"></script>
	
    <!-- chosen.jquery js -->
    <script src="'.URL.'scripts/chosen.jquery.min.js"></script>
    <script src="'.URL.'scripts/jquery.auto-complete.js"></script>
	
    <!-- jquery.prettyPhoto js -->
    <script src="'.URL.'scripts/jquery.prettyPhoto.js"></script>
    
	 <!-- countup and countdown js -->
    <script src="'.URL.'scripts/countup.js"></script>
    <script src="'.URL.'scripts/jquery.countdown.js"></script>
    
	<!-- slider -->
	<script src="'.URL.'scripts/slick-slider.js"></script>
	<script src="'.URL.'scripts/jquery.bxslider.js"></script>	
	<script src="'.URL.'scripts/owl.carousel.js"></script>

	<!-- custom js -->
	<script src="'.URL.'scripts/homepage-custom.js"></script>
	
	'.$addScript.'
	
  </body>
</html>';
		
		return $footer;
		}
			
			public function loginTakeNote() {
				$loginTakeNote = '
					<h3>Kindly Note</h3>
				<p>Kindly Note that this a community of honest, dedicated and willing members.</p>';
				return $loginTakeNote;
				}
				
	
 
}