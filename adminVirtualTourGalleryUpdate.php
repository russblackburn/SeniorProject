<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// when submit is pressed
if(isset($_POST['submitButton'])){
	// pull the items from the form
	$id = $_POST[id];
	$virtualTour = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[virtualTour])));
	
	//build the query
	$query = "UPDATE virtualTour SET description='$virtualTour' WHERE id=$id ";
	
	// talk with the database
	$result = mysqli_query($dbc, $query) or die('your query has failed');
	
	$feedback = '<p class="adminGreen">The description has been updated. <a href="virtualTour.php">&#8617; View VIRTUAL TOUR Page</a></p>';

}// end of isset

// build the query to display the current mission statement
$query01 = "SELECT * FROM virtualTour";

//communicate with the database
$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result01);

// terminate the connection
mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery19;
?>
<?php require_once('header.php'); ?>

<h1>Update Virtual Tour Description</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_virtualTour">
  
  <div class="form-group">
    <label for="virtualTour" data-toggle="popover" title="Virtual Tour Description" data-content="Description for the virtual tour. If there is no needed description, leave this blank.">Virtual Tour Description</label>
    <textarea class="form-control" rows="3" name="virtualTour" placeholder="Virtual Tour Description"><?php echo $found['description']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update</button>
</form>

<?php require_once('footer.php'); ?>