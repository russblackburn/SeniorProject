<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin; 
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query0 = "SELECT * FROM coreCourse WHERE hide='F' ORDER BY id DESC";

	//communicate with the database
	$result0 = mysqli_query($dbc, $query0) or die('The query has failed! 0');
	
	// build the query to display the categories statement
	$query1 = "SELECT * FROM thirdPartyCourse WHERE hide='F' ORDER BY id DESC";

	//communicate with the database
	$result1 = mysqli_query($dbc, $query1) or die('The query has failed! 0');
	
	
	
	// upload a core course event
	if(isset($_POST['submitButton']))
	{
		$courseID = mysqli_real_escape_string($dbc, trim($_POST[courseID]));
		
				// build the url for the specific choosen course
				$url = 'coreCourseDetail.php?id='.$courseID.'';
		
		// build the query to display the categories statement
		$query = "SELECT * FROM coreCourse WHERE id=$courseID";
	
		//communicate with the database
		$result = mysqli_query($dbc, $query) or die('The query has failed! 1');
		
		//put what is found from the query into a variable
		$found = mysqli_fetch_array($result);
		
		// load the data from the form
		$courseTitle = $found[courseTitle];
		$monthStart = mysqli_real_escape_string($dbc, trim($_POST[monthStart]));
		$dayStart = mysqli_real_escape_string($dbc, trim($_POST[dayStart]));
		$yearStart = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearStart])));
		$monthEnd = mysqli_real_escape_string($dbc, trim($_POST[monthEnd]));
		$dayEnd = mysqli_real_escape_string($dbc, trim($_POST[dayEnd]));
		$yearEnd = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearEnd])));
		$thirdParty = '1';
		
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
		
		// build the query
		$query = "INSERT INTO events (courseTitle, monthStart, dayStart, yearStart, startTime, monthEnd, dayEnd, yearEnd, endTime, url, courseID, thirdParty)". "VALUES ('$courseTitle','$monthStart','$dayStart','$yearStart','$startTime','$monthEnd','$dayEnd','$yearEnd','$endTime','$url','$courseID','$thirdParty')";
		
		// communicate the query with the database
		$result = mysqli_query($dbc, $query) or die('The databse query has failed! 2');
		
		// terminate the connection with the database
		mysqli_close($dbc);
		
		$feedback = '<p class="adminGreen">You have added a Core Course event to the calendar. <a href="events.php">&#8617; View EVENTS Page</a></p>';
		
	};//end of if submit/isset
	
	
	// upload a third party course event
	if(isset($_POST['submit']))
	{
		$courseID = mysqli_real_escape_string($dbc, trim($_POST[courseID]));
		
				// build the url for the specific choosen course
				$url = 'thirdPartyCourseDetail.php?id='.$courseID.'';
		
		// build the query to display the categories statement
		$query = "SELECT * FROM thirdPartyCourse WHERE id=$courseID";
	
		//communicate with the database
		$result = mysqli_query($dbc, $query) or die('The query has failed! 1');
		
		//put what is found from the query into a variable
		$found = mysqli_fetch_array($result);
		
		// load the data from the form
		$courseTitle = $found[courseTitle];
		$monthStart = mysqli_real_escape_string($dbc, trim($_POST[monthStart]));
		$dayStart = mysqli_real_escape_string($dbc, trim($_POST[dayStart]));
		$yearStart = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearStart])));
		$monthEnd = mysqli_real_escape_string($dbc, trim($_POST[monthEnd]));
		$dayEnd = mysqli_real_escape_string($dbc, trim($_POST[dayEnd]));
		$yearEnd = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearEnd])));
		$thirdParty = '2';
		
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
		
		// build the query
		$query = "INSERT INTO events (courseTitle, monthStart, dayStart, yearStart, startTime, monthEnd, dayEnd, yearEnd, endTime, url, courseID, thirdParty)". "VALUES ('$courseTitle','$monthStart','$dayStart','$yearStart','$startTime','$monthEnd','$dayEnd','$yearEnd','$endTime','$url','$courseID','$thirdParty')";
		
		// communicate the query with the database
		$result = mysqli_query($dbc, $query) or die('The databse query has failed! 2');
		
		// terminate the connection with the database
		mysqli_close($dbc);
		
		$feedback = '<p class="adminGreen">You have added a Third Party event to the calendar. <a href="events.php">&#8617; View EVENTS Page</a></p>';
		
	};//end of if submit/isset
	
	
	
	
	// upload a custom event
	if(isset($_POST['submitCustom']))
	{
		// load the data from the form
		$courseTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[courseTitle])));
		$monthStart = mysqli_real_escape_string($dbc, trim($_POST[monthStart]));
		$dayStart = mysqli_real_escape_string($dbc, trim($_POST[dayStart]));
		$yearStart = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearStart])));
		$monthEnd = mysqli_real_escape_string($dbc, trim($_POST[monthEnd]));
		$dayEnd = mysqli_real_escape_string($dbc, trim($_POST[dayEnd]));
		$yearEnd = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[yearEnd])));
		$thirdParty = '3';
		
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
		
		// build the query
		$query = "INSERT INTO events (courseTitle, monthStart, dayStart, yearStart, startTime, monthEnd, dayEnd, yearEnd, endTime, url, courseID, thirdParty)". "VALUES ('$courseTitle','$monthStart','$dayStart','$yearStart','$startTime','$monthEnd','$dayEnd','$yearEnd','$endTime','$url','$courseID','$thirdParty')";
		
		// communicate the query with the database
		$result = mysqli_query($dbc, $query) or die('The databse query has failed! 2');
		
		// terminate the connection with the database
		mysqli_close($dbc);
		
		$feedback = '<p class="adminGreen">You have added a custom event to the calendar. <a href="events.php">&#8617; View EVENTS Page</a></p>';
		
	};//end of if submit/isset
	?>

<h1>Add a New Event</h1>

<hr>

<h2>Core Courses</h2>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_event">
  
  <div class="form-group">
    	<label for="courseTitle">Select a Course</label>
        <select class="form-control" name="courseID">
        <?php
        while($row0 = mysqli_fetch_array($result0)){
            echo '<option value="'.$row0['id'].'">'.$row0['courseTitle'].'</option>';
		}
		?>
        </select>
    </div>
    
    
    
    <h3>Start Date and Time</h3>
    <label for="month">Start Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthStart">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayStart">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearStart" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">Start Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourStart">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10" selected="selected">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minStart">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmStart">
               <option value="am" selected="selected">am</option>
               <option value="pm">pm</option>
            </select>
    
        </div>
    </div>
    
    <br>
    
    <h3>End Date and Time</h3>
    <label for="month">End Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthEnd">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayEnd">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearEnd" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">End Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourEnd">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05" selected="selected">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minEnd">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmEnd">
               <option value="am">am</option>
               <option value="pm" selected="selected">pm</option>
            </select>
    
        </div>
    </div>
    <br>
  <button type="submit" class="btn btn-default" name="submitButton">Add Core Course Event</button>
</form>

<br>
<br>



<!-- start the form for the third party courses -->






<h2>Third Party Courses</h2>

<hr>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_event">
  
  <div class="form-group">
    	<label for="courseTitle">Select a Course</label>
        <select class="form-control" name="courseID">
        <?php
        while($row1 = mysqli_fetch_array($result1)){
            echo '<option value="'.$row1['id'].'">'.$row1['courseTitle'].'</option>';
		}
		?>
        </select>
    </div>
    
    
    
    <h3>Start Date and Time</h3>
    <label for="month">Start Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthStart">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayStart">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearStart" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">Start Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourStart">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10" selected="selected">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minStart">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmStart">
               <option value="am" selected="selected">am</option>
               <option value="pm">pm</option>
            </select>
    
        </div>
    </div>
    
    <br>
    
    <h3>End Date and Time</h3>
    <label for="month">End Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthEnd">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayEnd">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearEnd" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">End Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourEnd">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05" selected="selected">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minEnd">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmEnd">
               <option value="am">am</option>
               <option value="pm" selected="selected">pm</option>
            </select>
    
        </div>
    </div>
    <br>
  <button type="submit" class="btn btn-default" name="submit">Add Third Party Course Event</button>
</form>









<!-- start the form for the other events that are custom -->


<br>
<br>



<h2>Custom Events</h2>

<hr>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_event">
  
  <div class="form-group">
    <label for="customTitle">Custom Title</label>
    <input type="text" class="form-control" id="firstName" name="courseTitle" placeholder="Custom Title">
  </div>
    
    
    
    <h3>Start Date and Time</h3>
    <label for="month">Start Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthStart">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayStart">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearStart" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">Start Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourStart">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10" selected="selected">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minStart">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmStart">
               <option value="am" selected="selected">am</option>
               <option value="pm">pm</option>
            </select>
    
        </div>
    </div>
    
    <br>
    
    <h3>End Date and Time</h3>
    <label for="month">End Date: Month - Day - Year</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="monthEnd">
               <option>Month</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
            </select>
            
            <select class="form-control" name="dayEnd">
               <option>Day</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
            </select>
    
        	<input type="text" class="form-control" id="year" name="yearEnd" placeholder="Year" required>
        </div>
    </div>
    
    <br>
    
    <label for="month">End Time</label>
    <div class="form-inline">
        <div class="form-group">
            <select class="form-control" name="hourEnd">
               <option value="01">1</option>
               <option value="02">2</option>
               <option value="03">3</option>
               <option value="04">4</option>
               <option value="05" selected="selected">5</option>
               <option value="06">6</option>
               <option value="07">7</option>
               <option value="08">8</option>
               <option value="09">9</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="00">12</option>
            </select>
            
            <select class="form-control" name="minEnd">
               <option value="00" selected="selected">00</option>
               <option value="05">05</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="25">25</option>
               <option value="30">30</option>
               <option value="35">35</option>
               <option value="40">40</option>
               <option value="45">45</option>
               <option value="50">50</option>
               <option value="55">55</option>
            </select>
            
            <select class="form-control" name="ampmEnd">
               <option value="am">am</option>
               <option value="pm" selected="selected">pm</option>
            </select>
    
        </div>
    </div>
    <br>
  <button type="submit" class="btn btn-default" name="submitCustom">Add Custom Event</button>
</form>

<?php require_once('footer.php'); ?>