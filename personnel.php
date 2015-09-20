<?php 
	$page = about;
	$secondaryPage = personnel;
	require_once('adminJake.php');
	require_once('header.php');

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM personnel ORDER BY priority";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');

?>

<h1>Personnel</h1>

<hr>

<?php

	//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
		echo '<figure>';
		echo '<a href="details.php?id='. $row['id'].'">';
		echo '<img src="images/personnel/'.$row['photo'].'" alt="'.$row['first_name'].' '.$row['last_name'].'" width="280" height="415">';
		echo '</a>';
  		echo '<figcaption>'.$row['first_name'].' '.$row['last_name'].'|'.$row['qualifications'].'</figcaption>';
		echo '</figure>';
	};

	//WE'RE DONE SO HANG UP
	mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>