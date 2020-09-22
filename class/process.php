<?php
include_once('db.php');
require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime package

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
					<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
					<head>
					<!--[if gte mso 12]>
					> <style type="text/css">
					> [a.btn {
						padding:15px 22px !important;
						display:inline-block !important;
					}]
					> </style>
					> <![endif]-->
					<title>kreative</title>
					<style type="text/css">
					div, p, a, li, td {
						-webkit-text-size-adjust:none;
					}
					.ReadMsgBody {
						width: 100%;
						background-color: #d1d1d1;
					}
					.ExternalClass {
						width: 100%;
						background-color: #d1d1d1;
						line-height:100%;
					}
					body {
						width: 100%;
						height: 100%;
						background-color: #d1d1d1;
						margin:0;
						padding:0;
						-webkit-font-smoothing: antialiased;
						-webkit-text-size-adjust:100%;
					}
					html {
						width: 100%;
					}
					img {
						-ms-interpolation-mode:bicubic;
					}
					table[class=full] {
						padding:0 !important;
						border:none !important;
					}
					table td img[class=imgresponsive] {
						width:100% !important;
						height:auto !important;
						display:block !important;
					}
					@media only screen and (max-width: 800px) {
					body {
					 width:auto!important;
					}
					table[class=full] {
					 width:100%!important;
					}
					table[class=devicewidth] {
					 width:100% !important;
					 padding-left:20px !important;
					 padding-right: 20px!important;
					}
					table td img.responsiveimg {
					 width:100% !important;
					 height:auto !important;
					 display:block !important;
					}
					}
					@media only screen and (max-width: 640px) {
					table[class=devicewidth] {
					 width:100% !important;
					}
					table[class=inner] {
					 width:100%!important;
					 text-align: center!important;
					 clear: both;
					}
					table td a[class=top-button] {
					 width:160px !important;
					  font-size:14px !important;
					 line-height:37px !important;
					}
					table td[class=readmore-button] {
					 text-align:center !important;
					}
					table td[class=readmore-button] a {
					 float:none !important;
					 display:inline-block !important;
					}
					.hide {
					 display:none !important;
					}
					table td[class=smallfont] {
					 border:none !important;
					 font-size:26px !important;
					}
					table td[class=sidespace] {
					 width:10px !important;
					}
					}
					 @media only screen and (max-width: 520px) {
					}
					@media only screen and (max-width: 480px) {
					
					 table {
					 border-collapse: collapse;
					}
					table td[class=template-img] img {
					 width:100% !important;
					 display:block !important;
					}
					}
					@media only screen and (max-width: 320px) {
					}
					</style>
					</head>
					
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
										  <td height="75" class="inner" valign="middle"><a href="http://projectlive.ng/"><img class="logo" src="http://projectlive.ng/images/logo-e.png" width="180" height="61" alt="Logo"></a></td>
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
												<td align="center"><a href="https://facebook.com/" style="margin-top:5px; display:inline-block;" target="_blank"><img src="http://projectlive.ng/images/facebook.png" width="32" height="atuo" alt="Social Media" /></a></td>
												<td align="center"><a href="https://twitter.com/" style="margin-top:5px; display:inline-block;" target="_blank"><img src="http://projectlive.ng/images/twitter.png" width="32" height="atuo" alt="Social Media" /></a></td>
												 
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
										  <td width="93.33%"><img class="imgresponsive" src="http://projectlive.ng/images/footer-bg-img.jpg" width="554" height="atuo" alt="Banner" /></td>
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
												<td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#000000;">&copy; 2014 <br/> Global Business Builders.org</td>
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
			  
			$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);
			
			$text = ''; // text versions of email.
			
			$crlf = "\n";
			
			$mime = new Mail_mime($crlf);
			$mime->setTXTBody($text);
			$mime->setHTMLBody($html);
			
			//do not ever try to call these lines in reverse order
			$body = $mime->get();
			$headers = $mime->headers($headers);
			
			 $host = "localhost"; // all scripts must use localhost
			 $username = "noreply@litchproject.io"; //  your email address (same as webmail username)
			 $password = "Global2010"; // your password (same as webmail password)
			
			$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,
			'username' => $username,'password' => $password));
			
			$mail = $smtp->send($to, $headers, $body);
			
			if (PEAR::isError($mail)) {
			return "<p>" . $mail->getMessage() . "</p>" ;
			}
			else {
			return  $return;
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
