<?php
include_once('db.php');
require_once "PHPMailer/PHPMailerAutoload.php";

class process {
    private $db;
	
    public function __construct($db){
        $this->db = $db;
    }
	
	public function emailMessenger ($to, $from, $subject, $message, $return, $title) {
		
		$html = '<html xmlns="http://www.w3.org/1999/xhtml">
					
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					
					<head></head>
					
					<body>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
					  <tr>
						<td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
							<tr>
							  <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:5px 5px 0 0; background-color:#ffffff;">
								  <tr>
									<td height="29">&nbsp;</td>
								  </tr>
								  <tr>
									<td><table border="0" cellspacing="0" cellpadding="0" align="left" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tr>
										  <td width="23" class="hide">&nbsp;</td>

										  <td height="75" class="inner" valign="middle"><a href="'.URL.'"><img class="logo" src="'.URL.'images/logo.png" width="180" height="61" alt="Logo"></a></td>
										</tr>
									  </table>
									  <table width="150" border="0" cellspacing="0" cellpadding="0" align="right" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tr>
										  <td height="15">&nbsp;</td>
										</tr>
									  </table></td>
								  </tr>
								  <tr>
									<td style="border-bottom:1px solid #dbdbdb;">&nbsp;</td>
								  </tr>
								</table></td>
							</tr>
						  </table></td>
					  </tr>
					</table>
					
					
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
					  <tr>
						<td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
							<tr>
							  <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="background-color:#ffffff;">
								  <tr>
									<td height="23">&nbsp;</td>
								  </tr>
								  <tr>
									<td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
										  <td width="23" class="sidespace">&nbsp;</td>
										  <td><table width="76%" border="0" cellspacing="0" cellpadding="0" align="left" class="inner" id="banner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											  <tr>
												<td style="font:bold 27px Arial, Helvetica, sans-serif; border-right:1px solid #dbdbdb;" class="smallfont">'.$title.'</td>
											  </tr>
											  <tr>
												<td height="20">&nbsp;</td>
											  </tr>
											</table>
											<table width="22%" border="0" cellspacing="0" cellpadding="0" align="right" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											  <tr>
												<!--<td align="center"><a href="https://facebook.com/earnersfund" style="margin-top:5px; display:inline-block;" target="_blank"><img src="'.URL.'images/facebook.png" width="32" height="atuo" alt="Social Media" /></a></td>
												<td align="center"><a href="https://twitter.com/earnersfund" style="margin-top:5px; display:inline-block;" target="_blank"><img src="'.URL.'images/twitter.png" width="32" height="atuo" alt="Social Media" /></a></td>-->
												 
											  </tr>
											  <tr>
												<td height="20">&nbsp;</td>
												<td height="20">&nbsp;</td>
												<td height="20">&nbsp;</td>
											  </tr>
											</table></td>
										  <td width="23" class="sidespace">&nbsp;</td>
										</tr>
									  </table>
									  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
										  <td width="3.33%" class="sidespace">&nbsp;</td>
										  <td width="93.33%"><img class="imgresponsive" src="'.URL.'images/email-img.jpg" width="554" height="atuo" alt="Banner" style="max-width:100%"/></td>
										  <td width="3.33%" class="sidespace">&nbsp;</td>
										</tr>
										<tr>
										  <td height="20">&nbsp;</td>
										  <td height="20">&nbsp;</td>
										  <td height="20">&nbsp;</td>
										</tr>
									  </table>
									  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
										  <td width="23" class="sidespace">&nbsp;</td>
										  <td>
										 
											
											<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right" class="inner">
											  <tr>
												<td style="font:14px/19px Arial, Helvetica, sans-serif; color:#333332;">'.$message.'</td>
											  </tr>
											  <tr>
												<td height="20">&nbsp;</td>
											  </tr>
											 
											
											</table></td>
										  <td width="23" class="sidespace">&nbsp;</td>
										</tr>
										<tr>
										  <td height="16">&nbsp;</td>
										  <td height="16">&nbsp;</td>
										  <td height="16">&nbsp;</td>
										</tr>
									  </table></td>
								  </tr>
								  <tr>
									<td style="border-bottom:1px solid #dbdbdb;">&nbsp;</td>
								  </tr>
								</table></td>
							</tr>
						  </table></td>
					  </tr>
					</table>
					 	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
					  <tr>
						<td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
							<tr>
							  <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:0 0 7px 7px;">
								  <tr>
									<td height="18">&nbsp;</td>
								  </tr>
								  <tr>
									<td><table class="inner" align="right" width="340" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
										
									  </table>
									  
									  <table class="inner" align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
										<tr>
										  <td width="21">&nbsp;</td>
										  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											  <tr>
												<td align="center" 
												style="font:11px Helvetica,  Arial, sans-serif; color:#000000;">&copy; '.date("Y").' <br/> Earners Fund </td>
											  </tr>
											  <tr>
												<td height="18">&nbsp;</td>
											  </tr>
											</table></td>
											
										  <td width="21">&nbsp;</td>
										</tr>
									  </table></td>
								  </tr>
								</table></td>
							</tr>
						  </table></td>
					  </tr>
					</table>
					</body>
					</html>';
			 
			 
			 //Create a new PHPMailer instance
			$mail = new PHPMailer;
			// Set PHPMailer to use the sendmail transport
			$mail->isSendmail();
			//Set who the message is to be sent from
			$mail->setFrom($from, 'Mason Capital Investment');
			//Set an alternative reply-to address
			$mail->addReplyTo($from, 'Mason Capital Investment');
			//Set who the message is to be sent to
			$mail->addAddress($to, '');
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($html);
			//Replace the plain text body with one created manually
			$mail->AltBody = $message;
			 
			
			//send the message, check for errors
			if (!$mail->send()) {
				//return "Mailer Error: " . $mail->ErrorInfo;
			} else {
				//return $return;
			}

						
		
		}
		
		public function generateLink($unique, $limit) {
			
			$carr = round ($limit / 2);
			$hl = $limit - $carr;
			
			/// string 1 data
			$strings = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWZYZ0123456789';
			$shuffle = str_shuffle($strings);
			$string1 = substr($shuffle, 0, $hl);
			
			// string 2 data
			$encryptUniqueElem = md5($unique);
			$additionalStrings = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWZYZ0123456789';
			$cj = $encryptUniqueElem.$additionalStrings;
			$shuffle = str_shuffle($cj);
			$string2 = substr($shuffle, 0, $hl);
			
			
			$link = $string1.$string2;
			return $link;
		
		}
		
		public function encryptDecrypt($action, $string){	
				$encrypt_method="AES-256-CBC";
				$secret_key="hkdr456v6v6f7zlopqacdyw";
				$secret_iv="ffyf6f19732uktf26gd6g26t82g";
				
				$key=hash("sha256", $secret_key);
				
				$iv=substr(hash('sha256', $secret_iv), 0, 16);
				
				if ($action == "encrypt"){
					
				$output=openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
				
				$output=base64_encode($output);	
					
					}
					else if ($action == "decrypt"){
						
					$output=openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);	
						}
				return $output;
		}
		
		public function generateActivityID() {
			
			$this->db->runQuery("SELECT activityID FROM incoming ORDER BY activityID DESC LIMIT 1");
			if ($this->db->numRows() < 1) {
				/// then form it
				$newRecord = 1628;
				}
				else {
					$fetch = $this->db->getData();
					$lastRecord = $fetch["activityID"];
					$newRecord = $lastRecord + 1;
					}
			
			return $newRecord;
		}
		
		public function getDollarToNairaRate() {
			$rate = 1;
			$this->db->runQuery("SELECT dollar_to_naira FROM setup ORDER BY id DESC");
			if ($this->db->numRows() > 0) {
				$fetch = $this->db->getData();
				$rate = $fetch["dollar_to_naira"];
				}
				return $rate;
			}
			
		public function getinstantSetUp($info) {
			
			$instantIncentive = 0;
			$instantMinimum = 1;
			$instantIncentiveHold = 0;
			
			$this->db->runQuery("SELECT instant_incentive, instant_minimum, instant_incentive_hold  FROM setup ORDER BY id DESC LIMIT 1");
			if ($this->db->numRows() > 0) {
			$fetch = $this->db->getData();	
			$instantIncentive = $fetch["instant_incentive"];
			$instantMinimum = $fetch["instant_minimum"];	
			$instantIncentiveHold  = $fetch["instant_incentive_hold"];
			}
			
			if ($info === "minimum") {
				return $instantMinimum;
				}
				else if ($info === "incentive") {
					return $instantIncentive;
					}
					else if ($info === "hold") {
						return  $instantIncentiveHold;
						}
						 
			
			}
			
		public function getlistedSetUp($info) {
			
			$listedIncentive = 0;
			$listedMinimum = 1;
			$listedIncentiveHold = 0;
			
			$this->db->runQuery("SELECT listed_incentive, listed_minimum, listed_incentive_hold FROM setup ORDER BY id DESC LIMIT 1");
			if ($this->db->numRows() > 0) {
			
			$fetch = $this->db->getData();	
			$listedIncentive = $fetch["listed_incentive"];
			$listedMinimum = $fetch["listed_minimum"];	
			$listedIncentiveHold  = $fetch["listed_incentive_hold"];
			}
			
			if ($info === "minimum") {
				return $listedMinimum;
				}
				else if ($info === "incentive") {
					return $listedIncentive;
					}
					else if ($info === "hold") {
						return  $listedIncentiveHold;
						}
			
			}		
			
		public function getReferralBonus () {
			$referalBonus = 0;
			$this->db->runQuery("SELECT referral_bonus FROM setup ORDER BY id DESC LIMIT 1");
			if ($this->db->numRows() > 0) {
				$fetch = $this->db->getData();
				$referalBonus = $fetch["referral_bonus"];
				}
				return $referalBonus;
			}	
		
		public function processSignUp($signUpEmail, $signUpPassword, $signUpRetypePassword, $signUpReferral) {
			 
			
			if ($signUpEmail === "") {	
			return  '<div class="alert alert-danger"> Please enter your email </div>';
				 }
				else if (!filter_var($signUpEmail, FILTER_VALIDATE_EMAIL)) {
				return '<div class="alert alert-danger fade in"> This Email is not valid </div>';
				}
				else if ($signUpPassword === "") {	
				return '<div class="alert alert-danger"> Please enter your password </div>';
				 } 
				 else if ($signUpRetypePassword === "") {
				 return  '<div class="alert alert-danger"> Please re-type your password </div>';
					 }
					 else if ($signUpPassword !== $signUpRetypePassword) {
				 return  '<div class="alert alert-danger"> Passwords do not match </div>'; 
						 }
					 		
				//check to ensure it is not a duplicate email address
				$this->db->runQuery("SELECT id FROM users WHERE email = '$signUpEmail'");			 
				if ($this->db->numRows() > 0){
				return '<div class="alert alert-danger"> This email is already in use </div>';
					}
					
				 		
					// check to ensure referral exists
					if ($signUpReferral !== "") {
						 
						$this->db->runQuery("SELECT id FROM users WHERE username = '$signUpReferral'");
						if ($this->db->numRows() < 1) {
					return '<div class="alert alert-danger">Your referral username is incorrect. No such username exists on the system</div>';
						} // if it doesnt exits
						 
						
						
					}
					
				 
				$signUpPassword = md5($signUpPassword);
				
				//genrate link
				$confirmationLink = $this->generateLink(time(), 52);
				
				//encryptEmail
				$encryptedEmail = $this->encryptDecrypt("encrypt", $signUpEmail);
					
				// else now insert
				$query = $this->db->runQuery("INSERT INTO users(email, password, referral) VALUES('$signUpEmail', '$signUpPassword',  '$signUpReferral')");	
				
				if (!$query) {
				return '<div class="alert alert-danger">This sign up process was not successful. Please try again</div>'; 
					}
				
			  return true;					 
			}
			
		public function timelineUpdate ($uid, $info, $type) {
			/// clean this information
			$info = $this->db->cleanData($info);
			$uid = $this->db->cleanData($uid);
			
			if ($uid !== "" && $info !== "") {
				$this->db->runQuery("INSERT INTO timeline (uid, info, type,  date) VALUES ('$uid', '$info', '$type', now())");
				}
			
			}	
			
		
 
}