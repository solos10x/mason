<?php
session_start();
include_once("../class/db.php");
include_once("../class/session.php");

$db = new db();
$session = new session($db);

	 $session->sessionDestroy("userSessionID");
	 
	 header("location: ".URL);
	 exit();
	 
?>