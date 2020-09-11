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

$title = siteName.' ::: Deposit ';
?>
<?php 
		
		//schedule user to deposit
		if (isset($_POST["deposit"])) {
			
			$amount = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["amount"]));
			$type = $db->cleanData($_POST["type"]);	
			
			
			if ($amount == "") {
				echo '<div class="alert alert-danger">Error: No amount was specified</div>';
				exit();
				}
					//check further
				else if ($amount == "" || $amount == 0) {
					echo '<div class="alert alert-danger">Please enter  amount you to deposit</div>';
			exit();
					}
					else if ($amount < 100) {
						 echo '<div class="alert alert-danger">$100 is the minimum amount allowed</div>';
			exit();
						 }
						else if ($type == "") {
							echo  '<div class="alert alert-danger">Error: Please select the type</div>';
			exit();
							}		
							
					//select address 
				$db->runQuery("SELECT * FROM wallet WHERE type = '$type'");
				if ($db->numRows() < 1) {
					$output = '<div class="clearfix result-not-found">No Address yet</div>';
					}
			$fetch = $db->getData();
			$type = $fetch["type"];	
			$address = $fetch["address"];	
			////create acttivity id
			$activityID = $process->generateActivityID();
			
			// insert
			$query = $db->runQuery("INSERT INTO incoming (activityID, uid, username, amount, type, address, status, date)
			
			VALUES('$activityID', '$uid', '$username', '$amount', '$type', '$address', 'Pending', now())");		
			
			if (!$query) {
			$error = '<div class="alert alert-danger"> Error: This process was not completed. Please try again</div>';
				}
			
			$info = 'You have request to deposit the amount of $'.$amount.' <span class="label label-sm label-success">'.$activityID.'</span>';
				
			$process->timelineUpdate($uid, $info, "Request To Deposit");		
				header("location: ".URL."dashboard/deposit");
				exit();
			
			}

?>

<?php 
			$db->runQuery("SELECT * FROM incoming WHERE uid = '$uid' AND status = 'Completed' ORDER BY id DESC LIMIT 1");
			if ($db->numRows() < 1) {
				$output = '	
											<div class="admin-search-action-wrap"> 
												<div></div>
												<h3> New Deposit </h3>
												'.$error.'
												<form action="" method="post">
													<div class="form-group">
													<label>Enter amount in Dollar($)</label>
													<input type="text" name="amount" class="form-control" placeholder="Amount to Deposit in Dollar"/>
													</div>
													
													<div class="form-group">
													<label>Select wallet to make deposit</label>
													<select class="form-control form-select" name="type"  > 
													<option >Select payment Type</option>
													<option value="BTC">Bitcoin</option>
													<option value="ETH">Ethereum</option>
													</select>
													</div>
													<div class="margiv-top-10">
													<button class="btn green btn-wrap green-btn btn-bordered btn-padded-sm" name="deposit">  Make Payment  </button>
												</form>
											</div>
												<!-- end of admin search action wrap -->			
											';
									} 
									else{
										$output = '	
											<div class="admin-search-action-wrap"> 
												<div id="error-schedule"></div>
												<h3>  </h3>';
													// loop out 
												while ($row = $db->getData()){
											 
													$address = $row["address"];
													$type = $row["type"];
													$amount = $row["amount"];
													$username = $row["username"];
													
													$output .= '<div class="note note-info box-shadowed ">
													<h2>'.$username.'</h2>
														<h4 class="block">
														<strong>
														  Addrress: '.$row["address"].'
														</strong>
														<br>
														<br>
														<strong>
														  Cryptocurrency:  '.$row["type"].'
														</strong>
														<br>
														<br>
														<strong>
														  Amount to Deposit: '.$row["amount"].'
														</strong>
														</h4>
														<p style=""> i.e. Monday to Friday<br/></p>
													</div>';
												}
										$output .='	</div>';
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
                                    <span>Deposit </span>
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