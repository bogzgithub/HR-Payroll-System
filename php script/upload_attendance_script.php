<?php
session_start();
ini_set('max_execution_time', 300);
include "../class/connect.php";

// if not isset
if(empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post'){ //catch file overload error...
        $postMax = ini_get('post_max_size'); //grab the size limits...
        //echo "<p style=\"color: #F00;\">\nPlease note files larger than {$postMax} will result in this error!<br>Please be advised this is not a limitation in the CMS, This is a limitation of the hosting server.<br>For various reasons they limit the max size of uploaded files, if you have access to the php ini file you can fix this by changing the post_max_size setting.<br> If you can't then please ask your host to increase the size limits, or use the FTP uploaded form</p>"; // echo out error and solutions...
       // addForm(); //bounce back to the just filled out form.
        $_SESSION["attendance_upload_error"] = "The file size you have uploaded is larger than the maximum size limit of {$postMax}b";
        

}
else {

	if (isset($_FILES["dat_file"]["name"])){
		$file_tmp_name = $_FILES["dat_file"]["tmp_name"];
		$base_name = basename($_FILES["dat_file"]["name"]);
		$file_type = pathinfo($base_name,PATHINFO_EXTENSION);
		$file_name = "dtr_dat_files" . "." . $file_type;

		// if the uploaded files is not dat
		if ($file_type != "dat"){
			$_SESSION["attendance_upload_error"] = "Please upload only dat files";			
		}
		// success
		else {
			include "../class/dat_file_logs.php"; // for database purpose
			include "../class/date.php"; // for date purpose
			include "../class/time_in_time_out.php"; // for insert time in time out
			$date = new date;


			$dat_files = new DatFilesLog;
			// save the first entry
			if ($dat_files->numrowsDatFiles() == 0){
				
				$final_final_name = "1_".$file_name; 
				$dat_files->insertDatFiles($final_final_name,$date->getDate());
			}
			// id database has already has entry/entrys
			else {
				$last_id = $dat_files->lastIdDatFiles();
				$final_final_name = ++$last_id . "_".$file_name; 
				$dat_files->insertDatFiles($final_final_name,$date->getDate());
			}

			// uploading
			$path = "../dat files/";
			$location = $path . $final_final_name;
			move_uploaded_file($file_tmp_name,$location);

			// for saving the attendance info
			header('Content-Type: text/plain');
			$lines = file($location);
			$count = count($lines);
			$counter = 1;

			do {
				//echo $counter;
				//echo $lines[$counter];
			
				$data = explode("\t",$lines[$counter]);

				$bio_id = str_replace(" ","",$data[0]);

				$date =  (string)$data[1];

				$final_date_time = explode(" ",$date); // the index 0 is for date , the index 1 is used for time in or time out

				//echo $date . "\n";
				//echo $counter . ": BIO ID: ". $bio_id . ", DATE:" .$final_date_time[0] . ", TIME IN/OUT:" .$final_date_time[1] . "\n";

				$final_bio_id = (int)$bio_id;
				$final_date = $final_date_time[0];
				$final_time = $final_date_time[1]; // it will choose if it is time in or time out


				$time_in_time_out = new Insert_time_attendance($final_bio_id,$final_date,$final_time,'');
				// for inserting time in time out , if 0 num rows insert if exist update
				if ($time_in_time_out->getRowsTimeInOut($final_date,$final_bio_id) == 0){
					
					$time_in_time_out->insert_time_in_time_out();
				}
				else {
					if ($time_in_time_out->selectExtist($final_date,$final_bio_id) != $final_time) {
						$time_in_time_out->updateTimeInTimeOut($final_date,$final_bio_id,$final_time);
					}
				}
				
				$counter++;
			}while($counter < ($count - 1));
			$_SESSION["upload_success"] = "Successfully Uploaded";
		}
}
}
// if not isset

//$_SESSION["attendance_upload_error"] = "There an error during uploading";
header("Location:../attendance_upload.php");
?>