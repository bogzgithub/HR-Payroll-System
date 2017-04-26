<?php

	class Insert_time_attendance extends Connect_db{
		public $bio_id;
		public $date;
		public $time_in;
		public $time_out;

		public function __construct($bio_id,$date,$time_in,$time_out){
			$this->bio_id = $bio_id;
			$this->date = $date;
			$this->time_in = $time_in;
			$this->time_out = $time_out;
		}

		// FOR INSERT TIME IN TIME OUT
		public function insert_time_in_time_out(){
			$connect = $this->connect();
			// insert query
			// the date is enclosed with slant qoutation because it is a php reserve word
			$insert_qry = "INSERT INTO tb_attendance(attendance_id,bio_id,`date`,time_in,time_out) VALUES ('','".$this->bio_id."',
																								'".$this->date."',
																								'".$this->time_in."',
																								'".$this->time_out."')";
			$sql = mysqli_query($connect,$insert_qry);
		}

		// for getting the rows
		public function getRowsTimeInOut($date,$bio_id){
			$connect = $this->connect();
			$num_rows = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM tb_attendance WHERE `date`='$date' AND bio_id = '$bio_id'"));
			return $num_rows;
		}

		// for update
		public function updateTimeInTimeOut($date,$bio_id,$time_out){
			$connect = $this->connect();
			$update_qry = "UPDATE tb_attendance SET time_out = '$time_out' WHERE `date` = '$date' AND bio_id = '$bio_id'";
			$sql = mysqli_query($connect,$update_qry);

		}

		// for selecting to avoid time out will be his/ her in
		public function selectExtist($date,$bio_id){
			$connect = $this->connect();
			$select_qry = "SELECT * FROM tb_attendance WHERE `date`='$date' AND bio_id = '$bio_id'";
			$result = mysqli_query($connect,$select_qry);
			$row = mysqli_fetch_object($result);
			$time_in = $row->time_in;
			return $time_in;

		}
		
	}
?>