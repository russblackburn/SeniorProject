<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery12;
require_once('header.php');

	// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query1 = "SELECT * FROM videoSubcategory ORDER BY id DESC";

	//communicate with the database
	$result1 = mysqli_query($dbc, $query1) or die('The query has failed!');

	if(isset($_POST['submitButton']))
	{
	// PREPARE THE VIDEOLINK FOR UPLOAD TO THE DATABASE
	$string = $_POST[videoLink];
	$string = stripslashes($string);
	$newstring = str_ireplace('<iframe width="560" height="315"', '', $string);
	$newstring = str_ireplace('frameborder="0" allowfullscreen></iframe>', '', $newstring);
	
		
	// load the data from the form
	$videoLink = mysqli_real_escape_string($dbc, trim($newstring));
	$videoDescription = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[videoDescription])));
	$subcategoryID = $_POST[subcategoryID];
		
	//upload the information to the database 
	
	// build the query
	$query = "INSERT INTO videoGallery(videoLink, videoDescription, subcategoryID)". 
	"VALUES ('$videoLink','$videoDescription','$subcategoryID')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	$feedback = '<p class="adminGreen">The video is now in the directory. <a href="videos.php">&#8617; View VIDEOS Page</a></p>';
	
	};//end of if submit/isset
	
	?>

<h1>Add a New Video</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_video">

	<div class="form-group">
    	<label for="category" data-toggle="popover" title="Select a Subcategory" data-content="Select the subcategory that you want to link the video too.">Select a Subcategory</label>
        <select class="form-control" name="subcategoryID">
        <?php
        while($row = mysqli_fetch_array($result1)){
            echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
		}
		?>
        </select>
	</div>
    
    <div class="form-group">
    <label for="videoLink" data-toggle="popover" title="Video Link" data-content="Copy and paste the embed link from the YouTube video. To find the embed link click SHARE then EMBED. If there are problems uploading a video, only copy the src section of the embed link (i.e. src=&quot;https://www.yo...&quot;).">Video Link</label>
    <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Video Link">
  </div>
  
  <div class="form-group">
    <label for="photoDescription" data-toggle="popover" title="Video Description" data-content="Add a video description. If there is no needed description, leave this blank.">Video Description</label>
    <textarea class="form-control" rows="2" name="videoDescription" placeholder="Video Description"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary" name="submitButton">Add Video</button>
</form>

<?php require_once('footer.php'); ?>