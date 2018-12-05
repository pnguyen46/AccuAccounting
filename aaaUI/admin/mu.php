
<?php

//$username = filter_input(INPUT_POST,'EmployeeID');
//$password = filter_input(INPUT_POST,'pswrd');
$password="";
for($i=0;$i<8;$i++)
    {
        $password .=chr(rand(0,25)+97);
    }
$email  = filter_input(INPUT_POST,'email');
$FirstName  = filter_input(INPUT_POST,'firstName');
$LastName = filter_input(INPUT_POST,'lastName');
$Occupation =filter_input(INPUT_POST,'Occupation');
$Description = "Create User";

if(!empty($email)){
if(!empty($password)){


    $host="den1.mysql2.gear.host";
    $dbusername ="accuaccountingdb";
    $dbpassword = "letmein559!";
    $dbname ="accuaccountingdb";

// Create connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
    die('Connect Error('. mysqli_connect_errno().')'
    .mysqli_connect_error());
}
else{
     $sql = "INSERT INTO `registeruser`( `email`, `firstName`, `lastName`, `Password`, `Occupation`) VALUES ('$email','$FirstName','$LastName','$password','$Occupation')";
    if($conn->query($sql))
    {
        header("Location: manageuser.php");
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
sleep(1);
header('location: manageuser.php');
exit;







?>
