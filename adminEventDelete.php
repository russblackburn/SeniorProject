<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin; 
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// BUILD THE QUERY FOR CORE COURSES
		//BUILD THE QUERY
		$query1 = "SELECT * FROM events WHERE thirdParty='1' ORDER BY courseTitle ASC, dateOrder ASC";
	
		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
	// BUILD THE QUERY FOR THIRD PARTY COURSES
		//BUILD THE QUERY
		$query2 = "SELECT * FROM events WHERE thirdParty='2' ORDER BY courseTitle ASC, dateOrder ASC";
	
		//TRY AND TALK TO THE DB
		$result2 = mysqli_query($dbc, $query2) or die('query failed');
		
	// BUILD THE QUERY FOR CUSTOM EVENTS
		//BUILD THE QUERY
		$query3 = "SELECT * FROM events WHERE thirdParty='3' ORDER BY courseTitle ASC, dateOrder ASC";
	
		//TRY AND TALK TO THE DB
		$result3 = mysqli_query($dbc, $query3) or die('query failed');
?>

<h1>Select Event To Delete</h1>

<hr>


<!-- core courses -->
<h2>Core Courses</h2>
<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row1 = mysqli_fetch_array($result1)){
	echo'<p>';
	echo $row1['courseTitle'].' | '.$row1['monthStart'].'-'.$row1['dayStart'].'-'.$row1['yearStart'].' <span class="adminGray">('.$row1['startTime'].')</span>';
	echo ' | ';
	echo $row1['monthEnd'].'-'.$row1['dayEnd'].'-'.$row1['yearEnd'].' <span class="adminGray">('.$row1['endTime'].')</span>';
	echo ' <a href="adminEventDeleteDetail.php?id='. $row1['id'].'">[delete]</a>';
	echo'</p>';
	};
?>

<br>

<!-- third party courses -->
<h2>Third Party Courses</h2>
<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row2 = mysqli_fetch_array($result2)){
	echo'<p>';
	echo $row2['courseTitle'].' | '.$row2['monthStart'].'-'.$row2['dayStart'].'-'.$row2['yearStart'].' <span class="adminGray">('.$row2['startTime'].')</span>';
	echo ' | ';
	echo $row2['monthEnd'].'-'.$row2['dayEnd'].'-'.$row2['yearEnd'].' <span class="adminGray">('.$row2['endTime'].')</span>';
	echo ' <a href="adminEventDeleteDetail.php?id='. $row2['id'].'">[delete]</a>';
	echo'</p>';
	};
?>

<br>

<!-- custom events -->
<h2>Custom Events</h2>
<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row3 = mysqli_fetch_array($result3)){
	echo'<p>';
	echo $row3['courseTitle'].' | '.$row3['monthStart'].'-'.$row3['dayStart'].'-'.$row3['yearStart'].' <span class="adminGray">('.$row3['startTime'].')</span>';
	echo ' | ';
	echo $row3['monthEnd'].'-'.$row3['dayEnd'].'-'.$row3['yearEnd'].' <span class="adminGray">('.$row3['endTime'].')</span>';
	echo ' <a href="adminEventDeleteDetail.php?id='. $row3['id'].'">[delete]</a>';
	echo'</p>';
	};
?>

<?php //WE'RE DONE SO HANG UP
mysqli_close($dbc); ?>
<?php require_once('footer.php'); ?>