<?php
include_once("../class/db.php");
include_once("../class/html.php");
include_once("../class/process.php");
include_once("../class/session.php");

$db = new db();
$db2 = new db();
$html = new html($db);
$process = new process($db);
$session = new session($db);

$limit = 0;		 
?>
<?php 
		
		/* CRON TASK
		** AUTOMATED CRON SCHEDULER 
		*/
		
		//Get Preset Limit
		$db->runQuery("SELECT list_limit FROM setup");
		if ($db->numRows() > 0) {
			$fetch = $db->getData();
			$limit = $fetch["list_limit"];
			}
			
		/// Pick all Off for timed
		$db->runQuery("SELECT id FROM incoming WHERE type = 'Instant' AND status = 'Off' ORDER BY activityID ASC LIMIT $limit");
		if ($db->numRows() > 0) {
			while ($row = $db->getData()) {
			//get the id
			$rowID = $row["id"];
			
			// return and turn on
			$db2->runQuery("UPDATE incoming SET status = 'On' WHERE id = '$rowID' AND type = 'Timed'");	
				}
			}	 
		
?>
<?php
	/// Pick all Off for Express
		$db->runQuery("SELECT id FROM incoming WHERE type = 'Listed' AND status = 'Off' ORDER BY activityID ASC LIMIT $limit");
		if ($db->numRows() > 0) {
			 
			while ($row = $db->getData()) {
			//get the id
			$rowID = $row["id"];
			
			// return and turn on
			$db2->runQuery("UPDATE incoming SET status = 'On' WHERE id = '$rowID' AND type = 'Express'");	
				}
			}	 
?>

               