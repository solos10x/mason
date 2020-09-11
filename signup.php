<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/process.php");
include_once("class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$title = 'Mason Capital Investment | Sign Up';
$err = '';
$email = '';
$password = '';
$referral = '';
$retypePassword = '';
			
			if ($session->sessionCheck("userSessionID")) {
			header("location: dashboard.php");
			exit();
			}
			
?>
<?php 
		/// signup
	if (isset($_POST["signup"])){
	$email = $db->cleanData($_POST["email"]);
	$password = $db->cleanData($_POST["password"]);
	$retypePassword = $db->cleanData($_POST["retype_password"]);
	$referral = $db->cleanData($_POST["referral"]);	
	
	if ($email === "" || empty($email)) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		Email field is empty
		</div>';
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		Email is not valid </div>';
		}
	else if ($password === "" || empty($password)) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>  Password field is empty </div>';
		}
	else if ($retypePassword === "" || empty($retypePassword)) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a> Please re-type your password </div>';
		}
	else if ($password !== $retypePassword) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>  Passwords do not match </div>';
		}
		
	else if ($referral === "" || empty($referral)) {
		$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		Referral field is empty
		</div>';
		}
	
		
		
	else {
				
				
		///get confirmationLink
		$confirmationLink = $process->generateLink($email, 52);
		
		///encrypt email address
		$encryptedEmail = $process->encryptDecrypt("encrypt", $email);
		
		// check members for match
		$query = $db->runQuery("SELECT id FROM users WHERE email = '$email'");
		
		if ($db->numRows() > 0) {
			$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>  This email address is already in use </div>';
			}
			
			
			
			// check to ensure referral exists
			
				$query = $db->runQuery("SELECT id FROM users WHERE uid = '$referral'");
				if ($db->numRows() < 1) {
		        	$err = '<div class="alert alert-danger">Your referral ID is incorrect. No such username exists on the system</div>';
				} // if it doesnt exits
			
		
			
			
		else {	
		// check tempusers for match
		$query = $db->runQuery("SELECT id FROM tempusers WHERE email = '$email'");
		
		if ($db->numRows() > 0) {
			$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>  This email has already signed up awaiting confirmaion. 
		Click <a href="welcome.php?resend='.$encryptedEmail.'"><b style="color:#060"> HERE </b> to resend confirmation link</div>';
			}
				
			
		else {
		
		
		
		$password = md5($password);
		
		/// insert into temporary table
		$query = $db->runQuery("INSERT INTO tempusers (email, password, confirmationLink, referral) VALUES ('$email', '$password', '$confirmationLink', '$referral')");
		
		if (!$query) {
			$err = '<div class="alert alert-danger fade in"> 
		<a href="#" class="close" data-dismiss="alert">&times;</a>  An error occured. Please try again </div>';
		}
		else {	
		
		/// generate Email and send to user
		$to = $email;
		$from  = "noreply@globalbusinessbuilders.org.ng";
		$subject = 'Welcome to Global Business Builder';
		$message = ' <p> It is nice to have you join this great and wonderful family. Please click on the button below to confirm your email address </p>
		 <tr>  
		 <td height="20">&nbsp;</td> </tr>
           <tr>
            <td align="center" class="readmore-button"><a href="http://globalbusinessbuilders.org.ng/confirm.php?emid='.$encryptedEmail.'&token='.$confirmationLink.'" style="font:bold 12px/29px Arial, Helvetica, sans-serif; color:#ffffff; text-decoration:none; background:#16c4a9; float:left; padding:0 19px; border-radius:24px; text-transform:uppercase;">Confirm Email</a></td>
            </tr>
		
		<p> If for any reason the button above is not clickable, please copy and paste the link below into your browser\'s address bar. 
		
		http://globalbusinessbuilders.org.ng/confirm.php?emid='.$encryptedEmail.'&token='.$confirmationLink.'
		
		</p>
		';
		
		$title = 'Confirm your email address';
		$return = 'Successful';
		
		$mail = $process->emailMessenger($to, $from, $subject, $message, $return, $title);
		
		header("location: welcome.php?emid=".$encryptedEmail);
		exit();
		}
		}
		}
		}			
		
			
	
		
		}	
?>
<?php
echo $html->loginHead('', $title, '', '');
?>
	<h1>  </h1>
	<div class="w3layouts">
		<div class="signin-agile">
        <?php echo $err; ?>
       <a href="<?php echo URL ?>"><img src="<?php echo URL."images/logo.jpg" ?>" class="site-logo"/></a>
			<h2>Sign Up Now</h2>
            
			<form action="" method="post">
				<input type="text" name="email" class="email" placeholder="Email" required="" value="<?php echo $email; ?>">
				<input type="password" placeholder="Enter password" name="password" required="" value="<?php echo $password ?>">
                <input type="password" placeholder="Re-type password" name="retype_password" required="" value="<?php  echo $retypePassword;?>">
                <input type="text" name="referral" class="email" placeholder="Referral"  value="<?php echo $referral; ?>">
              
				<div class="clear"></div>
				<input type="submit" value="Sign Up" name="signup">
			</form>
             <div class="clear"> <br/> <br/><a href="<?php echo URL ?>login" style="color:#444">Already a member? <b style="font-weight:700; color:#060"> Login </b> </a><br> </div>
		</div>
		<div class="signup-agileinfo">
			<h3>Sign Up</h3>
			<p>Kindly Note that this a comuunity of honest, dedicated and willing members.</p>
		</div>
		<div class="clear"></div>
	</div>
    
	<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> 
        </p>
	</div>
   
<body>
</html>