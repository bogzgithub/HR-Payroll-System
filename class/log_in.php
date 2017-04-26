<?php
	class Login extends Connect_db{
	//	public $username;
	//	public $password;
		
		public function setLogin($username,$password){
			$connect = $this->connect();
			$this->username = mysqli_real_escape_string($connect,$username);
			$this->password = mysqli_real_escape_string($connect,$password);
			// FOR CHECKING TO THE DATABASE IF EXIST
			$select_exist_qry = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_employee_info WHERE Username = '".$this->username."' AND PASSWORD='".$this->password."'"));
			return $select_exist_qry;
		}


		// getting information of id
		public function LoginDetails($username,$password){
			$connect = $this->connect();
			$this->username = mysqli_real_escape_string($connect,$username);
			$this->password = mysqli_real_escape_string($connect,$password);		
			$select_qry = "SELECT * FROM tb_employee_info WHERE Username = '".$this->username."' AND PASSWORD='".$this->password."'";
			$result = mysqli_query($connect,$select_qry);
			$row = mysqli_fetch_object($result);
			$user_id = $row->emp_id;
			return $user_id;
		}


		// for get specific user role by id
		public function getRole($id){
			$connect = $this->connect();
			$select_qry = "SELECT * FROM tb_employee_info WHERE emp_id='$id'";
			$result = mysqli_query($connect,$select_qry);
			$row = mysqli_fetch_object($result);
			$role = $row->role_id;
			return $role;
		}

	}

?>