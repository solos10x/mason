<?php 
include_once("class/db.php");
include_once("class/html.php");

$db = new db();
$html = new html($db);

$title = 'Mason Capital Investment ::: 404';
?>
<?php
echo $html->loginHead('', $title, '', '');
?>
<h1> </h1>
	<div class="w3layouts">
        <div class="agileinfo">
            <h1 style="font-size: 250px; color:#f90;"> 404 </h1>
			<h1><a href="index.php" class="login-pg-resend-btn">Home</a></h1>
			
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