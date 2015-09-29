<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin; 
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM newResearch ORDER BY researchTitle ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Delete Research</h1>

<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['researchTitle'];
	echo ' <a href="adminResearchDeleteConf.php?id='. $row['id'].'">[delete]</a>';
	echo'</p>';
	};

//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>