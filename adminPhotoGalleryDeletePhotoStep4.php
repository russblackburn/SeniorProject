<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	
	$photo_id = $_GET[id];
	$subcategoryID = $_GET[subcategoryID];
	$n1 = $_GET[n1];
	$n2 = $_GET[n2];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoGallery WHERE id=$photo_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery9;
?>
<?php require_once('header.php'); ?>

<p><a href="adminPhotoGalleryDeletePhoto.php">Select the Photo's Category</a> ><a href="adminPhotoGalleryDeletePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Photo's Subcategory</a> ><a href="adminPhotoGalleryDeletePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Photo</a> > Delete the Photo</p>

<h1>Delete a Photo</h1>

<hr>

<h3>Delete the Photo</h3>


<label for="oldImage">Photo</label>
<div class="row">
<img class="paddingBottom col-xs-12 col-sm-6 col-md-4" src="images/gallery/photo/photo/<?php echo $found['photo'];?>">
</div>


<a href="adminPhotoGalleryDeletePhotoStep5.php?id=<?php echo $photo_id;?>&subcategoryID=<?php echo $subcategory_id; ?>&n1=<?php echo $n1; ?>&n2=<?php echo $n2; ?>" type="submit" name="submit">[delete]</a>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>