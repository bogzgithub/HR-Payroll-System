<?php
session_start();
include "../class/connect.php";
include "../class/department.php";
$dept_id = $_GET["department_id"];
$department_class = new Department;
// check if position id exist bka kc inedit sa inspect element eh
if ($department_class->existDepartmentById($dept_id) != 0){
	$_SESSION["dept_id_update"] = $dept_id;

?>
	<form class="form-horizontal" action="php script/update_department_script.php" method="post">
		<div class="container-fluid">								
			<label class="control-label"><span class="glyphicon glyphicon-blackboard" style="color:#2E86C1;"></span> Department</label>
			<div class="input-group">
				<input type="text" name="department" value="<?php echo utf8_encode($department_class->getDepartmentValue($dept_id)->Department);  ?>" autocomplete="off" placeholder="Enter Department" class="form-control" required="required">
			 	<span class="input-group-btn">
			    	<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-pencil"></span></button>
			    </span>
			</div>								
		</div>
	</form>

<?php
} // end of if
else {
	echo "<center><span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> There is an error during getting of data</center>";
}

?>
