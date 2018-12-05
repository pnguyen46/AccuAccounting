<?php

session_start();

	if(session_destroy())
	{
		echo"<div class ='alert alert-danger' style =color: blue; '>Registration successful, you may now login!</div>";
		header('Refresh: 2; URL = login.php');
	}
?>
