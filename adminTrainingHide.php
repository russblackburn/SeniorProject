<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin; 
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM coreCourse ORDER BY courseTitle ASC";
	$query2 = "SELECT * FROM thirdPartyCourse ORDER BY courseTitle ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	$result2 = mysqli_query($dbc, $query2) or die('query failed 2');
?>

<h1>Hide/Un-hide a Course</h1>

<hr>

<h3>Core Courses</h3>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['courseTitle'];
	echo ' is currently ';
	if($row['hide'] == T){ echo 'hidden';}else{echo 'visible';}
	echo ' <a href="adminTrainingHideConfCore.php?id='. $row['id'].'">[select]</a>';
	echo'</p>';
	};
?>

<h3>Third Party Courses</h3>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result2)){
	echo'<p>';
	echo $row['courseTitle'];
	echo ' is currently ';
	if($row['hide'] == T){ echo 'hidden';}else{echo 'visible';}
	echo ' <a href="adminTrainingHideConfThirParty.php?id='. $row['id'].'">[select]</a>';
	echo'</p>';
	};
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>