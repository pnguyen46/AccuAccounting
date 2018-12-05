<?php

session_start();

	if(session_destroy())
	{
		echo"<div class ='alert alert-danger' style =color: blue; '> You have successfully logged out! </div>";
		header('Refresh: 2; URL = login.php');
	}
