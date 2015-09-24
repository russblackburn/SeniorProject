<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminRuss.php');
	$page = admin; 
	require_once('header.php');
	
	$subcategory_id = $_GET[id];
	$n1 = $_GET[n1];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoGallery WHERE subcategoryID=$subcategory_id ORDER BY id ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<p><a href="adminPhotoGalleryUpdatePhoto.php">Select the Photo's Category</a> ><a href="adminPhotoGalleryUpdatePhotoStep2.php?id=<?php echo $n1; ?>&n1=<?php echo $n1; ?>"> Select the Photo's Subcategory</a> > Select the Photo</p>

<h1>Update a Photo</h1>

<hr>

<h3>Select the Photo</h3>
<div class="row">
<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo ' <a href="adminPhotoGalleryUpdatePhotoStep4.php?id='. $row['id'].'&subcategoryID='.$subcategory_id.'&n1='.$n1.'&n2='.$subcategory_id.'"><img class="paddingBottom col-xs-6 col-sm-3" src="images/gallery/photo/photo/'.$row['photo'].'"></a>';
	};
?>
</div><!-- end of row -->

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>