<?php
//header("Location: managerJournal.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//require('config.php'); // CONNECTION to Database
$link = mysqli_connect("den1.mysql5.gear.host", "accudb", "Fo4TA64eI~v_", "accudb");
 
$changes = 'Rejected Journal Entry';
$occupation = 'Manager';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


 /* ----------    Update Journal and set journal entry status to approved         -----------                                  */       
         $sql_journal = "Update Journal SET isApproved = ?, comments = ? WHERE journalEntryID = ?";

                if($stmt_journal = mysqli_prepare($link, $sql_journal))
                {
                    mysqli_stmt_bind_param($stmt_journal, "iss",$isApproved, $comments, $journalEntryID);
                    
                    $journalEntryID = $_POST['journalEntryID'];
                    $comments =  $_POST['comment'];
                    $isApproved = 3;
                    $sq2 = "INSERT INTO logs (Changes, Description,Occupation) VALUES ('$changes','$journalEntryID','$occupation')";
					$output = mysqli_prepare($link,$sq2);
                      if(mysqli_stmt_execute($stmt_journal))
                        {
							mysqli_stmt_execute($output);

                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journal. " . mysqli_error($link);
                         }



                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journal. " . mysqli_error($link);
              }

mysqli_close($link);

?>
