<?php
session_start();
if (!isset($_SESSION["id"])){
	header("Location:index.php");
}
include "class/connect.php"; // fixed class
include "class/position_class.php"; // fixed class


include "class/role.php";
// for universal variables
$id = $_SESSION["id"];


// this area is for null of session
$_SESSION["view_emp_id"] = null;

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Employee Registration</title>
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
		<script src="js/string_uppercase.js"></script>
		<script src="js/numbers_only.js"></script>
		<script src="js/custom.js"></script>
		<script>
			$(document).ready(function(){
				$("input[name='birthdate']").dcalendarpicker();
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
								<a href="#" class="btn btn-info">Logout</a>
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
					<a href="Mainform.php">
						<span class="glyphicon glyphicon-dashboard"></span>&nbsp; Events Dashboard
					</a>
				</li>
				<li class="parent">
					<a data-toggle="collapse" href="#sub-item-1-employee">
						<span class="glyphicon glyphicon-user"></span>&nbsp; Employee <span class="pull-right glyphicon glyphicon glyphicon-menu-up" id=""></span>
					</a>
					<ul class="children collapse in" id="sub-item-1-employee">
						<li class="">
							<a class="active-sub-menu" href="emp_registration.php">
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
				<div class="row" style="border-bottom:1px solid  #d5dbdb ">
					<ol class="breadcrumb">
						<li><a href="MainForm.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
						<li class="" id="home_id">Employee Registration</li> 
					</ol>
				</div>
			</div>

			<!-- for body -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-success content-element" style="">

							 <div class="panel-body">
							 	<fieldset>
							 		<legend style="border-bottom:1px solid  #566573 ">
							 			<center><b>Employee Registration Form</b></center>
						 			</legend>
									<form class="form-horizontal" method="post" action="php script/registration_script.php" enctype="multipart/form-data">																		
										<b><small><i>Fields with (<span style="color:#b03a2e;">*</span>) are required<br/>
										Contact Number Format:  Cellphone No (09123456789) , Landline No (1234567, with area code 123456789)</br>
										Gov't No Format: SSS No (Compose of 10 digits) , Pag-ibig No (Compose of 12 digits), Tin No (Compose of 9 digits), Philhealth No (Compose of 12 digits)</i></small></b>
										<p>&nbsp;
											<?php if (isset($_SESSION["error_msg_registration"])){ echo "<span class='glyphicon glyphicon-remove' style='color:#CB4335'></span> ". "<span style='color:#CB4335'>".$_SESSION["error_msg_registration"] . "</span>"; $_SESSION["error_msg_registration"] = null;}?>
											<?php if (isset($_SESSION["success_msg_registration"])){ echo "<span class='glyphicon glyphicon-ok' style='color:#196F3D'></span> ". "<span style='color:#196F3D'>" .$_SESSION["success_msg_registration"] . "</span>"; $_SESSION["success_msg_registration"] = null;}?>
										</p>																					
										<fieldset>
											<legend style="border-bottom:1px solid #808b96">Basic Information</legend>
											<div class="col-sm-10 col-sm-offset-1">

												<div class="form-group">	
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> Last Name&nbsp;<span class="red-asterisk">*</span></label>
														<input type="text" name="lastName" id="txt_only" value="<?php if (isset($_SESSION["emp_reg_lasname"])) { echo $_SESSION["emp_reg_lasname"]; $_SESSION["emp_reg_lasname"] = null; } ?>" class="form-control" placeholder="Enter Last Name" required="required">
													</div>

													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> First Name&nbsp;<span class="red-asterisk">*</span></label>
														<input type="text" name="firstName" id="txt_only" value="<?php if (isset($_SESSION["emp_reg_firstname"])) { echo $_SESSION["emp_reg_firstname"]; $_SESSION["emp_reg_firstname"] = null; } ?>" class="form-control" placeholder="Enter First Name" required="required">
													</div>
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> Middle Name</label>
														<input type="text" name="middleName" id="txt_only" value="<?php if (isset($_SESSION["emp_reg_middlename"])) { echo $_SESSION["emp_reg_middlename"]; $_SESSION["emp_reg_middlename"] = null; } ?>" class="form-control" placeholder="Enter Middle Name">
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-8">
														<label class="control-label"><span class="glyphicon glyphicon-home" style="color:#2E86C1;"></span> Address&nbsp;<span class="red-asterisk">*</span></label>
														<textarea name="address" name="address" class="form-control" placeholder="Enter Address" required="required"><?php if (isset($_SESSION["emp_reg_address"])) { echo $_SESSION["emp_reg_address"]; $_SESSION["emp_reg_address"] = null; } ?></textarea>
													</div>

													<div class="col-sm-4">						
													    <label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> Role&nbsp;<span class="red-asterisk">*</span></label>
														<select name="role" required="required" class="form-control">
															<option value=""></option>
															<?php																
																$row_class = new Role;
																$row_class->getAllRole();
															?>
														</select>
													</div>

													
												</div>

												<div class="form-group">

													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-blackboard" style="color:#2E86C1;"></span> Department&nbsp;<span class="red-asterisk">*</span></label>
														<select class="form-control" name="department" required="required">
															<option value=""></option>
															<?php
																include "class/department.php";
																$department_class = new Department;
																$department_class->getDepartmentInfo();															
															?>
														</select>
													</div>

													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-tasks" style="color:#2E86C1;"></span> Position&nbsp;<span class="red-asterisk">*</span></label>
														<select class="form-control" name="position" required="required">
															<option value=""></option>
															<?php
																if (isset($_SESSION["emp_reg_department"])){
																	
																	$position_class = new Position;
																	$position_class->getAllPosition($_SESSION["emp_reg_department"]);
																	$_SESSION["emp_reg_department"] = null;
																}
															?>
														</select>
													</div>
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-calendar" style="color:#2E86C1;"></span> Birthdate&nbsp;<span class="red-asterisk">*</span></label>
														<input type="text" name="birthdate" autocomplete="off" value="<?php if (isset($_SESSION["emp_reg_birthdate"])) { echo $_SESSION["emp_reg_birthdate"]; $_SESSION["emp_reg_birthdate"] = null; } ?>" class="form-control" placeholder="Enter Birthdate" required="required">
													</div>
													
												</div>

												<div class="form-group">

													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> Gender</label>
														<select class="form-control" name="gender">
															<option value=""></option>
															<option value="Male" <?php if (isset($_SESSION["emp_reg_gender"])){ if ($_SESSION["emp_reg_gender"] == "Male") { echo "selected=selected"; $_SESSION["emp_reg_gender"] = null;}} ?> >Male</option>
															<option value="Female" <?php if (isset($_SESSION["emp_reg_gender"])){ if ($_SESSION["emp_reg_gender"] == "Female") { echo "selected=selected"; $_SESSION["emp_reg_gender"] = null;}} ?>>Female</option>
														</select>
													</div>


													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-phone-alt" style="color:#2E86C1;"></span> Contact No</label>
														<input type="text" name="contactNo" id="number_only" value="<?php if (isset($_SESSION["emp_reg_contactNo"])) { echo $_SESSION["emp_reg_contactNo"]; $_SESSION["emp_reg_contactNo"] = null; } ?>" maxlength="11" class="form-control" placeholder="Enter Contact No">
													</div>

													
													
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-envelope" style="color:#2E86C1;"></span> Email Address</label>
														<input type="email" name="email_add" value="<?php if (isset($_SESSION["emp_reg_emailAdd"])) { echo $_SESSION["emp_reg_emailAdd"]; $_SESSION["emp_reg_emailAdd"] = null; } ?>" class="form-control" placeholder="Enter Email Address">
													</div>

												</div>

												<div class="form-group">
													<div class="col-sm-12">
														<label class="control-label"><span class="glyphicon glyphicon-picture" style="color:#2E86C1;"></span> Profile Images</label>
														<input type="file" name="profileImage" accept="image/*">
													</div>
												</div>
											</div>
										</fieldset>


										<fieldset>
											<legend style="border-bottom:1px solid #808b96">Government Information</legend>
												<div class="col-sm-10 col-sm-offset-1">
													<div class="form-group">	
														<div class="col-sm-4">						
															<label class="control-label"><img src="img/government images/SSS-Logo.jpg" class="government-logo" alt="SSS-Logo"/><span>&nbsp; SSS No.</label>
															<input type="text" name="sssNo" id="number_only" value="<?php if (isset($_SESSION["emp_reg_sss_no"])) { echo $_SESSION["emp_reg_sss_no"]; $_SESSION["emp_reg_sss_no"] = null; } ?>" class="form-control" placeholder="Enter SSS No.">
														</div>

														<div class="col-sm-4">						
															<label class="control-label"><img src="img/government images/pag-ibig-logo.jpg" class="government-logo" alt="Pag-big-Logo"/><span>&nbsp; Pag-ibig No.</label>
															<input type="text" name="pagibigNo" id="number_only" value="<?php if (isset($_SESSION["emp_reg_pag_ibig_no"])) { echo $_SESSION["emp_reg_pag_ibig_no"]; $_SESSION["emp_reg_pag_ibig_no"] = null; } ?>" class="form-control" placeholder="Enter Pag-ibig No.">
														</div>
														<div class="col-sm-4">						
															<label class="control-label"><img src="img/government images/bir-Logo.jpg" class="government-logo" alt="BIR-Logo"/><span>&nbsp; Tin No.</label>
															<input type="text" name="tinNo" id="number_only" value="<?php if (isset($_SESSION["emp_reg_tin_no"])) { echo $_SESSION["emp_reg_tin_no"]; $_SESSION["emp_reg_tin_no"] = null; } ?>" class="form-control" placeholder="Enter Tin No.">
														</div>
													</div>

													<div class="form-group">
														<div class="col-sm-4">						
															<label class="control-label"><img src="img/government images/philhealth-logo.jpg" class="government-logo" alt="Philhealth-Logo"/><span>&nbsp; Philhealth No.</label>
															<input type="text" name="philhealthNo" id="number_only" value="<?php if (isset($_SESSION["emp_reg_philhealt_no"])) { echo $_SESSION["emp_reg_philhealt_no"]; $_SESSION["emp_reg_philhealt_no"] = null; } ?>" class="form-control" placeholder="Enter Philhealth No.">
														</div>
													</div>
												</div>
										</fieldset>


										<fieldset>
											<legend style="border-bottom:1px solid #808b96">User Account Information</legend>
											<div class="col-sm-10 col-sm-offset-1">
												<div class="form-group">
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-user" style="color:#2E86C1;"></span> Username&nbsp;<span class="red-asterisk">*</span></label>
														<input type="text" name="username" value="<?php if (isset($_SESSION["emp_reg_username"])) { echo $_SESSION["emp_reg_username"]; $_SESSION["emp_reg_username"] = null; } ?>" class="form-control" placeholder="Enter Username" required="required">
													</div>

													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-lock" style="color:#2E86C1;"></span> Password&nbsp;<span class="red-asterisk">*</span></label>
														<input type="password" name="password" class="form-control" placeholder="Enter Password" required="required">
													</div>
													<div class="col-sm-4">						
														<label class="control-label"><span class="glyphicon glyphicon-lock" style="color:#2E86C1;"></span> Confirm Password&nbsp;<span class="red-asterisk">*</span></label>
														<input type="password" name="confirmPassword" class="form-control" placeholder="Enter Confirm Password" required="required">
													</div>
												</div>
											</div>
										</fieldset>

										<div class="form-group" style="text-align:center;">
											<input type="submit" class="btn btn-primary" value="Submit"/>
										</div>
									</form>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>

			

		</div>

	</body>
</html>