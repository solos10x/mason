<?php
include_once("../../class/db.php");
include_once("../../class/process.php");

$db = new db();
$db2 = new db();
$process = new process($db);
?>
<?php		
	// update user basic details
	if (isset($_POST["action"]) && $_POST["action"] === 'updateBasicDetails') {
		
		$username = $db->cleanData(preg_replace("#[^a-z0-9_-]#i", "", $_POST["username"]));
		$email = $db->cleanData($_POST["email"]);
		$phone = $db->cleanData($_POST["phone"]);
		$country = $db->cleanData($_POST["country"]);
		$uid = $db->cleanData($_POST["uid"]);
		
		//
		if ($username === "") {
			echo 'Username field cannot be left blank';
			exit();
			}
			else if (strlen($username) < 4) {
				echo 'Username should be more than 3 characters long';
				exit();
				}
				else if ($username === "Admin" || $username === "admin" || $username === "ADMIN") {
					echo 'This username is not available';
					exit();
					}
				else if ($email === "") {
					echo 'Email field cannot be left blank';
					exit();
					}
					else if ($phone === "") {
						echo 'Please enter a valid phone number';
						exit();
						}
						else if ($country === "") {
							echo 'Please select your country of residence from the drop down list';
							exit();
							}
							else {
								
					//ensure user with uid existrs
					$db->runQuery("SELECT id FROM users WHERE id = '$uid'");
					if ($db->numRows() < 1) {
						echo 'No record for this user found';
						exit();
						}			
					
					// ensure it is not a duplicate id
					$db->runQuery("SELECT id FROM users WHERE username = '$username' AND id != '$uid'");
					if ($db->numRows() > 0) {
						echo 'Someone is already using this username';
						exit();
						}
						
					//if not duplicate
					$query = $db->runQuery("UPDATE users SET username = '$username', email = '$email', phone = '$phone', country = '$country' WHERE id = '$uid'");
					if (!$query) {
						echo 'An error occured. Please try again';
						exit();
						}
					
					
					
					$process->timelineUpdate($uid, "You updated your profile basic details", "Basic Update");	
						echo 'Success';
						exit();
						
								}
					
		
		}	
?>
<?php 
		// update password
		if (isset($_POST["action"]) && $_POST["action"] === "update_password") {
		 
			$currPassword = $db->cleanData($_POST["curr_password"]);
			$newPassword = $db->cleanData($_POST["new_password"]);
			$confPassword = $db->cleanData($_POST["conf_password"]);
			$uid = $db->cleanData($_POST["uid"]);
			
			if ($currPassword === "") {
				echo 'Please enter your old password';
				exit();
				}
				else if ($newPassword === "") {
					echo 'Please enter your new password';
					exit();
					}
				else if ($confPassword === "") {
					echo 'Please confirm your new password';
					exit();
					}
					else if ($newPassword !== $confPassword){
						echo 'Both passwords do not match';
						exit();
						}
						else {
				$currPassword = md5($currPassword);
				
				// confirm match
				$db->runQuery("SELECT id FROM users WHERE id = '$uid' AND password = '$currPassword'");
				if ($db->numRows() < 1) {
					echo 'Your current password is not correct';
					exit();
					}
				
				$newPassword = md5($newPassword);			
				$query = $db->runQuery("UPDATE users SET password = '$newPassword' WHERE id = '$uid'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				$process->timelineUpdate($uid, "You updated your password", "Password Update");	
					
				echo 'Success';
				exit();
								
							}
			
			}
?>
<?php
		// update bank //fa fa-btc
		if (isset($_POST["action"]) && $_POST["action"] === "update_bank") {
		 
			$bankAccountName = $db->cleanData($_POST["bank_account_name"]);
			$bankAccountNumber = $db->cleanData($_POST["bank_account_number"]);
			$bankAccountType = $db->cleanData($_POST["bank_account_type"]);
			$bank = $db->cleanData($_POST["bank"]);
			$uid = $db->cleanData($_POST["uid"]);
			$bankActive = $db->cleanData($_POST["bank_active"]);
			
			if ($bankAccountName === "") {
				echo 'Please enter your bank account name';
				exit();
				}
				else if ($bankAccountNumber === "") {
					echo 'Please enter your bank account number';
					exit();
					}
				else if ($bank === "") {
					echo 'Please enter the name of your bank';
					exit();
					}
					else if ($bankAccountType === "") {
						echo 'Please enter the type of account you use';
						exit();
						}
					else {
		 
	 		 
				$query = $db->runQuery("UPDATE users SET bank = '$bank',
				 bank_account_name = '$bankAccountName', 
				 bank_account_number = '$bankAccountNumber',
				 bank_account_type = '$bankAccountType',
				 bank_active = '$bankActive' WHERE id = '$uid'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				$process->timelineUpdate($uid, "You updated your bank details", "Bank Update");		
					
				echo 'Success';
				exit();
								
							}
			
			}
?>
<?php
	// update paypal
		if (isset($_POST["action"]) && $_POST["action"] === "update_paypal") {
		 
			$paypalID = $db->cleanData($_POST["paypal_id"]);
			$uid = $db->cleanData($_POST["uid"]);
			$paypalActive = $db->cleanData($_POST["paypal_active"]);
			
			  $query = $db->runQuery("UPDATE users SET paypal_id = '$paypalID', paypal_active = '$paypalActive' WHERE id = '$uid'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				$process->timelineUpdate($uid, "You updated your paypal details", "Paypal Update");			
					
				echo 'Success';
				exit();	
					
		}
?>
<?php
	// update bitcoin details
		if (isset($_POST["action"]) && $_POST["action"] === "update_bitcoin") {
		 
			$bitcoinAddress = $db->cleanData($_POST["bitcoin_address"]);
			$uid = $db->cleanData($_POST["uid"]);
			$bitcoinActive = $db->cleanData($_POST["bitcoin_active"]);
			
			  $query = $db->runQuery("UPDATE users SET bitcoin_address = '$bitcoinAddress', bitcoin_active = '$bitcoinActive' WHERE id = '$uid'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				$process->timelineUpdate($uid, "You updated your bitcoin details", "Bitcoin Update");	
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php 
			/// admin update bitcoin value
			if (isset($_POST["action"]) && $_POST["action"] === "set_bitcoin_value") {
			
			$bitcoinValue = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["bitcoin_value"]));
			
			if ($bitcoinValue === ""){
				echo 'Please enter a value';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET bitcoin_value = '$bitcoinValue'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
				}
			
?>
<?php
	// admin update dollar value
		if (isset($_POST["action"]) && $_POST["action"] === "set_dollar_value") {
		 
			$dollarValue = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["dollar_value"]));
			
			if ($dollarValue === ""){
				echo 'Please enter a numerical naira equivalent for 1 dollar';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET dollar_to_naira = '$dollarValue'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php
	// admin update instant incentive
		if (isset($_POST["action"]) && $_POST["action"] === "set_instant_incentive") {
		 
			$instantIncentive = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["instant_incentive"]));
			$instantIncentiveHold = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["instant_incentive_hold"]));
			$instantMinimum = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["instant_minimum"]));
			

			
			if ($instantIncentive === ""){
				echo 'Please enter a numerical value for instant incentive';
				exit();
				}
				
				if ($instantMinimum === ""){
				echo 'Please enter a numerical value for instant minimum donation';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET instant_incentive = '$instantIncentive', instant_incentive_hold = '$instantIncentiveHold', 
			  instant_minimum = '$instantMinimum'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php
	// admin update listed incentive
		if (isset($_POST["action"]) && $_POST["action"] === "set_listed_incentive") {
		 
			$listedIncentive = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["listed_incentive"]));
			$listedIncentiveHold = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["listed_incentive_hold"]));
			$listedMinimum = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["listed_minimum"]));
			
			if ($listedIncentive === ""){
				echo 'Please enter a numerical value for listed incentive';
				exit();
				}
				
				if ($listedMinimum === ""){
				echo 'Please enter a numerical value for listed minimum donation';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET listed_incentive = '$listedIncentive', listed_incentive_hold = '$listedIncentiveHold', listed_minimum = '$listedMinimum'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php
	// admin update list pop out limit
		if (isset($_POST["action"]) && $_POST["action"] === "listing") {
		 
			$listLimit = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["list_limit"]));
			
			if ($listLimit === ""){
				echo 'Please enter a numerical value for the limit';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET list_limit = '$listLimit'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php
	// admin update list pop out limit
		if (isset($_POST["action"]) && $_POST["action"] === "referral_bonus") {
		 
			$referralBonus = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["referral_bonus"]));
			
			if ($referralBonus === ""){
				echo 'Please enter a numerical value for the bonus';
				exit();
				}
			
			  $query = $db->runQuery("UPDATE setup SET referral_bonus = '$referralBonus'");
				
				if (!$query){
					echo 'Update process was not successful. Please try again';
					exit();
					}
					
				echo 'Success';
				exit();	 
			
			}
?>
<?php
		// admin upgrade user to admin
		if (isset($_POST["action"]) && $_POST["action"] === "upgrade_to_admin") {
			
			$username = $db->cleanData($_POST["user"]);
			
			// check if exixts
			$db->runQuery("SELECT id FROM users WHERE username = '$username'");
			if ($db->numRows() < 1) {
				echo 'No such username was found';
				exit();
				}
			
			$query = $db->runQuery("UPDATE users SET level = 'admin' WHERE username = '$username'");
			
			if (!$query) {
				echo 'This process was not successful. Please try again';
				exit();
				}
			echo 'Success';
			exit();
			}
?>
<?php
		// admin downgrade user to user
		if (isset($_POST["action"]) && $_POST["action"] === "remove_as_admin") {
			
			$username = $db->cleanData($_POST["user"]);
			
			// check if exixts
			$db->runQuery("SELECT id FROM users WHERE username = '$username'");
			if ($db->numRows() < 1) {
				echo 'No such username was found';
				exit();
				}
			
			$query = $db->runQuery("UPDATE users SET level = 'user' WHERE username = '$username'");
			
			if (!$query) {
				echo 'This process was not successful. Please try again';
				exit();
				}
			echo 'Success';
			exit();
			}
?>
<?php 
		
		//schedule user to receive
		if (isset($_POST["action"]) && $_POST["action"] === "schedule_to_receive") {
		 
			$username = $db->cleanData($_POST["user"]);
			$amount = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["amount"]));
			$type = $db->cleanData($_POST["type"]);
			
			if ($username === "") {
				echo 'Error: No username was provided';
				exit();
				}
				else if ($amount === "") {
					echo 'Error: No amount was specified';
					exit();
					}
					else if ($type === "") {
						echo 'Error: Please update status ';
						exit();
						}
						
				//confirm user is true
				$db->runQuery("SELECT id FROM users WHERE username = '$username'");
				if ($db->numRows() < 1) {
					echo 'This user does not exist';
					exit();
					}
			$fetch = $db->getData();
			$uid = $fetch["id"];		
					
			////create acttivity id
			$activityID = $process->generateActivityID();
			
			// insert
			$query = $db->runQuery("INSERT INTO outgoing (activityID, donor_uid, donor_username, donate_amount, status, date)
			
			VALUES('$activityID', '$uid', '$username', '$amount', '$type', now())");		
			
			if (!$query) {
			echo 'Error: This process was not completed. Please try again';
			exit();
				}
			
			$info = ' $'.$amount.' was successfully Deposited <span class="label label-sm label-success">'.$activityID.'</span>';
				
			$process->timelineUpdate($uid, $info, "Deposit Confirmed");		
				echo 'Success';
				exit();
			
			}

?>
<?php 
		// donation
			if (isset($_POST["action"]) && $_POST["action"] == "deposit") {
			
			$activityID = $db->cleanData($_POST["activityID"]);
			$id = $db->cleanData($_POST["id"]);
			$username = $db->cleanData($_POST["username"]);
			$amount = $db->cleanData(preg_replace("#[^0-9]#i", "", $_POST["amount"]));
				
			
			// check if there is an activity as such
			$db->runQuery("SELECT * FROM incoming WHERE activityID = '$activityID' AND status = 'pending'");
			if ($db->numRows() < 1) {
				echo 'No record of this activity was found';
				exit();
				}
				
			//grab ractiity information
			$fetch = $db->getData();				
			$recipientUID = $fetch["id"];
			$recipientUsername = $fetch["username"];
			$amount = $fetch["amount"];
			$activityType = $fetch["type"];
			
			 
			// confirm recipient still exists
			$db->runQuery("SELECT id FROM users WHERE id = '$recipientUID'");
			if ($db->numRows() < 1) {
				echo 'This recipient no longer exists on this platform';
				exit();
				}
			
			// get default setup info	
			if ($activityType === "ETH") {
				$holdType = 'listed Hold';
				}
				else {
					$minimumDonation = (int) $process->getlistedSetUp("minimum");
					$incentive = (int) $process->getlistedSetUp("incentive");
					$hold = (int) $process->getlistedSetUp("hold");
					$holdType = 'listed Hold';
					}
					
						
			
			 //check further
			 if ($donateAmount === "" || $donateAmount === 0) {
				 echo 'Please enter a real amount you wish to donate';
				 exit();
				 }
			 if ($donateAmount < $minimumDonation) {
				 echo 'Your donation is below the minimum allowed for this section';
				 exit();
				 }
				 else if ($donateAmount > $outstandingAmount) {
					 echo 'Your donation is above the outstanding balance left for this recipient';
					 exit();
					 }
					 else if ($balExceed === true) {
						 echo 'If you cannot donate everything for this recipient, then ensure what is left is up to the minimum allowed for this section. This is to grant other users the ability to donate for this recipient as well';
						 exit();
						 }
			
			
			//calculate donor incentive if he/she donates this amount
			$donorProfit = ($incentive / 100) * $donateAmount;
			
			/// we hold back this 
			$profitHold = ($hold / 100) * $donorProfit;
			
			
			 
			 /// hold for this new amount
			$info = $hold.'% of incentive gained ($'.$donorProfit.') as a result of donating the sum of $'.$donateAmount.' to '.$recipientUsername;
			
			// insert into hold for the with held profit
			$db->runQuery("INSERT INTO hold (uid, username, type, amount, info, user_status, referred_uid, referred_status, date)
			VALUES ('$donorUID', '$donorUsername', '$holdType', '$profitHold', '$info', 'hold', '$recipientUID', 'completed', now())");
			
			
			// calculate balance left of the profit earned
			$profitBalance = $donorProfit - $profitHold;
			
			//calculate total expected amoiunt for this donor if later confirmed by recipient
			$totalExpectedForDonor = $donateAmount + $profitBalance;
			
			
			// insert into outgoin for this donor
			$query = $db->runQuery("INSERT INTO incoming (activityID, uid, username, amount, type, status, date)
			VALUES('$activityID', '$uid', '$username', '$amount', '$type', 'pending', now())");	;	 
				
				
				
			if (!$query) {
				echo 'An error occured. Please try again';
				exit();
				}
				else {
				
				if ($leftOver === 0) {
					$db->runQuery("UPDATE incoming SET status = 'Completed' WHERE uid = '$recipientUID' AND activityID = '$activityID'");
					}
				
				/// insert into donor timeline
			$info = 'You made a reservation on Activity ID <span class="label label-sm label-success">'.$activityID.'</span>';	
			
		 $process->timelineUpdate($donorUID, $info, "Reservation");	
					
			
		/// insert into donor timeline
			$info = 'A reservation was made on your Activity with ID <span class="label label-sm label-success">'.$activityID.'</span>';			
			
			$process->timelineUpdate($recipientUID, $info, "Reservation");		
					echo 'Success';
					exit();
					}	
				}
		
?>
<?php 
		
		// if donor clicks the paid button
		if (isset($_POST["action"]) && $_POST["action"] === "donor_paid") {
			
		$donorUID = $db->cleanData($_POST["donor_uid"]);
		$donorUsername = $db->cleanData($_POST["donor_username"]);
		$activityID = $db->cleanData($_POST["activityID"]);
		$rowID = $db->cleanData($_POST["rowID"]);
		
		// check if activity for receival exists
		$db->runQuery("SELECT id, uid FROM incoming WHERE activityID = '$activityID'");
		if ($db->numRows() < 1) {
			echo 'There is no record for this activity ';
			exit();
			}
		$grab = $db->getData();	
		$recipientUID = $grab["uid"];	
		
		//check if this donor actially reserved
		$db->runQuery("SELECT donate_amount FROM outgoing WHERE activityID = '$activityID' AND (donor_uid = '$donorUID' AND id = '$rowID') AND (status != 'Unconfirmed')");
		if ($db->numRows() < 1) {
			echo 'You have no reservation matching this ID';
			exit();
			}
			
	 	// update hold for where this donor is a reffered
		$db->runQuery("UPDATE hold SET referred_status = 'pending' WHERE referred_uid = '$donorUID' AND referred_status = 'hold'");
		
		//update hold for where this donor is a refreral or has an active hold and his own referred has already commited or donated
		$db->runQuery("UPDATE hold SET user_status = 'pending' WHERE uid = '$donorUID' AND (user_status = 'hold' AND referred_status = 'completed') ");	
		
		// if done. update current status of outgoing to paid
		$query = $db->runQuery("UPDATE outgoing SET status = 'Paid' WHERE donor_uid = '$donorUID' AND (id = '$rowID' AND activityID = '$activityID')");
		
		
		if (!$query) {
			echo 'An error occured. Please try again';
			exit();
			}
		 
		$info = 'You claimed your donation to activity ID  <span class="label label-sm label-info">'.$activityID.'</span>  was successful';
		$process->timelineUpdate($donorUID, $info, "Payment Claim");
		
		$info = 'A claim on donation successfully paid was made on Activity ID  <span class="label label-sm label-info">'.$activityID.'</span>  ';
		$process->timelineUpdate($recipientUID, $info, "Payment Claim");	
		
		echo 'Success';
		exit();		
			}	  

?>
<?php 
		
		// if recipient clicks the unconfirm button
		if (isset($_POST["action"]) && $_POST["action"] === "unconfirm_donor") {
		 
			
			$activityID = $db->cleanData($_POST["activityID"]);
			$donorUID = $db->cleanData($_POST["donor_uid"]);
			$donorUsername = $db->cleanData($_POST["donor_username"]);
			$recipientUID = $db->cleanData($_POST["recipient_uid"]);
			$recipientUsername = $db->cleanData($_POST["recipient_username"]);
			$incomingRowID = $db->cleanData($_POST["incomingRowID"]);
			$outgoingRowID = $db->cleanData($_POST["outgoingRowID"]);
			$type = $db->cleanData($_POST["type"]);
			
			if ($type === "instant") {
				$holdType = 'instant Hold';
				}
				else {
					$holdType = 'listed Hold';					
					}
			
		 
			
			//check if activty exists
			$db->runQuery("SELECT id FROM incoming WHERE activityID = '$activityID' AND uid = '$recipientUID'");
			if ($db->numRows() < 1) {
				echo 'No activity found with this ID';
				exit();
				}
			/// delete frrom hold this user was already in hold expecting pay
			$db->runQuery("DELETE FROM hold WHERE type = '$holdType' AND (uid = '$donorUID' AND user_status != 'completed') ");
			
			// update hold where donor is suposed to be a referred 
			$db->runQuery("UPDATE hold SET referred_status = 'hold' WHERE referred_uid = '$donorUID' AND 
			(referred_status != 'completed' AND type = 'Referral Bonus')");
			
			/// update the outgoing for this activiy
			$query = $db->runQuery("UPDATE outgoing SET status = 'Unconfirmed' WHERE activityID = '$activityID' AND id = '$outgoingRowID'");
			
			if (!$query) {
				echo 'An error occured. Please try again';
				exit();
				}
			
			$info = 'Your donation was not confirmed by the recipient on Activity ID  <span class="label label-sm label-danger">'.$activityID.'</span> ';
		$process->timelineUpdate($donorUID, $info, "Unconfirm");
		
		$info = 'You did not confirm '.$donorUsername.' for the claim on  Activity ID  <span class="label label-sm label-danger">'.$activityID.'</span> ';
		$process->timelineUpdate($recipientUID, $info, "Unconfirm");
				
				echo 'Success';
				exit();
			
			}

?>
<?php 
	// if recipient clicks the confirm button
		if (isset($_POST["action"]) && $_POST["action"] === "confirm_donor") {
			 
			
			$activityID = $db->cleanData($_POST["activityID"]);
			$donorUID = $db->cleanData($_POST["donor_uid"]);
			$donorUsername = $db->cleanData($_POST["donor_username"]);
			$recipientUID = $db->cleanData($_POST["recipient_uid"]);
			$recipientUsername = $db->cleanData($_POST["recipient_username"]);
			$incomingRowID = $db->cleanData($_POST["incomingRowID"]);
			$outgoingRowID = $db->cleanData($_POST["outgoingRowID"]);
			$type = $db->cleanData($_POST["type"]);
			
			if ($type === "instant") {
				$holdType = 'instant Hold';
				}
				else {
					$holdType = 'listed Hold';					
					}
			
		 
			
			//check if activty exists
			$db->runQuery("SELECT id, amount FROM incoming WHERE activityID = '$activityID' AND uid = '$recipientUID'");
			if ($db->numRows() < 1) {
				echo 'No activity found with this ID';
				exit();
				}
				
			$fetch = $db->getData();	
			$recipientExpectedAmount = $fetch["amount"];
			
			// get new activity for this donor to now e qualified to receive
			$newActivityID = $process->generateActivityID();
			
			
			// If recipient status is hold ==>, recipient/referal( the person you referred) is yet to recommit 
			// if recipient status is pending==>, he has paid but not conmfirmed
			// if reciepient status is completed===>, he has paid and has been comnfirmed
			
			// if user( you awaiting to get these withheld sum) staus is hold, no payment yet
			// if user status is pending, paid but not confirmed
			// if user status is awaiting_Release, he has paid, been confirmed and this money should be released to the next transaction
			// if completed, hold money has been released
			// ONLY when RECIPIENT STATUS == COMPLETED AND USER STATUS IS == AWAITING RELEASE, WILL THIS AMOUNT BE CALCULATED AND ADDED FOR THIS NEW USER
			
		 
			$previouslyHeld = 0;
			$db->runQuery("SELECT id, amount FROM hold WHERE uid = '$donorUID' AND (referred_status = 'completed' AND user_status = 'awaiting_release')
			 AND (type = 'Referral Bonus' OR type = '$holdType' ) ");
			
			if ($db->numRows() > 0) {
				while ($row = $db->getData()) {
					//compute this amount
					$previouslyHeld = $previouslyHeld + $row["amount"];
					$rowID = $row["id"];
					
					 $db2->runQuery("UPDATE hold SET user_status = 'completed', released_to_activity = '$newActivityID' WHERE id = '$rowID'");
					 
					}
				}
		     
			/// update hold for this donor if hes gat some cash withheld already
			// when the referred is completed
			// when his own status is not awaiting release already
			// when his own status is not comleted already
			// i.e, he is already on hold or pending 
			$db->runQuery("UPDATE hold SET user_status = 'awaiting_release'
			WHERE uid = '$donorUID' AND referred_status = 'completed' AND 
			(user_status = 'pending') ");
				
			// update hold of this user if he is a reffered
			$db->runQuery("UPDATE hold SET referred_status = 'completed' WHERE referred_uid = '$donorUID' AND type = 'Referral Bonus'");
			
			/// update the outgoing for this activiy
			// resultant activity is neccessary for viewing transaction receipt
			// it shows how the activty ID  on the outgoing table resultted in this donor being moved to his own activity on the incoming table
			// helps me to find the link on the activty you paid before getting your own activity 
			
			 $query = $db->runQuery("UPDATE outgoing SET status = 'Confirmed', resultant_activity = '$newActivityID', previous_held = '$previouslyHeld' WHERE activityID = '$activityID' AND (id = '$outgoingRowID' AND donor_uid = '$donorUID')");
			
			
			// process and input this donor in the next line to receive
			$db->runQuery("SELECT * FROM outgoing WHERE activityID = '$activityID' AND (id = '$outgoingRowID' AND donor_uid = '$donorUID')");
			if ($db->numRows() > 0) {
				$grab = $db->getData();
				$donateAmount = $grab["donate_amount"];
				$incentivePercent = $grab["current_incentive_percent"];
				$incentiveHold = $grab["current_incentive_hold"];
				
				$profitEarned = $grab["profit_earned"];
				$profitHold = $grab["profit_hold"];
				$previouslyHeld = $grab["previous_held"];
				$type = $grab["type"];
				
				//calculate new total for this donor
				$profitBalance = (int) $profitEarned - (int) $profitHold;
				
				$donorEntitlement = $donateAmount + $profitBalance + $previouslyHeld;
				
				// now insert for this donor
				$query = $db->runQuery("INSERT INTO incoming (activityID, uid, username, amount, type, status, date)
				VALUES('$newActivityID', '$donorUID', '$donorUsername', '$donorEntitlement', '$type', 'Off', now() )");
				
				}	
			
			if (!$query) {
				echo 'An error occured. Please try again';
				exit();
				}
				
			
			$info = 'Your donation on Activity ID  <span class="label label-sm label-success">'.$activityID.'</span> was successfully confirmed ';
		$process->timelineUpdate($donorUID, $info, "Confirm");
		
		$info = 'Your successfully received and confirmed donation from '.$donorUsername.'  on Activity ID  <span class="label label-sm label-success">'.$activityID.'</span> ';
		$process->timelineUpdate($recipientUID, $info, "Confirm");
				
				echo 'Success';
				exit();
			
			}	
?>
<?php 
				/// Cancel reservation
				if (isset($_POST["action"]) && $_POST["action"] === "cancel_reservation") {
		
		$donorUID = $db->cleanData($_POST["donor_uid"]);
		$donorUsername = $db->cleanData($_POST["donor_username"]);
		$activityID = $db->cleanData($_POST["activityID"]);
		$rowID = $db->cleanData($_POST["rowID"]);
		$type = $db->cleanData($_POST["type"])." Hold";
		$recipientUID = $db->cleanData($_POST["recipientUID"]);
		$amountDonated = $db->cleanData($_POST["amountDonated"]);
		$profitHold = $db->cleanData($_POST["profitHold"]);
		
		/// check fif activity ID exists for this recipient
		$db->runQuery("SELECT id FROM incoming WHERE activityID = '$activityID' AND uid = '$recipientUID'");
		if ($db->numRows() < 1) {
			echo 'No record of this activity ID was found';
			exit();
			}
		
		//delete record from hold for this dononr
		$db->runQuery("DELETE FROM hold WHERE uid = '$donorUID' AND referred_uid = '$recipientUID' AND 
		(type = '$type' AND user_status = 'hold') AND (amount = '$profitHold') LIMIT 1");
		
		// then delete from outgoing
		$query = $db->runQuery("DELETE FROM outgoing WHERE donor_uid = '$donorUID' AND activityID = '$activityID' AND 
		(recipient_uid = '$recipientUID' AND status = 'Reserved') AND (profit_hold = '$profitHold')");
		
		$query = true;
		
		if (!$query) {
			echo 'An error occured. This process was not completed';
			exit();
			}
		
		// update this activity if already completed	
		$db->runQuery("SELECT status FROM incoming WHERE activityID = '$activityID'");
		$fetch = $db->getData();
		
		$currStatus = $fetch['status'];
		
		if ($currStatus === "Completed"){
			$db->runQuery("UPDATE incoming SET status = 'Off' WHERE activityID = '$activityID' AND uid = '$recipientUID'");
			}
			
			echo 'Success';
			exit();
					}
?>