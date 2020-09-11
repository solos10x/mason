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
$password = '';
		
	$title = 'Earners Fund ::: Login';
/*<script src="https://www.google.com/recaptcha/api.js"></script>
*/
?>
<?php 
		
		// Login user
		if (isset($_POST["login"])) {
			
			$email = $db->cleanData($_POST["email"]);
			$password = $db->cleanData($_POST["password"]);
			
			//$googleReCaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			//$recaptchaResponse = json_decode($googleReCaptcha);
			
			
			if ($email === "") {
				$loginErr = '<div class="alert alert-danger"> Pleae enter your email address</div>';
				}
				else if ($password === "") {
					$loginErr = '<div class="alert alert-danger"> Please enter your password </div>';
					}
					//else if (!$recaptchaResponse->success) {
				//$loginErr = '<div class="alert alert-danger">Please verify you are not a robot </div>';
			//	}
					else {
						
				$password = md5($password);	
					
					//confirm
			$db->runQuery("SELECT id FROM users WHERE email = '$email' AND password = '$password'");
			if ($db->numRows() < 1) {
				$loginErr = '<div class="alert alert-danger"> Email/Password is incorrect</div>';
				}
				else {
					$fetch = $db->getData();
					$id = $fetch["id"];
					
				//set session
				$session->setSession("userSessionID", $id);
				header("location: ".URL."dashboard");
				exit();	
					}
						
						}
			
			}

?>
<?php 
		if (isset($_SESSION["welcome"])) {
			$loginErr = $_SESSION["welcome"];
			unset($_SESSION["welcome"]);
			}
?>
<?php
echo $html->loginHead('', $title, '', '');
?>
	<h1>  </h1>
	<div class="w3layouts">
		<div class="signin-agile">
        <a href="<?php echo URL ?>"> <img src="<?php echo URL."images/logo.jpg" ?>" class="site-logo"/> </a>
         <?php echo $loginErr; ?>
			<h2>Login</h2>
            
			<form action="" method="post">
				<input type="text" name="email" class="email" placeholder="Email" required="" value="<?php echo $email ?>">
				<input type="password" name="password" class="password" placeholder="Password" required="">
                
               
				<a href="<?php echo URL ?>forgotpass">Forgot Password?</a><br>
				<div class="clear"></div>
				<input type="submit" value="Login" name="login">
			</form>
            <div class="clear"> <br/> <br/><a href="<?php echo URL ?>signup" style="color:#444">Not yet a member? <b style="font-weight:700; color:#060"> Sign Up </b> </a><br> </div>
		</div>
		<div class="signup-agileinfo">
			<?php echo $html->loginTakeNote("login"); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer-w3l">
		<p class="agileinfo"> &copy; <?php echo date("Y").' '.siteName   ?> 
        </p>
	</div>
   
<body>
</html>