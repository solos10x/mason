<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$bitcoinValue = '';
$dollarToNaira = '';
		
		//session check
		if (!$session->sessionCheck("userSessionID")){
			header("location: ".URL."login");
			exit();
		}
		else {
		$userSessionID = $db->cleanData($session->getSession("userSessionID"));
		}
		
		
		//select and check
		$db->runQuery("SELECT * FROM users WHERE id = '$userSessionID'");
		if ($db->numRows() < 1) {
			header("location: ".URL);
			exit();
			}
			
		$fetch = $db->getData();
		$username = $fetch["username"];
		$userLevel = $fetch["level"];
		
		if ($userLevel !== "super_admin") {
			header("location: ".URL."dashboard");
			exit();
			}

$title = siteName.' Admin Site Set Up ';
?>
<?php
		//select site set up information
		$db->runQuery("SELECT * FROM setup ORDER BY id DESC LIMIT 1");
		if ($db->numRows() > 0) {
			$fetch = $db->getData();
			$bitcoinValue = $fetch["bitcoin_value"];
			$dollarToNaira = $fetch["dollar_to_naira"];
			$referralBonus = $fetch["referral_bonus"];
			}
		
?>
<?php
echo $html->dashboardHead('
<link href="'.URL.'plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="'.URL.'plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="'.URL.'plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="'.URL.'css/profile.min.css" rel="stylesheet" type="text/css" />
', $title, '', '');
echo $html->dashboardHeader();
echo $html->dashboardSideBar($userLevel);
?>
 
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        
                   
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo URL.'dashboard/profile'; ?>">Dashboard</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>User Profile</span>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END PAGE BAR -->
                        
                       
                        <div class="row">
                            <div class="col-md-12">
                            
                               
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content profile-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                        
                                            <div class="portlet light ">
                                            
                                                <div class="portlet-title tabbable-line">
                                                
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Site Setup</span>
                                                    </div>
                                                    
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Bitcoin</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Dollar</a>
                                                        </li>
                                                         <li>
                                                            <a href="#tab_1_6" data-toggle="tab">Referral Bonus</a>
                                                        </li>

                                                    </ul>
                                                    
                                                </div>
                                                
                                                <div class="portlet-body">
                                               
                                                    <div class="tab-content tab-content-inputs-wrap">
                                                    
                                                        <!-- BITCOIN SETUP TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                           <div id="error-bitcoin"></div>
                                                           
                                                              <div class="form-group">
                                                                        <label class="control-label">Bitcoin</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                1 bitcoin = 
                                                                            </span>
                                    <input type="text" class="form-control form-input-no-border" placeholder="value in dollars" id="bitcoin-value" value="<?php echo $bitcoinValue; ?>"> 
                                                    </div>
                                                       </div>
                   
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.setBitcoinValue()" id="update-bitcoin-value-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- END BASIC INFO TAB -->
                                                        
                                                          <!-- DOLLAR SETUP TAB -->
                                                          <div class="tab-pane" id="tab_1_2">
                                                           <div id="error-dollar"></div>
                                                           
                                                              <div class="form-group">
                                                                        <label class="control-label">Dollar to Naira Value</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                1 dollar = 
                                                                            </span>
                                    <input type="text" class="form-control form-input-no-border" placeholder="value in naira" id="dollar-value" value="<?php echo $dollarToNaira; ?>"> 
                                                    </div>
                                                       </div>
                   
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.setDollarValue()" id="update-dollar-value-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- DOLLAR SET UP TAB -->
                                                       
                             
                             
                          <!-- REFERRAL BONUS -->
                     <div class="tab-pane" id="tab_1_6">
                      <div id="error-referral"></div>
                                                           
                     <div class="form-group">
                    <label class="control-label">Referral Bonus</label>
                    <input type="text" class="form-control form-input-no-border" placeholder="Enter a number" id="ref-bonus" value="<?php echo $referralBonus; ?>"> 
                     </div>
                   
                       <div class="margiv-top-10">
                     <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.setReferralBonus()" id="update-ref-btn"> Update </button>
                        </div>
                                                         
                           </div>
                             <!-- END REFERRAL BONUS TAB -->    
                                                       
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                                
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT //ionic-letteravatar-->
           
      
     
<?php echo $html->dashboardFooter('
<script src="'.URL.'plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="'.URL.'plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="'.URL.'scripts/profile.min.js" type="text/javascript"></script>'); ?>         