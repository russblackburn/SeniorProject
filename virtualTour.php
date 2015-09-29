<?php 
	$page = gallery;
	$secondaryPage = virtualTour;
	require_once('adminVariables.php');
	require_once('header.php');

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM virtualTour";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');

?>

<h1>Virtual Tour</h1>

<hr>

<?php

	//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
		echo '<p>';
		echo $row['description'];
		echo '</p>';
	};

	//WE'RE DONE SO HANG UP
	mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>