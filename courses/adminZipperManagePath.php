<?php
require_once('../adminAuthorize.php');
require_once('../adminVariables.php');

$page = admin;
$adminPage = zip;
$adminSecondaryPage = zip3;
require_once('../header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM courseContent ORDER BY contentTitle";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Manage Course Content Path</h1>

<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo '<p>';
	echo $row['contentTitle'];
	echo ' - ';
	echo '<a href="'.$row['fullURL'].'" target="_blank">';
	echo $row['fullURL'];
	echo '</a>';
	echo '&nbsp; - &nbsp;';
	echo ' <a href="adminZipperManagePathDetail.php?id='. $row['id'].'">[manage]</a>';
	echo '</p>';
	};

//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('../footer.php'); ?>