<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin;
	$adminPage = gallery;
	$adminSecondaryPage = gallery5;
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoSubcategory ORDER BY subcategory ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Update a Subcategory (Photo)</h1>

<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['subcategory'];
	echo ' <a href="adminPhotoGalleryUpdateSubcategoryDetail.php?id='. $row['id'].'">[update]</a>';
	echo'</p>';
	};
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>