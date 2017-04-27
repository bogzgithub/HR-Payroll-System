<?php
include "../class/connect.php";
include "../class/emp_information.php";

$emp_id = $_GET["emp_id"];

// for num rows exist id
$emp_info_class = new EmployeeInformation;
if ($emp_info_class->checkExistEmpId($emp_id) == 1){
	echo $emp_id;
}

else { // ibig savihin error message
	echo "Error";
}


?>