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

$output = '';
$referredStatus = '';
$referralStatus = '';

		
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
		 
		$dollarRate = $process->getDollarToNairaRate();
	 

$title = siteName.' ::: My Referrals';
?>
<?php 
		
		//select referrals
		$db->runQuery("SELECT * FROM hold WHERE username = '$username' AND type = 'Referral Bonus' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			
			$record = '<p align="center"> You are yet to refer a trader to this platform </p>';
			
		}
		else {
			$record = '<table class="table table-bordered table-striped table-condensed flip-content">
							 <thead>
							 <tr>
								 <th>Username</th>
								 <th>Referred Commitment</th>
								  <th>Bonus Status</th>
								    <th>Action</th>
								 </tr>
								 </thead>
						  <tbody>';
		
		while ($row = $db->getData()){
			
			$referredUID = $row["referred_uid"];
			
			$db2->runQuery("SELECT username, joined FROM users WHERE id = '$referredUID'");
			if ($db2->numRows() > 0) {
				$grab = $db2->getData();
				$reserverUsername = $grab["username"];
				$referredJoinedDate = $grab["joined"];
				}
				else {
					$reserverUsername = 'No record';
					}
			
			//check refererrd status
			if ($row["referred_status"] === "hold") {
				$referredStatus = '<label class="label label-danger">Not yet</label>';
				}
				else if ($row["referred_status"] === "pending") {
					$referredStatus = '<label class="label label-pending">Awaiting Confirmation</label>';
					}
					else if ($row["referred_status"] === "completed") {
						$referredStatus = '<label class="label label-success">Commited</label>';
						}
						
			
			//check if released truely
			if ($row["referred_status"] === "completed" && $row["user_status"] === "completed" && ($row["released_to_activity"] !== "")) {
				$releasedStatus = '<label class="label label-success">Released</label>';
				}
				else {
					$releasedStatus = '<label class="label label-danger">Hold</label>';
					}
			
			$record .= ' <tr>
			<td>'.ucfirst($reserverUsername).'</td>
			<td>'.$referredStatus.'</td>
			<td>'.$releasedStatus.'</td>
			<td><a href="'.URL.'dashboard/myreferrals?ref='.$process->encryptDecrypt("encrypt", $row["id"]).'" class="label label-success">View Details</a></td>
			<td></td>
			</tr> ';
			}													
																 
		$record .= '</tbody></table>';
			}

?>
<?php 
			//default output
			$output = '<div class="row">
                            <div class="col-md-12">
                            
                                <div class="portlet light bordered">
                                       
                                        
										<div class="tab-content">
                                        
											<div class="tab-pane fade active in" id="tab_1_1">
																
												 
												<div class="portlet box blue-sharp color-remove-prop">
													<div class="portlet-title">
														<div class="caption">
															 My Referrals 
															 </div>
													</div>
													<div class="portlet-body box-shadowed">
														<div class="table-responsive">
															'.$record.'
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
		if (isset($_GET["ref"])) {
			$rowID = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["ref"]));
			
			$db->runQuery("SELECT * FROM hold WHERE id = '$rowID' AND uid = '$uid'");
			
			if ($db->numRows() < 1){
				$output = '<div class="admin-search-action-wrap" align="center">  No record found </div>';
				} 
				else {
					$row = $db->getData();
					
				$referredUID = 	$row["referred_uid"];
				
				$db->runQuery("SELECT username, joined FROM users WHERE id = '$referredUID'");
				if ($db->numRows() > 0) {
					$grab = $db->getData();
					$reserverUsername = $grab["username"];
					$referredJoinedDate = $grab["joined"];
					}
				
				//check refererrd status
			if ($row["referred_status"] === "hold") {
				$referredStatus = '<label class="label label-danger">Not yet</label>';
				}
				else if ($row["referred_status"] === "pending") {
					$referredStatus = '<label class="label label-pending">Awaiting Confirmation</label>';
					}
					else if ($row["referred_status"] === "completed") {
						$referredStatus = '<label class="label label-success">Commited</label>';
						}
						
			//check if released truely
			if ($row["referred_status"] === "completed" && $row["user_status"] === "completed" && ($row["released_to_activity"] !== "")) {
				$releasedStatus = '<label class="label label-success">Released</label> 
				(This bonus amount was added to your incoming donation on activity #'.$row["released_to_activity"].')';
				}
				else {
					$releasedStatus = '<label class="label label-danger">Hold</label>';
					}			
				
				$output = '<div class="admin-search-action-wrap" align="center">
				<ul class="hold-transx"> 
				<li>Referred: <span>'.ucfirst($reserverUsername).' </span> </li>
				<li>Joined: <span>'.date("l, jS F Y,  g:i:s A", strtotime($referredJoinedDate)).' </span> </li>
				<li>Referred commitment status: <span>'.$referredStatus.' (This tracks the first Deposit activity of this referred user) </span></li>
				
				<li> Expected Bonus($): '.$row["amount"].' </li>
				<li> Expected Bonus(&#8383;): '.$row["amount"] / $dollarRate.' </li>	
				<li> Release Status: '.$releasedStatus.' <span> <br/> <small> You ONLY get to receive this bonus if <br/>
				1. Your referred user has successfully completed and given out a donation <br/>
				2. You, as a follow up, successfully completes and gives out a donation <br/> 
				When the above processes are successfully completed, this bonus amount will be automatically calculated into the very next incoming donation for you</small></span> </li>			
				</ul>
				<div class="clearfix" align="center"> <a href="'.URL.'dashboard/myreferrals"><button class="btn btn-primary btn-wrap red-btn">Go back</button> </a></div>
				';
				
				
				$output .= '</div>';	
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
                                    <span>My referrals</span>
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