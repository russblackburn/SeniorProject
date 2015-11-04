<?php
require_once('../adminAuthorize.php');
require_once('../adminVariables.php');
	
	$courseContentID = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		// load the data from the form
		$id = $_POST[id];
		$contentTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[contentTitle])));
		$fullURL = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[fullURL])));
	
		//build the query
		$query = "UPDATE courseContent SET contentTitle='$contentTitle', fullURL='$fullURL' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">The path has been updated. <a href="adminZipperManagePath.php">&#8617; Manage Path List</a></p>';
		
		};//end of isset
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM courseContent WHERE id=$courseContentID";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
	
	// terminate the connection with the database
	mysqli_close($dbc);
?>

<?php
$page = admin;
$adminPage = zip;
$adminSecondaryPage = zip3;
require_once('../header.php'); 
?>

<h1>Manage Path for <?php echo $found['contentTitle'] ?></h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php //DISPLAY WHAT WE FOUND ?>

<div class="form-group">
    <label for="title" data-toggle="popover" title="Content Title" data-content="Give the content a title." required>Content Title</label>
    <input type="text" class="form-control" id="contentTitle" name="contentTitle" placeholder="Content Title" value="<?php echo $found['contentTitle']; ?>">
  </div>

<div class="form-group">
    <label for="customTarget" data-toggle="popover" title="Path" data-content="Manage the path for the zip file manually.">Path</label>
    <input type="text" class="form-control" id="path" name="fullURL" placeholder="Path" value="<?php echo $found['fullURL']; ?>">
  </div>



<input type="hidden" name="id" value="<?php echo $found['id'];?>">
<input type="submit" class="btn btn-primary" name="submit" value="Update">
&nbsp; <a href="adminZipperManagePath.php"> Cancel</a>
</fieldset>
</form>


<?php require_once('../footer.php'); ?>