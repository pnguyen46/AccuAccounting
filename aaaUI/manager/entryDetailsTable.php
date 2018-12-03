<?php

 $link = mysqli_connect("den1.mysql5.gear.host", "accudb", "Fo4TA64eI~v_", "accudb");
if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}





     


    $query = "SELECT * FROM `journalEntries` WHERE journalEntryID = " . "'" .$_POST['journalEntryID'] . "'";
	$result = mysqli_query($link,$query);
	//echo"$row['journalEntryID']";
	if (!$result) {
	    die('Invalid query: ' . $_POST['journalEntryID']);
	}
	while($row = mysqli_fetch_array($result))
	{
		if($row['debits'] !=0 || $row['credits'] !=0)
		{
			    $debits = "";
		        $credits = "";
			    if($row['debits'] != 0){
			    	$debits = "$". $row['debits'];

			    }
			    if($row['credits'] != 0){
			    	$credits = "$". $row['credits'];
			    }
			    $accoutNumber = getAccountCode($row['account']);
				echo"<tr>";
				 echo "<td>". $accoutNumber. " </td>";
			    echo "<td>" . $row['account'] . "</td>";
			    echo "<td>" . $debits . "</td>";
			    echo "<td>" . $credits . "</td>";
			    echo"</tr>";

		}
		        


        }
	    

		
function getAccountCode($account){
	$coaQuery = "SELECT * FROM `coa` WHERE AcctName = " ."'" .$account. "'";
	global $link;
        $resultCOA = mysqli_query($link,$coaQuery);
        if (!$resultCOA) 
            {die('Invalid query for coa table '.$account);}
        while($rowCOA = mysqli_fetch_array($resultCOA))
            {
                $accoutNumber = $rowCOA['AcctNumber'];
            }

          return  $accoutNumber;
}
	
	    






?>