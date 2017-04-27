<?php
session_start();
include "../class/connect.php";
include "../class/position_class.php";
$position_class = new Position;


if (isset($_SESSION["position_del_id"])){
	$position_id = $_SESSION["position_del_id"];

	// for information purpose
	$position = $position_class->getPositionById($position_id)->Position;

	$position_class->deletePosition($position_id); // deletion query

	$_SESSION["success_msg_del_position"] = "<center><span class='glyphicon glyphicon-ok' style='color:#1d8348'></span> The <b>" . $position. " Position </b> is successfully deleted</center>";
	header("Location:../position_list.php");

}

else {
	header("Location:../MainForm.php");
}

?>