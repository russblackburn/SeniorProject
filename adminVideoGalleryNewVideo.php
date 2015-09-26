<?php
require_once('adminAuthorize.php');
require_once('adminRuss.php');
$page = admin; 
require_once('header.php');

	// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query1 = "SELECT * FROM videoSubcategory ORDER BY id DESC";

	//communicate with the database
	$result1 = mysqli_query($dbc, $query1) or die('The query has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$videoLink = mysqli_real_escape_string($dbc, trim($_POST[videoLink]));
	$videoDescription = mysqli_real_escape_string($dbc, trim($_POST[videoDescription]));
	$subcategoryID = $_POST[subcategoryID];
		
	//upload the information to the database 
	
	// build the query
	$query = "INSERT INTO videoGallery(videoLink, videoDescription, subcategoryID)". 
	"VALUES ('$videoLink','$videoDescription','$subcategoryID')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	echo '<p>';
	echo 'The video is now in the directory.';
	echo '</p>';
	
	};//end of if submit/isset
	
	?>

<h1>Add a New Video</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_video">

	<div class="form-group">
    	<label for="category">Select a Subcategory</label>
        <select class="form-control" name="subcategoryID">
        <?php
        while($row = mysqli_fetch_array($result1)){
            echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
		}
		?>
        </select>
	</div>
    
    <div class="form-group">
    <label for="videoLink">Video Link</label>
    <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Video Link">
  </div>
  
  <div class="form-group">
    <label for="photoDescription">Video Description</label>
    <textarea class="form-control" rows="2" name="videoDescription" placeholder="Video Description"></textarea>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Video</button>
</form>

<?php require_once('footer.php'); ?>