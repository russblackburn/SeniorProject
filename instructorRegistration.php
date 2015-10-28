<?php $page = register; ?>
<?php $secondaryPage = instructorRegistration; ?>
<?php require_once('header.php');
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM register WHERE id='2'";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<div class="pagePadding">
<h1>Instructor Registration</h1>
<hr>

<?php
if($found['description'] != NULL) {
	// CHECK description
	echo '<p>'.$found['description'].'</p>';
	echo '<hr>';
}
?>

<!-- begin form -->
<?php
require_once('instructorRegistrationForm.php');
?>

</div><!-- end of pagePadding -->

<?php
	// terminate the connection
	mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>