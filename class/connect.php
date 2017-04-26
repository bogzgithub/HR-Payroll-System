<?php
class Connect_db{
	public $servername;
	public $username;
	public $password;
	public $dbname;

	protected function connect(){
		$this->servername = 'localhost';
		$this->username = 'root';
		$this->password = '';
		$this->dbname = 'prototype_db_hr_payroll';
		// mysqli connect
		$conn = mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
		return $conn;

	}
}

?>