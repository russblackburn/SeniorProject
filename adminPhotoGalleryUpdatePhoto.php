<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminRuss.php');
	$page = admin; 
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoCategory ORDER BY category ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<p>Select the Photo's Category</p>

<h1>Update a Photo</h1>

<hr>

<h3>Select the Photo's Category</h3>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['category'];
	echo ' <a href="adminPhotoGalleryUpdatePhotoStep2.php?id='. $row['id'].'">[select]</a>';
	echo'</p>';
	};
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>