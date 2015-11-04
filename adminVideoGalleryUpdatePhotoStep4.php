<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	
	$photo_id = $_GET[id];
	$subcategoryID = $_GET[subcategoryID];
	$n1 = $_GET[n1];
	$n2 = $_GET[n2];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	// PREPARE THE VIDEOLINK FOR UPLOAD TO THE DATABASE
	$string = $_POST[videoLink];
	$string = stripslashes($string);
	$newstring = str_ireplace('<iframe width="560" height="315"', '', $string);
	$newstring = str_ireplace('frameborder="0" allowfullscreen></iframe>', '', $newstring);
	
	// load the data from the form
	$id = $_POST[id];
	$videoLink = mysqli_real_escape_string($dbc, trim($newstring));
	$videoDescription = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[videoDescription])));
		
		//build the query
		$query = "UPDATE videoGallery SET videoLink='$videoLink', videoDescription='$videoDescription' WHERE id=$id";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">The video has been updated. <a href="videos.php">&#8617; View VIDEOS Page</a></p>';
	
	};//end of if submit/isset
	
	//BUILD THE QUERY
	$query01 = "SELECT * FROM videoGallery WHERE id=$photo_id";

	//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery15;
?>
<?php require_once('header.php'); ?>

<p><a href="adminVideoGalleryUpdateVideo.php">Select the Video's Category</a> ><a href="adminVideoGalleryUpdatePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Video's Subcategory</a> ><a href="adminVideoGalleryUpdatePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Video</a> > Update the Video</p>

<h1>Update a Video</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>


<h3>Update the Video</h3>


<label for="oldVideo" data-toggle="popover" title="Old Video" data-content="This is the current video being used. If the video does not need to be updated, skip the video link section.">Old Video</label>
<?php
	echo '<div class="centeriFrame">';
	echo '<iframe class="videoiFrame paddingTop"'. $found['videoLink'].' frameborder="0" allowfullscreen></iframe>';
	echo '</div><!-- end of centeriFrame -->';
?>

<br>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_video">

<div class="form-group">
    <label for="videoLink" data-toggle="popover" title="Video Link" data-content="Copy and paste the embed link from the YouTube video. To find the embed link click SHARE then EMBED. If there are problems uploading a video, only copy the src section of the embed link (i.e. src=&quot;https://www.yo...&quot;). If the video does not need to be updated, skip this section and the current video will be used.">Video Link</label>
    <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Video Link" value="<?php echo htmlentities($found['videoLink']); ?>">
  </div>
  
  <div class="form-group">
    <label for="photoDescription" data-toggle="popover" title="Video Description" data-content="Add a video description. If there is no needed description, leave this blank.">Video Description</label>
    <textarea class="form-control" rows="2" name="videoDescription" placeholder="Video Description"><?php echo $found['videoDescription']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="getSubcategoryID" value="<?php echo $subcategoryID; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update</button>
</form>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>