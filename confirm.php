<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/process.php");
include_once("class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

			if ($session->sessionCheck("userSessionID")) {
			header("location: ".URL."dashboard");
			exit();
			}
			
		if (!isset($_GET["emid"])) {
			header("location: ".URL);
			exit();
			}

$output = '';
		
	$title = 'Mason Capital Investment ::: Confirm Email Address';
	$output = '<h3  class="msg-title"> <span class="hdr-mk-red hdr-mk-bd">  Not </span> <span class="hdr-mk-wht">Found</span> </h3>
			<div class="msg-return-board"> 
			<p> This is an invalid URL or the page must have been moved <br/> <br/> </p>
			<div align="center"> <a href="'.URL.'"><button  class="login-pg-resend-btn"> Return Home </button></a> </div>
			</div>
			';
?>
<?php 
		
		 
	 if (isset($_GET["emid"]) && isset($_GET["token"])) {
		 
		$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
			
		$token = $db->cleanData($_GET["token"]);
		
		$query = $db->runQuery("SELECT id FROM tempusers WHERE email = '$email' AND confirmation_link = '$token'" );
		
		 if (!$query || $db->numRows() > 0) {
		$output = '<h3 class="msg-title"> <span class="hdr-mk-red hdr-mk-bd">  Successfully  </span> <span class="hdr-mk-wht">Verified!</span> </h3>
					<div class="msg-return-board"> 
					<p> Thank you! This  email verification process was successful </p>
                          
                       <p> Please click the button below to round up this process and login to your account <br/><br/>
              <a href="'.URL.'confirm?emid='.$_GET["emid"].'&token='.$token.'&react=move"> 
			  <button  class="login-pg-resend-btn"> Complete Process </button> </a>
               </p> 
			   </div>';
			 }
	  
	  
	 }
?>
<?php 
		
			if (isset($_GET["emid"]) && isset($_GET["token"]) && isset($_GET["react"])) {
		 	
		$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
		$token = $db->cleanData($_GET["token"]);
		
		$query = $db->runQuery("SELECT email, password, referral FROM tempusers WHERE email = '$email' AND confirmation_link = '$token'");
		
		if ($db->numRows() > 0) {
			
		$fetch = $db->getData();
		
		$email = $fetch["email"];
		$password = $fetch["password"];	
		$referral = $fetch["referral"];
		
		// insert
		$query = $db->runQuery("INSERT INTO users (email, password, referral, joined) VALUES ('$email', '$password', '$referral', now())");	
		
		$lastInsertedID = $db->lastInsertedID();		
		
		if ($query) {
		/// delete frrom tempuser
		$db->runQuery("DELETE FROM tempusers WHERE email = '$email' ");
		
		// if referal is not empty
		if ($referral !== "") {
		$db->runQuery("SELECT id, username FROM users WHERE username = '$referral' ");
		if ($db->numRows() > 0) {
			$grab = $db->getData();
			$referralID = $grab["id"];
			$referralUsername = $grab["username"];
			
			$referralBonus = $process->getReferralBonus();
			
			$db->runQuery("INSERT INTO hold (uid, username, type, amount, info, referred_uid, referred_status, user_status, date)
			VALUES('$referralID', '$referralUsername', 'Referral Bonus', '$referralBonus', 'Bonus gained for refering a new Trader to the platform', 
			'$lastInsertedID', 'pending', 'pending', now())");
			}
		}
		
		// Send Email
		$to = $email;
		$from  = noReplyMail;
		$subject = 'Succesful Email Verification';
		$message = ' <p> Thank you! Your  email address has been successfully verified.  </p>
		
		<p>We sincerely believe and hope that you will be an active participant on this platform. Your willingness to commit and be dedicated to the system is one of the keys needed to sustain the platform </p>
		
		<p> Please click on the button below to login to your dashboard </p>
		
		 <tr>  
		 <td height="20">&nbsp;</td> </tr>
           <tr>
            <td align="center" class="readmore-button"><a href="'.URL.'login" style="font:bold 12px/29px Arial, Helvetica, sans-serif; color:#ffffff; text-decoration:none; background:#16c4a9; float:left; padding:0 19px; border-radius:24px; text-transform:uppercase;">Login</a></td>
            </tr>';
		
		$title = 'Email Verified';
		$return = 'Successful';
		
		 $process->emailMessenger($to, $from, $subject, $message, $return, $title);
			
			}
		 
			header("location: ".URL."login");
			exit();
			}
			
			}
		
?>
<?php
echo $html->loginHead('', $title, '', '');
?>
 
      <h1> </h1>
 <div class="w3layouts">
 <div class="signin-agile">
 <a href="<?php echo URL ?>"> <img src="<?php echo URL."images/logo.jpg" ?>" class="site-logo"/> </a>
            <?php echo $output; ?>
              </div>
              
              <div class="signup-agileinfo">
		
			<?php echo $html->loginTakeNote("confirm"); ?>
		</div>
		<div class="clear"></div>
              
        </div>
        
<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> 
        </p>
	</div>
   
<body>
</html>