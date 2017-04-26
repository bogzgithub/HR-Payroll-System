<?php
include "../class/connect.php";
include "../class/position_class.php";

$dept_id = $_GET["department_id"];
$position_class = new Position;
$position_class->getPositionInfo($dept_id);

?>