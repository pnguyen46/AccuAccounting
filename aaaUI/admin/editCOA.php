<?php
header('location: chartofaccounts.php');
//Start session => For passing error/success messages
if (!isset($_SESSION))
    session_start();

$AcctID  = filter_input(INPUT_POST,'AcctID');
$AcctNumber  = filter_input(INPUT_POST,'AcctNumber');
$AcctName  = filter_input(INPUT_POST,'AcctName');
$AcctCategory = filter_input(INPUT_POST,'AcctCategory');
$AccountTerm = filter_input(INPUT_POST,'Term');
$NormalSide =filter_input(INPUT_POST,'NormalSide');
$InitialBalance =filter_input(INPUT_POST,'InitialBalance');
$Status= filter_input(INPUT_POST,'Status');




        $host="den1.mysql1.gear.host";
        $dbusername ="accudb";
        $dbpassword = "Fi9A-342?v5W";
        $dbname ="accudb";

// Create connection
       $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
// Create connection
    //$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     else{

                $sql = "UPDATE `coa` SET `AcctCategory`='$AcctCategory',`Term` = '$AccountTerm',`NormalSide`='$NormalSide',`Balance`='$InitialBalance',`Status`='$Status' WHERE `coa`.`AcctID` = '$AcctID'";
                $res = $conn->query($sql);
                if ($res === TRUE) {
                     $_SESSION["Notification"] = "Success";

                    $_SESSION["feed_back"] = "Account was updated";

            } else {
                $_SESSION["Notification"] = "Error";
                    $_SESSION["feed_back"] =  $conn->error;
					echo "fail";            }
        }

$conn->close();





?>