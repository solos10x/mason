<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/process.php");
include_once("class/session.php");

$db = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$err = '';
$output = '<form class="login-form" action="" method="post">
                <h3 class="msg-title">Reset Password</h3>  <br/> 
				
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" /> </div>
                </div>
				
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="rpassword" /> 
                        </div>
                </div>
                
                <div class="form-actions">
                <input type="submit"  name="reset" value="Reset">
                </div>
             <br/>
            </form>';

$email = '';
		
	$title = 'Earners Fund ::: Reset Password';

	if ($session->sessionCheck("userSessionID")) {
			header("location: ".URL."dashboard");
			exit();
			}
			
		if (!isset($_GET["emid"])) {
			header("location: ".URL);
			exit();
			}	

?>
<?php 
			//check if user reset requests exists
			if (isset($_GET["emid"]) && isset($_GET["token"])) {
				$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
				$token = $db->cleanData($_GET["token"]);
				
			//check
			$db->runQuery("SELECT id FROM users WHERE email = '$email' AND reset_link = '$token'");
			
			if ($db->numRows() < 1) {
			$output = '<h3 class="msg-title"> <span class="hdr-mk-red hdr-mk-bd">  Not </span> <span class="hdr-mk-wht">Found</span> </h3>
			<div class="msg-return-board"> 
			<p> This is an invalid URL or the page must have been moved <br/> <br/> </p>
			<div align="center"> <a href="'.URL.'"><button  class="login-pg-resend-btn"> Return Home </button></a> </div>
			</div>';
				}
					
				}
?>
<?php 
			
			// reset pass
			if (isset($_POST["reset"])) {
				
			$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
			$token = $db->cleanData($_GET["token"]);	
			
			$password = $db->cleanData($_POST["password"]);
			$retypePassword = $db->cleanData($_POST["password"]);
			
			if ($password == "") {
				$err = '<div class="alert alert-danger"> Please enter a new password for your account</div>';
				}
				else if ($retypePassword == "") {
					$err = '<div class="alert alert-danger">Please re-enter your password</div>';
					}
					else if ($password !== $retypePassword) {
						$err = '<div class="alert alert-danger"> Passwords do not match</div>';
						}
						else {
				
				$password = md5($password);	
				 
				//update			
			$query = $db->runQuery("UPDATE users SET password = '$password', reset_link = '' WHERE email = '$email' AND reset_link = '$token'");			
				
			if (!$query) {
				$err = '<div class="alert alert-danger">An error occured. Please try again </div>';
				}
				else {
					header("location: ".URL."resetpass?emid=".$_GET["emid"]."&action=completed");
					exit();
					} // esle if updated
				
				} // else no user input error
				
				}
	
?>
<?php 
			
			if (isset($_GET["emid"]) && isset($_GET["action"]) && $_GET["action"] == "completed") {
				$email = $db->cleanData($process->encryptDecrypt("decrypt", $_GET["emid"]));
				
				//check
				$db->runQuery("SELECT id FROM users WHERE email = '$email'");
				if ($db->numRows() < 1) {
					header("location: ".URL);
					exit();
					}
				
				$output = ' 
               <br/> <h3 class="msg-title"><b> CONGRATULATIONS! </b></h3>  <br/>
              
                 <p> Your password reset process was successful.<br/> <br/> Please click on the button below to login to your dashboard </p> <br/>
                
                <div class="form-actions" align="center">
               <a href="'.URL.'login"> <button type="button"  class="login-pg-resend-btn"> Login Now</button> </a>
                </div>
             <br/>
             ';	
					
				}
		
?>
<?php
echo $html->loginHead('', $title, '', '');
?>
<h1>  </h1>
	<div class="w3layouts">
 <div class="signin-agile">
 <a href="<?php echo URL ?>"> <img src="<?php echo URL."images/logo.jpg" ?>" class="site-logo"/> </a>
				
               <?php echo $err; ?> 
            <!-- BEGIN LOGIN FORM -->
            <?php echo $output; ?>
            <!-- END LOGIN FORM -->
        </div>
        
        <div class="signup-agileinfo">
			<?php echo $html->loginTakeNote("forgotpass"); ?>
		</div>
		<div class="clear"></div>
        </div>
        
        
 	<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> 
        </p>
	</div>
   
<body>
</html>