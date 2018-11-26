<?php

 $link = mysqli_connect("den1.mysql5.gear.host", "aaadb", "Aj2Y24W~?FU2", "aaadb");
if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}


    $query = "SELECT * FROM `coa` WHERE AcctName = " . "'" .$_POST['account'] . "'";
	$result = mysqli_query($link,$query);
	if (!$result) {
	    die('Invalid query: ' . $_POST['account']);
	}
	while($row = mysqli_fetch_array($result))
	{
		
	echo"<tr>";
    echo "<td style='font-weight: bold;'>Total Balance: </td>";
    echo "<td style='font-weight: bold;'>$" . number_format($row['Balance'],2) . "</td>";
    echo"</tr>";

			
        }
	    

		
		
	
	    






?>