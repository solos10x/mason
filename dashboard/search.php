<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$searchUsername = '';
$output = '';

		
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
			header("location: ".URL."dashboard/logout");
			exit();
			}
			
		$fetch = $db->getData();
		$username = $fetch["username"];
		$userLevel = $fetch["level"];
		
		if ($userLevel !== "super_admin") {
			header("location: ".URL."dashboard");
			exit();
			}

$title = siteName.' ::: Search User ';
?>
<?php 
		
		if (isset($_GET["user"])) {
			$searchUsername = $db->cleanData($_GET["user"]);
			
			$db->runQuery("SELECT * FROM users WHERE username = '$searchUsername'");
			if ($db->numRows() < 1 ) {
				$output = '<div class="clearfix result-not-found">No record found</div>';
				}
				else {
				$grab = $db->getData();
				$searchUID = $grab["id"];
				$output = ' 
                                     <div class="tab-pane active" id="tab_1_1">
                                      <div class="row parent-row">
                                           <div class="col-md-12">
										   
                                                 <div class="row basic-search-details">
                                                  <div class="col-md-8 profile-info basic-profile-info">
                                                        <h1 class="font-green sbold uppercase">'.ucfirst($grab["username"]).'</h1>
                                                        <p> Joined: <span>'.date("l, jS F Y,  g:i:s A", strtotime($grab["joined"])).' </span> </p>
														<p>Email: <span>'.$grab["email"].'</span> </p>
														<p>Country: <span>'.$grab["country"].'</span> </p>
														<p>Phone: <span>'.$grab["phone"].'</span> </p>
														<p> </p>
                                                        <p>Referal link: <span>'.URL.'login?ref='.strtolower($grab["username"]).'</span></p>
                                                        
                                                    </div>
                                                    <!--end col-md-8-->';
                          
		 // Total Donation Sent
		$totalDonationSent = 0;				 
		$db->runQuery("SELECT donate_amount FROM outgoing WHERE donor_uid = '$searchUID' AND status = 'Confirmed'");
		if ($db->numRows() > 0) {
			while($row = $db->getData()) {
				$totalDonationSent = $totalDonationSent + $row["donate_amount"];
				}
			}
			
		// Total Donation Received
		$totalDonationReceived = 0;
		$db->runQuery("SELECT donate_amount FROM outgoing WHERE recipient_uid = '$searchUID' AND status = 'Confirmed'");
		if ($db->numRows() > 0) {
			while($row = $db->getData()) {
				$totalDonationReceived = $totalDonationReceived + $row["donate_amount"];
				}
			}	 
			
	// total REFERRAL
	$totalReferralBonus = 0;
	$db->runQuery("SELECT amount FROM hold WHERE uid = '$searchUID' AND type = 'Referral Bonus' AND 
			(referred_status = 'completed' AND user_status = 'completed')");
			if ($db->numRows() > 0) {
				while ($row = $db->getData()) {
					$totalReferralBonus = $totalReferralBonus + $row["amount"];
					}
				}	
	
	 	// total incentvie received
		$totalIncentive = 0;
			$db->runQuery("SELECT donate_amount, profit_earned, profit_hold FROM outgoing WHERE donor_uid = '$searchUID' AND status = 'Confirmed'");
			if ($db->numRows() > 0) {
				$totalProfit = 0;
				$totalProfitHold = 0;
				while ($row = $db->getData()) {
					$totalProfit = $totalProfit +  $row["profit_earned"];
					$totalProfitHold = $totalProfitHold + $row["profit_hold"];
					}
				// cacl
				$profitBalance = $totalProfit - $totalProfitHold;
				$totalIncentive = $profitBalance;	
				}
 				
						                            
                         $output .= '<div class="col-md-4">
                                                        <div class="portlet sale-summary">
                                                            <div class="portlet-title">
                                                                <div class="caption font-red sbold"> Activity Summary </div>
                                                                <div class="tools">
                                                                    <a class="reload" href="javascript:;"> </a>
                                                                </div>
                                                            </div>
                                                            
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <span class="sale-info"> CAPITAL
                                                                            <i class="fa fa-img-up"></i>
                                                                        </span>
                                                                        <span class="sale-num"> $'.$totalDonationSent.' </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="sale-info"> EQUITY
                                                                            <i class="fa fa-img-down"></i>
                                                                        </span>
                                                                        <span class="sale-num"> $'.$totalDonationReceived.' </span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="sale-info"> REFFERAL BONUS</span>
                                                                        <span class="sale-num"> $'.$totalReferralBonus.' </span>
                                                                    </li>
																	  <li>
                                                                        <span class="sale-info"> WITHDRAWNAL</span>
                                                                        <span class="sale-num"> $'.$totalIncentive.' </span>
                                                                    </li>
                                                                </ul>
                                                             
                                                        </div>
                                                    </div>   <!--end col-md-4-->
                                                    
                                                </div>
                                                <!--end basic-search-details-->';
              /// view users latest activity
			  $db->runQuery("SELECT * FROM timeline WHERE uid = '$searchUID' ORDER BY id DESC limit 10"); 
			                                   
              $output .= '<ul class="nav nav-tabs"> <li class="active">  <a href="#tab_1_11" data-toggle="tab"> Timeline History </a> </li></ul>';
                                                    
               $output .= ' <div class="tab-content">
                               <div class="tab-pane active">
                                    
                                          <table class="table table-striped table-bordered table-advance table-hover">
                                                  <thead>
                                                            <tr>
                                                                            <th> Type  </th>
                                                                            <th class="hidden-xs"> Date </th> 
																	     </tr>
                                                      </thead>
                               <tbody>';
																	
					if ($db->numRows() < 1) {
						$output .= '<tr><td> No record </td></tr>';
						}
						else {												
				while ($row = $db->getData()) {													
                $output .= ' <tr>
				<td>'.$row["type"].' </td>
				<td>'.date("l, jS F Y,  g:i:s A", strtotime($row["date"])).' </td>
                     </tr>';
						}
						}
						
               $output .= '  </tbody>
                             </table> <!-- end of table -->
                    
                                </div>  <!-- end of tab pane -->
                                </div> <!-- end of tab content -->';
                              
				$output .= '<div class="admin-search-action-wrap">
												<div id="error-upgrade"></div>
												<h4> User Action </h4>
												<p id="admin-upgrade-toggle-wrap"> <button class="btn btn-primary" onclick=\'controller.upgradeToAdmin("'.$grab["username"].'")\' id="upgrade-admin-btn"> Upgrade To Admin </button> </p>
												</div>
												
												<div class="admin-search-action-wrap"> 
												<div id="error-schedule"></div>
												<h4> Confirmed funds depoisted </h4>
												
												<div class="form-group">
												<input class="form-control" id="receive-amount" placeholder="Amount confirmed in dollars"/>
												</div>
												
												<div class="form-group">
												<select class="form-control form-select" id="type"> 
												<option value="Confirmed">Confirmed</option>
												<option value="Unconfirmed">Unconfirmed</option>
												</select>
												</div>
												
												<button class="btn btn-primary" onclick=\'controller.scheduleToReceive("'.$grab["username"].'")\' id="schedule-admin-btn">  Confirm Deposit  </button>
												
												</div>
												<!-- end of admin search action wrap -->
												
                                            </div>
                                            <!--end col-md-12-->
                                            
                                        </div>
                                        <!-- end of parent row -->
                                    </div>
                                    <!--end tab-pane-->
                                     ';	
					
					} // else if recor was found
			
			}
//<link href="'.URL.'plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
//<link href="'.URL.'css/profile-2.min.css" rel="stylesheet" type="text/css" />
?>
<?php
echo $html->dashboardHead('', $title, '', '');
echo $html->dashboardHeader();
echo $html->dashboardSideBar($userLevel);
?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                   
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Search     
                        </h1>
                        <!-- END PAGE TITLE-->
      
                        <div class="profile">
                              
                    
                    <div class="form-group">
                    <label class="control-label">Search</label>
                    <input type="text" class="form-control search-input" placeholder="Enter username" id="user" value="<?php echo $searchUsername; ?>"> 
                     </div>
                   
                       <div class="margiv-top-10">
                     <button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" onclick='controller.searchUser("<?php echo URL ?>")'> Search </button>
                        </div>
  
                     <?php echo $output; ?>
                            
                    
                    </div>
                    
                    </div>
                    
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
       <!-- <script src="'.URL.'scripts/profile.min.js" type="text/javascript"></script> -->
<?php echo $html->dashboardFooter(''); ?>         