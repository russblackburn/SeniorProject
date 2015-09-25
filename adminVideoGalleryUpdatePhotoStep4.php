<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminRuss.php');
	
	$photo_id = $_GET[id];
	$subcategoryID = $_GET[subcategoryID];
	$n1 = $_GET[n1];
	$n2 = $_GET[n2];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM videoGallery WHERE id=$photo_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$videoLink = mysqli_real_escape_string($dbc, trim($_POST[videoLink]));
	$videoDescription = mysqli_real_escape_string($dbc, trim($_POST[videoDescription]));
	
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE videoGallery SET videoLink='$videoLink', videoDescription='$videoDescription' WHERE id=$id";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		header('Location: adminVideoGalleryUpdatePhotoStep3.php?id='.$n2.'&n1='.$n1.'');
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<p><a href="adminVideoGalleryUpdateVideo.php">Select the Video's Category</a> ><a href="adminVideoGalleryUpdatePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Video's Subcategory</a> ><a href="adminVideoGalleryUpdatePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Video</a> > Update the Video</p>

<h1>Update a Video</h1>

<hr>

<h3>Update the Video</h3>


<label for="oldVideo">Old Video</label>
<div class="row">
<p><?php echo $found['videoLink']; ?></p>
</div>

<br>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_video">

<div class="form-group">
    <label for="videoLink">Video Link</label>
    <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Video Link" value="<?php echo $found['videoLink']; ?>">
  </div>
  
  <div class="form-group">
    <label for="photoDescription">Video Description</label>
    <textarea class="form-control" rows="2" name="videoDescription" placeholder="Video Description"><?php echo $found['videoDescription']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="getSubcategoryID" value="<?php echo $subcategoryID; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update</button>
</form>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>