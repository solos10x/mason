<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$db2 = new db();
$db3 = new db();

$html = new html($db);
$process = new process($db);
$session = new session($db);

$limit = 0;	
	 
$record = '';
?>
<?php 
 $scheduledUser = array();
		$db->runQuery("SELECT DISTINCT username FROM incoming WHERE amount != '' AND username != 'Cedar'");
		if ($db->numRows() > 0) {
		while ($row = $db->getData()) {
		$receivingUser = $row["username"];
		
		$db2->runQuery("SELECT id FROM outgoing WHERE donor_username = '$receivingUser'");
		if ($db2->numRows() < 1) {
		 $scheduledUser[] = $receivingUser;
			}
			}
			
			foreach ($scheduledUser as $x) {
			$db3->runQuery("SELECT amount FROM incoming WHERE username = '$x'");
			$total = 0;
			while ($grab = $db3->getData()) {
				$total = $total + $grab["amount"];
				$record .= 'Username: '.ucfirst($x)." ==> ".$total * 500;
				}	
				}		
				
				echo $record;
				exit();
			}
?>

               