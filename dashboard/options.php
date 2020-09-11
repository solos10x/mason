<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$db2 = new db();
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
		$uid = $fetch["id"];
		
		
	 $instantMinimum = $process->getinstantSetUp("minimum");
	 $instantIncentive = $process->getinstantSetUp("incentive");
	 $instantHold = $process->getinstantSetUp("hold");
	 
	  $listedMinimum = $process->getlistedSetUp("minimum");
	 $listedIncentive = $process->getlistedSetUp("incentive");
	 $listedHold = $process->getlistedSetUp("hold");

		
		$dollarRate = $process->getDollarToNairaRate();
$title = siteName.' :::  Donation Options ';
$instantOutput = '';
$listedOutput = '';
?>
<?php
echo $html->dashboardHead('<link href="'.URL.'css/pricing.min.css" rel="stylesheet" type="text/css" />', $title, '', '');
echo $html->dashboardHeader();
echo $html->dashboardSideBar($userLevel);
?>
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                 
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo URL ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Options</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
							
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- END PAGE HEADER-->
                        
						
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                <!-- BEGIN VALIDATION STATES-->
								 
                                    <div class="portlet-body col-md-12">
                                        <div class="note note-success options-instructions">
                                            <h3 class="block">KINDLY NOTE:</h3>
                                            <ul>
                   							
                                            <li> The <b> Instant Donation </b> panel offer <?php echo $process->getinstantSetUp("incentive"); ?>% incentives after 24hrs - 7days based on teh availability of donors. You don't need to wait for the list to make a donation. </li>
                                            
											<li> The default currency on our platform is (cash) US dollars. We are adapting Bitcoin crypto currency as well and advice users to familiarize themselves with online digital currency. Convert from USD ($) to get the exact amount in your local currency.  </li>
                                             
											<li> <b>The Listed Donation </b> panel offer <?php echo $process->getlistedSetUp("incentive"); ?>% incentives after 24hrs - 15days based on supply and demand.The list time will always be communicated on the timeline from time to time. </li>
                                                                                        
                                            <li> Always confirm all details and account numbers and/or Bitcoin address accurately to avoid irreversible transactions once made. </li>
                                            
                                            <li> Once you understand the idea of <b> RE-COMMITMENT</b>, it will create multiple income streams and will make the platform more sustainable. The system will release the held amount once you have successfully completed the recommitment. </li>
                                            
											<li>All participants are highly advised to complete the transaction within 15hrs to avoid suspension.</li>
                                            
											<li>Donate to fellow participants who use same payment processor option to help both of you speed up the transaction (local bank to local bank, BTC to BTC, paypal to paypal)</li>
										 
											<li>Do not reserve or pledge if your have no intention to offer and complete a donation.</li>
											 </ul>
                                        </div>
									</div>
								<div class="portlet-body">
									<div class="pricing-content-1">
										<div class="row">
											<div class="col-md-6">
												<div class="price-column-container border-active">
													<div class="price-table-head bg-green">
														<h2 class="no-margin">Instant Donations</h2>
													</div>
													<div class="arrow-down border-top-green"></div>
													<div class="price-table-pricing">
														<h3>
															<sup class="price-sign">$</sup><?php echo $instantMinimum; ?> <br>
															&#8358; <?php echo $instantMinimum * $dollarRate; ?></h3>
														<p>minimum donation</p>
														 
													</div>
													<div class="price-table-content">
														<div class="row mobile-padding">
															<div class="col-xs-3 text-right mobile-padding">
																<i class="icon-user-follow"></i>
															</div>
															<div class="col-xs-9 text-left mobile-padding"><?php echo $instantIncentive."%" ?> Incentives after 48hrs - 7days</div>
														</div>
													  
														<div class="row mobile-padding">
															<div class="col-xs-3 text-right mobile-padding">
																<i class="icon-refresh"></i>
															</div>
															<div class="col-xs-9 text-left mobile-padding">System holds <?php echo $instantHold."%" ?> in the system for re-donate then releases the full donation once you donate again.</div>
														</div>
													</div>
													<div class="arrow-down arrow-grey"></div>
													<div class="price-table-footer">
														<a href="<?php echo URL ?>dashboard/instantlist" type="button" class="btn green price-button sbold uppercase">CONTINUE</a>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="price-column-container border-active">
													<div class="price-table-head bg-purple">
														<h2 class="no-margin">Listed Donations</h2>
													</div>
													<div class="arrow-down border-top-purple"></div>
													<div class="price-table-pricing">
														<h3>
															<sup class="price-sign">$</sup><?php echo $listedMinimum; ?> <br>
															&#8358; <?php echo $listedMinimum * $dollarRate; ?>
															</h3>
														<p>minimum donation</p>
													</div>
													<div class="price-table-content">
														<div class="row mobile-padding">
															<div class="col-xs-3 text-right mobile-padding">
																<i class="icon-users"></i>
															</div>
															<div class="col-xs-9 text-left mobile-padding"><?php echo $listedIncentive ?>% Incentives after 48hrs - 14days</div>
														</div>
													  
														<div class="row mobile-padding">
															<div class="col-xs-3 text-right mobile-padding">
																<i class="icon-refresh"></i>
															</div>
															<div class="col-xs-9 text-left mobile-padding">System holds <?php echo $listedHold ?>% in the system for re-donate then releases the full donation once you donate again.</div>
														</div>
													</div>
													<div class="arrow-down arrow-grey"></div>
													<div class="price-table-footer">
														<a href="<?php echo URL ?>dashboard/listedlist" type="button" class="btn green price-button sbold uppercase">CONTINUE</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div></div>
						</div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
<?php echo $html->dashboardFooter(''); ?>                 