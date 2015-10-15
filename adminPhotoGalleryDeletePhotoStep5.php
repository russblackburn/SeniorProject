<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	
	$photo_id = $_GET[id];
	$subcategoryID = $_GET[subcategoryID];
	$n1 = $_GET[n1];
	$n2 = $_GET[n2];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		
		//BUILD A SELECT QUERY
		$query = "DELETE FROM photoGallery WHERE id=$_POST[id]";
		
		
		//TRY AND DELETE THE RECORD
		$result = mysqli_query($dbc, $query) or die('delete query failed'); 
		
		@unlink($_POST['photo']);
	
		
		//REDIRECT
		header('Location: adminPhotoGalleryDeletePhotoStep3.php?id='.$n2.'&n1='.$n1.'');
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
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

<p><a href="adminPhotoGalleryDeletePhoto.php">Select the Photo's Category</a> ><a href="adminPhotoGalleryDeletePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Photo's Subcategory</a> ><a href="adminPhotoGalleryDeletePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Photo</a> > Delete the Photo Confirmation</p>

<h1>Delete a Photo</h1>

<hr>

<h3>Delete the Photo Confirmation</h3>


<label for="oldImage">Photo</label>
<div class="row">
<img class="paddingBottom col-xs-12 col-sm-6 col-md-4" src="images/gallery/photo/photo/<?php echo $found['photo'];?>">
</div>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">


<input type="hidden" name="photo" value="images/gallery/photo/photo/<?php echo $found['photo'];?>">
<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminPhotoGalleryDeletePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Cancel</a>
</form>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>