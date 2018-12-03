
<?php

//$username = filter_input(INPUT_POST,'EmployeeID');
//$password = filter_input(INPUT_POST,'pswrd');
//$password="";
//for($i=0;$i<8;$i++)
//    {
//        $password .=chr(rand(0,25)+97);
//    }
$AcctNumber  = filter_input(INPUT_POST,'AcctNumber');
$AcctName  = filter_input(INPUT_POST,'AcctName');
$AcctCategory = filter_input(INPUT_POST,'AcctCategory');
$AcctSubCategory=filter_input(INPUT_POST,'AcctSubCategory');
$NormalSide =filter_input(INPUT_POST,'NormalSide');
$InitialBalance =filter_input(INPUT_POST,'InitiallBalance');
//$Status= filter_input(INPUT_POST,'Status');

if(!empty($AcctNumber)){
if(!empty($AcctName)){

   
    $host="den1.mysql5.gear.host";
    $dbusername ="accudb";
    $dbpassword = "Fo4TA64eI~v_";
    $dbname ="accudb";
    
// Create connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if(mysqli_num_rows()){
        die('Connect Error('. mysqli_connect_errno().')'
    .mysqli_connect_error()); 
}
else{





     $sql = "INSERT INTO `coa`( `AcctNumber`, `AcctName`, `AcctCategory`, `AcctSubCategory`, `NormalSide`,`InitialBalance`) VALUES ('$AcctNumber','$AcctName','$AcctCategory','$AcctSubCategory','$NormalSide','$InitialBalance')";
	if($conn->query($sql))
    {
        echo "New record is inserted successfully";
        echo"<a href=\"chartOfAccounts.php\">GO BACK</a>";
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
