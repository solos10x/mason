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
$reserverCountry = 'N/A';
$reserverPhone = 'N/A';
$reserverUID = 'N/A';
$reserverUsername = 'N/A';

$userPaypalID = 'N/A';
$userBitcoinAddress = 'N/A';

		
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
		$email = $fetch["email"];
		$phone = $fetch["phone"];
		$uid = $fetch["id"];
		$bank = $fetch["bank"];
		$bankAccountName = $fetch["bank_account_name"];
		$bankAccountNumber = $fetch["bank_account_number"];
		$bankAccountType = $fetch["bank_account_type"];
		
		if ($fetch["paypal_id"] !== ""){
			$userPaypalID = $fetch["paypal_id"];
			} else if ($fetch["bitcoin_address"] !== "") {
				$userBitcoinAddress = $fetch["bitcoin_address"];
				}
		
		$dollarRate = $process->getDollarToNairaRate();
	 

$title = siteName.' ::: Deposit History ';
$instantOutput = '';
$listedOutput = '';
?>
<?php 
		
		//select for instant
		$db->runQuery("SELECT * FROM incoming WHERE uid = '$uid' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			
			$instantOutput = '<p align="center"> No record  </p>';
			
		}
		else {
			$instantOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Activity ID</th>
							     <th>Payment Method </th>
								 <th>Deposited Amount($)</th>
								  <th>Deposited Amount(&#8383)</th>
								 <th>Status</th>
								 <th>Action</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			
			$activityID = $row["activityID"];
			// determine status
			$statusOutput = '<span class="activity-status-note activity-completed">Completed</span>';
			if ($row["status"] !== "Completed") {
				$statusOutput = '<span class="activity-status-note activity-pending">Pending</span>';
			}
			$instantOutput .= '<tr>
			<td>#'.$row["activityID"].'</td>
			<td>BTC Transfer</td>
			<td>$'.$row["amount"].'</td>
			<td>&#8383;'.$row["amount"] / $dollarRate.' </td>
			<td>'.$statusOutput.'</td>
			<td><a href="'.URL.'dashboard/deposit_history?activity='.$process->encryptDecrypt("encrypt", $activityID).'" class="label label-success">View</a></td>
			</tr>';
			}													
																 
		$instantOutput .= '</tbody></table>';
			}

?>

<?php 
			//default output
			$output = '<div class="row">
                            <div class="col-md-12">
                            
                                <div class="portlet light bordered">
                                       
										<div class="tab-content">
                                        
											<div class="tab-pane fade active in" id="tab_1_1">
																
												<!-- OUTPUT INSTANT DONATION HISTORY-->
												<div class="portlet box blue-sharp color-remove-prop">
													<div class="portlet-title">
														<div class="caption">
															 Deposit <small>History</small></div>
													</div>
													<div class="portlet-body box-shadowed">
														<div class="table-responsive">
															'.$instantOutput.'
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
		$db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID' AND uid = '$uid'");	
		
		if ($db->numRows() < 1) {
			$output = '<div align="center">No record found for this ID</div>';
			}
				
			else {
			$fetch = $db->getData();
			$totalExpected = $fetch["amount"];
			$recipientUID = $fetch["uid"];
			$recipientUsername =  $fetch["username"];
			$type = $fetch["type"];
			$iRowID = $fetch["id"];
			
			$totalReserved = 0;
			
			/// determine total received in this activity so far
			$db->runQuery("SELECT amount FROM incoming WHERE activityID = '$activityID' AND  (type = '$type' AND status != 'pedding')");	
			if ($db->numRows() > 0) {
				while ($row = $db->getData()) {
					$totalReserved = $totalReserved + $row["amount"];
					}
				}
			
			$balanceLeft = $totalExpected - $totalReserved;	
				
		//		
			$output = '<div class="preview-activity-history"> 
			<h4> Incoming Donation (#'.$fetch["activityID"].') </h4>
			<ul>
			<li class="text-success"><b> Total Deposit: <span>$ '.$totalReserved.' </span>(&#8383; '.$totalReserved / $dollarRate.');</b> </li>
			<div class="clearfix"></div>
			<div class=""> <a href="'.URL.'dashboard/deposit_history?viewreceipt='.$fetch["activityID"].'" target="_blank"> <span class="activity-status-note activity-pending"> View Receipt </span> </a> </div>
			 </ul>';
			 
			 
			 /// show table of payers if exists
			 $db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID'");
			 if ($db->numRows() < 1) {
				 $output .= '<div align="center">  No deposit details at the moment</div>';
				 }
				 else {
					 $output  .= '<h4> Deposit  </h4>';
					 
						  
				while ($row = $db->getData()){
		 
			$reserverUID = $row["uid"];
			$oRowID = $row["id"];
			
			//get username, phone, country
			$db2->runQuery("SELECT username, phone, country FROM users WHERE id = '$reserverUID'");
			if ($db2->numRows() > 0) {
				$fetch = $db2->getData();
				$reserverUsername = $fetch["username"];
				$reserverPhone = $fetch["phone"];
				$reserverCountry = $fetch["country"];
				}
			
			
			 
				
			$output .= '<div class="box-shadowed table-wrap-padded preview-inc-record">
			<div id="error-'.$oRowID.'"> </div>
			<div class="table-responsive">
			<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Username</th>
							     <th>Deposited Amount ($)</th>
								 <th>Deposited Amount (&#8383;)</th>
								 <th>Country</th>
								 <th>Phone</th>
								 <th>Status</th>
								 </tr>
								 </thead>
						  <tbody>';			
			$output .= '<tr>
			<td>'.$reserverUsername.'</td>
			<td>$'.$row["amount"].'</td>
			<td>&#8383;'.$row["amount"] / $dollarRate.'</td>
			<td>'.$reserverCountry.'</td>
			<td>'.$reserverPhone.'</td>
			<td><b id="status-box-'.$oRowID.'">'.$row["status"].'</b></td>
			</tr>';
			$output .= '</tbody></table> </div>
			';
			
			if ($row["status"] === "Paid") {
				$btns = '<br/> <br/> 
			<button class="btn btn-primary btn-wrap green-btn" onclick=\'controller.recipientConfirmDonation("'.$activityID.'", "'.$recipientUID.'", "'.$recipientUsername.'", "'.$reserverUID.'", "'.$reserverUsername.'", "'.$type.'", "'.$iRowID.'", "'.$oRowID.'")\' id="confirm-donation-btn-'.$oRowID.'"> Confirm </button>   
			<p> <small> I hereby agree to the fact that I received donation from '.ucfirst($reserverUsername).'</small> </p> <br/> <br/> <br/>
			 
			<!--<button class="btn btn-primary btn-wrap red-btn" onclick=\'controller.recipientUnconfirmDonation("'.$activityID.'", "'.$recipientUID.'", "'.$recipientUsername.'", "'.$reserverUID.'", "'.$reserverUsername.'", "'.$type.'", "'.$iRowID.'", "'.$oRowID.'")\' id="unconfirm-donation-btn-'.$oRowID.'"> Unconfirm </button>  
			<p> <small> I hereby claim that no payment for this activity was made to me by  '.ucfirst($reserverUsername).'</small> </p>
			</div>-->';	
				}
				else {
					$btns = '';
					}
			
			
			
			$output .= '<div id="btn-wrap-'.$oRowID.'" class="btn-wrap-incoming-conf">'.$btns.'</div>';
			$output .= '</div>';	
			}													
																 
			  
					 
					 }
			 
			 
			$output .= '</div>';
				} // else if match exists
		
			
			} // end of if get actigivty

?>
<?php 
			
			// view transaction reciept
			if (isset($_GET["viewreceipt"])) {
			
			$activityID = $db->cleanData($_GET["viewreceipt"]);
			
			// check if exists 	
			$db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID' AND uid = '$uid'");
			if ($db->numRows() < 1) {
				$output = '<div class="admin-search-action-wrap" align="center">  No record found </div>';
				}
				else {
				
				$grab = $db->getData();
				$totalExpected = $grab["amount"];
				$type = $grab["type"];
				$receiptStatus = $grab["status"];
				
				if ($receiptStatus === "Completed") {
					$status = '<span class="activity-status-note activity-completed">Completed</span>';
					}
					else {
						$status = '<span class="activity-status-note activity-pending">Pending</span>';
						}
			 		
				$output = ' 
				<div class="admin-search-action-wrap"> 
                      
                        <h1 class="page-title"> Activity
                            <small>Receipt</small>
                        </h1>
                      
						
                        <div class="invoice">
                            <div class="row invoice-logo">
                                <div class="col-xs-6 invoice-logo-space">
                                    <img src="'.URL.'images/lo.png" class="img-responsive" alt="" /> </div>
									
                                <div class="col-xs-6">
                                    <p> #'.$activityID.' / '.$type.' Deposit
                                        <span class="muted"> '.date("l, jS F Y,  g:i:s A", strtotime($grab["date"])).' </span>
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                 
                                <div class="col-xs-4 invoice-payment">
                                    <h3>Payment History:</h3>
                                    <ul class="list-unstyled">';
                   
				   //// select the last paid record that resulted in this transaction iD
			$db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID'");
			if ($db->numRows() < 1) {
				$output .= '<li> No history linked to this activity </li>';
				
				/// set defaults
				$amountDonated = 0;
				$gain = 0;
				$previouslyHeld = 0;
				$gainHold = 0;	
				$activityPaid = 'None';
				}
				                     
				else {	
				$row = $db->getData();
				$activityPaid = $row["activityID"];			
				
				$output .= ' <li>
                              <strong>Activity Paid :</strong> #'.$activityPaid.' </li>
                                        <li>
                                            <strong>Recipient:</strong> '.ucfirst($row["username"]).' </li>
                                        <li>
                                            <strong>Amount Donated ($):</strong>$'.$row["amount"].'</li>
                                        <li>
										 <li> 
											<strong>Amount Donated (&#8383;):</strong>&#8383;'.$row["amount"] / $dollarRate.'
										 </li>
										  <br/>
										  <li>
                                          <strong>Current Status:</strong> '.$status.' 
										  </li>';
         
		 		
				$amountDonated = $row["amount"];
					
				$previouslyHeld = 0;
					
					}
					
				
					
		 $output .=' </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> Action </th>
                                                <th> Item </th>
                                                <th class="hidden-xs"> Description </th>
                                                <th> Total ($) </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <span class="add-text">Add +</span>   </td>
                                                <td> Amount Deposit  </td>
                                                <td class="hidden-xs"> Deposit for trading at Mason Capital Investment  </td>
                                                <td> $'.$amountDonated.' <strong>(&#8383;' .$amountDonated / $dollarRate.')</strong> </td>
                                            </tr>                      
                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="well">       
									 <address>
                                            <strong>'.ucfirst($username).', </strong> 
											<br/>  Phone: '.$phone.' 
                                           
                                            </address>	
											
                                        <address>
                                            <strong>Paypal ID</strong>
                                            <br/>
                                            '.$userPaypalID.'
                                        </address>
										
										 <address>
                                            <strong>Bitcoin Address</strong>
                                            <br/>
                                            '.$userBitcoinAddress.'
                                        </address>
                                    </div>
                                </div>
                                <div class="col-xs-8 invoice-block">
                                    <ul class="list-unstyled amounts">
                                        <li>
                                            <strong>Sub Total: &nbsp;  $'.$totalExpected.' </strong>  </li>
                                       
                                            <strong>VAT: &nbsp; $0 </strong> </li>
                                        <li>
                                            <strong>Grand Total ($): &nbsp; $'.$totalExpected.'</strong> 
											</li>
											<li>
                                            <strong>Grand Total (&#8383;): &nbsp; &#8383; '.$totalExpected / $dollarRate.'</strong> 
											</li>
                                    </ul>
                                    <br/>
                                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                        <i class="fa fa-print"></i>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
						
						</div>';
				}
				}

?>
<?php
echo $html->dashboardHead('<link href="'.URL.'css/invoice.min.css" rel="stylesheet" type="text/css" />', $title, '', '');
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
                                    <span>Deposit History</span>
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