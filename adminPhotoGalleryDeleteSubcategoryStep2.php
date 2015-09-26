<?php 
//CHANGE LOCATION REDIRECT - CHANGE ADMINJAKE.PHP TO NEW DB
	require_once('adminAuthorize.php');
	require_once('adminRuss.php');  

	$subcategory_id = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		$subcategoryID = $_POST[id];
		$subcategoryPhoto = $_POST[photo];
		
		// GET THE PHOTOGALLERY INFORMATION FROM THE DATABASE
			//BUILD THE QUERY1
			$query1 = "SELECT * FROM photoGallery WHERE subcategoryID=$subcategoryID";
			
			//TRY AND TALK TO THE DB
			$result1 = mysqli_query($dbc, $query1) or die('query failed 1');
			
			// DELETE THE PHOTOS IN THE PHOTOGALLERY FOLDERS
			while($row1 = mysqli_fetch_array($result1)){
				@unlink('images/gallery/photo/photo/'.$row1[photo].'');
			}
			
			// BUILD THE DELETE QUERY FOR THE PHOTOGALLERY
			$query2 = "DELETE FROM photoGallery WHERE subcategoryID=$subcategoryID";
					
			//TRY AND DELETE THE RECORDS
			$result2 = mysqli_query($dbc, $query2) or die('delete query failed 2');
			
		// DELETE THE SUBCATEGORY
		
			// DELETE THE SUBCATEGORY PHOTO FROM THE FOLDERS
			@unlink($subcategoryPhoto);

			// BUILD THE DELETE QUERY FOR THE SUBCATEGORY
			$query3 = "DELETE FROM photoSubcategory WHERE id=$subcategoryID";
					
			//TRY AND DELETE THE RECORDS
			$result3 = mysqli_query($dbc, $query3) or die('delete query failed 2');
			
		//REDIRECT
		header("Location: adminPhotoGalleryDeleteSubcategory.php");
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM photoSubcategory WHERE id=$subcategory_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
?>

<?php

	$page = admin; 
	require_once('header.php');

?>

<h1>Delete Subcategory Confirmation</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php
//DISPLAY WHAT WE FOUND
echo '<div class="row">';
echo '<img class="col-xs-12 col-sm-4" src="images/gallery/photo/subcategory/'.$found['photo'].'">';
echo '</div>';
echo '<h2>'.$found['subcategory']. '</h2>';


?>

<input type="hidden" name="photo" value="images/gallery/photo/subcategory/<?php echo $found['photo'];?>">
<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminPhotoGalleryDeleteSubcategory.php"> Cancel</a>
<p class="help-block">This will also delete all associated photos</p>
</fieldset>
</form>


<?php require_once('footer.php'); ?>