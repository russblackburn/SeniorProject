<?php 
//CHANGE LOCATION REDIRECT - CHANGE ADMINJAKE.PHP TO NEW DB
	require_once('adminAuthorize.php');
	require_once('adminJake.php');  

	$faq_id = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		
		//BUILD A SELECT QUERY
		$query = "DELETE FROM faq WHERE id=$_POST[id]";
		
		
		//TRY AND DELETE THE RECORD
		$result = mysqli_query($dbc, $query) or die('delete query failed'); 
	
		
		//REDIRECT
		header("Location: adminFAQDelete.php");
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM faq WHERE id=$faq_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
?>

<?php

	$page = admin; 
	require_once('header.php');

?>

<h1>Delete FAQ Confirmation</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php
//DISPLAY WHAT WE FOUND

	echo '<h3>';
	echo '<strong>Question: </strong>'.$found['question'];
	echo '</h3>';
	
	echo '<h3>';
	echo '<strong>Answer: </strong>'.$found['answer'];
	echo '</h3><br>';

?>

<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminFAQDelete.php"> Cancel</a>
</fieldset>
</form>


<?php require_once('footer.php'); ?>