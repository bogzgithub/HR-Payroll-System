<?php

class Department extends Connect_db{

	// for inserting
	public function insertDepartment($department,$date){
		$connect = $this->connect();
		$department = mysqli_real_escape_string($connect,$department);
		$insert_qry = "INSERT INTO tb_department (dept_id,Department,DateCreated) VALUES ('','$department','$date')";
		$sql = mysqli_query($connect,$insert_qry);
	}

	// getting the last id of the department
	// for get the last id
	public function lastIdDepartment(){
		$connect = $this->connect();
		$select_last_id_qry = "SELECT * FROM tb_department ORDER BY dept_id DESC LIMIT 1";
		$result = mysqli_query($connect,$select_last_id_qry);
		$row = mysqli_fetch_object($result);
		$last_id = $row->dept_id;
		return $last_id;
	}

	// checking if exist
	public function existDepartment($department){
		$connect = $this->connect();
		$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_department WHERE Department = '$department'"));
		return $num_rows;
	}



	// checking if exist by id
	public function existDepartmentById($dept_id){
		$connect = $this->connect();
		$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_department WHERE dept_id = '$dept_id'"));
		return $num_rows;
	}

	// get the current id of the exist Department
	public function getInformationDepartment($department){
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_department WHERE Department = '$department'";
		$result = mysqli_query($connect,$select_qry);
		$row = mysqli_fetch_object($result);
		return $row;
	}

	// for getting all position
	public function getDepartmentInfo(){
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_department";
		if ($result = mysqli_query($connect,$select_qry)){
			while($row = mysqli_fetch_object($result)){

				// for retrieval purpose in case of error in employee registration during saving
				$selected = "";
				if (isset($_SESSION["emp_reg_department"])){
					if ($_SESSION["emp_reg_department"] == $row->dept_id) {
							$selected = "selected=selected";
					}
				}

				echo "<option value='$row->dept_id' ".$selected.">";
					echo $row->Department;
				echo "</option>";
			}
		}
	}

	// for get the department value by dept_id
	public function getDepartmentValue($dept_id){
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_department WHERE dept_id = '$dept_id'";
		$result = mysqli_query($connect,$select_qry);
		$row = mysqli_fetch_object($result);
		return $row;
	}


	// for table get all department
	public function getDepartmentToTable(){
		//$row_design = ""; // static value
		$connect = $this->connect();
		$select_qry = "SELECT * FROM tb_department";
		if ($result = mysqli_query($connect,$select_qry)){
			while($row = mysqli_fetch_object($result)){

				/*if ($row_design == "danger"){
					$row_design = "";
				}

				if ($row_design == "warning"){
					$row_design = "danger";
				}

				if ($row_design == "info"){
					$row_design = "warning";
				}

				if ($row_design == "success"){
					$row_design = "info";
				}


				if ($row_design == "active"){
					$row_design = "success";
				}

				if ($row_design == ""){
					$row_design = "active";
				} */

				// check if exist to the position so it will not be deleted or edited
				$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_position WHERE dept_id='$row->dept_id'"));
				if ($num_rows == 0){
					echo "<tr id=".$row->dept_id.">";
						echo "<td>" .$row->Department ."</td>";
						echo "<td>";
							echo "<span class='glyphicon glyphicon-pencil' style='color:#b7950b'></span> <a href='#' id='edit_deptartment' class='action-a'>Edit</a>";
							echo "<span> | </span>";
							echo "<span class='glyphicon glyphicon-trash' style='color:#515a5a'></span> <a href='#' id='delete_department' class='action-a'>Delete</a>";
						echo "</td>";
					echo "</tr>";
				}
				else {
					echo "<tr>";
					echo "<td>" .$row->Department ."</td>";
					echo "<td>";
						echo "No actions";
					echo "</td>";
					echo "</tr>";
				}
			}
		}
	}



	// for updating department VALUE
	public function updateDepartment($dept_id,$department){
		$connect = $this->connect();
		$update_qry = "UPDATE tb_department SET Department = '$department' WHERE dept_id='$dept_id'";
		$sql = mysqli_query($connect,$update_qry);
	}


	// for deleting department by id
	public function deleteDepartment($dept_id){
		$connect = $this->connect();
		$delete_qry = "DELETE FROM tb_department WHERE dept_id='$dept_id'";
		$sql = mysqli_query($connect,$delete_qry);
	}




}

?>