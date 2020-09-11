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
			
		if (!isset($_GET["emid"]) && !isset($_GET["resend"])) {
			header("location: ".URL);
			exit();
			}

$output = '';
		
	$title = 'Mason Capital Investment :::  Welcome on Board';
	$output = '<h3 class="msg-title"> <span class="hdr-mk-red hdr-mk-bd">  Not </span> <span class="hdr-mk-wht">Found</span> </h3>
			<div class="msg-return-board"> 
			<p> This is an invalid URL or the page must have been moved <br/> <br/> </p>
			<div align="center"> <a href="'.URL.'"><button class="login-pg-resend-btn"> Return Home </button></a> </div>
			</div>
			';
?>
<?php 
		
		if (isset($_GET["emid"])) {
			
		$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
		
		// check if email exists
		$db->runQuery("SELECT id FROM tempusers WHERE email = '$email'");
	
		if ($db->numRows() > 0) {
			
			if (isset($_GET["type"]) && $_GET["type"] == "resend") {
				$xJ = '<p> A mail with a confirmation link has just been <b style="color:#b0191e; ">RESENT</b> to the email address you signed up with. </p>';
				}
				else {
					$xJ = '<p> A mail with a confirmation link has just been sent to the email address you signed up with. </p>';
					}
				
			$output = '<h3 class="msg-title"> <span class="hdr-mk-red hdr-mk-bd">  Thank </span> <span class="hdr-mk-wht">you!</span> </h3>
			<div class="msg-return-board"> 
			'.$xJ.'
			<p> Please click on the link and let\'s get started.  </p>
			
			<p class="sub-note"> Didn\'t get the mail? <br/> Try checking your spam/junk folder or click the resend button </p>
			<div align="left"> <a href="'.URL.'welcome?resend='.$_GET["emid"].'"><button class="login-pg-resend-btn"> Resend </button></a> </div>
			</div>
			';	
			}
		}
		
?>
<?php 
		
		// if resend button is clicked
		if (isset($_GET["resend"])) {
			 
		$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["resend"]));
			
		// check db to confirm
		$query = $db->runQuery("SELECT id, email FROM tempusers WHERE email = '$email' ORDER BY id DESC LIMIT 1");	
		
			// if not found
			if ($query === false || $db->numRows() < 1) {
				// header out
				header("location: ".URL."welcome?emid=".$_GET["resend"]);
				exit();
			}
			
		/// if found
		$fetch = $db->getData();	
		$id = $fetch["id"];
		$email = $fetch["email"];
			
		///get confirmationLink
		$confirmationLink = $process->generateLink(time(), 52);
		
		///encrypt email address
		$encryptedEmail = $process->encryptDecrypt("encrypt", $email);
		 
		// if found,
		//send user a welcome mail
			$to = $email;
			$from  = noReplyMail;
			$subject = 'Welcome to Earners Fund';
			$message = ' <p style="margin:10px auto"> Welcome on board </p>
			
			<p style="margin:10px auto"> To confirm this account is yours and fully functional, kindly click on the button below to confirm your email address </p>
			
		 <tr>  
		 <td height="20">&nbsp;</td> </tr>
           <tr>
            <td align="center" class="readmore-button"><a href="'.URL.'confirm?emid='.$encryptedEmail.'&token='.$confirmationLink.'" style="font:bold 12px/29px Arial, Helvetica, sans-serif; color:#ffffff; text-decoration:none; background:#16c4a9; float:left; padding:15px 19px; border-radius:7px;">Confirm Email</a></td>
            </tr>
		
		<p> If for any reason the button above is not clickable, please copy and paste the link below into your browser\'s address bar. 
		
		'.URL.'confirm?emid='.$encryptedEmail.'&token='.$confirmationLink.'
		
		</p>
		';
		
		$title = 'Confirm your email address';
		$return = 'Successful';
		
		 $process->emailMessenger($to, $from, $subject, $message, $return, $title);
		
		// update link value in the database
		$db->runQuery("UPDATE tempusers SET confirmationLink = '$confirmationLink' WHERE email = '$email' AND id = '$id' ");
		
		header("location: ".URL."welcome?emid=".$encryptedEmail."&type=resend");
		exit();	
			
			 
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
		
			<?php echo $html->loginTakeNote("welcome"); ?>
		</div>
		<div class="clear"></div>
    </div>
        <!-- END LOGIN -->
 	<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> 
        </p>
	</div>
   
<body>
</html>