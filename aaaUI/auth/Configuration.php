<?php 

class Configuration {
	
 	private $servername;
 	private $dbusername;
 	private $dbpassword;
 	private $dbname;

 	// private $conn = new Configuration;

 	public function __construct(){
 		

 		// echo 'Server name: '. $this -> hostname="No value ".'<br>';
 		// echo 'Server username: '. $this -> hostusername="No value".'<br>';
 		// echo 'Server password: '. $this -> hostpassword="No value".'<br>';
 		// echo 'Database name: '. $this -> dbname = "No value".'<br>';
 	}
 	public function __destruct() {}

 	// Setter and getter
 	public function setHostName($hostname) {
 		if(!is_string($hostname)) {
       		throw new Exception('$hostname must be a string!');
   		}
 		$this -> hostname = $hostname;
 	}

 	public function getHostName() {
 		return $this -> hostname;
 	}

 	public function setHostUserName($hostusername){
 		$this -> hostusername = $hostusername;
 	}

 	public function getHostUserName() {
 		return $this -> hostusername;
 	}

 	public function setHostPassword($hostpassword) {
 		$this -> hostpassword = $hostpassword;
 	}

 	public function getHostPassword() {
 		return $this -> hostpassword;
 	}

 	public function setDatabaseName($dbname) {
 		$this -> dbname =$dbname;
 	}

 	public function getDatabaseName() {
 		return $this -> dbname;
 	}

}

?>