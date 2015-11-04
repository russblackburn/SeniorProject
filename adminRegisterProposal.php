<?php
	require_once('adminAuthorize.php');
	require_once('adminVariables.php');
	
	// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// when submit is pressed
	if(isset($_POST['submitButton'])){
		// pull the items from the form
		$id = $_POST[id];
		$description = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[description])));
		
		//build the query
		$query = "UPDATE register SET description='$description' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed');
		
		$feedback = '<p class="adminGreen">The Request Service Proposal has been updated. <a href="requestServiceProposal.php">&#8617; View REQUEST SERVICE PROPOSAL Page</a></p>';
	}//end of if submit/isset
	
	// build the query to display the current mission statement
	$query01 = "SELECT * FROM register WHERE id='3'";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = register;
$adminSecondaryPage = register3;
?>
<?php require_once('header.php'); ?>

<h1>Update Request Service Proposal Description</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_instructor_registration">
  
  <div class="form-group">
    <label for="description" data-toggle="popover" title="Description" data-content="Description or instructions to register. If there is no needed description, leave this blank.">Description</label>
    <textarea class="form-control" rows="3" name="description" placeholder="Description"><?php echo $found['description']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update</button>
</form>

<?php require_once('footer.php'); ?>