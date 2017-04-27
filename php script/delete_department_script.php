<?php
session_start();
include "../class/connect.php";
include "../class/department.php";
$department_class = new Department;

if (isset($_SESSION["dept_del_id"])){
	$dept_id = $_SESSION["dept_del_id"];

	// for information purpose
	$department = $department_class->getDepartmentValue($dept_id)->Department;

	$department_class->deleteDepartment($dept_id); // deletion query

	$_SESSION["success_msg_del_dept"] = "<center><span class='glyphicon glyphicon-ok' style='color:#1d8348'></span> The <b>" . $department. " Department </b> is successfully deleted</center>";
	header("Location:../department_list.php");

}

else {
	header("Location:../MainForm.php");
}

?>