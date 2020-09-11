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
 $bitCoinActive = '';
 $paypalActive = '';
 $bankActive = '';
 $bitCoinIcon = '';
 $paypalIcon = '';
 $bankIcon = '<i class="fa fa-bank payment-icon bank"></i>';
 $recipientBank = '';
 $recipientBankAccountName = '';
 $recipientBankAccountNumber = '';
 $recipientBitcoinAddress = '';
 $recipientCountry = '';
 $recipientPaypalID = '';
 $recipientPhone = '';
 $recipientUID = '';
 $recipientUsername = '';
 

	
	$popUp = '';	
		
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
		$donorUsername = $fetch["username"];
		$userLevel = $fetch["level"];
		$donorUID = $fetch["id"];
	 
	 $dollarRate = $process->getDollarToNairaRate(); 

$title = siteName.' :::  Instant Donations ';
$InstantOutput = '';
?>
<?php 
		$db->runQuery("SELECT * FROM incoming WHERE type = 'Instant' AND status = 'On'");
		if ($db->numRows() < 1) {
			$InstantOutput = '<div class="admin-search-action-wrap" align="center"> Please check back later for the list</div>';
			}
			else {
			$InstantOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Donation ID</th>
								  <th>Recipient</th>
							     <th>Amount in ($)</th>
								 <th>Amount in (&#8358;)</th>
								 <th>Payment Accepted</th>
								 <th>Action</th>
								 </tr>
								 </thead>
						  <tbody>';	
						  
			while ($row = $db->getData()){
			
			$activityID = $row["activityID"];
			$uid = $row["uid"];
			 
			 //check payment accepted
			 $db2->runQuery("SELECT paypal_ID, bitcoin_address FROM users WHERE id = '$uid'");
			
			 if ($db2->numRows() > 0) {
			 $fetch = $db2->getData();
			 $bitCoinActive = $fetch["bitcoin_active"];
			 $paypalActive = $fetch["paypal_active"];
			 $bankActive = $fetch["bank_active"];
			 
			/* if ($bitCoinActive == "Yes") {
				 $bitCoinIcon = '&nbsp; <i class="fa fa-btc payment-icon bitcoin"></i>&nbsp;';
				 }
				 else {
					 $bitCoinIcon  = '';
					 }
				 
				if ($paypalActive != "Yes") {
					$paypalIcon = '&nbsp; <i class="fa fa-cc-paypal payment-icon paypal"></i> &nbsp;';
					} 
					else {
						$paypalIcon = '';
						}
					
					if ($bankActive != 'No') {
						$bankIcon = '<i class="fa fa-bank payment-icon bank"></i>';
						}
						else {
							$bankActive = '';
							}*/
				 
			}
			  
			 /// select outstanding balance for this user
			 $totalDonated = 0;
			 $db2->runQuery("SELECT donate_amount FROM outgoing WHERE activityID = '$activityID'");
			 if ($db2->numRows() > 0) {
				 while ($x = $db2->getData()) {
					 $totalDonated = $totalDonated + $x["donate_amount"];
					 }
				 }
			  
			  $outstandingAmount = $row["amount"] - $totalDonated;
			  
			$InstantOutput .= '<tr>
			<td>#'.$row["activityID"].'</td>
			<td>'.ucfirst($row["username"]).' </td>
			<td>'.$outstandingAmount.'</td>
			<td>'.$outstandingAmount * $dollarRate.' </td>
			<td> '.$bankIcon.' '.$bitCoinIcon.' '.$paypalIcon.'</td>
			<td><a href="'.URL.'dashboard/instantlist?reserve='.$process->encryptDecrypt("encrypt", $activityID).'" class="btn btn-primary btn-wrap green-btn">Donate</a></td>
			</tr>';
			}													
																 
		$InstantOutput .= '</tbody></table>';		  
				}
?>
<?php 
			
			//default output
			$output = ' <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
									<h1 class="page-title"> Make Donation
									</h1>
                                <!-- BEGIN VALIDATION STATES-->
								<div class="portlet box blue-sharp color-remove-prop">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            Instant List</div>
                                    </div>
                                    <div class="portlet-body box-shadowed">
                                        <div class="table-responsive">
                                        '.$InstantOutput.'
                                        </div>
                                    </div>
                                </div>
								
								</div>
							</div>
						</div>';
			
?>
<?php 
		
		///reservation system
		if (isset($_GET["reserve"])) {
			
			
	$popUp = '<script> 
	window.alert("Warning! Do not Reserve if you don\'t intend to complete transaction!");
	</script>';	
			
			$activityID = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["reserve"]));
			$output = '';
			
			//check if activity exists
			$db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID' AND status != 'Completed'");
			if ($db->numRows() < 1) {
				$output = '<div class="admin-search-action-wrap" align="center"> No record found</div>';
				}
				else {
				$fetch = $db->getData();
				$recipientUsername = $fetch["username"];
				$recipientUID = $fetch["uid"];
				$expectedAmount = $fetch["amount"];
				
				// determine outstanding
				$totaDonated = 0;
				$db2->runQuery("SELECT donate_amount FROM outgoing WHERE activityID = '$activityID'");
				if ($db2->numRows() > 0) {
					while ($row = $db2->getData()) {
						$totaDonated = $totaDonated + $row["donate_amount"];
						}
					}
				$outstandingAmount = $expectedAmount - $totaDonated;
					
					
				// select recipient information from user table
					$db->runQuery("SELECT * FROM users WHERE id = '$recipientUID' AND username = '$recipientUsername'");
					if ($db->numRows() > 0) {
						$grab = $db->getData();
						$recipientUsername = $grab["username"];
						$recipientPhone = $grab["phone"];
						$recipientCountry = $grab["country"];
						$recipientBank = $grab["bank"];
						$recipientBankAccountName = $grab["bank_account_name"];
						$recipientBankAccountNumber = $grab["bank_account_number"];
						$recipientPaypalID = $grab["paypal_ID"];
						$recipientBitcoinAddress = $grab["bitcoin_address"];
						}	
					
					$output = ' <div class="portlet-body">
                                <div class="pricing-content-1">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="price-column-container border-active">
											
                                                <div class="price-table-head bg-blue">
                                                    <h2 class="no-margin">Total Amount</h2>
                                                </div>
												
                                                <div class="arrow-down border-top-blue"></div>
												
                                                <div class="price-table-pricing">
                                                   <h3>
                                                        <sup class="price-sign">$</sup><span id="outstanding-dollars">'.$outstandingAmount.'</span></h3>
                                                    <p><b>&#8358; <span id="outstanding-naira">'.$outstandingAmount * $dollarRate.'</span></b></p>
                                                </div>
                                              
                                                <div class="arrow-down arrow-grey"></div>
                                             
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="price-column-container border-active">
                                                <div class="price-table-head bg-red">
                                                    <h2 class="no-margin">Outstanding</h2>
                                                </div>
                                                <div class="arrow-down border-top-red"></div>
                                                <div class="price-table-pricing">
                                                    <h3>
                                                        <sup class="price-sign">$</sup>'.$outstandingAmount.'</h3>
                                                    <p><b>&#8358; '.$outstandingAmount * $dollarRate.'</b></p>
                                                </div>
                                             
                                                <div class="arrow-down arrow-grey"></div>
                                              
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-4">
                                            <div class="price-column-container border-active">
                                                <div class="price-table-head bg-purple">
                                                    <h2 class="no-margin">Your Donation</h2>
                                                </div>
                                                <div class="arrow-down border-top-purple"></div>
                                                <div class="price-table-pricing">
                                                 
												<input type="number" id="amount" class="form-control input-my-donation" placeholder="In dollars"/>
                                                      <button class="btn btn-primary btn-wrap red-btn donate-btn"  id="donate-btn"
						   onclick=\'controller.donateNow("'.$activityID.'", "'.$donorUID.'", "'.$donorUsername.'", "'.$recipientUID.'", "'.$recipientUsername.'", "'.$outstandingAmount.'", "'.$process->getInstantSetUp("minimum").'", "'.$dollarRate.'")\'> Donate </button> </p>
                                                </div>
												
                                                
                                                <div class="arrow-down arrow-grey"></div>
                                                
                                            </div>
                                        </div>
                                       
									   <div class="clearfix"></div>
									   
									 </div>
									   <!-- end of row -->';
					
					
									   
					$output .= ' <div class="reservation-info-board">
									  
									    <h4> Please Note: </h4>
									  <ul> 
									  <li> Minimum donation amount for this section is  <span>$'.$process->getInstantSetUp("minimum").'<span> </li>
									  <li> You gain your <span>donation + '.$process->getInstantSetUp("incentive").'%</span>  within 48 hrs - 7days of donation</li>
									  <li> The system holds back <span>'.$process->getInstantSetUp("hold").'%</span> of the incentive gained. This withheld amount is added up to any amount you are entitled to when you re-donate again. This is to keep the system moving efficiently </li>
									  <li>Do not click on donate if you have no intention of donating the inputed amount</li>
									  <li>There is no cancel button after the button is clicked</li>
									  <li>Amount is in dollars. To pay the intended amount to the recipient in your local currency, do the conversion from dollars to your local currency</li>
									  <li> Contact the recipient after payment to confirm you </li>
									  <li>This platform thrives on faithfulness and and honesty. Defaulters will be penalised</li>
									   
									  </ul> 
									  
									   </div>
									   <!-- end of reservation important notice 
                                      
                                </div>
                            </div>';
					}
			}

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
                       
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo URL ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Make Instant Donations</span>
                                </li>
                            </ul>
                       
                        </div>
                        <!-- END PAGE BAR -->
                   <div id="status-report"></div>     
                   <?php echo $output; ?>
                      
                     
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
<?php echo $html->dashboardFooter($popUp); ?>