<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current mission statement
$query = "SELECT * FROM mission_statement";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

// when submit is pressed
if(isset($_POST['submitButton'])){
	// pull the items from the form
	$id = $_POST[id];
	$mission_statement = mysqli_real_escape_string($dbc, trim($_POST[mission_statement]));
	
	// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//build the query
	$query = "UPDATE mission_statement SET mission_statement='$mission_statement' WHERE id=$id ";
	
	// talk with the database
	$result = mysqli_query($dbc, $query) or die('your query has failed');
	
	// terminate the connection
	mysqli_close($dbc);
	
	header('Location: adminLanding.php');

}

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update Mission Statement</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_mission_statement">
  
  <div class="form-group">
    <label for="missionStatement">Mission Statement</label>
    <textarea class="form-control" rows="3" name="mission_statement" placeholder="Mission Statement"><?php echo $found['mission_statement']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update</button>
</form>

<?php require_once('footer.php'); ?>