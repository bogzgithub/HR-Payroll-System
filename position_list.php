<?php
session_start();
if (!isset($_SESSION["id"])){
	header("Location:index.php");
}
include "class/connect.php"; // fixed class
include "class/position_class.php"; // fixed class


include "class/department.php";

// for universal variables
$id = $_SESSION["id"];

// this area is for null of session
$_SESSION["view_emp_id"] = null;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Position</title>
		<link rel="shortcut icon" href="img/logo/time.png"> <!-- for logo -->

		<!-- css -->
		<link rel="stylesheet" href="css/lumen.min.css">
		<link rel="stylesheet" href="css/plug ins/calendar/dcalendar.picker.css">
		<link rel="stylesheet" href="css/plug ins/data_tables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="css/custom.css">

		<!-- js -->
		<script src="js/jquery-1.12.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plug ins/calendar/dcalendar.picker.js"></script>
		<script src="js/plug ins/data_tables/jquery.dataTables.js"></script>
		<script src="js/plug ins/data_tables/dataTables.bootstrap.js"></script>
		<script src="js/chevron.js"></script>
		<script src="js/custom.js"></script>
		<script>
			$(document).ready(function(){
				$('#position_list').DataTable();
			});

			<?php
				// error in adding
				if (isset($_SESSION["position_dept_error"])){
					echo '$(document).ready(function() {
						$("#add_error_modal_body").html("'.$_SESSION["position_dept_error"].'");
						$("#add_errorModal").modal("show");
					});';
					$_SESSION["position_dept_error"] = null;
				}

				// success in adding
				if (isset($_SESSION["position_dept_success"])){
					echo '$(document).ready(function() {
						$("#success_modal_body_add").html("'.$_SESSION["position_dept_success"].'");
						$("#add_successModal").modal("show");
					});';
					$_SESSION["position_dept_success"] = null;
				}


				// error in updating
				if (isset($_SESSION["update_error_msg_position"])){
					echo '$(document).ready(function() {
						$("#error_modal_body").html("'.$_SESSION["update_error_msg_position"].'");
						$("#errorModal").modal("show");
					});';
					$_SESSION["update_error_msg_position"] = null;
				}


				// success in updating
				if (isset($_SESSION["update_success_msg_position"])){
					echo '$(document).ready(function() {
						$("#success_modal_body").html("'.$_SESSION["update_success_msg_position"].'");
						$("#successModal").modal("show");
					});';
					$_SESSION["update_success_msg_position"] = null;
				}


				// success in deleting
				if (isset($_SESSION["success_msg_del_position"])){
					echo '$(document).ready(function() {
						$("#success_modal_body_del").html("'.$_SESSION["success_msg_del_position"].'");
						$("#successDelete").modal("show");
					});';
					$_SESSION["success_msg_del_position"] = null;
				}


			?>
		</script>
	</head>
	<body>
		<!-- for nav menu -->
		<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#357ca5;">
			<div class="container-fluid">
				<div class="navbar-header">
				<!--
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsemenu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button> -->
				<a class="navbar-brand" href="MainForm.php">
					<img src="img/logo/lloyds logo.png" class="lloyds-logo"/>
				  	<span style="color:rgba(255, 255, 255, 0.8);">&nbsp;HR & Payroll System</span>
				</a>
				</div>

				<div class="dropdown pull-right full-name">
					<span style="color:#ffffff">
						<?php
							include "class/emp_information.php";
							$emp_info = new EmployeeInformation;
							$position_class = new Position;

							$row = $emp_info->getEmpInfoByRow($id);
							echo $row->Firstname . " " . $row->Middlename . " " . $row->Lastname;
						?>
					</span>
					<span style="color:#ffffff">|</span>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">		
						<span class="caret" style="color: #145a32 "></span>
					</a>
					<!-- <a class="log-out" id="log_out" href="../php script/log_out_script.php"> Log Out</a> -->
					<ul class="dropdown-menu log-out-menu" role="menu">
						<div class="log-out-div">
							<img src="<?php echo $row->ProfilePath; ?>" class="log-out-pic" alt="Profile Picture"/> <br/>
							<p class="log-out-p">  <?php echo $row->Firstname . " " . $row->Middlename . " " . $row->Lastname . " - " . $position_class->getPositionById($row->position_id)->Position; ?>
								<small style="display:block;font-size:12px;">Member since <?php echo $row->DateCreated; ?></small>
							</p>
						</div>
						<span class="col-sm-12 log-out-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-info">Profile</a>
							</div>
								<!-- <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li> -->
							<div class="pull-right">
								<a href="php script/log_out_script.php" class="btn btn-info">Logout</a>
							</div>
						</span>
					</ul>


				</div>

			</div>	<!-- end of  div -->

		</nav> <!-- end of nav -->


		<div class="sidebar">
			<ul class="nav">
				<div style="text-align:center;padding:15px;background-color:#e9ecf2;">
					<img src="<?php echo $row->ProfilePath; ?>" class="profile-pic"/>
					<div><b><?php echo $row->Firstname . " " . $row->Middlename . " " . $row->Lastname ?></b></div>
					<div><strong style="color:#1b4f72"><?php echo $position_class->getPositionById($row->position_id)->Position;?></strong></div>
				</div>
				<!-- <li class="divider"></li> -->
				<li class="parent">
					<a href="Mainform.php">
						<span class="glyphicon glyphicon-dashboard"></span>&nbsp; Events Dashboard
					</a>
				</li>
				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-employee">
						<span class="glyphicon glyphicon-user"></span>&nbsp; Employee <span class="pull-right glyphicon glyphicon glyphicon-menu-down" id=""></span>
					</a>
					<ul class="children collapse" id="sub-item-1-employee">
						<li class="">
							<a class="" href="emp_registration.php">
								<span class="glyphicon glyphicon-registration-mark" style="color: #5dade2 "></span><span>&nbsp; Registration</span>
							</a>
						</li>
						<li>
							<a class="" href="employee_list.php">
								<span class="glyphicon glyphicon-list-alt" style="color: #5dade2 "></span><span>&nbsp; Employee List</span>
							</a>
						</li>

					

						<!--<li>
							<a class="" href="position.php">
								<span class="glyphicon glyphicon-briefcase" style="color: #5dade2 "></span><span>&nbsp; Position</span>
							</a>
						</li>-->
					</ul>
				</li>


				<li class="parent">
					<a href="#">
						<span class="glyphicon glyphicon-registration-mark"></span>&nbsp; Biometrics Registration
					</a>
				</li>

				<li class="parent">
					<a href="department_list.php">
						<span class="glyphicon glyphicon-blackboard"></span>&nbsp; Department
					</a>
				</li>

				<li class="parent">
					<a href="position_list.php" style="background-color:#1d8348;">
						<span class="glyphicon glyphicon-tasks" ></span>&nbsp; Position
					</a>
				</li>


				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-government">
						<span class="glyphicon glyphicon-asterisk"></span>&nbsp; Gov't Table<span class="pull-right glyphicon glyphicon glyphicon-menu-down" id=""></span>
					</a>
					<ul class="children collapse" id="sub-item-1-government">
						<li class="">
							<a class="" href="#">
								<img src="img/government images/SSS-Logo.jpg" class="government-logo" alt="SSS-Logo"/><span>&nbsp; SSS</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<img src="img/government images/bir-Logo.jpg" class="government-logo" alt="BIR-Logo"/><span>&nbsp; BIR</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<img src="img/government images/pag-ibig-logo.jpg" class="government-logo" alt="Pag-big-Logo"/><span>&nbsp; Pag-ibig</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<img src="img/government images/philhealth-logo.jpg" class="government-logo" alt="Philhealth-Logo"/><span>&nbsp; Philhealth</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="parent">
					<a href="event_list.php">
						<span class="glyphicon glyphicon-calendar" ></span>&nbsp; Events
					</a>
				</li>


				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-attendance">
						<span class="glyphicon glyphicon-time"></span>&nbsp; Attendance <span class="pull-right glyphicon glyphicon glyphicon-menu-down" id=""></span>
					</a>
					<ul class="children collapse" id="sub-item-1-attendance">
						<li class="">
							<a class="" href="attendance_upload.php">
								<span class="glyphicon glyphicon-upload" style="color: #5dade2 "></span><span>&nbsp; Upload Attendance</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-eye-open" style="color: #5dade2 "></span><span>&nbsp; View Attendance</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-list-alt" style="color: #5dade2 "></span><span>&nbsp; Attendance List</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-tags" style="color: #5dade2 "></span><span>&nbsp; Attendance Updates</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-payroll">
						<span class="glyphicon glyphicon-ruble"></span>&nbsp; Payroll <span class="pull-right glyphicon glyphicon glyphicon-menu-down" id=""></span> 
					</a>
					<ul class="children collapse" id="sub-item-1-payroll">
						<li class="">
							<a class="" href="#">
								<span class="glyphicon glyphicon-usd" style="color: #5dade2 "></span><span>&nbsp; Salary</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-print" style="color: #5dade2 "></span><span>&nbsp; My Payslip</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-deduction">
						<span class="glyphicon glyphicon-minus-sign"></span>&nbsp; Deduction <span class="pull-right glyphicon glyphicon glyphicon-menu-down" id=""></span>
					</a>
					<ul class="children collapse" id="sub-item-1-deduction">
						<li class="">
							<a class="" href="#">
								<span class="glyphicon glyphicon-plus-sign" style="color: #5dade2"></span><span>&nbsp; Add Deduction</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-list-alt" style="color: #5dade2 "></span><span>&nbsp; Deduction List</span>
							</a>
						</li>
						<li>
							<a class="" href="#">
								<span class="glyphicon glyphicon-minus" style="color: #5dade2 "></span><span>&nbsp; Employee Deduction</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="parent">
					<a href="#">
						<span class="glyphicon glyphicon-road"></span>&nbsp; Audit Trail
					</a>
				</li>

				<li class="parent">
					<a href="#">
						<span class="glyphicon glyphicon-send"></span>&nbsp; Generate Payroll
					</a>
				</li>
			</ul>
		</div> <!-- end of sidebar -->

		<div class="content">

			<!-- for menu directory at the top -->
			<div class="container-fluid">
				<div class="row" style="border-bottom:1px solid #BDBDBD;">
					<ol class="breadcrumb">
						<li><a href="MainForm.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
						<li class="active" id="home_id">Position</li> 
					</ol>
				</div>
			</div>

			<!-- for body -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 content-div">
						<div class="thumbnail" style="border:1px solid #BDBDBD;">
							<div class="caption">
								<fieldset>
									<legend style="color:#357ca5;border-bottom:1px solid #BDBDBD"><span class="glyphicon glyphicon-list-alt"></span> Position List <small class="pull-right"><a href="#add_position_modal" data-toggle="modal" class="custom-add-items"><span class="glyphicon glyphicon-plus"></span>Add New</a></small></legend>
									<span><small><b><span class="glyphicon glyphicon-info-sign" style="color:#2E86C1;"></span> Note: If the position already used for creating an employee it can not be edit and delete.</b></small></span><br/><br/>
									<table id="position_list" class="table table-bordered table-hover" style="border:1px solid #BDBDBD;">
										<thead>
											<tr>
												<th><span class="glyphicon glyphicon-tasks" style="color:#186a3b"></span> Position</th>
												<th><span class="glyphicon glyphicon-blackboard" style="color:#186a3b"></span> Department</th>
												<th><span class="glyphicon glyphicon-wrench" style="color:#186a3b"></span> Action</th>
											</tr>
										</thead>
										<tbody>	
											<?php
												
												$position_class->getPositionToTable();
											?>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div> <!-- end of thumbnail -->
					</div>
				</div> <!-- end of row -->
			</div> <!-- end of container-fluid -->			
		</div>


		<!-- FOR ADD NEW MODAL -->
		<div id="add_position_modal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#1b4f72;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-plus' style='color:#fff'></span>&nbsp;Add Position</h5>
					</div> 
					<div class="modal-body">
						<div class="container-fluid">
							<form class="form-horizontal" action="php script/position_department_script.php" method="post">	<!-- ../php script/position_department_script.php -->	
									<div class="form-group">
										<label class="control-label"><span class="glyphicon glyphicon-tasks" style="color:#2E86C1;"></span> Position: </label>
										<input type="text" name="position" placeholder="Enter Position" class="form-control" required="required">

										<label class="control-label"><span class="glyphicon glyphicon-blackboard" style="color:#2E86C1;"></span> Department: </label>
										<select name="department" class="form-control" required="required">
											<option value=""></option>
											<?php
												$department_class = new Department;
												$department_class->getDepartmentInfo();
											?>
										</select>
										
									</div>
									<div class="form-group">								
										<button type="submit" class="btn btn-primary pull-right"/>Add</button>
									</div>							
								</form>
						</div>
					</div> 
					<!-- <div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div> -->
				</div>

			</div>
		</div> <!-- end of modal -->

			
		<!-- FOR ERROR MODAL IN  -->
		<div id="add_errorModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#b03a2e;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-plus' style='color:#fff'></span>&nbsp;Add Position Notification</h5>
					</div> 
					<div class="modal-body" id="add_error_modal_body">
						
					</div> 
			 		<div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->


		<!-- FOR SUCCESS MODAL -->
		<div id="add_successModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#1d8348;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-plus' style='color:#fff'></span>&nbsp;Add Position Notification</h5>
					</div> 
					<div class="modal-body" id="success_modal_body_add">
						
					</div> 
					<div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->



		<!-- FOR EDIT MODAL -->
		<div id="editModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#357ca5;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-pencil' style='color:#b7950b'></span> Edit Position</h5>
					</div> 
					<div class="modal-body" id="edit_modal_body">
						
					</div> 
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div> -->
				</div>

			</div>
		</div> <!-- end of modal -->


		<!-- FOR ERROR MODAL -->
		<div id="errorModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#b03a2e;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-alert' style='color:#fff'></span>&nbsp;Edit Position Notification</h5>
					</div> 
					<div class="modal-body" id="error_modal_body">
						
					</div> 
			 		<div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->


		<!-- FOR DELETE CONFIRMATION MODAL -->
		<div id="deletePositionConfirmationModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#21618c;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-trash' style='color:#fff'></span>&nbsp;Delete Position Notification</h5>
					</div> 
					<div class="modal-body" id="delete_modal_body">
						
					</div> 
					<div class="modal-footer" style="padding:5px;text-align:center;" id="delete_modal_footer">
						<a href="#" class="btn btn-default" id="delete_yes_position">YES</a>
						<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->


		<!-- FOR SUCCESS MODAL -->
		<div id="successDelete" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#1d8348;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-trash' style='color:#fff'></span>&nbsp;Delete Position Notification</h5>
					</div> 
					<div class="modal-body" id="success_modal_body_del">
						
					</div> 
					<div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->


		<!-- FOR SUCCESS MODAL -->
		<div id="successModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-sm">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="background-color:#1d8348;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title" style="color:#fff"><span class='glyphicon glyphicon-check' style='color:#fff'></span>&nbsp;Edit Position Notification</h5>
					</div> 
					<div class="modal-body" id="success_modal_body">
						
					</div> 
					<div class="modal-footer" style="padding:5px;">
						<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
					</div>
				</div>

			</div>
		</div> <!-- end of modal -->



	</body>
</html>