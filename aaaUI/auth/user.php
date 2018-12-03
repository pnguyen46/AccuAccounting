<?php
//include "databaseConnection.php";
include 'Employee.php';

	class user extends Employee
	{
		
		
		public $conn;
		
		private $validity = false;
		private $errorLogin;
		
		public function __construct()
		{
			$this->conn =  mysqli_connect('den1.mysql1.gear.host', 'accudb', 'Fi9A-342?v5W', 'accudb');
			//$session = session_start();
			
			//echo'OK';
			
			if (mysqli_connect_errno()) {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  exit;
			}

		}

		public function setValidity() 
 		{
			$this-> validity = true; 
 		}
 		
		public function getValidity()//
		{
			return $this -> validity; 
		}
		
		public function authenticateUser($username, $password)
		{
		
			$result = new user;
			$errorLogin =null;

			$sql= "SELECT * FROM  registeruser WHERE email = '$username' LIMIT 1";
    		$result2 = mysqli_query($this-> conn, $sql);
    		
    		//if(mysqli_num_rows($result2))
    		
    		while ($row = mysqli_fetch_array($result2 ,MYSQLI_BOTH)) 
    		{
    			if ($row['email'] == $username && $row['Password'] == $password ) 
				{
					$_SESSION['email'] = $row['email'];
					$_SESSION['Occupation'] = $row['Occupation'];
					$result -> getValidity();
					$userType = $_SESSION['Occupation'];
					return $userType;
				}
				
				else
				{
					echo 'You are not authenticated';
					return null;
				}
			}
		}
		
		public  function redirect($username, $password) 
		{
			$result = new user;
			if($result -> getUserType($username, $password) == 'Admin')
			{
				session_start();		
				header('Location: ../Admin/chartOfAccounts.php');
				echo 'You have successfully logged in';
				exit();
				
			}
			
			else if($result -> getUserType($username, $password) == 'Manager')
			{
				session_start();
				header('Location: ../Manager/chartOfAccounts.php');
				exit();
			}
			else if($result -> getUserType($username, $password) == 'Regular')
			{
				session_start();
				header('Location: ../standard/chartOfAccounts.php');
				exit();
			}
			else 
			{
				header('Location: login.php?err=1');
				exit();
			}
		
		}
		
		public function login($username, $password)
		{ 
			$user = new user;
    		
			if($user -> authenticateUser($username, $password))
			{
				//$session_start();
				return true;
			}
			else 
			{
				return false;
			}
		}
		
		public function getUserType($username, $password)
		{
			$userType;
			
			$sql2= "SELECT * FROM  registeruser WHERE email = '$username' LIMIT 1";
    
            $result = mysqli_query($this->conn, $sql2);

            while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) 
            {

                  if ($row['email'] == $username && $row['Password'] == $password ) 
                  {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['Occupation'] = $row['Occupation'];
                    $userType = $_SESSION['Occupation'];
                    return $userType; 
                }

                else 
                {
                      echo 'user type undifined!';
                      return null;
                }     
            }
		
		}
		
		public function logout()
		{
			session_start();
			session_destroy();
		}
	}
	//$userObject = new user;
?>