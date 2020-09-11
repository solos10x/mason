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
		 

$title = siteName.' ::: General Broadcast';
?>
<?php 
		if (isset($_POST["broadcast"])) {
			$message = $db->cleanData(htmlentities($_POST["message"]));
			if ($message == "") {
				$error = '<div class="alert alert-danger">Please enter a message</div>';
				}
				else {
			///first turn off all exising
			$db->runQuery("UPDATE broadcast SET status = 'Off'");
			
			// teh insrt
			$query = $db->runQuery("INSERT INTO broadcast (message, status, date) VALUES ('$message', 'On', now())");
			if (!$query) {
			 $error = '<div class="alert alert-danger">An error occured. Please try again</div>';
				}
				else {
					$_SESSION["errmsg"] = '<div class="alert alert-success">Successfully Posted</div>';
					header("location: ".URL."dashboard/broadcast");
					exit();
					}		
					}
			}
?>
<?php 

		
		 
			$output  = '<div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                                   '.$error.'
								    <div class="portlet-title">
                                        <div class="general-broadcast-board">
											<form action="" method="post">
											<textarea required="required" name="message"></textarea>
                                            <button class="btn btn-primary btn-wrap red-btn" name="broadcast"> New Broadcast </button>
										</form>
										 </div>
                                    </div>
									
									 <div class="portlet-body">';
									
									
		// output existing support ticket by this user
		$db->runQuery("SELECT * FROM broadcast ORDER BY id DESC LIMIT 50");	 
		if ($db->numRows() < 1) {
			$output .= '<p align="center"> No broadcast history </p>'; 
			}
		else {
		$output .= '<table class="table table-striped table-bordered table-hover">
                       <thead>
                         <tr>
                            <th class="none">Message </th>
                               <th class="none">Date</th>
                                   <th class="none">Action</th>
                           </tr>
                          </thead>
                       <tbody>';
											
						while ($row = $db->getData()) {
		
		if ($row["status"] === "Off") {
			$currStatus = '<span class="label label-sm label-danger">Off</span>';
			}
			else {
			$currStatus = '<span class="label  label-success">On</span>';	
				}
							 
		$output .= '<tr> 
		<td class="tb-txtarea"><textarea>'.$row["message"].'</textarea></td>
		<td> '.date("l, jS F Y,  g:i:s A", strtotime($row["date"])).'</td>
		<td  class="tb-txtarea">
		'.$currStatus.'
		<select onchange=\'controller.updateBroadcastStatus("'.URL.'", "'.$row["id"].'")\' id="broadcast-status">
		<option></option>
		<option value="off">Turn Off</option>
		<option value="on">Turn On</option>
		</select></td>
		</tr>';
							
							}					
							
							$output .= '</tbody>
                                        </table>
                                     
                                    </div>
                                    
							</div>';
			 
		}
?>
<?php 
		// update status
		if (isset($_GET["update"]) && $_GET["newstatus"]) {
			$rowID = $db->cleanData($_GET["update"]);
			$newStatus = $db->cleanData(ucfirst($_GET["newstatus"]));
			
			$query = $db->runQuery("UPDATE broadcast SET status = '$newStatus' WHERE id = '$rowID'");
			if (!$query) {
				$_SESSION["errmsg"] = '<div class="alert alert-danger"> Update process was not successful. Please try again </div>';
				header("location: ".URL."dashboard/broadcast");
				exit();
				}
				else {
				$_SESSION["errmsg"] = '<div class="alert alert-success"> Successfully Updated </div>';
				header("location: ".URL."dashboard/broadcast");
				exit();	
					}
			}
?>
<?php 
		if (isset($_SESSION["errmsg"])) {
			$genErr = $_SESSION["errmsg"];
			unset($_SESSION["errmsg"]);
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
                                    <span>General Broadcast</span>
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