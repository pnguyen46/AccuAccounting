<?php
if (!isset($_SESSION))
    session_start();

$firstName =filter_input(INPUT_POST,'firstName');
$lastName =filter_input(INPUT_POST,'lastName');
$email =filter_input(INPUT_POST,'email');
$Password =filter_input(INPUT_POST,'Password');
$Occupation =filter_input(INPUT_POST,'Occupation');
$Status= filter_input(INPUT_POST,'Status');
$empId = filter_input(INPUT_POST, 'EmpId');


$host="lden1.mysql1.gear.host";
$dbusername ="accudb";
$dbpassword = "Sm2v5W9?4-24";
$dbname ="accudb";

// Create connection
$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
	die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error()); 
}
else{
	$sql = "UPDATE registeruser SET  firstName='$firstName',lastName='$lastName',email='$email',Password='$Password',Occupation='$Occupation', Status='$Status' WHERE EmployeeID=$empId";
    $res = $conn->query($sql);
    if ($res === TRUE) {
        $_SESSION["feed_back"] = "User Updated Successfully ";

    } else {
        $_SESSION["feed_back"] = "Error: " . $conn->error;
    }
}

$conn->close();

header('location: manageuser.php');

?>
