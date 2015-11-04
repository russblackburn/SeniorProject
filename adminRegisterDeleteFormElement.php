<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin; 
	$adminPage = register;
	$adminSecondaryPage = register6;
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM instructor_form_elements ORDER BY form_element ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Delete a Course/Topic of Interest</h1>

<hr>

<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo'<p>';
	echo $row['form_element'];
	echo ' <a href="adminRegisterDeleteFormElementConf.php?id='. $row['id'].'">[delete]</a>';
	echo'</p>';
	};

//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>