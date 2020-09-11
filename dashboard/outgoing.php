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
$recipientBank = 'N/A';
$recipientBankAccountName = 'N/A';
$recipientBankAccountNumber = 'N/A';
$recipientBitcoinAddress = 'N/A';
$recipientCountry = 'N/A';
$recipientPaypalID = 'N/A';
$recipientPhone = 'N/A';

		
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
	 	
		$dollarRate = $process->getDollarToNairaRate();

$title = siteName.' ::: Outgoing Donations ';
$instantOutput = '';
$listedOutput = '';
?>
<?php 
		
		//select for 
		$db->runQuery("SELECT * FROM outgoing WHERE donor_uid = '$uid' AND type = 'Instant' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			
			$instantOutput = '<p align="center"> No record  </p>';
			
		}
		else {
			$instantOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Donation ID</th>
								  <th>Recipient  </th>
							     <th>Amount Donated ($)</th>
								 <th> Amount Donated (&#8358;) </th>
								 <th>Status</th>
								 <th>Action</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			
			$activityID = $row["activityID"];
		 
		 	$status = '';
			
			if ($row["status"] === "Reserved") {
				$status = '<label class="label label-info">Reserved</label>';
				}
				else if ($row["status"] === "Paid") {
					$status = '<label class="label label-warning">Paid</label>';
					}
					else if ($row["status"] === "Unconfirmed") {
						$status = '<label class="label label-danger">Unconfirmed</label>';
						}
						else if ($row["status"] === "Confirmed") {
						$status = '<label class="label label-success">Confirmed</label>';
						}
							
			$instantOutput .= '<tr>
			<td>#'.$row["activityID"].'</td>
			<td>'.$row["recipient_username"].'</td>
			<td>'.$row["donate_amount"].' </td>
			<td>'.$row["donate_amount"] * $dollarRate.'</td>
			<td>'.$status.'</td>
			<td><a href="'.URL.'dashboard/outgoing?activity='.$process->encryptDecrypt("encrypt", $activityID).'&rid='.$process->encryptDecrypt("encrypt", $row["id"]).'" class="label label-success">View</a></td>
			</tr>';
			}													
																 
		$instantOutput .= '</tbody></table>';
			}

?>
<?php 
		
		//select for 
	  $db->runQuery("SELECT * FROM outgoing WHERE donor_uid = '$uid' AND type = 'Listed' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			
			$listedOutput = '<p align="center"> No record  </p>';
			
		}
		else {
			$listedOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Donation ID</th>
								 <th>Recipient  </th>
							     <th>Amount Donated ($)</th>
								 <th> Amount Donated (&#8358;) </th>
								 <th>Status</th>
								 <th>Action</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			
			$activityID = $row["activityID"];
		 
		 	$status = '';
			
			if ($row["status"] === "Reserved") {
				$status = '<label class="label label-info">Reserved</label>';
				}
				else if ($row["status"] === "Paid") {
					$status = '<label class="label label-warning">Paid</label>';
					}
					else if ($row["status"] === "Unconfirmed") {
						$status = '<label class="label label-danger">Unconfirmed</label>';
						}
						else if ($row["status"] === "Confirmed") {
						$status = '<label class="label label-success">Confirmed</label>';
						}
							
			$listedOutput .= '<tr>
			<td>#'.$row["activityID"].'</td>
			<td>'.$row["recipient_username"].'</td>
			<td>'.$row["donate_amount"].' </td>
			<td>'.$row["donate_amount"] * $dollarRate.'</td>
			<td>'.$status.'</td>
			<td><a href="'.URL.'dashboard/outgoing?activity='.$process->encryptDecrypt("encrypt", $activityID).'&rid='.$process->encryptDecrypt("encrypt", $row["id"]).'" class="label label-success">View</a></td>
			</tr>';
			}													
																 
		$listedOutput .= '</tbody></table>';
			}

?>
<?php 
			//default output
			$output = '<div class="row">
                            <div class="col-md-12">
                            
                                <div class="portlet light bordered">
                                       
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> Instant </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> Listed </a>
                                            </li>
                                        </ul>
                                        
										<div class="tab-content">
                                        
											<div class="tab-pane fade active in" id="tab_1_1">
																
										 
												<div class="portlet box blue-sharp color-remove-prop">
													<div class="portlet-title">
														<div class="caption">
															 Outgoing Donation  </div>
													</div>
													<div class="portlet-body box-shadowed">
														<div class="table-responsive">
															'.$instantOutput.'
														</div>
													</div>
												</div>
											</div>
							
											<div class="tab-pane fade" id="tab_1_2">
												<!-- BEGIN SAMPLE FORM PORTLET-->
												 <div class="portlet box  blue-madison green-meadow  color-remove-prop">
													
                                                    <div class="portlet-title">
														<div class="caption">
														Outgoing Donation </div>
													</div>
                                                    
													<div class="portlet-body box-shadowed">
														<div class="table-responsive">
														'.$listedOutput.'
														</div>
													</div>
                                                    
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                            ';
?>
<?php 
		///view user activity
		if (isset($_GET["activity"])) {
			
		$activityID = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["activity"]));
		$rowID = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["rid"]));
		
		$db->runQuery("SELECT * FROM outgoing WHERE activityID = '$activityID' AND (donor_uid = '$uid' AND id = '$rowID') ");	
		
		if ($db->numRows() < 1) {
			$output = '<div align="center" class="admin-search-action-wrap">No record found for this ID</div>';
			}	
			else {
			
			$output = '';
			
			// loop out 
			while ($fetch = $db->getData()){
	 
			$amountDonated = $fetch["donate_amount"];
			$profitHold = $fetch["profit_hold"];
			$type = $fetch["type"];
  			$recipientUID = $fetch["recipient_uid"];
			$recipientUsername = $fetch["recipient_username"];
			
			$output .= '<div class="reservation-info-board box-shadowed">
			<h4> Outgoing Donation for Activity (#'.$fetch["activityID"].') </h4>
			<div id="error-donate-status"></div>
			';
			$output .= '<ul>
			 <li>Your donation($): <span>$'.$fetch["donate_amount"].'</span> </li>
			 <li>Your donation(&#8358;): <span>&#8358;'.$fetch["donate_amount"] * $dollarRate.'</span> </li>
			  </ul>';

			//select out recipient info
			$db2->runQuery("SELECT * FROM users WHERE id = '$recipientUID'  AND username = '$recipientUsername'");
			if ($db2->numRows() > 0) {
				$grab = $db2->getData();
				$recipientCountry = $grab["country"];
				$recipientUID = $grab["id"];
				$recipientPhone = $grab["phone"];
				$recipientBank = $grab["bank"];
				$recipientBankAccountName = $grab["bank_account_name"];
				$recipientBankAccountNumber = $grab["bank_account_number"];
				$recipientPaypalID = $grab["paypal_ID"];
				$recipientBitcoinAddress = $grab["bitcoin_address"];
				}
				
			
			$output .='	<ul>
			 <h4> Recipient Details</h4>
			<li>Username: <span>'.$recipientUsername.'</span> </li>
			<li>Country: <span>'.$recipientCountry.'</span> </li>
			<li>Phone Number: <span>'.$recipientPhone.'</span> </li>
			<li>Bank: <span>'.$recipientBank.'</span> </li>
			<li>Account Name: <span>'.$recipientBankAccountName.'</span> </li>
			<li>Account Number: <span>'.$recipientBankAccountNumber.'</span> </li>
			<li>Paypal ID: <span>'.$recipientPaypalID.'</span> </li>
			<li>Bitcoin Address: <span>'.$recipientBitcoinAddress.'</span> </li>
			</ul><br/>';
			
			// determine status
			if ($fetch["status"] === "Reserved") {
				$status = '<button class="btn btn-primary btn-wrap red-btn" onclick=\'controller.donorPaidBtn("'.$fetch["donor_uid"].'", "'.$fetch["donor_username"].'", "'.$activityID.'", "'.$fetch["id"].'")\' id="donor-confirm-paid-btn">Paid</button>
			<p> <small> Only click on this button if you are very sure you have donated this amount to the recipient whose details are displayed above </small> </p>';
			$status .= '<div align="right" class="cancel-reservation-wrap">  <button class="btn btn-primary" onclick=\'controller.cancelReservation("'.$fetch["donor_uid"].'", "'.$fetch["donor_username"].'", "'.$fetch["activityID"].'", "'.$fetch["id"].'", "'.$type.'", "'.$amountDonated.'", "'.$profitHold.'",   "'.$recipientUID.'", "'.URL.'")\' id="donor-cancel-reservation-btn"> Cancel Reservation</button> 
			<p> <small> Please kindly note that cancelling this reservation will make you forfeit corresponding incentives and bonuses you should have earned by making the donation </small> </p>
			</div>
		<div class="clearfix"></div>';
				}
				else if ($fetch["status"] === "Paid") {
				$status = '<button class="btn btn-primary btn-wrap red-btn" disabled="disabled">Awaiting Confirmation</button>
			<p> <small> Contact the recipient to confirm the receival of your donation </small> </p>';	
					}
					else if ($fetch["status"] === "Unconfirmed") {
				$status = '<button class="btn btn-primary btn-wrap red-btn" disabled="disabled">Unconfirmed</button>
			<p> <small> Rcipient didn\'t confirm the receival of your donation </small> </p>';		
						}
						else if ($fetch["status"] === "Confirmed") {
				$status = '<button class="btn btn-primary btn-wrap green-btn" disabled="disabled">Confirmed and Completed</button>
			<p> <small> Your donation for this activity was confirmed </small> </p>';		
						}
						
		 	
			$output .= '<div id="donate-status-wrap">'.$status.'</div>';
			
			
			$output .= '</div>';
			} // end nof loop oit
			 
			
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
                                    <a href="<?php echo URL ?>">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Outgoing Donation</span>
                                </li>
                            </ul>
                          
                       
                        </div>
                        <!-- END PAGE BAR -->
                        
          				<?php echo $output; ?>
                        
                            
						</div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
<?php echo $html->dashboardFooter(''); ?>                 