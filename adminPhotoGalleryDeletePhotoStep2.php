<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin;
	$adminPage = gallery;
	$adminSecondaryPage = gallery9;
	require_once('header.php');
	
	
	
	if($_GET[n1] == NULL){
	$category_id = $_GET[id];
	}else{
		$category_id = $_GET[n1];	
	}
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoSubcategory WHERE categoryID=$category_id ORDER BY subcategory ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<p><a href="adminPhotoGalleryDeletePhoto.php">Select the Photo's Category</a> > Select the Photo's Subcategory</p>

<h1>Delete a Photo</h1>

<hr>

<h3>Select the Photo's Subcategory</h3>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['subcategory'];
	echo ' <a href="adminPhotoGalleryDeletePhotoStep3.php?id='. $row['id'].'&n1='.$category_id.'">[select]</a>';
	echo'</p>';
	};
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>