<?php

 $link = mysqli_connect("den1.mysql2.gear.host", "accuaccountingdb", "letmein559!", "accuaccountingdb");
if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}



  	$query = "SELECT * FROM `coa` WHERE AcctSubCategory = " ."'" .$_POST['subcategory'] . "'";
	$result = mysqli_query($link,$query);
	if (!$result) {
	    die('Invalid query: ' . $_POST['subcategory']);
	}
	    echo "<option> Choose a ledger: </option>";
	while($row2 = mysqli_fetch_array($result))
	    echo "<option>" .$row2['AcctName'] ."</option>";

//. "  ".$row2['AcctNumber']




?>
