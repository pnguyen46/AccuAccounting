<?php
session_start();
 $link = mysqli_connect("den1.mysql1.gear.host", "accudb", "Fi9A-342?v5W", "accudb");
if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}

    $query = "SELECT * FROM `journalEntries` WHERE account = " . "'" .$_POST['account'] . "'";
	$result = mysqli_query($link,$query);
	if (!$result) {
	    die('Invalid query: ' . $_POST['account']);
	}
	while($row = mysqli_fetch_array($result))
	{
		$journalEntryDate = "NA";
		$Balance = 0;


		$journalQuery = "SELECT * FROM `journal` WHERE journalEntryID = " ."'" .$row['journalEntryID'] . "'";
		$resultJournal = mysqli_query($link,$journalQuery);
		if (!$resultJournal) {die('Invalid query for journal table');}
		
		while($rowJournal = mysqli_fetch_array($resultJournal)){$journalEntryDate = $rowJournal['targetDate']; $isApproved =$rowJournal['isApproved'];}
        
        if($isApproved == 1){
	        $coaQuery = "SELECT * FROM `coa` WHERE AcctName = " ."'" .$_POST['account']  . "'";
			$resultCOA = mysqli_query($link,$coaQuery);
			if (!$resultCOA) {die('Invalid query for coa table');}
			while($rowCOA = mysqli_fetch_array($resultCOA)){$Balance = $rowCOA['Balance'];}

			if( ($row['debits'] != 0) || ($row['credits'] != 0))
			{
				echo"<tr>";
			    echo "<td>" . $journalEntryDate . "</td>";
			    echo "<td> $" . number_format($row['debits'],2) . "</td>";
			    echo "<td> $" . number_format($row['credits'],2) . "</td>";
			    echo "<td> $" . number_format($row['accountBalanceBefore'],2) . "</td>";
			    echo "<td> $" . number_format($row['accountBalanceAfter'],2) . "</td>";
			    $url = 'journalEntryDetails.php?entry=' . $row['journalEntryID'];
			    echo "<td> <a href='" .$url ."'>" . $row['journalEntryID'] . "</a></td>";
			    echo"</tr>";

			}
		


        }
	    

		
		
	}
	    




session_write_close();

?>