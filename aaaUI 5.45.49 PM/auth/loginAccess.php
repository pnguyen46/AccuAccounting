<?php
include 'databaseConnection.php';

class User extends Employee {
 
		public $db;
 
		public function __construct(){
			
 
			}
		}
 
		/*** for registration process ***/
		public function create_user($firstname,$lastname,$email,$jobTitle)
		{
 		
			$password = md5($password);
			//$sql="SELECT * FROM users WHERE uname='$username' OR uemail='$email'";
			$sql= "SELECT * FROM  EmployeeProfile WHERE empEmail = '$userID' LIMIT 1";
 
			//checking if the username or email is available in db
			$check =  $this->db->query($sql) ;
			$count_row = $check->num_rows;
 
			//if the username is not in db then insert to the table
			if ($count_row == 0){
				//$sql1="INSERT INTO employeeProfile SET empFirstName ='$firstname', empLastName ='$lastname', empEmail='$email', e='$email'";
				$sql = "INSERT INTO `EmployeeProfile`(`empID`, `empFirstName`, `empLastName`, `empEmail`, `empJobTitle`, `password`, `userType`) 
				VALUES ('','$firstname','$lastname','$$email','$jobType','$password','$userType')";

				if()
				$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");


        		return $result;
			}
			else { return false;}
		}
 
		/*** for login process ***/
		public function check_login($emailusername, $password){
 
        	$password = md5($password);
			$sql2="SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";
 
			//checking if the username is available in the table
        	$result = mysqli_query($this->db,$sql2);
        	$user_data = mysqli_fetch_array($result);
        	$count_row = $result->num_rows;
 
	        if ($count_row == 1) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true;
	            $_SESSION['uid'] = $user_data['uid'];
	            return true;
	        }
	        else{
			    return false;
			}
    	}
 
    	/*** for showing the username or fullname ***/
    	public function get_fullname($uid){
    		$sql3="SELECT fullname FROM users WHERE uid = $uid";
	        $result = mysqli_query($this->db,$sql3);
	        $user_data = mysqli_fetch_array($result);
	        echo $user_data['fullname'];
    	}
 
    	/*** starting the session ***/
	    public function get_session(){
	        return $_SESSION['login'];
	    }
 
	    public function user_logout() {
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }
 
	}
?>
// 	class userLogin
// 	{
// 		private $username;
// 		private $password;
// 		public $isLoggedIn;

// 		public function UsrLoggedIn(){
// 			return $this -> $isLoggedIn = true;
// 		}


// 		public function userAuthentication() {
// 			$username = $_POST[$this -> $username];
// 			$password = $_POST[$this -> $password];
// 		}



// 		public function required validation($field)
// 		{
// 			$count = 0;

// 			foreach ($field as $key => $value) 
// 			{
// 				# code...
// 				if(empty($value))
// 				{
// 					$count++;
// 					$this -> $error = "<p>" .$key . "is required</p>";
// 				}
// 			}

// 			if ($count == 0)
// 			{
// 				return true;
// 			}
// 		}



// 	}

// ?>