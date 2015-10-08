<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$eventID = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current events
	$query = "SELECT * FROM events WHERE id=$eventID";
	
	//communicate with the database
	$result = mysqli_query($dbc, $query) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	if($found['thirdParty'] == 3) {
		$courseTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[courseTitle])));
	}
	$monthStart = mysqli_real_escape_string($dbc, trim($_POST[monthStart]));
	$dayStart = mysqli_real_escape_string($dbc, trim($_POST[dayStart]));
	$yearStart = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearStart])));
	$monthEnd = mysqli_real_escape_string($dbc, trim($_POST[monthEnd]));
	$dayEnd = mysqli_real_escape_string($dbc, trim($_POST[dayEnd]));
	$yearEnd = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearEnd])));
	
			// get the time and format it correctly
			$amPm = $_POST[ampmStart];
			
			if($amPm == am) {
				$hourStart = $_POST[hourStart];
				$minStart = $_POST[minStart];
				$startTime = 'T'.$hourStart.':'.$minStart.':00';
				}else{
					$hourStart = $_POST[hourStart];
					$hourStartPM = $hourStart + 12;
					$minStart = $_POST[minStart];
					$startTime = 'T'.$hourStartPM.':'.$minStart.':00';
					}
					
			// get the time and format it correctly
			$amPm = $_POST[ampmEnd];
			
			if($amPm == am) {
				$hourEnd = $_POST[hourEnd];
				$minEnd = $_POST[minEnd];
				$endTime = 'T'.$hourEnd.':'.$minEnd.':00';
				}else{
					$hourEnd = $_POST[hourEnd];
					$hourEndPM = $hourEnd + 12;
					$minEnd = $_POST[minEnd];
					$endTime = 'T'.$hourEndPM.':'.$minEnd.':00';
					}
		
		if($found['thirdParty'] == 3) {
			//UPLOAD THE CUSTOM COURSE WITH THE CHANGED COURSETITLE
			//build the query
			$query = "UPDATE events SET courseTitle='$courseTitle', monthStart='$monthStart', dayStart='$dayStart', yearStart='$yearStart', startTime='$startTime', monthEnd='$monthEnd', dayEnd='$dayEnd', yearEnd='$yearEnd', endTime='$endTime' WHERE id=$id ";
			
			// talk with the database
			$result = mysqli_query($dbc, $query) or die('your query has failed 1');
			
			$feedback = '<p class="adminGreen">Your event has been updated. <a href="events.php">&#8617; View EVENTS Page</a></p>';
			
		}else{
			// UPLOAD THE COURE COURSE AND THE THIRD PARTY COURSE WITHOUT CHANGING THE COURSETITLE
			//build the query
		$query = "UPDATE events SET monthStart='$monthStart', dayStart='$dayStart', yearStart='$yearStart', startTime='$startTime', monthEnd='$monthEnd', dayEnd='$dayEnd', yearEnd='$yearEnd', endTime='$endTime' WHERE id=$id ";
		
			// talk with the database
			$result = mysqli_query($dbc, $query) or die('your query has failed 1');
			
			$feedback = '<p class="adminGreen">Your event has been updated. <a href="events.php">&#8617; View EVENTS Page</a></p>';
			
			}
	};//end of if submit/isset
	

	if(isset($_POST['submitButton'])) {	
	// build the query to display the current events
	$query01 = "SELECT * FROM events WHERE id=$id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	$found = NULL;
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	}
	
	// terminate the connection
	mysqli_close($dbc);

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['courseTitle'];?></h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_event">

	<?php
	if($found['thirdParty'] == 3) {
	echo '<div class="form-group">';
        echo '<label for="customTitle">Custom Title</label>';
        echo '<input type="text" class="form-control" id="customTitle" name="courseTitle" placeholder="Custom Title" value="'.$found['courseTitle'].'">';
  	echo '</div>';
	}
	?>

	<h3>Start Date and Time</h3>
    <label for="month">Start Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthStart">
               <option value="01" <?php if($found['monthStart'] == '01'){echo 'selected="selected"';} ?>>01</option>
               <option value="02" <?php if($found['monthStart'] == '02'){echo 'selected="selected"';} ?>>02</option>
               <option value="03" <?php if($found['monthStart'] == '03'){echo 'selected="selected"';} ?>>03</option>
               <option value="04" <?php if($found['monthStart'] == '04'){echo 'selected="selected"';} ?>>04</option>
               <option value="05" <?php if($found['monthStart'] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="06" <?php if($found['monthStart'] == '06'){echo 'selected="selected"';} ?>>06</option>
               <option value="07" <?php if($found['monthStart'] == '07'){echo 'selected="selected"';} ?>>07</option>
               <option value="08" <?php if($found['monthStart'] == '08'){echo 'selected="selected"';} ?>>08</option>
               <option value="09" <?php if($found['monthStart'] == '09'){echo 'selected="selected"';} ?>>09</option>
               <option value="10" <?php if($found['monthStart'] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($found['monthStart'] == '11'){echo 'selected="selected"';} ?>>11</option>
               <option value="12" <?php if($found['monthStart'] == '12'){echo 'selected="selected"';} ?>>12</option>
            </select>
            
            <select class="form-control" name="dayStart">
               <option value="01" <?php if($found['dayStart'] == '01'){echo 'selected="selected"';} ?>>01</option>
               <option value="02" <?php if($found['dayStart'] == '02'){echo 'selected="selected"';} ?>>02</option>
               <option value="03" <?php if($found['dayStart'] == '03'){echo 'selected="selected"';} ?>>03</option>
               <option value="04" <?php if($found['dayStart'] == '04'){echo 'selected="selected"';} ?>>04</option>
               <option value="05" <?php if($found['dayStart'] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="06" <?php if($found['dayStart'] == '06'){echo 'selected="selected"';} ?>>06</option>
               <option value="07" <?php if($found['dayStart'] == '07'){echo 'selected="selected"';} ?>>07</option>
               <option value="08" <?php if($found['dayStart'] == '08'){echo 'selected="selected"';} ?>>08</option>
               <option value="09" <?php if($found['dayStart'] == '09'){echo 'selected="selected"';} ?>>09</option>
               <option value="10" <?php if($found['dayStart'] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($found['dayStart'] == '11'){echo 'selected="selected"';} ?>>11</option>
               <option value="12" <?php if($found['dayStart'] == '12'){echo 'selected="selected"';} ?>>12</option>
               <option value="13" <?php if($found['dayStart'] == '13'){echo 'selected="selected"';} ?>>13</option>
               <option value="14" <?php if($found['dayStart'] == '14'){echo 'selected="selected"';} ?>>14</option>
               <option value="15" <?php if($found['dayStart'] == '15'){echo 'selected="selected"';} ?>>15</option>
               <option value="16" <?php if($found['dayStart'] == '16'){echo 'selected="selected"';} ?>>16</option>
               <option value="17" <?php if($found['dayStart'] == '17'){echo 'selected="selected"';} ?>>17</option>
               <option value="18" <?php if($found['dayStart'] == '18'){echo 'selected="selected"';} ?>>18</option>
               <option value="19" <?php if($found['dayStart'] == '19'){echo 'selected="selected"';} ?>>19</option>
               <option value="20" <?php if($found['dayStart'] == '20'){echo 'selected="selected"';} ?>>20</option>
               <option value="21" <?php if($found['dayStart'] == '21'){echo 'selected="selected"';} ?>>21</option>
               <option value="22" <?php if($found['dayStart'] == '22'){echo 'selected="selected"';} ?>>22</option>
               <option value="23" <?php if($found['dayStart'] == '23'){echo 'selected="selected"';} ?>>23</option>
               <option value="24" <?php if($found['dayStart'] == '24'){echo 'selected="selected"';} ?>>24</option>
               <option value="25" <?php if($found['dayStart'] == '25'){echo 'selected="selected"';} ?>>25</option>
               <option value="26" <?php if($found['dayStart'] == '26'){echo 'selected="selected"';} ?>>26</option>
               <option value="27" <?php if($found['dayStart'] == '27'){echo 'selected="selected"';} ?>>27</option>
               <option value="28" <?php if($found['dayStart'] == '28'){echo 'selected="selected"';} ?>>28</option>
               <option value="29" <?php if($found['dayStart'] == '29'){echo 'selected="selected"';} ?>>29</option>
               <option value="30" <?php if($found['dayStart'] == '30'){echo 'selected="selected"';} ?>>30</option>
               <option value="31" <?php if($found['dayStart'] == '31'){echo 'selected="selected"';} ?>>31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearStart" placeholder="Year" required value="<?php echo $found['yearStart']; ?>">
        </div>
    </div>
    
    <br>
    
    <?php
	// BREAK THE TIME INTO SEPERATE PIECES
		$myArray = explode(':', $found['startTime']);
	?>
    
    <label for="month">Start Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourStart">
               <option value="01" <?php if($myArray[0] == 'T01' || $myArray[0] == 'T13'){echo 'selected="selected"';} ?>>1</option>
               <option value="02" <?php if($myArray[0] == 'T02' || $myArray[0] == 'T14'){echo 'selected="selected"';} ?>>2</option>
               <option value="03" <?php if($myArray[0] == 'T03' || $myArray[0] == 'T15'){echo 'selected="selected"';} ?>>3</option>
               <option value="04" <?php if($myArray[0] == 'T04' || $myArray[0] == 'T16'){echo 'selected="selected"';} ?>>4</option>
               <option value="05" <?php if($myArray[0] == 'T05' || $myArray[0] == 'T17'){echo 'selected="selected"';} ?>>5</option>
               <option value="06" <?php if($myArray[0] == 'T06' || $myArray[0] == 'T18'){echo 'selected="selected"';} ?>>6</option>
               <option value="07" <?php if($myArray[0] == 'T07' || $myArray[0] == 'T19'){echo 'selected="selected"';} ?>>7</option>
               <option value="08" <?php if($myArray[0] == 'T08' || $myArray[0] == 'T20'){echo 'selected="selected"';} ?>>8</option>
               <option value="09" <?php if($myArray[0] == 'T09' || $myArray[0] == 'T21'){echo 'selected="selected"';} ?>>9</option>
               <option value="10" <?php if($myArray[0] == 'T10' || $myArray[0] == 'T22'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($myArray[0] == 'T11' || $myArray[0] == 'T23'){echo 'selected="selected"';} ?>>11</option>
               <option value="00" <?php if($myArray[0] == 'T00' || $myArray[0] == 'T12'){echo 'selected="selected"';} ?>>12</option>
            </select>
            
            <select class="form-control" name="minStart">
               <option value="00" <?php if($myArray[1] == '00'){echo 'selected="selected"';} ?>>00</option>
               <option value="05" <?php if($myArray[1] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="10" <?php if($myArray[1] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="15" <?php if($myArray[1] == '15'){echo 'selected="selected"';} ?>>15</option>
               <option value="20" <?php if($myArray[1] == '20'){echo 'selected="selected"';} ?>>20</option>
               <option value="25" <?php if($myArray[1] == '25'){echo 'selected="selected"';} ?>>25</option>
               <option value="30" <?php if($myArray[1] == '30'){echo 'selected="selected"';} ?>>30</option>
               <option value="35" <?php if($myArray[1] == '35'){echo 'selected="selected"';} ?>>35</option>
               <option value="40" <?php if($myArray[1] == '40'){echo 'selected="selected"';} ?>>40</option>
               <option value="45" <?php if($myArray[1] == '45'){echo 'selected="selected"';} ?>>45</option>
               <option value="50" <?php if($myArray[1] == '50'){echo 'selected="selected"';} ?>>50</option>
               <option value="55" <?php if($myArray[1] == '55'){echo 'selected="selected"';} ?>>55</option>
            </select>
            
            <select class="form-control" name="ampmStart">
               <option value="am"
				<?php
					if($myArray[0] == 'T01' || $myArray[0] == 'T02') {
						echo 'selected="selected"';
						}
						else if($myArray[0] == 'T03' || $myArray[0] == 'T04') {
								echo 'selected="selected"';
							}
							else if($myArray[0] == 'T05' || $myArray[0] == 'T06') {
									echo 'selected="selected"';
								}
								else if($myArray[0] == 'T07' || $myArray[0] == 'T08') {
									echo 'selected="selected"';
									}
									else if($myArray[0] == 'T09' || $myArray[0] == 'T10') {
										echo 'selected="selected"';
										}
										else if($myArray[0] == 'T11' || $myArray[0] == 'T00') {
											echo 'selected="selected"';
											}
											else {
												$pmCheck = true;
												}
												?>>am</option>
               <option value="pm"<?php if($pmCheck == true) {echo 'selected="selected"';} ?>>pm</option>
            </select>
    
        </div>
    </div>
    
    <br>
    
    <h3>End Date and Time</h3>
    <label for="month">End Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthEnd">
               <option value="01" <?php if($found['monthEnd'] == '01'){echo 'selected="selected"';} ?>>01</option>
               <option value="02" <?php if($found['monthEnd'] == '02'){echo 'selected="selected"';} ?>>02</option>
               <option value="03" <?php if($found['monthEnd'] == '03'){echo 'selected="selected"';} ?>>03</option>
               <option value="04" <?php if($found['monthEnd'] == '04'){echo 'selected="selected"';} ?>>04</option>
               <option value="05" <?php if($found['monthEnd'] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="06" <?php if($found['monthEnd'] == '06'){echo 'selected="selected"';} ?>>06</option>
               <option value="07" <?php if($found['monthEnd'] == '07'){echo 'selected="selected"';} ?>>07</option>
               <option value="08" <?php if($found['monthEnd'] == '08'){echo 'selected="selected"';} ?>>08</option>
               <option value="09" <?php if($found['monthEnd'] == '09'){echo 'selected="selected"';} ?>>09</option>
               <option value="10" <?php if($found['monthEnd'] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($found['monthEnd'] == '11'){echo 'selected="selected"';} ?>>11</option>
               <option value="12" <?php if($found['monthEnd'] == '12'){echo 'selected="selected"';} ?>>12</option>
            </select>
            
            <select class="form-control" name="dayEnd">
               <option value="01" <?php if($found['dayEnd'] == '01'){echo 'selected="selected"';} ?>>01</option>
               <option value="02" <?php if($found['dayEnd'] == '02'){echo 'selected="selected"';} ?>>02</option>
               <option value="03" <?php if($found['dayEnd'] == '03'){echo 'selected="selected"';} ?>>03</option>
               <option value="04" <?php if($found['dayEnd'] == '04'){echo 'selected="selected"';} ?>>04</option>
               <option value="05" <?php if($found['dayEnd'] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="06" <?php if($found['dayEnd'] == '06'){echo 'selected="selected"';} ?>>06</option>
               <option value="07" <?php if($found['dayEnd'] == '07'){echo 'selected="selected"';} ?>>07</option>
               <option value="08" <?php if($found['dayEnd'] == '08'){echo 'selected="selected"';} ?>>08</option>
               <option value="09" <?php if($found['dayEnd'] == '09'){echo 'selected="selected"';} ?>>09</option>
               <option value="10" <?php if($found['dayEnd'] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($found['dayEnd'] == '11'){echo 'selected="selected"';} ?>>11</option>
               <option value="12" <?php if($found['dayEnd'] == '12'){echo 'selected="selected"';} ?>>12</option>
               <option value="13" <?php if($found['dayEnd'] == '13'){echo 'selected="selected"';} ?>>13</option>
               <option value="14" <?php if($found['dayEnd'] == '14'){echo 'selected="selected"';} ?>>14</option>
               <option value="15" <?php if($found['dayEnd'] == '15'){echo 'selected="selected"';} ?>>15</option>
               <option value="16" <?php if($found['dayEnd'] == '16'){echo 'selected="selected"';} ?>>16</option>
               <option value="17" <?php if($found['dayEnd'] == '17'){echo 'selected="selected"';} ?>>17</option>
               <option value="18" <?php if($found['dayEnd'] == '18'){echo 'selected="selected"';} ?>>18</option>
               <option value="19" <?php if($found['dayEnd'] == '19'){echo 'selected="selected"';} ?>>19</option>
               <option value="20" <?php if($found['dayEnd'] == '20'){echo 'selected="selected"';} ?>>20</option>
               <option value="21" <?php if($found['dayEnd'] == '21'){echo 'selected="selected"';} ?>>21</option>
               <option value="22" <?php if($found['dayEnd'] == '22'){echo 'selected="selected"';} ?>>22</option>
               <option value="23" <?php if($found['dayEnd'] == '23'){echo 'selected="selected"';} ?>>23</option>
               <option value="24" <?php if($found['dayEnd'] == '24'){echo 'selected="selected"';} ?>>24</option>
               <option value="25" <?php if($found['dayEnd'] == '25'){echo 'selected="selected"';} ?>>25</option>
               <option value="26" <?php if($found['dayEnd'] == '26'){echo 'selected="selected"';} ?>>26</option>
               <option value="27" <?php if($found['dayEnd'] == '27'){echo 'selected="selected"';} ?>>27</option>
               <option value="28" <?php if($found['dayEnd'] == '28'){echo 'selected="selected"';} ?>>28</option>
               <option value="29" <?php if($found['dayEnd'] == '29'){echo 'selected="selected"';} ?>>29</option>
               <option value="30" <?php if($found['dayEnd'] == '30'){echo 'selected="selected"';} ?>>30</option>
               <option value="31" <?php if($found['dayEnd'] == '31'){echo 'selected="selected"';} ?>>31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearEnd" placeholder="Year" required value="<?php echo $found['yearEnd']; ?>">
        </div>
    </div>
    
    <br>
    
    <?php
	// BREAK THE TIME INTO SEPERATE PIECES
		$myArray1 = explode(':', $found['endTime']);
	?>
    
    <label for="month">End Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourEnd">
               <option value="01" <?php if($myArray1[0] == 'T01' || $myArray1[0] == 'T13'){echo 'selected="selected"';} ?>>1</option>
               <option value="02" <?php if($myArray1[0] == 'T02' || $myArray1[0] == 'T14'){echo 'selected="selected"';} ?>>2</option>
               <option value="03" <?php if($myArray1[0] == 'T03' || $myArray1[0] == 'T15'){echo 'selected="selected"';} ?>>3</option>
               <option value="04" <?php if($myArray1[0] == 'T04' || $myArray1[0] == 'T16'){echo 'selected="selected"';} ?>>4</option>
               <option value="05" <?php if($myArray1[0] == 'T05' || $myArray1[0] == 'T17'){echo 'selected="selected"';} ?>>5</option>
               <option value="06" <?php if($myArray1[0] == 'T06' || $myArray1[0] == 'T18'){echo 'selected="selected"';} ?>>6</option>
               <option value="07" <?php if($myArray1[0] == 'T07' || $myArray1[0] == 'T19'){echo 'selected="selected"';} ?>>7</option>
               <option value="08" <?php if($myArray1[0] == 'T08' || $myArray1[0] == 'T20'){echo 'selected="selected"';} ?>>8</option>
               <option value="09" <?php if($myArray1[0] == 'T09' || $myArray1[0] == 'T21'){echo 'selected="selected"';} ?>>9</option>
               <option value="10" <?php if($myArray1[0] == 'T10' || $myArray1[0] == 'T22'){echo 'selected="selected"';} ?>>10</option>
               <option value="11" <?php if($myArray1[0] == 'T11' || $myArray1[0] == 'T23'){echo 'selected="selected"';} ?>>11</option>
               <option value="00" <?php if($myArray1[0] == 'T00' || $myArray1[0] == 'T12'){echo 'selected="selected"';} ?>>12</option>
            </select>
            
            <select class="form-control" name="minEnd">
               <option value="00" <?php if($myArray1[1] == '00'){echo 'selected="selected"';} ?>>00</option>
               <option value="05" <?php if($myArray1[1] == '05'){echo 'selected="selected"';} ?>>05</option>
               <option value="10" <?php if($myArray1[1] == '10'){echo 'selected="selected"';} ?>>10</option>
               <option value="15" <?php if($myArray1[1] == '15'){echo 'selected="selected"';} ?>>15</option>
               <option value="20" <?php if($myArray1[1] == '20'){echo 'selected="selected"';} ?>>20</option>
               <option value="25" <?php if($myArray1[1] == '25'){echo 'selected="selected"';} ?>>25</option>
               <option value="30" <?php if($myArray1[1] == '30'){echo 'selected="selected"';} ?>>30</option>
               <option value="35" <?php if($myArray1[1] == '35'){echo 'selected="selected"';} ?>>35</option>
               <option value="40" <?php if($myArray1[1] == '40'){echo 'selected="selected"';} ?>>40</option>
               <option value="45" <?php if($myArray1[1] == '45'){echo 'selected="selected"';} ?>>45</option>
               <option value="50" <?php if($myArray1[1] == '50'){echo 'selected="selected"';} ?>>50</option>
               <option value="55" <?php if($myArray1[1] == '55'){echo 'selected="selected"';} ?>>55</option>
            </select>
            
            <select class="form-control" name="ampmEnd">
               <option value="am"
				<?php
					if($myArray1[0] == 'T01' || $myArray1[0] == 'T02') {
						echo 'selected="selected"';
						}
						else if($myArray1[0] == 'T03' || $myArray1[0] == 'T04') {
								echo 'selected="selected"';
							}
							else if($myArray1[0] == 'T05' || $myArray1[0] == 'T06') {
									echo 'selected="selected"';
								}
								else if($myArray1[0] == 'T07' || $myArray1[0] == 'T08') {
									echo 'selected="selected"';
									}
									else if($myArray1[0] == 'T09' || $myArray1[0] == 'T10') {
										echo 'selected="selected"';
										}
										else if($myArray1[0] == 'T11' || $myArray1[0] == 'T00') {
											echo 'selected="selected"';
											}
											else {
												$pmCheck1 = true;
												}
												?>>am</option>
               <option value="pm"<?php if($pmCheck1 == true) {echo 'selected="selected"';} ?>>pm</option>
            </select>
    
        </div>
    </div>
    <br>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update <?php echo $found['courseTitle']; ?></button>
</form>

<?php require_once('footer.php'); ?>