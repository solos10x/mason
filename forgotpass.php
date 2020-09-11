<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/process.php");
include_once("class/session.php");
 

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$secret = '6LdP2xYUAAAAAC4mm8r9fLZPsBgh2Pp0Jdc5TJEz';
 
$signUpErr = '';
$loginErr = '';
$forgotPassError = '';
$addScript = '';

$signUpEmail = '';
$signUpReferral = '';
$signUpPassword = '';

$email = '';
		
	$title = 'Mason Capital Investment ::: Forgot Password';
		
		if ($session->sessionCheck("userSessionID")) {
			header("location: ".URL."dashboard");
			exit();
			}
?>
<?php
		// Forgot password 
		if (isset($_POST["forgot"])) {
			
			$email = $db->cleanData($_POST["email"]);
			 
			 
			if ($email === "") {
				$forgotPassError = '<div class="alert alert-error"> Please enter the email address you signed up with</div>';
				}
				else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$forgotPassError =  '<div class="alert alert-danger"> This Email is not valid </div>';
				}
			 
				else {
					
				// check for match
				$db->runQuery("SELECT id FROM users WHERE email = '$email'");
				
				if ($db->numRows() < 1) {	
				$forgotPassError =  '<div class="alert alert-danger"> There is no record of this email address on the system </div>';
					} // if not found
					else {
					
				$fetch = $db->getData();
				$id = $fetch["id"];
				
				//encryptEmail
				$encryptedEmail = $process->encryptDecrypt("encrypt", $email);
				
				//generate token link
				$confirmationLink = $process->generateLink(time(), 52); 
				
				/// send mail 		
				$to = $email;
				$from  = noReplyMail;
				$subject = 'Mason Capital Investment | Password Reset Request';
				$message = ' <p> We understand you forgot your password and therefore can not login. Not to worry, we have you covered.  </p>
				
				<p> Please click on the button below to reset your password. Ensure you use a combination that is easy for you to remember this time, but hard for others to guess. </p>
				
				 <tr>  
				 <td height="20">&nbsp;</td> </tr>
				  <tr>
				<td align="center" class="readmore-button"><a href="'.URL.'resetpass?emid='.$encryptedEmail.'&token='.$confirmationLink.'" style="font:bold 12px/29px Arial, Helvetica, sans-serif; color:#ffffff; text-decoration:none; background:#16c4a9; float:left; padding:0 19px; border-radius:24px; text-transform:uppercase;">Reset Password</a></td>
				</tr>
				
				<p> If for any reason the button above is not clickable, please copy and paste the link below into your browser\'s address bar. 
				
				'.URL.'resetpass?emid='.$encryptedEmail.'&token='.$confirmationLink.'
				
				</p>
				
				<p style="color:#900"> Please kindly ignore this message if you didn\'t request for a password change </p>';
				
				$title = 'Reset your password';
				$return = 'Successful';
		
		 $process->emailMessenger($to, $from, $subject, $message, $return, $title);	
		
		// store the new link in the members section
		$query = $db->runQuery("UPDATE users SET reset_link = '$confirmationLink' WHERE id = '$id' AND email = '$email' ");	
			
			if (!$query) {
				$forgotPassError = '<div class="alert alert-danger fade in"> 
			An  error occured. Please try again
		</div>';	
				}
			else {
			 
				
			header("location: ".URL."forgotpass?redir=forgot_pass&emid=".$encryptedEmail."&type=sent");
			exit();

				}	
						
						} // esle if found
					} // else if no error with input
					
			
			}
?>
<?php
		
		// forgot pass loink has been sent!
		if (isset($_GET["redir"]) && $_GET["redir"] == "forgot_pass" && isset($_GET["emid"]) && isset($_GET["type"]) && $_GET["type"] == "sent") {
				 
			
		$emailSent = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
		
		//confirmreset link exists
		$db->runQuery("SELECT reset_link FROM users WHERE email = '$emailSent'");
		
		if ($db->numRows() < 1) {
			header("location: ".URL);
			exit();
			}
			
		$fetch = $db->getData();
		$resetLink = $fetch["reset_link"];

		// confirm not empty
		if ($resetLink === "") {
			$forgotPassError = '<div class="alert alert-error"> No reset request exists for this email address </div>';
			}
			else {
			$forgotPassError = '<div class="alert alert-success alert-green"> A mail with a reset link has just been sent to your email address. Please follow the instructions in the mail to reset your password </div>';	
				}
					
			}
		
?>
<?php
echo $html->loginHead('<script src="https://www.google.com/recaptcha/api.js"></script>', $title, 'Mason Capital Investment', '');
?>
<h1>  </h1>
	<div class="w3layouts">
		<div class="signin-agile">
        <a href="<?php echo URL ?>"> <img src="<?php echo URL."images/logo.jpg" ?>" class="site-logo"/> </a>
         <?php echo $forgotPassError; ?>
			<h2>Forgot Password</h2>
            
			<form action="" method="post">
				<input type="text" name="email" class="email" placeholder="Email" required="" value="<?php echo $email ?>">
                               
				<div class="clear"></div>
				<input type="submit" value="Login" name="forgot">
			</form>
		</div>
		<div class="signup-agileinfo">
			<?php echo $html->loginTakeNote("forgotpass"); ?>
		</div>
		<div class="clear"></div>
	</div>
    
	<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> </p>
	</div>
   
<body>
</html>
 