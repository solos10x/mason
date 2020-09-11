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
$error = '';
$noError = '';
$replyError = '';
$replyMessage = '';
$genErr = '';
$allUsers = 0;
 

		
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
		
		if ($userLevel === "user") {
			header("location: ".URL."dashboard");
			exit();
			}
		 

$title = siteName.' ::: All Users';
?>
<?php 

	  
		$db->runQuery("SELECT * FROM users WHERE level != 'super_admin' AND username != '' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			$output  = '<div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                                    
								 <div class="portlet-body" align="center">
								 No users found
								 </div>	
									</div>';
			}
			else {
				$allUsers = $db->numRows();
		$output = '<div class="portlet light portlet-fit portlet-form bordered">
                                    
                                    	<!-- -->
                                    <div class="portlet-body">
                                            '.$noError.'
                                        <table class="table table-striped table-bordered table-hover" id="sample_4">
                                            <thead>
                                                <tr>
                                                    <th class="none">Username</th>
                                                    <th class="none">Capital</th>
                                                    <th class="none">Equity</th>
													<th class="none">Referred Bonus </th>
                                                </tr>
                                            </thead>
                                            <tbody>';
											
						while ($row = $db->getData()) {
						 
						 $thisUser = $row["username"];
						 
						 $totalDonated = 0;
						$db2->runQuery("SELECT donate_amount FROM outgoing WHERE donor_username = '$thisUser' AND status = 'Confirmed'");
						if ($db2->numRows() > 0) {
							while ($row = $db2->getData()) {
								$totalDonated = $totalDonated + $row["donate_amount"];
								}
							}
							
							 $totalReceived = 0;
						$db2->runQuery("SELECT donate_amount FROM outgoing WHERE recipient_username = '$thisUser' AND status = 'Confirmed'");
						if ($db2->numRows() > 0) {
							while ($row = $db2->getData()) {
								$totalReceived = $totalReceived + $row["donate_amount"];
								}
							}
							
							 $totalReferred = 0;
						$db2->runQuery("SELECT id FROM users WHERE referral = '$thisUser' AND username != '' ");
						if ($db2->numRows() > 0) {
							$totalReferred = $db2->numRows();
							}
							
							

					 
							$output .= '<tr>
							 <td>'.$thisUser.'</td> 
							<td>$'.$totalDonated.'</td>
							<td>$'.$totalReceived.'</td>
							<td>$'.$totalReferred.'</td>
							</tr>';
							
							}					
							
							$output .= '</tbody>
                                        </table>
                                     
                                    </div>
                                    
							</div>';
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
                                    <span>All Users (<?php echo $allUsers ?>) </span>
                                </li>
                            </ul>
                        
                        </div>
                        <!-- END PAGE BAR -->
                  
                         
                            <div>
                            <?php echo $genErr; ?>
                            <?php echo $output; ?>
							</div>
						
						
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
<?php echo $html->dashboardFooter(''); ?>  