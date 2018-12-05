<?php
session_start();
$_SESSION['message']= '';

$mysqli = new mysqli('den1.mysql2.gear.host', 'accuaccountingdb', 'letmein559!', 'accuaccountingdb');
$errPsw = 0;
$errNodb = 0;

if ($_SERVER['REQUEST_METHOD']=='POST') {
    if($_POST['Password']==$_POST['confirmPassword']) {

      $FirstName = $mysqli->real_escape_string($_POST['firstName']);
      $LastName = $mysqli->real_escape_string($_POST['lastName']);
      $Email = $mysqli->real_escape_string($_POST['email']);
      $password = $mysqli->real_escape_string($_POST['Password']);


      $sql = "INSERT INTO `registeruser`( `email`, `firstName`, `lastName`, `Password`)
      VALUES ('$Email','$FirstName','$LastName','$password')";

      if ($mysqli->query($sql) == true) {
        header("Location: regsuccess.php");
        exit();
      }
      else {
            $_SESSION['message'] = "Registration unsuccessful user was not added!";
            header('location: registerUser.php');
            exit();
        }
      }
      else {
          $_SESSION['message'] = "Both passwords do not match!";
          header('location: registerUser.php');
          exit();
          }
    exit();
  }
?>
