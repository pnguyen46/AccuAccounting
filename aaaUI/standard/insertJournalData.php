<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//require('config.php'); // CONNECTION to Database
$link = mysqli_connect("den1.mysql1.gear.host", "accudb", "Fi9A-342?v5W", "accudb");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
function generateJournalEntryID() {
    $length = 9;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $entryIdentifier = '';
    for ($i = 0; $i < $length; $i++) {
        $entryIdentifier .= $characters[rand(0, $charactersLength - 1)];
    }
    return $entryIdentifier;
}


//server, user, password, db


  $entryID= generateJournalEntryID();



/* ----------    Insert to Journal Entries first to record the different account transactions    -----------                                  */
           
    //Generate random string to be used as the journal entry ID,so each individual transaction will belong to the same journal entry.
     
      for($i=0; $i < count($_POST['account']); $i++) {
                $sql_journal_entries = "INSERT INTO JournalEntries(journalEntryID,account, debits,credits) VALUES (?, ?, ?, ?)";

                if($stmt_journal_entries = mysqli_prepare($link, $sql_journal_entries))
                {
                    mysqli_stmt_bind_param($stmt_journal_entries, "ssdd",$entryID, $account, $debits, $credits);
                    
                    $account = addslashes($_POST['account'][$i]);
                    $debits = addslashes($_POST['debits'][$i]);
                    $credits = addslashes($_POST['credits'][$i]);
                      if(mysqli_stmt_execute($stmt_journal_entries))
                        {
                      
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journal_entries. " . mysqli_error($link);
                         }



                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journal_entries. " . mysqli_error($link);
              }

        } 



 /* ----------    Insert to Journal            -----------                                  */       
         $sql_journal = "INSERT INTO Journal(journalEntryID,description,isApproved, targetDate) VALUES (?, ?, ?, ?)";

                if($stmt_journal = mysqli_prepare($link, $sql_journal))
                {
                    mysqli_stmt_bind_param($stmt_journal, "ssis",$entryID, $description, $approved,$targetDate);
                    
                    $description = $_REQUEST['description'];
                    $approved = 0;
                    $targetDate = $_REQUEST['journalDate'];
                    //date("Y-m-d",strtotime($_REQUEST['journalDate']));
                    
                      if(mysqli_stmt_execute($stmt_journal))
                        {
                        
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journal. " . mysqli_error($link);
                         }



                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journal. " . mysqli_error($link);
              }
/* ----------    Insert to Files Table          -----------                                  */


  for($i=0; $i < count($_POST['filesToUpload']); $i++) {
        $sql_files = "INSERT INTO Files(journalEntryID,file,description) VALUES (?, ?, ?)";

                      if($stmt_files = mysqli_prepare($link, $sql_files))
                      {
                          mysqli_stmt_bind_param($stmt_files, "sbs", $entryID,  $file, $description);

                          $file = addslashes($_FILES['filesToUpload'][$i]);
                          $description = "file added to journal entry: . $entryID";
                          
                            if(mysqli_stmt_execute($stmt_files))
                              {
                                header("Location: journal.php");
                   
                              } 
                           else{
                              echo "ERROR: Could not execute query: $sql_files. " . mysqli_error($link);
                               }



                      }
                   else
                   {
                      echo "ERROR: Could not prepare query: $sql_files. " . mysqli_error($link);
                    }

}
 header("Location: journal.php");



// Close statement
mysqli_stmt_close($stmt_journal_entries);
mysqli_stmt_close($stmt_journal);

// Close connection
mysqli_close($link);

?>

            
          
    







