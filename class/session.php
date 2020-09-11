<?php
include_once("db.php");
include_once("process.php");
class session {
	
	private $db;
	private $session;
	
	 public function __construct($db){	 
	    $this->db = $db;
		$this->process = new process($db);
		}
	 	
	
	  public function setSession($name, $value){
			
			if (!isset($_SESSION[$name])){	
			$_SESSION[$name] = $this->process->encryptDecrypt("encrypt", $value);
			return true;
			}
			
		}	
			
			
		public function sessionCheck($name){
			
			if (isset($_SESSION[$name])){
				return true;
				}
				else {
					return false;
					}
			}	
			
		public function getSession($name){
			
			$output = '';
			if (isset($_SESSION[$name])) {
				$encryptedSession = $_SESSION[$name];
				$decryptedSession = $this->process->encryptDecrypt("decrypt", $encryptedSession);
				$output = $decryptedSession;
				}
			return $output;	
			
			}	
			 
	
	 public function sessionDestroy($name) {
		 
		 if ($this->sessionCheck($name)){
			 unset($_SESSION[$name]);
			 return true;
			 }
			 
		 }
		 
		 
				
	
	
	}




?>