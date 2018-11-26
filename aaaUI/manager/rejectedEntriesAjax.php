<?php

 $link = mysqli_connect("localhost", "root", "", "aaadb");
if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}





     


    $query = "SELECT * FROM `journal` WHERE journalEntryID = " . "'" .$_POST['journalEntryID'] . "'";
	$result = mysqli_query($link,$query);
	//echo"$row['journalEntryID']";
	if (!$result) {
	    die('Invalid query: ' . $_POST['journalEntryID']);
	}
	while($row = mysqli_fetch_array($result))
	{

		        
				
			    echo  $row['comments'];
			    

		
		        


        }
	    

		

	
	    






?>