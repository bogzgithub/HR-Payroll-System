<?php

class EmployeeInformation extends Connect_db{

	// for specific person log in
	public function getEmpInfoByRow($id){
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_employee_info WHERE emp_id='$id'";
		$result = mysqli_query($connect,$select_qry);
		$row = mysqli_fetch_object($result);
		return $row;
	}



	// for inserting information
	public function insertEmployee($lname,$fname,$mname,
									$address,$role,$department,$position,
									$birthdate,$gender,$contactNo,$email,
									$profileImage,$profilePath,$username,
									$password,$sssNo,$pagibigNo,$tinNo,$philhealthNo,$dateCreated){

		$connect = $this->connect();
		
		//$biod_id = mysqli_real_escape_string($connect,$bio_id);
		$lname = mysqli_real_escape_string($connect,$lname);
		$fname = mysqli_real_escape_string($connect,$fname);
		$mname = mysqli_real_escape_string($connect,$mname);
		$address = mysqli_real_escape_string($connect,$address);
		$role = mysqli_real_escape_string($connect,$role);
		$department = mysqli_real_escape_string($connect,$department);
		$position = mysqli_real_escape_string($connect,$position);
		$birthdate = mysqli_real_escape_string($connect,$birthdate);
		$contactNo = mysqli_real_escape_string($connect,$contactNo);
		$email = mysqli_real_escape_string($connect,$email);
		$profileImage = mysqli_real_escape_string($connect,$profileImage);
		$profilePath = mysqli_real_escape_string($connect,$profilePath);
		$username = mysqli_real_escape_string($connect,$username);
		$password = mysqli_real_escape_string($connect,$password);
		$sssNo = mysqli_real_escape_string($connect,$sssNo);
		$pagibigNo = mysqli_real_escape_string($connect,$pagibigNo);
		$tinNo = mysqli_real_escape_string($connect,$tinNo);
		$philhealthNo = mysqli_real_escape_string($connect,$philhealthNo);
		//$salary = mysqli_real_escape_string($connect,$username);
		$dateCreated = mysqli_real_escape_string($connect,$dateCreated);

		$insert_qry = "INSERT INTO tb_employee_info (emp_id,bio_id,Lastname,Firstname,
													Middlename,Address,role_id,dept_id,
													position_id,Birthdate,Gender,ContactNo,EmailAddress,
													ProfileImage,ProfilePath,Username,
													Password,SSS_No,PagibigNo,
													TinNo,PhilhealthNo,Salary,ActiveStatus,DateCreated)
											VALUES ('','','$lname','$fname',
													'$mname','$address','$role','$department',
													'$position','$birthdate','$gender',
													'$contactNo','$email','$profileImage','$profilePath',
													'$username','$password','$sssNo',
													'$pagibigNo','$tinNo','$philhealthNo',
													'','1','$dateCreated')";
		$sql = mysqli_query($connect,$insert_qry);

	}

	// fucntion check if the bio id is exist
	public function checkExistBioId($bio_id){
		$connect = $this->connect();
		$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_employee_info WHERE bio_id = '$bio_id'"));
		return $num_rows;
	}

	// fucntion check if the username is exist
	public function checkExistUsername($username){
		$connect = $this->connect();
		$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_employee_info WHERE Username = '$username'"));
		return $num_rows;
	}


	// for checking if the user id is exist in the database
	public function checkExistEmpId($emp_id){
		$connect = $this->connect();
		$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_employee_info WHERE emp_id = '$emp_id'"));
		return $num_rows;
	}


	// for getting the last id in database
	public function empLastId(){
		$connect = $this->connect();
		$select_last_id_qry = "SELECT * FROM tb_employee_info ORDER BY emp_id DESC LIMIT 1";
		$result = mysqli_query($connect,$select_last_id_qry);
		$row = mysqli_fetch_object($result);
		$last_id = $row->emp_id;
		return $last_id;
	}


	// for getting the info to table
	public function getPositionToTable(){
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_employee_info";
		if ($result = mysqli_query($connect,$select_qry)){
			while($row = mysqli_fetch_object($result)){
				$select_position_qry = "SELECT * FROM tb_position WHERE position_id = '$row->position_id'";
				$result_position = mysqli_query($connect,$select_position_qry);
				$row_position = mysqli_fetch_object($result_position);
				$position_val = $row_position->Position;

				// for active or inactive
				$active_stat = $row->ActiveStatus;
				// if active
				$active_value_action = "";
				if ($active_stat == 1){
					// value is dynamic
					$active_value_action = "Inactive";
				}

				// if inactive
				if ($active_stat == 0){
					// value is dynamic
					$active_value_action = "&nbsp;&nbsp;Active&nbsp;&nbsp;";
				}

				$active_value = "";
				if ($active_stat == 1){
					// value is dynamic
					$active_value = "Active";
				}

				if ($active_stat == 0){
					// value is dynamic
					$active_value = "Inactive";
				}



				// emp_id = 1 for ADMIN
				if ($row->emp_id != 1){
					echo "<tr id=".$row->emp_id.">";
						echo "<td>".$row->Firstname. " " .  $row->Middlename. " " .$row->Lastname. "</td>";
						echo "<td>".$row->Address."</td>";
						echo "<td>".$position_val."</td>";
						echo "<td>".$row->ContactNo."</td>";
						echo "<td>".$active_value."</td>";
						echo "<td>";
								echo "<span class='glyphicon glyphicon-pencil' style='color:#b7950b'></span> <a href='#' id='' class='action-a'>Edit</a>";
								echo "<span> | </span>";
								echo "<span class='glyphicon glyphicon-stats' style='color:#515a5a'></span> <a href='#' id='' class='action-a'>$active_value_action</a>";
								echo "<span> | </span>";
								echo "<span class='glyphicon glyphicon-eye-open' style='color:#515a5a'></span> <a href='#' id='view_emp_profile' class='action-a'>View</a>";
								
							echo "</td>";
					echo "</tr>";
				}
			}

		}

	}
	

}


?>