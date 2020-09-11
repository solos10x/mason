/**
Main/Custom Js 
**/

var controller =  {

	// update Basic Details
	updateBasicDetails: function () {
		
		var username = $("#username").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var country = $("#country").val();
		var uid = $("#uid").val();
		
		if (username === "" || username.length < 4) {
			$("#username").css("border", "1px solid #900");
			$("#error-basic").html('<div class="alert alert-danger">Your username is very important. Please enter a unique username not less than 4 characters</div>');
			return false;
			}
			else if (email === "") {
				$("#email").css("border", "1px solid #900");
			$("#error-basic").html('<div class="alert alert-danger">This process cannot continue. Email address is empty</div>');	
				return false;
				}
				else if (phone === "") {
				$("#phone").css("border", "1px solid #900");
			$("#error-basic").html('<div class="alert alert-danger">Please enter a phone number for your account. It is very important</div>');	
				return false;	
					}
					else if (country === "") {
			$("#country").css("border", "1px solid #900");
			$("#error-basic").html('<div class="alert alert-danger">Please select a country of residence</div>');	
				return false;		
						}
						else {
					$("#error-basic").html('<div class="alert alert-success">Please wait...</div>');	
					$("#update-basic-details-btn").prop("disabled", true);	
					$("#update-basic-details-btn").html('<img src="../images/squares.gif"/>');	
							
					
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
				if (req.readyState == 4 && req.status == 200) {
												
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-basic").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-basic-details-btn").prop("disabled", false);	
					$("#update-basic-details-btn").html('Update');
				}
					else {
			  $("#error-basic").html('<div class="alert alert-success">Your basic details has been successfully updated</div>');	
					$("#update-basic-details-btn").prop("disabled", false);	
					$("#update-basic-details-btn").html('Update');
					}		 
						
				}
							
			}
							
			  req.send("action=updateBasicDetails&username="+username+"&email="+email+"&phone="+phone+"&country="+country+"&uid="+uid);
										
							} 
		},
		
	// update User Passwrod
	updatePasswordDetails: function () {
		
		var currPassword = $("#curr-password").val();
		var newPassword = $("#new-password").val();
		var confPassword = $("#conf-password").val();
		var uid = $("#uid").val();
		
		
		if (currPassword === "") {
			$("#curr-password").css("border", "1px solid #900");
			$("#error-password").html('<div class="alert alert-danger">Please enter your current password</div>');
			return false;
			}
		else if (newPassword === "") {
			$("#new-password").css("border", "1px solid #900");
			$("#error-password").html('<div class="alert alert-danger">Please enter a new password</div>');
			return false;
			}
			else if (confPassword === "") {
				$("#conf-password").css("border", "1px solid #900");
			$("#error-password").html('<div class="alert alert-danger">Please confirm your new password</div>');	
				return false;
				}
				else if (newPassword !== confPassword) {
				$("#conf-password").css("border", "1px solid #900");
			$("#error-password").html('<div class="alert alert-danger">Passwords do not match</div>');	
				return false;	
					}
					 
						else {
					$("#error-password").html('<div class="alert alert-success">Please wait...</div>');	
					$("#update-password-details-btn").prop("disabled", true);	
					$("#update-password-details-btn").html('<img src="../images/squares.gif"/>');	
							
					
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-password").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-password-details-btn").prop("disabled", false);	
				$("#update-password-details-btn").html('Update');
				}
					else {
			  $("#error-password").html('<div class="alert alert-success">Your password has been successfully updated</div>');	
					$("#update-password-details-btn").prop("disabled", false);	
					$("#update-password-details-btn").html('Update');
					}		 
						
				}
							
			}
							
			  req.send("action=update_password&curr_password="+currPassword+"&new_password="+newPassword+"&conf_password="+confPassword+"&uid="+uid);
										
			} 
		},
		
	// update Bank Details
	updateBankDetails: function () {
		
		var bankAccountName = $("#bank-account-name").val();
		var bankAccountNumber = $("#bank-account-number").val();
		var bankAccountType = $("#bank-account-type").val();
		var bank = $("#bank").val();
		var uid = $("#uid").val();
		var bankActive = $("#bank-active").val();
		 
		if (bankAccountName === "") {
			$("#bank-account-name").css("border", "1px solid #900");
			$("#error-bank").html('<div class="alert alert-danger">Please enter your bank account name</div>');
			return false;
			}
		else if (bankAccountNumber === "") {
			$("#bank-account-number").css("border", "1px solid #900");
			$("#error-bank").html('<div class="alert alert-danger">Please enter your bank account number</div>');
			return false;
			}
			else if (bankAccountType === "") {
			$("#bank-account-type").css("border", "1px solid #900");
			$("#error-bank").html('<div class="alert alert-danger">Please enter the type of account you use</div>');
			return false;
			}
			else if (bank === "") {
			$("#bank").css("border", "1px solid #900");
			$("#error-bank").html('<div class="alert alert-danger">Please enter the name of your bank</div>');	
				return false;
				}
				  else {
					$("#error-bank").html('<div class="alert alert-success">Please wait...</div>');	
					$("#update-bank-details-btn").prop("disabled", true);	
					$("#update-bank-details-btn").html('<img src="../images/squares.gif"/>');	
							
					
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-bank").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-bank-details-btn").prop("disabled", false);	
				$("#update-bank-details-btn").html('Update');
				}
					else {
			  $("#error-bank").html('<div class="alert alert-success">Your bank details has been successfully updated</div>');	
					$("#update-bank-details-btn").prop("disabled", false);	
					$("#update-bank-details-btn").html('Update');
					}		 
						
				}
							
			}
							
			  req.send("action=update_bank&bank_account_name="+bankAccountName+"&bank_account_number="+bankAccountNumber+"&bank="+bank+"&uid="+uid+
			  "&bank_account_type="+bankAccountType+"&bank_active="+bankActive);
										
			} 
		},
		
	// update PayPal Details
	updatePaypalDetails: function () {
 
		var paypalID = $("#paypal-id").val();
		var uid = $("#uid").val();
		var paypalActive = $("#paypal-active").val();
	
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-paypal").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-paypal-details-btn").prop("disabled", false);	
				$("#update-paypal-details-btn").html('Update');
				}
					else {
			  $("#error-paypal").html('<div class="alert alert-success">Your paypal details has been successfully updated</div>');	
					$("#update-paypal-details-btn").prop("disabled", false);	
					$("#update-paypal-details-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=update_paypal"+"&uid="+uid+"&paypal_id="+paypalID+"&paypal_active="+paypalActive);
	 
		},
		
		// update Bitcoin Details
	updateBitcoinDetails: function () {
 
		var bitcoinAddress = $("#bitcoin-address").val();
		var uid = $("#uid").val();
		var bitcoinActive = $("#bitcoin-active").val();
	
				//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-bitcoin").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-bitcoin-details-btn").prop("disabled", false);	
				$("#update-bitcoin-details-btn").html('Update');
				}
					else {
			  $("#error-bitcoin").html('<div class="alert alert-success">Your bitcoin details has been successfully updated</div>');	
					$("#update-bitcoin-details-btn").prop("disabled", false);	
					$("#update-bitcoin-details-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=update_bitcoin"+"&uid="+uid+"&bitcoin_address="+bitcoinAddress+"&bitcoin_active="+bitcoinActive);
	 
		},
		
		
		// admin set Bitcoin value
	setBitcoinValue: function () {
 
			var bitcoinValue = $("#bitcoin-value").val();
	
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-bitcoin").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-bitcoin-value-btn").prop("disabled", false);	
				$("#update-bitcoin-value-btn").html('Update');
				}
					else {
			  $("#error-bitcoin").html('<div class="alert alert-success">Bitcoin value has been successfully updated</div>');	
					$("#update-bitcoin-value-btn").prop("disabled", false);	
					$("#update-bitcoin-value-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=set_bitcoin_value"+"&bitcoin_value="+bitcoinValue);
	 
		},
		
	// admin set dollar value
	setDollarValue: function () {
 
			var dollarValue = $("#dollar-value").val();
	
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-dollar").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-dollar-value-btn").prop("disabled", false);	
				$("#update-dollar-value-btn").html('Update');
				}
					else {
			  $("#error-dollar").html('<div class="alert alert-success">Dollar value has been successfully updated</div>');	
					$("#update-dollar-value-btn").prop("disabled", false);	
					$("#update-dollar-value-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=set_dollar_value"+"&dollar_value="+dollarValue);
	 
		},	
		
		// admin set dollar value
	setinstantIncentive: function () {
 
			var instantIncentive = $("#instant-incentive").val();
			var instantIncentiveHold = $("#instant-incentive-hold").val();
			var instantMinimum = $("#instant-minimum").val();
	
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-instant").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-instant-incentive-btn").prop("disabled", false);	
				$("#update-instant-incentive-btn").html('Update');
				}
					else {
			  $("#error-instant").html('<div class="alert alert-success">Set Up for Instant has been updated</div>');	
					$("#update-instant-incentive-btn").prop("disabled", false);	
					$("#update-instant-incentive-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=set_instant_incentive"+"&instant_incentive="+instantIncentive+"&instant_minimum="+instantMinimum+"&instant_incentive_hold="+instantIncentiveHold);
	 
		},
		
		// admin set dollar value
	setlistedIncentive: function () {
 
			var listedIncentive = $("#listed-incentive").val();
			var listedIncentiveHold = $("#listed-incentive").val();
			var listedMinimum = $("#listed-minimum").val();
	
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-listed").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-listed-incentive-btn").prop("disabled", false);	
				$("#update-listed-incentive-btn").html('Update');
				}
					else {
			  $("#error-listed").html('<div class="alert alert-success">Set up for Listed has been updated</div>');	
				 $("#update-listed-incentive-btn").prop("disabled", false);	
				 $("#update-listed-incentive-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=set_listed_incentive"+"&listed_incentive="+listedIncentive+"&listed_incentive_hold="+listedIncentiveHold+"&listed_minimum="+listedMinimum);
	 
		},
		
	// admin set list pop out value
	setListing: function () {
 
			var listLimit = $("#listing").val();
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-listing").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-listing-btn").prop("disabled", false);	
				$("#update-listing-btn").html('Update');
				}
					else {
			  $("#error-listing").html('<div class="alert alert-success">List pop out value has been updated</div>');	
				 $("#update-listing-btn").prop("disabled", false);	
				 $("#update-listing-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=listing"+"&list_limit="+listLimit);
	 
		},					
	
	searchUser: function (url){
		var user = $("#user").val();
		if (user !== "") {
			window.location.href = url+"dashboard/search?user="+user;
			}
		},
		
	// admin set referral bonus
	setReferralBonus: function () {
 
			var referralBonus = $("#ref-bonus").val();
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-referral").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#update-ref-btn").prop("disabled", false);	
				$("#update-ref-btn").html('Update');
				}
					else {
			  $("#error-referral").html('<div class="alert alert-success">Referral Bonus has been updated</div>');	
				 $("#update-ref-btn").prop("disabled", false);	
				 $("#update-ref-btn").html('Update');
					}		 
						
				}
							
			}
						
			  req.send("action=referral_bonus"+"&referral_bonus="+referralBonus);
	 
		},					
	
	searchUser: function (url){
		var user = $("#user").val();
		if (user !== "") {
			window.location.href = url+"dashboard/search?user="+user;
			}
		},	
		
	upgradeToAdmin: function (username) {
	
	if (username === "") {
		alert("No username provided");
		return false;
		}
		
		  $("#error-upgrade").html('<div class="alert alert-success">Processing...</div>');	
		  $("#upgrade-admin-btn").prop("disabled", true);	
		  $("#upgrade-admin-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
		  
		 
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-upgrade").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#upgrade-admin-btn").prop("disabled", false);	
				$("#upgrade-admin-btn").html('Upgrade to Admin');
				}
					else {
			  $("#error-upgrade").html('<div class="alert alert-success">This User is now an admin on this platform</div>');	
				 $("#upgrade-admin-btn").prop("disabled", false);	
				 $("#admin-upgrade-toggle-wrap").html('<button class="btn btn-primary btn-wrap red-btn" onclick=\'controller.removeAsAdmin("'+username+'")\' id="upgrade-admin-btn"> Remove as Admin </button>');
					}		 
						
				}
							
			}
						
			  req.send("action=upgrade_to_admin"+"&user="+username);
	 
		},
		
	removeAsAdmin: function (username) {
	
	if (username === "") {
		alert("No username provided");
		return false;
		}
		
		  $("#error-upgrade").html('<div class="alert alert-success">Processing...</div>');	
		  $("#upgrade-admin-btn").prop("disabled", true);	
		  $("#upgrade-admin-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
	 
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-upgrade").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#upgrade-admin-btn").prop("disabled", false);	
				$("#upgrade-admin-btn").html('Remove as Admin');
				}
					else {
			  $("#error-upgrade").html('<div class="alert alert-success">This user\'s admin privilege has been revoked</div>');	
				 $("#upgrade-admin-btn").prop("disabled", false);	
				 $("#admin-upgrade-toggle-wrap").html('<button class="btn btn-primary" onclick=\'controller.upgradeToAdmin("'+username+'")\' id="upgrade-admin-btn"> Upgrade To Admin </button>');
					}		 
						
				}
							
			}
						
			  req.send("action=remove_as_admin"+"&user="+username);
		},
		
	
	scheduleToReceive: function (username) {
	
	var amount = $("#receive-amount").val();
	var type = $("#type").val();	
		
	if (username === "") {
		alert("No username provided");
		return false;
		}
		
		  $("#error-schedule").html('<div class="alert alert-success">Processing...</div>');	
		  $("#schedule-admin-btn").prop("disabled", true);	
		  $("#schedule-admin-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
			 
			 
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-schedule").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#schedule-admin-btn").prop("disabled", false);	
				$("#schedule-admin-btn").html('Deposit Confirmed');
				}
					else {
			  $("#error-schedule").html('<div class="alert alert-success">Your account has been funded successfully</div>');	
				 $("#schedule-admin-btn").prop("disabled", false);	
				 	$("#schedule-admin-btn").html('Confirm Deposit');
					}		 
						
				}
							
			}
						
			  req.send("action=schedule_to_receive"+"&user="+username+"&amount="+amount+"&type="+type);
 
		},
		
	deposit: function () {
	
	var amount = $("#deposit-amount").val();
	var type = $("#type").val();	
	
		
		  $("#error-deposit").html('<div class="alert alert-success">Processing...</div>');	
		  $("#deposit-admin-btn").prop("disabled", true);	
		  $("#deposit-admin-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
			 
			 
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-deposit").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#deposit-admin-btn").prop("disabled", false);	
				$("#deposit-admin-btn").html('Make Deposit');
				}
					else {
			  $("#error-deposit").html('<div class="alert alert-success">Your have request to fund your account</div>');	
				 $("#deposit-admin-btn").prop("disabled", false);	
				 	$("#deposit-admin-btn").html('Make Deposit');
					}		 
						
				}
							
			}
						
			  req.send("action=deposit"+"&amount="+amount+"&type="+type);
 
		},				 
		
	donateNow: function (activityID, donorID, donorUsername, recipientID, recipientUsername, outstanding, minimumDonation, dollarRate) {
		
		var donateAmount = $("#amount").val();
	  
		if (donateAmount === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Please enter a valid amount you wish to donate</div>');
		return false;
		} 
		else if (activityID === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Activity ID is empty</div>');
		return false;
		}
		else if (parseInt(donateAmount) < parseInt(minimumDonation) ) {
		$("#status-report").html('<div class="alert alert-danger">Error: The minimum donation for this category is $'+minimumDonation+'</div>');
		return false;	
		}
		else if (parseInt(donateAmount) > parseInt(outstanding) ) {
		$("#status-report").html('<div class="alert alert-danger">Error: Your donation is above the outstanding amount left for this recipient</div>');
		return false;		
		}
		else if	(isNaN(donateAmount)){
		$("#status-report").html('<div class="alert alert-danger">Error: Only numbers are allowed</div>');
		return false;		
		}
			else if (donorID === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Donor ID is empty</div>');
		return false;		
				}
			else if (donorUsername === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Donor  Username is empty</div>');
		return false;		
				}	
			else if (recipientID === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Recipient ID is empty</div>');			
			return false;		
			}
		   else if (recipientUsername === "") {
		$("#status-report").html('<div class="alert alert-danger">Error: Recipient Username is empty</div>');			
			return false;		
			}
			 else if (donorID === recipientID) {
		$("#status-report").html('<div class="alert alert-danger">Error: You cannot donate to yourself</div>');					
		return false;			
			}
		 
		
		$("#status-report").html('<div class="alert alert-success">Please wait...this might take a while</div>');	
		$("#donate-btn").prop("disabled", true);	
		$("#donate-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
			 
			 
					//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#status-report").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#donate-btn").prop("disabled", false);	
				$("#donate-btn").html('Donate');
				}
					else {
			/*  $("#status-report").html('<div class="alert alert-success">Thank you. After making payment, click on Paid  to inform the recipient you have successfully transferred the inputed amount</div>');	
				 $("#donate-btn").prop("disabled", false);	
				 	$("#donate-btn").html('Donate'); **/
					window.location.href = 'https://earnersfund.net/dashboard/outgoing';
					
					var newOutstanding = outstanding - donateAmount;
					$("#outstanding-dollars").html(newOutstanding);
					$("#outstanding-naira").html(newOutstanding * dollarRate);
					}		 
						
				}
							
			}
						
			  req.send("action=donate"+"&activityID="+activityID+"&donorID="+donorID+"&donorUsername="+donorUsername+"&donate_amount="+donateAmount);
	},
	
	donorPaidBtn: function (donorUID, donorUsername, activityID, rowID) {
		
		var conf = confirm("Are you sure you have fully paid? A false claim might lead to termination of your account on this platform");
		
		if (!conf) {
			return false;
			}
		
		$("#error-donate-status").html('<div class="alert alert-success">Please wait...</div>');	
		$("#donor-confirm-paid-btn").prop("disabled", true);	
		$("#donor-confirm-paid-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
			 
			 
		 		//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-donate-status").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#donor-confirm-paid-btn").prop("disabled", false);	
				$("#donor-confirm-paid-btn").html('Paid');
				}
					else {
			  $("#error-donate-status").html('<div class="alert alert-success">Thank you for the payment. Awaiting confirmation from the recipient</div>');	
			  $("#donor-confirm-paid-btn").prop("disabled", false);	
			  $("#donate-status-wrap").html('<button class="btn btn-primary btn-wrap red-btn" disabled="disabled">Awaiting Confirmation</button><p> <small> Contact the recipient to confirm the receival of your donation </small> </p>');
					}		 
						
				}
							
			}
						
			  req.send("action=donor_paid"+"&donor_uid="+donorUID+"&donor_username="+donorUsername+"&activityID="+activityID+"&rowID="+rowID);
	 
		},
	
	cancelReservation: function (donorUID, donorUsername, activityID, rowID, type, amountDonated, profitHold,  recipientUID, url) {
		
		var conf = confirm("Are you sure you really wish to cancel this reservation?");
		
		if (!conf) {
			return false;
			}
		
		$("#error-donate-status").html('<div class="alert alert-success">Please wait...</div>');	
		$("#donor-cancel-reservation-btn").prop("disabled", true);	
		$("#donor-cancel-reservation-btn").html('<img src="../images/squares.gif" alt="Please wait..."/>');
			 
	 	 
		 		//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-donate-status").html('<div class="alert alert-danger">'+response+'</div>');	
				$("#donor-cancel-reservation-btn").prop("disabled", false);	
				$("#donor-cancel-reservation-btn").html('Paid');
				}
					else {
			  $("#error-donate-status").html('<div class="alert alert-success">This reservation has been cancelled.</div>');	
			 
			 setTimeout(function (){
				 window.location.href = '../dashboard/outgoing';
				 }, 2000)
			 
					}		 
						
				}
							
			}
						
			  req.send("action=cancel_reservation"+"&donor_uid="+donorUID+"&donor_username="+donorUsername+"&activityID="+activityID+"&rowID="+rowID+"&recipientUID="+recipientUID+"&type="+type+"&amountDonated="+amountDonated+"&profitHold="+profitHold);
	 
		},
	
	recipientUnconfirmDonation: function (activityID, recipientUID, recipientUsername, donorUID, donorUsername, type, incomingRowID, outgoingRowID) {
		
	  var conf = confirm("Are you sure you did not receive any donation from this donor? Click Ok to continue");
	  
	  if (!conf) {
		  return false;
		  } 
	  
		$("#error-"+outgoingRowID).html('<div class="alert alert-success">Please wait...</div>');	
		$("#unconfirm-donation-btn-"+outgoingRowID).prop("disabled", true);	
		$("#unconfirm-donation-btn-"+outgoingRowID).html('<img src="../images/squares.gif" alt="Please wait..."/>');
		 
			 
			 
		 		//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-"+outgoingRowID).html('<div class="alert alert-danger">'+response+'</div>');	
				$("#unconfirm-donation-btn-"+outgoingRowID).prop("disabled", false);	
				$("#unconfirm-donation-btn-"+outgoingRowID).html('Unconfirm');
				}
					else {
			  $("#error-"+outgoingRowID).html('<div class="alert alert-success">This donor reservation has been successfully removed</div>');	
			  $("#unconfirm-donation-btn-"+outgoingRowID).prop("disabled", false);	
			  $("#btn-wrap-"+outgoingRowID).html('<button class="btn btn-primary btn-wrap red-btn" disabled="disabled">Not Confirmed</button><p> <small> The system will reschedule you to receive donation in a short while </small> </p>');
					}		 
						
				}
							
			}
						
			  req.send("action=unconfirm_donor"+"&donor_uid="+donorUID+"&donor_username="+donorUsername+"&activityID="+activityID+"&incomingRowID="+incomingRowID+"&outgoingRowID="+outgoingRowID+"&type="+type+"&recipient_uid="+recipientUID+"&recipient_username="+recipientUsername);
	 
		},
		
	recipientConfirmDonation: function (activityID, recipientUID, recipientUsername, donorUID, donorUsername, type, incomingRowID, outgoingRowID) {
		
	  var conf = confirm("Are you sure you've received donation from this donor? Click Ok to continue");
	  
	  if (!conf) {
		  return false;
		  } 
	  
		$("#error-"+outgoingRowID).html('<div class="alert alert-success">Please wait...</div>');	
		$("#confirm-donation-btn-"+outgoingRowID).prop("disabled", true);	
		$("#confirm-donation-btn-"+outgoingRowID).html('<img src="../images/squares.gif" alt="Please wait..."/>');
		 
			 
			 
		 		//send ajax
				var req = new XMLHttpRequest();	
				var url = "../requests/ajax/processor.php";		
				req.open("POST", url, true);
				req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				req.onreadystatechange = function () {
			 
			
				if (req.readyState == 4 && req.status == 200) {
									 
				var response = req.responseText;
				response = response.trim();			
				 
				if (response !== "Success"){
			  	$("#error-"+outgoingRowID).html('<div class="alert alert-danger">'+response+'</div>');	
				$("#confirm-donation-btn-"+outgoingRowID).prop("disabled", false);	
				$("#confirm-donation-btn-"+outgoingRowID).html('Unconfirm');
				}
					else {
			  $("#error-"+outgoingRowID).html('<div class="alert alert-success">You have successfully confirmed that this donation was received</div>');	
			  $("#confirm-donation-btn-"+outgoingRowID).prop("disabled", false);	
			  $("#btn-wrap-"+outgoingRowID).html('<button class="btn btn-primary btn-wrap red-btn" disabled="disabled">Confirmed</button><p>Thank you!</p>');
			  
			  $("#status-box-"+outgoingRowID).html("Confirmed");
			  
					}		 
						
				}
							
			}
						
			  req.send("action=confirm_donor"+"&donor_uid="+donorUID+"&donor_username="+donorUsername+"&activityID="+activityID+"&incomingRowID="+incomingRowID+"&outgoingRowID="+outgoingRowID+"&type="+type+"&recipient_uid="+recipientUID+"&recipient_username="+recipientUsername);
	 
		},		
		
		updateBroadcastStatus: function (url, rowID) {
			
		var status = $("#broadcast-status").val();	
		
		if (status !== "") {
			var conf = confirm("Are you surfe you wish to wish update the status of this broadcast");
			if (!conf){
				return false;
				}
				else {
					window.location.href = url+'dashboard/broadcast?update='+rowID+"&newstatus="+status;
					}
			}
			
			}


}