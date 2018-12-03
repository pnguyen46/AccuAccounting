<?php
//header("Location: managerJournal.php");
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//require('config.php'); // CONNECTION to Database
$link = mysqli_connect("den1.mysql1.gear.host", "accudb", "Fi9A-342?v5W", "accudb");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


 /* ----------    Update Journal and set journal entry status to approved         -----------                                  */       
         $sql_journal = "Update `journal` SET isApproved = ? WHERE `journalEntryID` = ?";
                if($stmt_journal = mysqli_prepare($link, $sql_journal))
                {
                    mysqli_stmt_bind_param($stmt_journal, "is",$isApproved, $journalEntryID);
                    
                    $journalEntryID = $_POST['journalEntryID'];
                    $isApproved = 1;

                      if(mysqli_stmt_execute($stmt_journal))
                        {
							mysqli_stmt_execute($result);
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journal. " . mysqli_error($link);
                         }



                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journal. " . mysqli_error($link);
              }

 /* ----------    Update Journal and set journal entry status to approved         -----------                                  */ 

 $query = "SELECT * FROM `journalEntries` WHERE `journalEntryID` = " . "'" .$journalEntryID . "'";
    $result = mysqli_query($link,$query);
    if (!$result) {
        die('Invalid query: ' . $_POST['account']);
    }
    while($row = mysqli_fetch_array($result))
    {
    
        $coaQuery = "SELECT * FROM `coa` WHERE `AcctName` = " ."'" .$row['account']  . "'";
        $resultCOA = mysqli_query($link,$coaQuery);
        if (!$resultCOA) 
            {die('Invalid query for coa table');}
        while($rowCOA = mysqli_fetch_array($resultCOA))
            {
                $balance = $rowCOA['Balance'];
                $account = $row['account'];
                $debits = $row['debits'];
                $credits = $row['credits'];
                updateJournalEntryBalance($balance,'accountBalanceBefore', $journalEntryID, $account);
                updateAccountBalance($account, $debits, $credits, $balance, $journalEntryID);
                 //update debits and credits for coa
                updateDebitsCredits($debits, $credits, 'coa', $account,'AcctName');
                
                //update debits and credits for account and subaccount
               updateParentAccounts($debits, $credits, $account);
               
                
            }

 }

function getNormalSide($account){
    global $link;
    $coaAccount = "SELECT * FROM `coa` WHERE AcctName = " ."'" .$account  . "'";
        $getresultCOA = mysqli_query($link, $coaAccount);
        if (!$getresultCOA) 
        {
            die('Invalid query for coa table' .$account );
        }
        $normally = "";
        while($rowCOA = mysqli_fetch_array($getresultCOA))
            {
                $normally = $rowCOA['NormalSide'];

            }
        return $normally;    

}

function setBalance($account, $balance, $debits, $credits){
     $sql_coa = "Update `coa` SET Balance = ? WHERE AcctName = ?";
     global $link;

    if($stmt_coa = mysqli_prepare($link, $sql_coa))
    {
        mysqli_stmt_bind_param($stmt_coa, "ds",$balance, $account);
        
        
        
          if(mysqli_stmt_execute($stmt_coa))
            {
               echo "success setting ballance for account " .$account. "balance: ". $balance . "\n";
            } 
         else{
            echo "ERROR: Could not execute query: $sql_coa. " . mysqli_error($link);
             }



    }
    else
     {
        echo "ERROR: Could not prepare query: $sql_coa. " . mysqli_error($link);
      }

}
function updateJournalEntryBalance($balance, $column, $journalEntryID, $account)
{
      global $link;

     /* ----------             -----------                                  */       
         $sql_journalentry = "Update `journalentries` SET " .$column  . " = ? WHERE journalEntryID = ? AND account = ?";

                if($stmt_journalentry = mysqli_prepare($link, $sql_journalentry))
                {
                    mysqli_stmt_bind_param($stmt_journalentry, "iss", $balance, $journalEntryID, $account);
                    
                   
    
                      if(mysqli_stmt_execute($stmt_journalentry))
                        {
                             echo "   success setting journalentry column: " . $column . " balance: ". $balance ."\n";
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journalentry. " . mysqli_error($link);
                         }

                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journalentry. " . mysqli_error($link);
              }

}
function updateChartOfAccountDebitsCredits($debits, $credits, $account){
          global $link;
          $uno = 1;
                              
         $sql_journalentry = "Update `coa` SET hasTransactions ?, debits = debits + ?, credits = credits + ?  WHERE  AcctName = ?";

                if($stmt_journalentry = mysqli_prepare($link, $sql_journalentry))
                {
                    mysqli_stmt_bind_param($stmt_journalentry, "idds", $uno, $debits, $credits, $account);
                    
                   
    
                      if(mysqli_stmt_execute($stmt_journalentry))
                        {
                             echo "   success setting account debits and credits.";
                             echo "COAAABABY";
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journalentry. " . mysqli_error($link);
                         }

                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journalentry. " . mysqli_error($link);
              }


}


//update debits and credits of a given table
function updateDebitsCredits($debits, $credits, $table , $account, $column)
{
    global $link;

if($table == 'coa')
{
    $sql_journalentry = "Update `coa` SET hasTransactions = ?, debits = debits + ?, credits = credits + ?  WHERE  AcctName = ?";


}
else
{
    $sql_journalentry = "Update " . $table . " SET debits = debits + ?, credits = credits + ? WHERE  "  .$column . " = ? ";

}
 
                if($stmt_journalentry = mysqli_prepare($link, $sql_journalentry))
                {
                    if($table == "coa")
                    {
                         echo "COAAABABY";

                        $uno = 1;
                        mysqli_stmt_bind_param($stmt_journalentry, "idds", $uno, $debits, $credits, $account);
                    }
                    else
                     {
                        mysqli_stmt_bind_param($stmt_journalentry, "dds", $debits, $credits, $account);
                     }
                    
                    
                   
    
                      if(mysqli_stmt_execute($stmt_journalentry))
                        {
                             echo "   success setting account debits and credits for " . $account .$debits .$credits;
                        } 
                     else{
                        echo "ERROR: Could not execute query: $sql_journalentry. " . mysqli_error($link);
                         }

                }
             else
             {
                echo "ERROR: Could not prepare query: $sql_journalentry. " . mysqli_error($link);
              }


}


function updateParentAccounts($debits, $credits, $childAccount){
     global $link;
$accountCategorySQL = "Select AcctCategory from `coa` where AcctName = '" . $childAccount . "'"; 
$result = mysqli_query($link, $accountCategorySQL);
if ($result)
{
    $row = mysqli_fetch_assoc($result);
    $category =  $row['AcctCategory'];


    //Update Account Category
    updateDebitsCredits($debits, $credits, 'account' ,  $category ,'cat_name');
    $sub_accountCategorySQL = "Select `AcctSubCategory` from `coa` where AcctName = '" . $childAccount . "'"; 
    $result_sub_cat = mysqli_query($link, $sub_accountCategorySQL);
    if($result_sub_cat)
    {
        $row = mysqli_fetch_assoc($result_sub_cat);
        $subcategory =  $row['AcctSubCategory'];
        echo '*******' . $subcategory;

        //Update Account SubCategory
        updateDebitsCredits($debits, $credits, 'subaccounts',  $subcategory, 'subCat_name');   
    }
    else
    {
        echo "ERROR:updateParentAccount: Unable to get `AcctSubCategory` from coa";

    }

    //populate Account SubCategory

    
}
else
{
    echo "ERROR:updateParentAccount: Unable to get AcctCategory from coa";
}


}



function updateAccountBalance($account, $debits, $credits, $balance, $journalEntryID){
    $normally =  getNormalSide($account);
    if($normally == "Debit"){
        updateDebitNormalSide($account, $debits, $credits, $balance, $journalEntryID );

    }
    else if($normally == "Credit"){
        updateCreditNormalSide($account, $debits, $credits, $balance, $journalEntryID );
    }
    else{
        echo "Problem encountered while updating account balance.";
    }


}

function updateDebitNormalSide($account, $debits, $credits, $balance, $journalEntryID){
    if($debits > 0)
    {
        $balance = $balance + $debits;
    }
    else if ($credits > 0)
    {
        $balance  =  $balance - $credits;

    }
    
    setBalance($account, $balance, $debits, $credits);
    updateJournalEntryBalance($balance, 'accountBalanceAfter',$journalEntryID, $account);





}
function updateCreditNormalSide($account, $debits, $credits, $balance,$journalEntryID ){

    if($credits > 0)
    {
        $balance = $balance + $credits;
    }
    else if ($debits > 0)
    {
        $balance  =  $balance - $debits;

    }

   setBalance($account, $balance, $debits, $credits);
   updateJournalEntryBalance($balance, 'accountBalanceAfter',$journalEntryID,$account);


}






// Close statement

mysqli_stmt_close($stmt_journal);
//mysqli_stmt_close($stmt_coa);

// Close connection
mysqli_close($link);

?>

            
          
    







