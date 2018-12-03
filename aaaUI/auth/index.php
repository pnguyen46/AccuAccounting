<?php

//include "Configuration.php";
require_once('user.php');
//require_once('errorMessage.php');

	$user = new user;
	//$error;
		try 
		{
			if(isset($_POST['login']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				$user -> login($username,$password);
				$user -> redirect($username,$password);
					
			
				
				if(!$user -> login($username,$password))
				{
					$message = "Username or Password is incorrect";
					//header('Location: login.php?err=1');
				}
			}
			
		}

		catch(Exception $ex) 
		{
		  $_SESSION["errorType"] = "danger";
		  $_SESSION["errorMsg"] = $ex -> getMessage();
		}
?>