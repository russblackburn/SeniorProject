<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminRuss.php');
	$page = admin; 
	require_once('header.php');
	
	$subcategory_id = $_GET[id];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoGallery WHERE subcategoryID=$subcategory_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Update a Photo</h1>

<hr>

<h3>Select the Photo</h3>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo ' <a href="adminPhotoGalleryUpdatePhotoStep4.php?id='. $row['id'].'"><img src="images/gallery/photo/photo/'.$row['photo'].'"></a>';
	echo'</p>';
	};
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>