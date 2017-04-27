<?php
session_start();
include "../class/connect.php";
include "../class/position_class.php";
include "../class/department.php";

$position_class = new Position;
$department_class = new Department;


if (isset($_POST["position"])){
		
	$position_id =  $_SESSION["position_id_update"];
	$position = $_POST["position"];

	$dept_id = $position_class->getPositionById($position_id)->dept_id;
	$department = $department_class->getDepartmentValue($dept_id)->Department;


	// if did not fill up
	if ($position == ""){
		$_SESSION["update_error_msg_position"] =  "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> You did not fill up the required fields, No updates were taken</center>";
	}


	// check if there is no update
	else if ($position_class->getPositionById($position_id)->Position == $position){
		$_SESSION["update_error_msg_position"] =  "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> You did not change the <b>$position Position</b>, No updates were taken</center>";
	}

	// check if exist
	else if ($position_class->checkExist($dept_id,$position) != 0){
		$_SESSION["update_error_msg_position"] = "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> The <b>$position Position</b> already exist in the <b>$department Department</b></center>";
	}

	// update
	else {
		$_SESSION["update_success_msg_position"] = "<center><span class='glyphicon glyphicon-ok' style='color:#196F3D'></span> <b>" .$position_class->getPositionById($position_id)->Position." Position</b>, Successfully updated to <b>" . $position . " Position</b></br><center>";
		$position_class->updatePosition($position_id,$position);	
	}

	header("Location:../position_list.php");

}
else {
	header("Location:../MainForm.php");
}
?>