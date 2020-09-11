<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$username = '';
$email = '';
$phone = '';
$country = '<option value="">Please select</option>';
$bankAccountName = '';
$bankAccountNumber = '';
$bankAccountType = '';
$bank = '';
$paypalID = '';
$bitcoinAddress = '';

$basicUpdateErr = '';

		
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
		$email = $fetch["email"];
		$phone = $fetch["phone"];
		$country = '<option value="'.$fetch["country"].'">'.$fetch["country"].'</option>';	
		$bankAccountName = $fetch["bank_account_name"];
		$bankAccountNumber = $fetch["bank_account_number"];
		$bank = $fetch["bank"];
		$bankAccountType = $fetch["bank_account_type"];
		$bitcoinAddress = $fetch["bitcoin_address"];
		$paypalID = $fetch["paypal_id"];
		$userLevel = $fetch["level"];
		

		
		if ($username === "") {
			$usernameOutput = '<input type="text" placeholder="Enter a username for your account" class="form-control" value="'.$username.'" id="username"/>';
			}
			else  {
				$usernameOutput = '<input type="text" placeholder="Enter a username for your account" class="form-control" disabled="disabled" value="'.$username.'"/> 
				<input type="hidden" value="'.$username.'" id="username"/>
				';
				}


$title = siteName.' ::: User Profile ';
?>
<?php 
		
		if (isset($_GET["rep"]) && $_GET["rep"] === "incomplete_profile") {
			$basicUpdateErr = '<div class="alert alert-danger"> Please update your basic details before you proceed </div>';
			}
		
?>
<?php 


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
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>
                                                    
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Basic</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Password</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_3" data-toggle="tab">Bank</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_4" data-toggle="tab">Paypal</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_5" data-toggle="tab">Bitcoin</a>
                                                        </li>
                                                    </ul>
                                                    
                                                </div>
                                                
                                                <div class="portlet-body">
                                                 <input type="hidden" name="uid" id="uid" value="<?php echo $userSessionID; ?>"/>
                                                    <div class="tab-content tab-content-inputs-wrap">
                                                    
                                                        <!-- BASIC INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                           <div id="error-basic"><?php echo $basicUpdateErr; ?></div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Username</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                                                                   <?php echo $usernameOutput; ?>
                                                                    </div>
                                                                    </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                     <div class="input-icon">
                       												 <i class="fa fa-envelope"></i>
                                                                    <input type="text" class="form-control"  disabled="disabled" value="<?php echo $email ?>"/> 																	<input type="hidden" id="email" value="<?php echo $email; ?>"/>			
                                                                    </div>
                                                                    </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="control-label">Phone Number</label>
                                                                      <div class="input-icon">
                        <i class="fa fa-phone"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Enter a valid phone number" id="phone" value="<?php echo $phone; ?>"/> 
                        </div>
                </div>
                                                                   
                                                                <div class="form-group">
                                                                    <label class="control-label">Country of Residence</label>
                                                                     <div class="input-icon">
                        <i class="fa fa-location-arrow"></i>
                         <select name="country" id="country" class="select2 form-control">
                        <?php echo $country; ?>
                        <?php include_once("../requests/includes/countries.php"); ?>
                    </select> 
                    </div>
                    </div>
                   
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.updateBasicDetails()" id="update-basic-details-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- END BASIC INFO TAB -->
                                                        
                                                          <!-- PASSWORD INFO TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                           <div id="error-password"></div>
                                                           
                                                            <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="curr-password"/>
                       
                                                                    </div>
                                                                    </div> 
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="new-password"/>
                       
                                                                    </div>
                                                                    </div> 
                                                                    
                                                                <div class="form-group">
                                                                    <label class="control-label">Confirm Password</label>
                                                                     <div class="input-icon">
                       												 <i class="fa fa-lock"></i>
                                              <input type="password" class="form-control" id="conf-password"/> 																		
                                                                    </div>
                                                                    </div>
                          
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.updatePasswordDetails()" id="update-password-details-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- PASSWORD INFO TAB -->
                                                        
                                                        <!-- UPDATE BANK DETAILS TAB -->
                                                           <div class="tab-pane" id="tab_1_3">
                                                           <div id="error-bank"></div>
                                                           
                                                            <div class="form-group">
                                                                    <label class="control-label">Bank Account Name</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="bank-account-name" value="<?php echo $bankAccountName; ?>" placeholder="Enter your bank account name"/>
                       
                                                                    </div>
                                                                    </div> 
                                                                    
                                                                <div class="form-group">
                                                                    <label class="control-label">Bank Account Number</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="bank-account-number" value="<?php echo $bankAccountNumber; ?>" placeholder="Enter your bank account number"/>
                       
                                                                    </div>
                                                                    </div> 
																	
                                                                <div class="form-group">
                                                                    <label class="control-label">Bank Name</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="bank" value="<?php echo $bank; ?>" placeholder="Enter your bank name"/>
                       
                                                                    </div>
                                                                    </div> 
                                                                    
                                                                     <div class="form-group">
                                                                    <label class="control-label">Bank Account Type</label>
                                                                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control" id="bank-account-type" value="<?php echo $bankAccountType; ?>"/ placeholder="e.g Savings, Current">
                       
                                                                    </div>
                                                                    </div> 
                                                                   
                                                                    
                                                                     <div class="form-group">
                                                                    <label class="control-label">Active</label>
                                                                     <div class="input-icon">
                        <i class="fa fa-location-arrow"></i>
                         <select name="bank-active" id="bank-active" class="select2 form-control">
                         <option value="No">No</option>
                         <option value="Yes">Yes</option>
                    </select> 
                    </div> 
                    </div>
                          
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.updateBankDetails()" id="update-bank-details-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- END  BANK DETAILS TAB -->
                                                        
                                                        
                                                        <!-- UPDATE PAYPAL DETAILS TAB -->
                                                           <div class="tab-pane" id="tab_1_4">
                                                           <div id="error-paypal"></div>
                                                                <div class="form-group">
                                                                  
                                                                    <label class="control-label">Paypal ID</label>
                                                                     <div class="input-icon">
                       												 <i class="fa fa-bank"></i>
                                              <input type="text" class="form-control" id="paypal-id" value="<?php echo $paypalID ?>"/> 																		
                                                                    </div>
                                                                    </div>
                                                                    
                                                                     <div class="form-group">
                                                                    <label class="control-label">Active</label>
                                                                     <div class="input-icon">
                        <i class="fa fa-location-arrow"></i>
                         <select id="paypal-active" class="select2 form-control">
                         <option value="No">No</option>
                         <option value="Yes">Yes</option>
                    </select> 
                    </div> 
                    </div>
                          
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.updatePaypalDetails()" id="update-paypal-details-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- END PAYPAL DETAILS  TAB -->
                                                        
                                                        <!-- UPDATE BITCOIN DETAILS -->
                                                           <div class="tab-pane" id="tab_1_5">
                                                           <div id="error-bitcoin"></div>
                                                                <div class="form-group">
                                                                  
                                                                    <label class="control-label">Bitcoin Address</label>
                                                                     <div class="input-icon">
                       												 <i class="fa fa-bank"></i>
                                              <input type="text" class="form-control" id="bitcoin-address" value="<?php echo $bitcoinAddress; ?>"/> 																		
                                                                    </div>
                                                                    </div>
                                                                    
                                                                     <div class="form-group">
                                                                    <label class="control-label">Active</label>
                                                                     <div class="input-icon">
                        <i class="fa fa-location-arrow"></i>
                         <select id="bitcoin-active" class="select2 form-control">
                         <option value="No">No</option>
                         <option value="Yes">Yes</option>
                    </select> 
                    </div> 
                    </div>
                          
                                                                <div class="margiv-top-10">
                                           <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick="controller.updateBitcoinDetails()" id="update-paypal-details-btn"> Update </button>
                                                                </div>
                                                         
                                                        </div>
                                                        <!-- UPDATE BITCOIN DETAILS -->
                                                        
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
                <!-- END CONTENT -->
           
<?php echo $html->dashboardFooter(''); ?>         