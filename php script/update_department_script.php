<?php
session_start();
include "../class/connect.php";
include "../class/department.php";

$department_class = new Department;



$dept_id = $_SESSION["dept_id_update"];



$_SESSION["dept_id_update"] = null; // for refreshing the value

if (isset($_POST["department"])){
	$department = $_POST["department"];

	if ($department == ""){
		$_SESSION["update_error_msg_department"] = "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> <b>" . $department_class->getDepartmentValue($dept_id)->Department ." Department</b> can't update because you need to provide a new value</span></center>";

	}

	else if ($department_class->existDepartment($department) != 0) {

		// if department is equal to its current department
		if ($department == $department_class->getDepartmentValue($dept_id)->Department){
			$_SESSION["update_error_msg_department"] = "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> <b>You did not modify " . $department ." Department</b></center>";
		}
		// else if it is equal to other department
		else {
			$_SESSION["update_error_msg_department"] = "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> <b>" . $department ." Department</b> already exist</center>";
		}
	}

	else {		
		$_SESSION["update_success_msg_department"] = "<center><span class='glyphicon glyphicon-ok' style='color:#196F3D'></span> <b>" .$department_class->getDepartmentValue($dept_id)->Department." Department</b>, Successfully updated to <b>" . $department . " Department</b></br><center>";
		$department_class->updateDepartment($dept_id,$department);
		}
 }
header("Location:../department_list.php");

?>