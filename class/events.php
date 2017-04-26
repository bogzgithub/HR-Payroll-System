<?php
include "date.php";

	class Events extends Connect_db {

		// for getting all events render to events dashboard
		public function getAllEvents(){
			echo '<div class="container-fluid">
						<div class="row">';

			$date_class = new date;
			$connect = $this->connect();
			$select_qry = "SELECT * FROM tb_events ORDER BY dateTimeCreated DESC";
			if ($result = mysqli_query($connect,$select_qry)){
				while($row = mysqli_fetch_object($result)){
					echo '<div class="col-sm-9">
							<div class="panel panel-primary content-element">
								 <div class="panel-heading">
							 		' .$row->events_title.''
							 		.'<span class="pull-right">Date Posted: '.$date_class->dateFormat($row->dateTimeCreated).'</span>'.
								 '</div>
								 <div class="panel-body">'
								 	.$row->events_value.
								 '</div>
							</div>
						</div>';
				}
			}
					echo '<div class="calendar-div" style="">';
							echo '';
					echo '</div>'; // end of col-sm-3 
				echo "</div>"; // end of row
			echo "</div>";  // end of container-fluid

		}
	}


?>