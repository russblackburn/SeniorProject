<?php
	//BUILD THE QUERY for the form
	$query1 = "SELECT * FROM coreCourse WHERE includeOnForm='yes' AND hide='F' ORDER BY courseTitle ASC";

	//TRY AND TALK TO THE DB
	$result1 = mysqli_query($dbc, $query1) or die('query failed');
?>

<div class="entireForm">
<form action="studentRegistrationProcess.php" method="POST" enctype="multipart/form-data" name="student_registration">

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
  </div>
  
  <?php
	  if($page != services){// load this section on the student registration page---------------------------
			  // add script for ajax
			  echo '<script src="js/dropdown.js"></script>';
			  echo '<label for="course">Course</label>';
				echo '<div class="form-group">';
					echo '<div class="form-group">';
						echo '<select class="form-control" name="course" onchange="showUser(this.value)">';
						   echo '<option value="0">Select</option>';
							   while($row1 = mysqli_fetch_array($result1)){ 
									echo '<option value="'.$row1['id'].'">'.$row1['courseTitle'].'</option>';
							   }
						echo '</select>';
					echo '</div>';
				echo '</div>';
			
				// load the course time for the course that was choosen
				echo '<div id="txtHint"></div>';
			
	  		}
	  	else{// load this section on the course pages -----------------------------------------------------
		  		echo '<input type="hidden" name="course" value="'.$found['id'].'">';
				
				//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
				$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
				
				//BUILD THE QUERY
				$query01 = "SELECT * FROM events WHERE courseID=$courseID AND thirdParty='1' AND hide='F' ORDER BY dateOrder ASC";
			
				//TRY AND TALK TO THE DB
				$result01 = mysqli_query($dbc, $query01) or die('query failed');
				
				//TRY AND TALK TO THE DB
				$result02 = mysqli_query($dbc, $query01) or die('query failed');
				
				// GET THE CURRENT DATE
				date_default_timezone_set('America/Denver');
				$date = date('Ymd');
				
				// check to see if the field should display, if there are no events do not display the field at all
				$dropdownPositive = false;
				while($row02 = mysqli_fetch_array($result02)){
						if ($row02['dateOrder'] >= $date){
							$dropdownPositive = true;
							break;
						}
					}
				
				if($dropdownPositive == true){
				echo '<label for="dateAndTime">Date and Time</label>';
							echo '<div class="form-group">';
								echo '<div class="form-group">';
									echo '<select class="form-control" name="date_time">';
									   echo '<option value="0">Select</option>';
				
				while($row01 = mysqli_fetch_array($result01)){
					if ($row01['dateOrder'] >= $date){// check the database date against the current date
					// BUILD THE SECTION FOR THE START DATE AND TIME -----------------------	
							// BREAK THE TIME INTO SEPERATE PIECES
								$myArray = explode(':', $row01['startTime']);
								$hour = str_replace('T', '', $myArray[0]);
								
								switch ($hour) {
									case ($hour < 12):
										$ampm = 'am';
										break;
									case ($hour >= 12):
										$ampm = 'pm';
										break;
									default:
										$ampm = '';
								}
								
								switch ($hour) {
									case ($hour < 10):
										$hour = str_replace('0', '', $hour);
										break;
									case ($hour > 12):
										$hour = $hour - 12;
										break;
									default:
										$hour == $hour;
								}
						
				
								// display start date and time
								$startString = $row01['monthStart'].'/'.$row01['dayStart'].'/'.$row01['yearStart'].' · '.$hour.':'.$myArray[1].' '.$ampm;
								
								// BUILD THE SECTION FOR THE END DATE AND TIME ---------------------------
								// BREAK THE TIME INTO SEPERATE PIECES
								$myArray = explode(':', $row01['endTime']);
								$hour = str_replace('T', '', $myArray[0]);
								
								switch ($hour) {
									case ($hour < 12):
										$ampm = 'am';
										break;
									case ($hour >= 12):
										$ampm = 'pm';
										break;
									default:
										$ampm = '';
								}
								
								switch ($hour) {
									case ($hour < 10):
										$hour = str_replace('0', '', $hour);
										break;
									case ($hour > 12):
										$hour = $hour - 12;
										break;
									default:
										$hour == $hour;
								}
								if($row01['monthStart'].$row01['dayStart'].$row01['yearStart'] == $row01['monthEnd'].$row01['dayEnd'].$row01['yearEnd']){
									// display date and time without the ending date (ending date is on the same date as starting date)
											$finalText = $startString.' - '.$hour.':'.$myArray[1].' '.$ampm;
											echo '<option value="'.$finalText.'">'.$finalText.'</option>';
									}
									else{
											// display date and time with an ending date
											$finalText = $startString.' - '.$row01['monthEnd'].'/'.$row01['dayEnd'].'/'.$row01['yearEnd'].' · '.$hour.':'.$myArray[1].' '.$ampm;
											echo '<option value="'.$finalText.'">'.$finalText.'</option>';
										}
					}// end of conditional
				}// end of while
				
				
									echo '</select>';
								echo '</div>';
							echo '</div>';
				}// end of the conditional to check and see if there is a $dropdownPositive at all
		  	}// end of the else statement for the course pages
    ?>
  
  <button type="submit" class="btn btn-default" name="submitButton">Register</button>
</form>
</div><!-- end of entireForm -->