<?php
session_start();
if (isset($_SESSION["id"])){
	header("Location:MainForm.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Log In Form</title>
		<link rel="shortcut icon" href="img/logo/time.png"> <!-- for logo -->

		<!-- css -->
		<link rel="stylesheet" href="css/lumen.min.css">
		<link rel="stylesheet" href="css/custom.css">
		<style type="text/css">
			body, html {   
			    width: 100%;
			    height: 100%;
			    display:table;
			}
			body {
			    display:table-cell;
			    vertical-align:middle;
			    background-image:url("img/background image/background_images_log_in_page.jpg"); 
			    background-size:cover;

			}
			form,img {
			   /* display:table; shrinks to fit content */
			    margin:auto;
			}

		</style>

		<!-- js -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.2.min"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<center>
					<img src="img/logo/lloyds logo.png" style="width:60px;"/>
					<h3>Sign in to HR & Payroll System</h3>
				</center>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-offset-4">
					<form class="form-horizontal" action="php script/log_in_script.php" method="post">
						<div class="panel panel-info">
							<!-- <div class="panel-heading">
								<h3 class="panel-title" style="color:#17202a;">
									<span class="glyphicon glyphicon-lock"></span> LOG IN FORM
									
								</h3>
							</div> -->
							<div class="panel-body">
								<div class="col-sm-8 col-sm-offset-2">

									<!-- for username -->
							  		<div class="form-group">
							  			<label class="control-label"><b>Username</b></label>
						  				<input type="text" name="username" placeholder="Enter your username ..." class="form-control" autocomplete="off" required="required">
						  			</div>
						  			<!-- for password -->
						  			<div class="form-group">
					  					<label class="control-label"><b>Password</b></label>
						  				<input type="password" placeholder="Enter your password ..." name="password" class="form-control" autocomplete="off" required="required">
						  			</div>

						  			<!-- for submit button -->
						  			<div class="form-group">
					  					<input type="submit" class="btn btn-success col-sm-12" value="LOG IN">
					  					<!-- for error -->
					  					<div class="col-sm-12" style="margin-bottom:-25px;">
					  						<p style="color: #cb4335 ;">&nbsp;<?php if (isset($_SESSION["failed_log_in"])){ echo $_SESSION["failed_log_in"]; $_SESSION["failed_log_in"] = null;} ?></p>
					  					</div>
					  				</div>
					  				
					  			</div> <!-- end of col-md-12 -->
						  </div>	

						</div>
					</form>
				</div>
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</body>
</html>
