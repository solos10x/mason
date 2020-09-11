<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);
		
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
		$uid = $fetch["id"];
		
		if ($username === "") {
			header("location: ".URL."dashboard/profile?rep=incomplete_profile");
			exit();
			}	
			
		$dollarRate = $process->getDollarToNairaRate();	

$title = siteName.' ::: User Dashboard';
?>
<?php 
$totalDonationSent = 0;
$totalDonationReceived = 0;
$totalReferralBonus = 0;
$totalIncentive = 0;
$timeline = '';

		// Total Donation Sent
		$db->runQuery("SELECT donate_amount FROM outgoing WHERE donor_uid = '$uid' AND status = 'Confirmed'");
		if ($db->numRows() > 0) {
			while($row = $db->getData()) {
				$totalDonationSent = $totalDonationSent + $row["donate_amount"];
				}
			}
			
			// Total Donation Received
		$db->runQuery("SELECT donate_amount FROM outgoing WHERE recipient_uid = '$uid' AND status = 'Confirmed'");
		if ($db->numRows() > 0) {
			while($row = $db->getData()) {
				$totalDonationReceived = $totalDonationReceived + $row["donate_amount"];
				}
			}
			
			// total referal bonus acquired so far
			$db->runQuery("SELECT amount FROM hold WHERE uid = '$uid' AND type = 'Referral Bonus' AND 
			(referred_status = 'completed' AND user_status = 'completed')");
			if ($db->numRows() > 0) {
				while ($row = $db->getData()) {
					$totalReferralBonus = $totalReferralBonus + $row["amount"];
					}
				}

			// total incentvie received
			$db->runQuery("SELECT donate_amount, profit_earned, profit_hold FROM outgoing WHERE donor_uid = '$uid' AND status = 'Confirmed'");
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
				
				
			// outout timeline recent activites
			$db->runQuery("SELECT * FROM timeline WHERE uid = '$uid' ORDER BY id DESC LIMIT 50");
			if ($db->numRows() < 1) {
				$timeline = '<li style="text-align:center"> No recent activity </li>';
				}	
				else {
				
				while ($row = $db->getData()) {
					
					if ($row["type"] === "Reserve") {
						$iconType = 'fa fa-share';
						}
						else if ($row["type"] === "Basic Update") {
						$iconType = 'fa fa-user';
						}
						else if ($row["type"] === "Password Update") {
						$iconType = 'fa fa-lock';
						}
						else if ($row["type"] === "Bank Update") {
						$iconType = 'fa fa-bank';
						}
						else if ($row["type"] === "Paypal Update") {
						$iconType = 'fa fa-cc-paypal';
						}
						else if ($row["type"] === "Bitcoin Update") {
						$iconType = 'fa fa-btc bitcoin';
						}
						else  {
							$iconType = 'fa fa-check';
							}
							
				$timeline .= ' <li class="timeline-list">
                                 
                                 <div class="label label-sm label-info recent-activities-label"><i class="'.$iconType.'"></i></div>
                                   
                                 <div class="desc recent-activities-info">'.$row["info"].'
								 <p> '.date("l, jS F Y,  g:i:s A", strtotime($row["date"])).' </p>
								 </div>
                                  
								  <div class="clearfix"></div>  
								</li>';	
					}	
					
					}

?>
<?php 
		$broadcast = '';
		$db->runQuery("SELECT message, date FROM broadcast WHERE status = 'On' ORDER BY id DESC LIMIT 1");
		if ($db->numRows() === 1) {
			$row = $db->getData();
			$broadcast = '<div class="alert alert-danger">'.$row["message"].'</div>';
			}
?>
<?php 
		$broadcastHistory = '';// 
		$db->runQuery("SELECT * FROM broadcast WHERE status = 'Off'");
		if ($db->numRows() < 1) {
			$broadcastHistory = '<li style="text-align:center">No broadcast history</li>';
			}
			else {
			while ($row = $db->getData()) {	
				$broadcastHistory .= ' <li>
                           <div class="task-checkbox">
                           <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" value="1" checked="checked" disabled="disabled"/>
                             <span></span>
                             </label>
                            </div>
                                                       
								 <div class="task-title brodcast-history">
                                 '.$row["message"].'
								 
								 <p> '.date("l, jS F Y,  g:i:s A", strtotime($row["date"])).' </p>
                                  </div>
                                                      
			</li>';
			}
				}

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
              
                    
                     <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Dashboard</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
							
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                 		<?php echo $broadcast; ?>
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Dashboard
                            <small>stats</small>
                        </h1>
                        <!-- END PAGE TITLE-->
                        
                        
                        
                        <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="row">
                        
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                <div class="dashboard-stat2 box-shadowed">
                                    <div class="display">
                                        <div class="number">
                                            <h4 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo $totalDonationSent / $dollarRate; ?>"><?php echo $totalDonationSent *  $dollarRate ?></span>
                                                <small class="font-green-sharp">BTC</small>
                                            </h4>
                                            <small>Capital</small>
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo $totalDonationSent; ?>"><?php echo $totalDonationSent; ?></span>
                                                <small class="font-green-sharp">$</small>
                                            </h3>
                                        </div>
                                        
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                                                <span class="sr-only">100% progress</span>
                                            </span>
                                        </div>
                                    </div>
								</div>
                            </div>
                            
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 box-shadowed">
                                    <div class="display">
                                        <div class="number">
                                            <h4 class="font-purple-soft">
                                                <span data-counter="counterup" data-value="<?php echo $totalIncentive / $dollarRate; ?>"><?php echo $totalIncentive * $dollarRate; ?></span>
                                                <small class="font-purple-soft">BTC</small>
                                            </h4>
                                            <small><strong>EQUITY/PROFIT</strong></small>
                                            <h3 class="font-purple-soft">
                                                <span data-counter="counterup" data-value="<?php echo $totalIncentive; ?>"></span>
												<small class="font-purple-soft">$</small>
                                            </h3>
                                        </div>
                                        <div class="icon">
                                           
                                        </div>
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 100%;" class="progress-bar progress-bar-success purple-soft">
                                                <span class="sr-only">56% change</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 box-shadowed">
                                    <div class="display">
                                        <div class="number">
                                            <h4 class="font-blue-sharp">
                                                <span data-counter="counterup" data-value="<?php echo $totalReferralBonus * $dollarRate ?>"><?php echo $totalReferralBonus * $dollarRate ?></span>
                                                <small class="font-blue-sharp">BTC</small>
                                            </h4>
                                            <small><strong>REFERRAL BONUS</strong></small>
                                            <h3 class="font-blue-sharp">
                                                <span data-counter="counterup" data-value="<?php echo $totalReferralBonus; ?>"></span>
												<small class="font-blue-sharp">$</small>
                                            </h3>
                                        </div>
                                        <div class="icon">
                                           
                                        </div>
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 100%;" class="progress-bar progress-bar-success blue-sharp">
                                                <span class="sr-only">45% grow</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 box-shadowed">
                                    <div class="display">
                                        <div class="number">
                                            <h4 class="font-red-haze">
                                                <span data-counter="counterup" data-value="<?php echo $totalDonationReceived * $dollarRate ?>"><?php echo $totalDonationReceived * $dollarRate ?></span>
                                                <small class="font-red-haze">BTC</small>
                                            </h4>
                                            <small>WITHDRAWNAL</small>
                                            <h3 class="font-red-haze">
                                                <span data-counter="counterup" data-value="<?php echo $totalDonationReceived; ?>"><?php echo $totalDonationReceived; ?></span>
												<small class="font-red-haze">$</small>
                                            </h3>
                                        </div>
                                        <div class="icon">
                                             
                                        </div>
                                    </div>
                                    <div class="progress-info">
                                        <div class="progress">
                                            <span style="width: 100%;" class="progress-bar progress-bar-success red-haze">
                                                <span class="sr-only">85% change</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                           
                            
                          
							
                            <div class="col-md-12 dashboard-stats-box-2">
                              <!--  BEGIN PORTLET -->
                                    <div class="col-md-4 dashboard-portlet">
                                    <a href="http://coindesk.com" target="_blank">
                                        <div class="note note-success box-shadowed">
                                            <h4 class="block"><strong>Bitcoin Live Updates</strong></h4>
                                            <p> News, Prices and information on Bitcoins and other Digital Currencies. </p>
                                        </div>
                                        </a>
									</div>
                                   
                                    <div class="col-md-4 dashboard-portlet ">
                                        <div class="note note-info box-shadowed ">
                                            <h4 class="block">
                                            <strong>
                                              Trading will be done 5 days in a week 
                                            </strong>
                                            </h4>
                                            <p> i.e. Monday to Friday<br/></p>
                                        </div>
									</div>
                                    
                                    <div class="col-md-4 dashboard-portlet">
                                        <div class="note note-danger box-shadowed">
                                            <a href="<?php echo URL."dashboard/myreferrals" ?>"><h4 class="block"><strong>Click to view your referrals</strong></h4>
                                            <p> <?php echo URL."signup?ref=".$username; ?>  <br/> <br/></p> 
                                            </a>
                                        </div>
									</div>
                                    <!---->
								</div>
						</div>
						
                        <div class="row">
                        
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light bordered box-shadowed">
                                
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-share font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase">My Timeline</span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="portlet-body ">
                                    
                                        <div class="scroller " style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                           
                                            <ul class="feeds">
                                               <?php echo $timeline; ?>
                                            </ul>
                                        </div>
                                     
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                            <!-- Boradcast history -->
                            
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                                <div class="portlet light tasks-widget bordered box-shadowed">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-share font-dark hide"></i>
                                            <span class="caption-subject font-dark bold uppercase">Broadcast History</span>
                                        </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="task-content">
                                            <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
                                                <!-- START TASK LIST -->
                                                <ul class="task-list">
                                                  <?php echo $broadcastHistory; ?>
                                                </ul>
                                                <!-- END START TASK LIST -->
                                            </div>
                                        </div>
                                       <!-- <div class="task-footer">
                                            <div class="btn-arrow-link pull-right">
                                                <a href="javascript:;">See All Records</a>
                                                <i class="icon-arrow-right"></i>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- END CONTENT BODY -->
                    
                    
				</div>
                <!-- END CONTENT -->
                
<?php 
	
	$popUp = '';	
		
echo $html->dashboardFooter($popUp); 

?>             