<?php 
//CHANGE LOCATION REDIRECT - CHANGE ADMINJAKE.PHP TO NEW DB
	require_once('adminAuthorize.php');
	require_once('adminVariables.php');  

	$course_id = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		
		//BUILD A SELECT QUERY
		$query = "DELETE FROM coreCourse WHERE id=$_POST[id]";
		
		
		//TRY AND DELETE THE RECORD
		$result = mysqli_query($dbc, $query) or die('delete query failed'); 
		
		@unlink($_POST['photo']);
		@unlink($_POST['photo2']);
	
		
		//REDIRECT
		header("Location: adminTrainingDelete.php");
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM coreCourse WHERE id=$course_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
?>

<?php

	$page = admin; 
	require_once('header.php');

?>

<h1>Delete Core Course Confirmation</h1>
<em>(This will also delete the courses associated slider)</em>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php
//DISPLAY WHAT WE FOUND
echo '<div class="row">';
echo '<img class="col-xs-12 col-sm-6 col-md-4" src="images/training/course/'.$found['photo'].'">';
echo '</div>';
echo '<h2>'.$found['courseTitle']. '</h2>';

?>

<input type="hidden" name="photo" value="images/training/course/<?php echo $found['photo'];?>">
<input type="hidden" name="photo2" value="images/training/slider/<?php echo $found['slide_image'];?>">
<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminTrainingDelete.php"> Cancel</a>
</fieldset>
</form>


<?php require_once('footer.php'); ?>