<?php
	include "Configuration.php";

  	$object = new Configuration;

  	$object -> setHostName('den1.mysql2.gear.host');
  	$object -> setHostUserName('accuaccountingdb');
  	$object -> setHostPassword('letmein559!');
  	$object -> setDatabaseName('accuaccountingdb');

  	$serverName = $object -> getHostName();
  	$userName = $object->getHostUserName();
  	$serverPassword = $object -> getHostPassword();
  	$dbName =$object -> getDatabaseName();
  	$conn = mysqli_connect($serverName, $userName, $serverPassword, $dbName);
  	$session = session_start();
  	//echo'OK';

	if (mysqli_connect_errno()) {
	      echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>
