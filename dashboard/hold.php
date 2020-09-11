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
	 	
		$dollarRate = $process->getDollarToNairaRate();
	 

$title = siteName.' ::: Hold Donations ';
$instantOutput = '';
$listedOutput = '';
?>
<?php 
		
		//select for Instant
		$db->runQuery("SELECT * FROM hold WHERE uid = '$uid' AND type = 'Instant Hold' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			
			$instantOutput = '<p align="center"> No record  </p>';
			
		}
		else {
			$instantOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Type </th>
							     <th>Amount ($)</th>
								 <th>Amount (&#8358;)</th>
								 <th>Hold Details</th>
								 <th>Status</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			 
			 // determine status
			 if ($row["referred_status"] === "hold"  ){
				 $status = '<span class="label label-danger">Awaiting Referred Commitment</span>';
				 }
				 else if ($row["referred_status"] === "pending") {
					 $status = '<span class="activity-status-note activity-pending">Awaiting Referred Confirmation</span>';
					 }
					 else if ($row["referred_status"] === "completed" ) {
					
					// then check for this user
					if ($row["user_status"] === "hold") {
						$status = '<span class="activity-status-note activity-pending">Awaiting your re-commitment</span>';
						}
						else if ($row["user_status"] === "pending") {
						$status = '<span class="label label-danger">Awaiting your commitment confirmation</span>';	
							}
							else if ($row["user_status"] === "awaiting_release") {
						$status = '<span  class="activity-status-note activity-reserved">To be released on next incoming donation</span>';;		
								}
								else if ($row["user_status"] === "completed") {
						$status = '<span  class="activity-status-note activity-completed">Released</span>';			
									}
						 
						 }
			 
			 
			$instantOutput .= '<tr>
			<td>'.$row["type"].'</td>
			<td>$'.$row["amount"].'</td>
			<td>&#8358;'.$row["amount"] * $dollarRate.'</td>
			<td><a href="'.URL.'dashboard/hold?holdID='.$process->encryptDecrypt("encrypt", $row["id"]).'" class="label label-success">View Details</a></td>
			<td>'.$status.'</td>
			</tr>';
			}													
																 
		$instantOutput .= '</tbody></table>';
			}

?>
<?php 
		
		//select for listed
		$db->runQuery("SELECT * FROM hold WHERE uid = '$uid' AND type = 'Lsted Hold' ORDER BY id DESC");
	 	 	if ($db->numRows() < 1) {
			
			$listedOutput = '<div align="center"> No record  </p>';
			
		}
		else {
			$listedOutput = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Type </th>
							     <th>Amount ($)</th>
								 <th>Amount (&#8358;)</th>
								 <th>Hold Details</th>
								 <th>Status</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			 
			 // determine status
			 if ($row["referred_status"] === "hold"  ){
				 $status = '<span class="label label-danger">Awaiting Referred Commitment</span>';
				 }
				 else if ($row["referred_status"] === "pending") {
					 $status = '<span class="activity-status-note activity-pending">Awaiting Referred Confirmation</span>';
					 }
					 else if ($row["referred_status"] === "completed" ) {
					
					// then check for this user
					if ($row["user_status"] === "hold") {
						$status = '<span class="activity-status-note activity-pending">Awaiting your re-commitment</span>';
						}
						else if ($row["user_status"] === "pending") {
						$status = '<span class="label label-danger">Awaiting your commitment confirmation</span>';	
							}
							else if ($row["user_status"] === "awaiting_release") {
						$status = '<span  class="activity-status-note activity-reserved">To be released on next incoming donation</span>';;		
								}
								else if ($row["user_status"] === "completed") {
						$status = '<span  class="activity-status-note activity-completed">Released</span>';			
									}
						 
						 }
			 
			 
			$listedOutput .= '<tr>
			<td>'.$row["type"].'</td>
			<td>$'.$row["amount"].'</td>
			<td>&#8358;'.$row["amount"] * $dollarRate.'</td>
			<td><a href="'.URL.'dashboard/hold?holdID='.$process->encryptDecrypt("encrypt", $row["id"]).'" class="label label-success">View Details</a></td>
			<td>'.$status.'</td>
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
                                                <a href="#tab_1_2" data-toggle="tab"> listed </a>
                                            </li>
                                        </ul>
                                        
										<div class="tab-content">
                                        
											<div class="tab-pane fade active in" id="tab_1_1">
																
												<!-- OUTPUT Instant DONATION HISTORY-->
												<div class="portlet box blue-sharp color-remove-prop">
													<div class="portlet-title">
														<div class="caption">
															 Hold Donation</div>
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
														Listed Donation </div>
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
		if (isset($_GET["holdID"])) {
			
		$holdID = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["holdID"]));
		$db->runQuery("SELECT * FROM hold WHERE id = '$holdID'");	
		
		if ($db->numRows() < 1) {
			$output = '<div align="center" class="admin-search-action-wrap">No record found for this ID</div>';
			}	
			else {
			$fetch = $db->getData();
			$amountHold = $fetch["amount"];
			$type = $fetch["type"];
			
			 // determine status
			 if ($row["referred_status"] === "hold"  ){
				 $status = '<span class="label label-danger">Awaiting Referred Commitment</span>';
				 }
				 else if ($row["referred_status"] === "pending") {
					 $status = '<span class="activity-status-note activity-pending">Awaiting Referred Confirmation</span>';
					 }
					 else if ($row["referred_status"] === "completed" ) {
					
					// then check for this user
					if ($row["user_status"] === "hold") {
						$status = '<span class="activity-status-note activity-pending">Awaiting your re-commitment</span>';
						}
						else if ($row["user_status"] === "pending") {
						$status = '<span class="label label-danger">Awaiting your commitment confirmation</span>';	
							}
							else if ($row["user_status"] === "awaiting_release") {
						$status = '<span  class="activity-status-note activity-reserved">To be released on next incoming donation</span>';;		
								}
								else if ($row["user_status"] === "completed") {
						$status = '<span  class="activity-status-note activity-completed">Released</span>';			
									}
						 
						 }
			 	
			$output = '<div class="reservation-info-board box-shadowed"> 
			<h4> Hold Donation Details </h4>
			<ul>
			<li> Type: <span>'.$fetch["type"].'</span> </li>
			<li>Amount($): <span>$'.$fetch["amount"].'</span>  </li>
			<li>Amount(&#8358;): <span>&#8358;'.$fetch["amount"] * $dollarRate.'</span>  </li>
			<li>Brief: <span>'.$fetch["info"].'</span></li>
			<li>Date: <span>'.date("l, jS F Y,  g:i:s A", strtotime($fetch["date"])).'</span></li>
			<li>Status: <span>'.$status.'</span></li>
			<div class="clearfix"></div> <br/> <br/>
			<div class=""> <a href="'.URL.'dashboard/hold"><button class="btn btn-primary btn-wrap red-btn"> Go Back </button> </a></div>
			 </ul>';
			 
			 
			 
			$output .= '</div>';
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
                                    <span>Hold Donation</span>
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