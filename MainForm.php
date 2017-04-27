<?php
session_start();
if (!isset($_SESSION["id"])){
	header("Location:index.php");
}
include "class/connect.php"; // fixed class
include "class/position_class.php"; // fixed class


include "class/events.php";

// for universal variables
$id = $_SESSION["id"];

// this area is for null of session
$_SESSION["view_emp_id"] = null;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Event Dashboard</title>
		<link rel="shortcut icon" href="img/logo/time.png"> <!-- for logo -->

		<!-- css -->
		<link rel="stylesheet" href="css/lumen.min.css">
		<link rel="stylesheet" href="css/plug ins/calendar/dcalendar.picker.css">
		<link rel="stylesheet" href="css/custom.css">

		<!-- js -->
		<script src="js/jquery-1.12.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plug ins/calendar/dcalendar.picker.js"></script>
		<script src="js/chevron.js"></script>
		<script src="js/custom.js"></script>
		<script>
			$(document).ready(function(){
				
			});
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
					<div><strong style="color:#1b4f72"><?php echo $position_class->getPositionById($row->position_id)->Position; ?></strong></div>
				</div>
				<!-- <li class="divider"></li> -->
				<li class="parent">
					<a href="Mainform.php" style="background-color:#1d8348;">
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
					<a href="position_list.php">
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
						<span class="glyphicon glyphicon-calendar"></span>&nbsp; Events
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
						<li class="active" id="home_id">Dashboard</li> 
					</ol>
				</div>
			</div>

			<!-- for body -->
			<?php
				$events_class = new Events;
				$events_class->getAllEvents();

			?>



			
		</div>

	</body>
</html>