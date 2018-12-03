
<?php 
	class Employee {
		private $firstName;
		private $latName;
		private $email;
		private $roleStatus;

		public function __construct() {}
		/*setter and getter for first name*/
		public function setEmployeeFirstName($firstName) {
			if(!is_string($firstName))
       		    throw new Exception('$firstName must be a string!');

       		else
       		    $this -> firstName = $firstName;
		}

		public function getEmployeeFirstName() {
			return $this -> firstName;
		}
		/*setter and getter for last name*/
		public function setEmployeeLastName($lastName) {
			if(!is_string($lastName))
       		    throw new Exception('$lastName must be a string!');

       		else
       		    $this -> lastName = $lastName;
		}

		public function getEmployeeLastName() {
			return $this -> lastName;
		}
		/*setter and getter for first email */
		public function setEmployeeEmail($email) {
			if(!is_string($email))
       		    throw new Exception('$email must be a string!');

			else
			    $this -> $email = $email;
		}
		public function getEmployeeEmail() {
			return $this -> email;
		}
		/*setter and getter for first role status */
		public function setEmployeeRoleStatus($roleStatus) {
			if(!is_string($roleStatus))
       		    throw new Exception('$roleStatus must be a string!');

			else
			        $this -> roleStatus = $roleStatus;
		}
		public function getEmployeeRoleStatus() {
			return $this -> roleStatus;
		}
		public function printEmployeeFirstName()
		{
			 return $this-> getEmployeeFirstName();
			
		}
	}
		

	 ?>