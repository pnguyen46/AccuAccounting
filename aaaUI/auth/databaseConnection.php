<?php 
	include "Configuration.php";

  	$object = new Configuration;

  	$object -> setHostName('localhost');
  	$object -> setHostUserName('root');
  	$object -> setHostPassword('');
  	$object -> setDatabaseName('aaadb');

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