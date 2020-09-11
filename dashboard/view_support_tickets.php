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
		 

$title = siteName.' ::: View Support Tickets';
?>
<?php 
		// submit reply ticket
			if (isset($_POST["reply"])) {
				$replyMessage = $db->cleanData(htmlentities($_POST["reply_message"]));
				$fileDBName = '';
				$ticketID = $db->cleanData($_GET["viewticket"]);
			
		//// Pick images 1
		$fileName = $_FILES["attachment"]["name"];
		$fileTempLoc = $_FILES["attachment"]["tmp_name"];
		$fileSize = $_FILES["attachment"]["size"];
		$fileType = $_FILES["attachment"]["type"];
		
		
		 if ($replyMessage == "") {
			$replyError =  ' <div class="alert alert-danger">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  Please enter your message
		</div>';
			}
		 else{

		// image 1	
		if ($fileTempLoc){	
		 
		
		if(!preg_match("/.(jpg|png)$/i", $fileName)){
		    $replyError =  ' <div class="alert alert-danger">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  File should be in jpg or png format
		</div>';
			 }
		 else {
			 	   
		///explode and rename file
		$ex = explode(".", $fileName);
        $ext = $ex[1];
			  
		$fileDBName = time().'.'.$ext;
		$moveFile = move_uploaded_file($fileTempLoc, "../images/support/$fileDBName");
			
		if (!$moveFile){
		$replyError =  '<div class="alert alert-danger">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  There is an error uploading this file. Please ensure file size is not more than 5MB and file format is in png or jog format, then try again
		</div>';
			} // if file move was not successful
		  } // else if no error in file format
		  
		} // if file was uploaded
		
		// check the reply path
		$db->runQuery("SELECT ticketID, uid, username, category FROM support WHERE ticketID = '$ticketID' AND 
		(uid != '0' AND username != 'Admin') ORDER BY id ASC LIMIT 1");
		
		if ($db->numRows() < 1) {
			$replyError =  ' <div class="alert alert-danger">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  No trace for this ticketID was found
		</div>';
			}
			else {
		$fetch = $db->getData();
		$ticketID = $fetch["ticketID"];
		$username = $fetch["username"];
		$category = $fetch["category"];
		$ticketOwner = $db->cleanData($_GET["uid"]);
		
		// insert 
		$query = $db->runQuery("INSERT INTO support (ticketID, ticket_owner, uid, username, category, message,image,  date) 
		VALUES('$ticketID', '$ticketOwner', '0', 'Admin', '$category', '$replyMessage', '$fileDBName', now()) ");
		
		if (!$query) {
			$replyError = '<div class="alert alert-danger">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		 Reply could not be sent. Please try again
		</div>';
			}
			else {
				$replyMessage = '';
			$_SESSION["errmsg"] =  ' 
				<div class="alert alert-success"> Reply has been successfully posted</div>';
				header("location: ".URL."dashboard/view_support_tickets?viewticket=".$ticketID."&category=".strtolower($category)."&uid=".$fetch["uid"]);
				exit();
				}
				
			}
			}
				}

?>
<?php 

		// output existing support ticket by this user
		
		if ($userLevel === "super_admin" && $email !== "testing@gmail.com") {
			$department = 'super_admin';
			}
			else if ($userLevel === "super_admin" && $email === "testing@gmail.com") {
				$department = 'developer';
				}
				else {
					$department = 'admin';
					}
		//AND department = '$department'
		$db->runQuery("SELECT * FROM support WHERE admin_view_status = '0'  GROUP BY ticketID ORDER BY id DESC");
		if ($db->numRows() < 1) {
			$output  = '<div class="portlet light portlet-fit portlet-form bordered" id="form_wizard_1">
                                   
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                           <a href="'.URL.'dashboard/support?action=create_new"> <button class="btn btn-primary btn-wrap red-btn">  Create New </button> </a>
                                        </div>
                                    </div>
								 <div class="portlet-body" align="center">
								 No support ticket for this department 
								 </div>	
									</div>';
			}
			else {
				
		$output = '<div class="portlet light portlet-fit portlet-form bordered">
                                   
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                         <a href="'.URL.'dashboard/support?action=create_new"> <button class="btn btn-primary btn-wrap red-btn">  Create New </button> </a>
                                        </div>
                                    </div>
                                    	<!-- id="sample_4"-->
                                    <div class="portlet-body">
                                            '.$noError.'
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="none">TicketID </th>
                                                    <th class="none">Category</th>
                                                    <th class="none">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
											
						while ($row = $db->getData()) {
							$ticketID = $row["ticketID"];
						// AND username != 'Admin' AND (user_view_status = '0')
						$db2->runQuery("SELECT id FROM support WHERE ticketID = '$ticketID' AND (username != 'Admin' AND admin_view_status = '0')");
						if ($db2->numRows() < 1) {
							$unreadStatus = '';
							}
							else {
								$unreadStatus = '<span class="label label-sm label-warning">new</span>';
								}
							$output .= '<tr> <td> #'.$row["ticketID"].' '.$unreadStatus.'</td> 
							<td> '.$row["category"].'</td>
							<td><a href="'.URL.'dashboard/view_support_tickets?viewticket='.$row["ticketID"].'&category='.strtolower($row["category"]).'&uid='.$row["uid"].'"><span class="label label-sm label-success">View Ticket</span></a></td>
							</tr>';
							
							}					
							
							$output .= '</tbody>
                                        </table>
                                     
                                    </div>
                                    
							</div>';
			}

?>
<?php 
		// view tickett
		if (isset($_GET["viewticket"])) {
			$ticketID = $db->cleanData($_GET["viewticket"]);
			$category = $db->cleanData(ucfirst($_GET["category"]));
			$ticketOwner = $db->cleanData($_GET["uid"]);
			$output = '<div class="portlet light">
				    <div class="portlet-title">
                                        <div class="caption">
                                            <i class=" icon-layers font-red"></i>
                                         <a href="'.URL.'dashboard/view_support_tickets"> <button class="btn btn-primary btn-wrap red-btn"> Back </button> </a>
										  <a href="'.URL.'dashboard/view_support_tickets?moveto=super&ticketid='.$ticketID.'&category='.$category.'&uid='.$ticketOwner.'"> <button class="btn btn-primary btn-wrap red-btn"> Super </button> </a>
										   <a href="'.URL.'dashboard/view_support_tickets?moveto=developer&ticketid='.$ticketID.'&category='.$category.'&uid='.$ticketOwner.'"> <button  class="btn btn-primary btn-wrap red-btn"> Developer </button> </a>
                                        </div>
										 <h4 align="right"> Ticket ID #'.$ticketID.' ('.$category.') </h4>
                    </div>
				 <div class="portlet-body">';
		
		$db->runQuery("SELECT * FROM support WHERE ticketID = '$ticketID' AND ticket_owner = '$ticketOwner' ORDER BY id DESC");
		if ($db->numRows() < 1) {
			$output .= '<p align="center">  No record found for this ticketID</p>';
			}
			else {
		
		while ($row = $db->getData()) {
			
			if ($row["username"] == "Admin"){
					$wh = 'admin-thread';
					}
					else {
						$wh = 'user-thread';
						}
				
				if ($row["image"] != '') {
					$imgDir = '<img src="'.URL.'images/support/'.$row["image"].'" alt="image" class="img-responsive"/>';
					}
					else {
					$imgDir = '';
						}
					
				$output .= '<p class="msg-thread '.$wh.'"> 
				<span class="msg-thread-sticker">'.ucfirst($row["username"]).' <small style="color:#444"> ('.date("l, jS F Y,  g:i:s A", strtotime($row["date"])).')</small></span>
				'.$row["message"].'
				'.$imgDir.'
				</p>';	
			}
		  $output .= '<div style="clear:both"> </div>';	
		  
		  $db->runQuery("UPDATE support SET admin_view_status = '1' WHERE ticketID = '$ticketID' AND ticket_owner = '$ticketOwner'");
		  
		 $output .= '<div class="msg-thread reply-box">
		 <form action="" method="post" enctype="multipart/form-data">
		 
		 <div class="form-action">
		 <label> Message  </label>
		 <textarea name="reply_message">'.$replyMessage.'</textarea>
		 </div>
		 
		 <div class="form-action">
		 <label> Attachment </label>
		 <input type="file" name="attachment"/>
		 </div>
		 
		 <div class=""> 
		 <button class="btn btn-primary btn-wrap green-btn" type="submit" name="reply"> Reply </button>
		 </div>
		  
		  </form>
		  
		 </div>';
		
			}
		$output .= '</div>
		</div>';
			}

?>
<?php 
		
		if (isset($_GET["moveto"])) {
			$moveTo = $db->cleanData($_GET["moveto"]);
			$ticketID = $db->cleanData($_GET["ticketid"]);
			$category = $db->cleanData(ucfirst($_GET["category"]));
			$ticketOwner = $db->cleanData($_GET["uid"]);
			
			if ($moveTo === "super") {
				$moveTo = 'super_admin';
				}
				else if ($moveTo === "developer") {
					$moveTo = 'developer';
					}
			
			$db->runQuery("UPDATE support SET department = '$moveTo', admin_view_status = '0' WHERE ticketID = '$ticketID' AND ticket_owner = '$ticketOwner'");
			$_SESSION["errmsg"] =  ' 
				<div class="alert alert-success"> Ticket ID #'.$ticketID.' has been sucessfully moved to the appropriate department </div>';
				header("location: ".URL."dashboard/view_support_tickets");
				exit();
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
                                    <span>Support</span>
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