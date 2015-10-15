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
		$query = "DELETE FROM videoGallery WHERE id=$_POST[id]";
		
		
		//TRY AND DELETE THE RECORD
		$result = mysqli_query($dbc, $query) or die('delete query failed'); 
		
		//REDIRECT
		header('Location: adminVideoGalleryDeleteVideoStep3.php?id='.$n2.'&n1='.$n1.'');
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	//BUILD THE QUERY
	$query = "SELECT * FROM videoGallery WHERE id=$photo_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery18;
?>
<?php require_once('header.php'); ?>

<p><a href="adminVideoGalleryDeleteVideo.php">Select the Video's Category</a> ><a href="adminVideoGalleryDeleteVideoStep2.php?id=<?php echo $n1; ?>"> Select the Video's Subcategory</a> ><a href="adminVideoGalleryDeleteVideoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Video</a> > Delete the Video Confirmation</p>

<h1>Delete a Video</h1>

<hr>

<h3>Delete the Video Confirmation</h3>


<label for="oldImage">Video</label>
<?php
	echo '<div class="centeriFrame">';
	echo '<iframe class="videoiFrame paddingTop"'. $found['videoLink'].' frameborder="0" allowfullscreen></iframe>';
	echo '</div><!-- end of centeriFrame -->';
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">



<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminVideoGalleryDeleteVideoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Cancel</a>
</form>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>