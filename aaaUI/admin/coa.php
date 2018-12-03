<?php


$AcctNumber  = filter_input(INPUT_POST,'AcctNumber');
$AcctName  = filter_input(INPUT_POST,'AcctName');
$AcctCategory = filter_input(INPUT_POST,'AcctCategory');
$NormalSide =filter_input(INPUT_POST,'NormalSide');
$InitialBalance =filter_input(INPUT_POST,'InitialBalance');
$AccountTerm = filter_input(INPUT_POST,'Term');
//$Status= filter_input(INPUT_POST,'Status');


if(!empty($AcctNumber)){
if(!empty($AcctName)){


    
// Create connection
 $conn = mysqli_connect("den1.mysql5.gear.host", "accudb", "Fo4TA64eI~v_", "accudb");
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
     $sql = "INSERT INTO `coa`( `AcctNumber`, `AcctName`, `AcctCategory`,`Term`, `NormalSide`,`InitialBalance`, `Balance`) VALUES ('$AcctNumber','$AcctName','$AcctCategory','$AccountTerm','$NormalSide','$InitialBalance','$InitialBalance')";
	 
	if($conn->query($sql))
    {
        header("Location: chartOfAccounts.php");
        exit;
    }
    else{
        echo "Error: ".  $sql ."<br>". $conn->error;
    }
    
 
    $conn->close();
}
}
    

    else{
        echo"Password should not be Empty";
    die(); 
}
}
    else{
        echo"EmployeeID should not be Empty";
    die(); 
}





?>
