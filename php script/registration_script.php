<?php
session_start();
include "../class/connect.php";
include "../class/emp_information.php";
include "../class/date.php";
include "../class/department.php";
include "../class/date_format.php";
include "../class/email_validation_format.php";
include "../class/role.php";
include "../class/position_class.php";


if(empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post'){ //catch file overload error...
        $postMax = ini_get('post_max_size'); //grab the size limits...
        //echo "<p style=\"color: #F00;\">\nPlease note files larger than {$postMax} will result in this error!<br>Please be advised this is not a limitation in the CMS, This is a limitation of the hosting server.<br>For various reasons they limit the max size of uploaded files, if you have access to the php ini file you can fix this by changing the post_max_size setting.<br> If you can't then please ask your host to increase the size limits, or use the FTP uploaded form</p>"; // echo out error and solutions...
       // addForm(); //bounce back to the just filled out form.
        $_SESSION["error_msg_registration"] = "The file size you have uploaded is larger than the maximum size limit of {$postMax}b";
        

}
else {
	// if all has set and not edited by inspect element
if (isset($_POST["lastName"]) && isset($_POST["firstName"]) 
	&& isset($_POST["middleName"]) && isset($_POST["address"]) &&  isset($_POST["role"]) && isset($_POST["department"]) 
	&& isset($_POST["position"]) && isset($_POST["birthdate"]) && isset($_POST["gender"])
	&& isset($_POST["contactNo"]) && isset($_POST["email_add"]) && isset($_FILES["profileImage"]["name"]) && isset($_POST["sssNo"])
	&& isset($_POST["pagibigNo"]) && isset($_POST["tinNo"]) && isset($_POST["philhealthNo"]) && isset($_POST["username"])
	&& isset($_POST["password"]) && isset($_POST["confirmPassword"])) {




	// this variable is for error in regex
	$has_error_contactNo = 0;
	$count_contactNo = strlen($_POST["contactNo"]); // check the length

	// the contact number length must be 7 9 11
	// 11 - contact number
	// 9 - landline number with area code
	// 7 - landline number only

	if ($count_contactNo != 7 && $count_contactNo != 9 && $count_contactNo != 11) {
		$has_error_contactNo = 1;		
	}

		// if 11 cp number 09 cmula then follow by any 9 digits
	if ($count_contactNo == 11) {
		$regex = '/^[0]{1}[9]{1}[0-9]{9}$/i';

  		if (!preg_match($regex, $_POST["contactNo"])) {
  			$has_error_contactNo = 1;
  		}

	}

	//$bio_id = $_POST["bioId"];
	$lasname = $_POST["lastName"];
	$firstname = $_POST["firstName"];
	$middlename = $_POST["middleName"]; // optional
	$address = $_POST["address"];
	$role = $_POST["role"];
	$department = $_POST["department"];

	// for getting the value of department by id
	$department_class = new Department;

	$position = $_POST["position"];
	$birthdate = $_POST["birthdate"];

	// for date format
	$date_format_class = new DateFormat;
	$final_birthdate = $date_format_class->setDateFormat($birthdate);



	$gender = $_POST["gender"];
	$contactNo = $_POST["contactNo"];
	$emailAdd = $_POST["email_add"];


	// for checking if the inputed email is valid or not in a standard format as RFC 5322 Official Standard
	$email_class = new Email;
	$valid_email = $email_class->validateEmail($emailAdd);




	// for getting the last id in database of tb_employee_info to concatenate to the file name for unique purposes
	$emp_info_class = new EmployeeInformation;
	$emp_last_id = $emp_info_class->empLastId();

	// for image but is optional
	$file_tmp_name = $_FILES["profileImage"]["tmp_name"];
	$profileImage = basename($_FILES["profileImage"]["name"]);
	$profileImageName = ++$emp_last_id ."_". $profileImage;
	$file_type = pathinfo($profileImage,PATHINFO_EXTENSION);
	$file_size = $_FILES["profileImage"]["size"];
	$location = "../img/profile images/profile picture/" . $profileImageName; // for saving to the directory
	$profilePath = "img/profile images/profile picture/" . $profileImageName; // for database purpose
	

	
	$sss_no = $_POST["sssNo"]; // optional
	$pag_ibig_no = $_POST["pagibigNo"]; // optional
	$tin_no = $_POST["tinNo"]; // optional
	$philhealt_no = $_POST["philhealthNo"]; // optional
	
	// $salary = '';

	$username = $_POST["username"];
	$password = $_POST["password"];
	$confirmPassword = $_POST["confirmPassword"];

	// for retrieval purpose to the form in case of there is an error
	// basic information
	//$_SESSION["emp_reg_bio_id"] = $bio_id;
	
	$_SESSION["emp_reg_lasname"] = $lasname;
	$_SESSION["emp_reg_firstname"] = $firstname;
	$_SESSION["emp_reg_middlename"] = $middlename;
	$_SESSION["emp_reg_address"] = $address;
	$_SESSION["emp_reg_role"] = $role;
	$_SESSION["emp_reg_department"] = $department;
	$_SESSION["emp_reg_position"] = $position;
	$_SESSION["emp_reg_birthdate"] = $birthdate;
	$_SESSION["emp_reg_gender"] = $gender;
	$_SESSION["emp_reg_contactNo"] = $contactNo;
	$_SESSION["emp_reg_emailAdd"] = $emailAdd;

	// government information
	$_SESSION["emp_reg_sss_no"] = $sss_no;
	$_SESSION["emp_reg_pag_ibig_no"] = $pag_ibig_no;
	$_SESSION["emp_reg_tin_no"] = $tin_no;
	$_SESSION["emp_reg_philhealt_no"] = $philhealt_no;

	// account information
	$_SESSION["emp_reg_username"] = $username;
	




	// check if the bio id is exist must be unique
	//$emp_information = new EmployeeInformation;
	//$exist_bio_id = $emp_information->checkExistBioId($bio_id);

	// check if the username is exist must be unique
	$exist_username = $emp_info_class->checkExistUsername($username);


	// for role class
	$role_class = new Role;
	$position_class = new Position;


	// next validation if required fields has a value if not an error msg will appear
	if ($lasname == "" || $firstname == "" || $address == "" || $role == "" || $department == "" || $position == "" || $birthdate == "" || $gender == ""  || $username == "" || $password == "" || $confirmPassword == ""){
		$_SESSION["error_msg_registration"] = "There's an error during saving employee info, Information did not save.";
	}
	// first check if the uploaded images is jpeg,jpg,png
	else if ($profileImage != "" && $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"){
		$_SESSION["error_msg_registration"] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
	}

	// if password and confirm password does not match
	else if ($password != $confirmPassword) {
		$_SESSION["error_msg_registration"] = "Password and confirm password does not match.";
	}

	// if exist username
	else if ($exist_username != ""){
		$_SESSION["error_msg_registration"] = "The Username already exist.";
	}

	// if contact number is not valid
	else if ($contactNo != "" && $has_error_contactNo == 1){
		$_SESSION["error_msg_registration"] = "The Contact Number is not match to the format.";
	}

	// if invalid email format
	else if ($emailAdd != "" && $valid_email == 0){
		$_SESSION["error_msg_registration"] = "The Email Address is not valid.";
	}

	// if edited to the inspect element and change the value to string of position, role and department
	else if (!is_numeric($role) || !is_numeric($department) || !is_numeric($position)){
		$_SESSION["error_msg_registration"] = "There's an error during saving employee info, Information did not save.";
	}


	// if edited in the inspect element and change the value in a number but is not exist in the 
		//tb_position, tb_department, and tb_role
	else if ($role_class->existRole($role) == 0 || $department_class->existDepartmentById($department) == 0 || $position_class->checkExistPositionId($position) == 0){
		$_SESSION["error_msg_registration"] = "There's an error during saving employee info, Information did not save.";
	}


	// kapag 1 ung role id tapos kapag 1 din ung position id invalid request of saving information
	else if ($role == 1 || $position == 1 ){
		$_SESSION["error_msg_registration"] = "There's an error during saving employee info, Information did not save.";
	}

	// if username is below 4 character
	else if (strlen($username) < 4){
		$_SESSION["error_msg_registration"] = "The username length must be 4 and above character.";
	}

	// if password is below 8 character
	else if (strlen($username) < 8){
		$_SESSION["error_msg_registration"] = "The password length must be 8 and above character.";
	}


	// if no error success
	else {


		$position_class->getPositionById($position);
		$dept_id = $position_class->getPositionById($position)->dept_id; // for department id according to position id for information ok purpose


		//$_SESSION["success_msg_registration"] = "Employee $firstname $middlename $lasname is successfully registered";
		
		// set to null if success
			//$_SESSION["emp_reg_bio_id"] = null;
			$_SESSION["emp_reg_lasname"] = null;
			$_SESSION["emp_reg_firstname"] = null;
			$_SESSION["emp_reg_middlename"] = null;
			$_SESSION["emp_reg_address"] = null;
			$_SESSION["emp_reg_role"] = null;
			$_SESSION["emp_reg_department"] = null;
			$_SESSION["emp_reg_position"] = null;
			$_SESSION["emp_reg_birthdate"] = null;
			$_SESSION["emp_reg_gender"] = null;
			$_SESSION["emp_reg_contactNo"] = null;
			$_SESSION["emp_reg_emailAdd"] = null;

			// government information
			$_SESSION["emp_reg_sss_no"] = null;
			$_SESSION["emp_reg_pag_ibig_no"] = null;
			$_SESSION["emp_reg_tin_no"] = null;
			$_SESSION["emp_reg_philhealt_no"] = null;

			// account information
			$_SESSION["emp_reg_username"] = null;


			$date = new date; // for date

			// since it is not required
			if ($profileImage == "") {
				if ($gender == "Male"){
					$profileImageName = "male.jpg";
					$profilePath = "img/profile images/default/" . $profileImageName;
				}
				if ($gender == "Female"){
					$profileImageName = "female.jpg";
					$profilePath = "img/profile images/default/" . $profileImageName;
				}
			}
			else 
			{
				move_uploaded_file($file_tmp_name,$location);
			}	

			$emp_info_class->insertEmployee($lasname,$firstname,$middlename,$address,$role,$dept_id,$position,$final_birthdate,$gender,$contactNo,$emailAdd,$profileImageName,$profilePath,$username,$password,$sss_no,$pag_ibig_no,$tin_no,$philhealt_no,$date->getDate());
			$_SESSION["success_msg_registration"] = "Employee $firstname $middlename $lasname is successfully registered";
			
		}
		
	
	} 

	
		

}

	//echo $_SESSION["error_msg_registration"];
	//echo $_SESSION["success_msg_registration"];
header("Location:../emp_registration.php");

// if edited or if just browsing
?>