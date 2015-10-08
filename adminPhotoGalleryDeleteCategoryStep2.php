<?php 
//CHANGE LOCATION REDIRECT - CHANGE ADMINJAKE.PHP TO NEW DB
	require_once('adminAuthorize.php');
	require_once('adminVariables.php');  

	$category_id = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		$categoryID = $_POST[id];
		$categoryPhoto = $_POST[photo];
		
		// GET THE SUBCATEGORY INFORMATION FROM THE DATABASE
			//BUILD THE QUERY1
			$query1 = "SELECT * FROM photoSubcategory WHERE categoryID=$categoryID";
			
			//TRY AND TALK TO THE DB
			$result1 = mysqli_query($dbc, $query1) or die('query failed 1');
			
		// GET THE PHOTO INFORMATION FROM THE DATABASE AND DELETE IT AT THE SAME TIME
			//FOR EACH SUBCATEGORY, SELECT THE CORRESPONDING PHOTOS OF THAT SUBCATEGORY AND DELETE THEM
			while($row1 = mysqli_fetch_array($result1)){
				
				//variable to hold the current subcategoryID
				$subcategoryID = $row1[id];
				
				// GET THE RECORDS FROM THE DATABASE
					//BUILD THE QUERY2
					$query2 = "SELECT * FROM photoGallery WHERE subcategoryID=$subcategoryID";
					
					//TRY AND TALK TO THE DB
					$result2 = mysqli_query($dbc, $query2) or die('query failed 2');
				
				// DELETE THE PHOTOGALLERY PHOTOS FROM THE CURRENT SUBCATEGORY IN THE ARRAY
				while($row2 = mysqli_fetch_array($result2)){
					@unlink('images/gallery/photo/photo/'.$row2[photo].'');
				}
				
				// DELETE THE RECORDS FROM THE DATABASE
					//BUILD A SELECT QUERY
					$query3 = "DELETE FROM photoGallery WHERE subcategoryID=$subcategoryID";
					
					//TRY AND DELETE THE RECORDS
					$result3 = mysqli_query($dbc, $query3) or die('delete query failed 3'); 
			}
		
		//----------------------------------------------------------------DELETE ITEMS----------------------------
		
		// DELETE THE CATEGORY ITEMS
			// DELETE THE CATEGORY PHOTO
			@unlink($categoryPhoto);
			
			//BUILD A SELECT QUERY
			$query = "DELETE FROM photoCategory WHERE id=$categoryID";
		
			//TRY AND DELETE THE RECORD
			$result = mysqli_query($dbc, $query) or die('delete query failed 4'); 
			
		// DELETE THE SUBCATEGORY ITEMS
			// USE ANOTHER QUERY TO DELETE ALL OF THE PHOTOS IN THE SUBCATEGORY FOLDERS
				//BUILD THE QUERY1
				$query4 = "SELECT * FROM photoSubcategory WHERE categoryID=$categoryID";
				
				//TRY AND TALK TO THE DB
				$result4 = mysqli_query($dbc, $query4) or die('query failed 1');
			// DELETE THE SUBCATEGORY PHOTOS
			while($row4 = mysqli_fetch_array($result4)){
				// variable to hold the photo to delete
				$subcategoryPhoto = 'images/gallery/photo/subcategory/'.$row4[photo];
				@unlink($subcategoryPhoto);
			}
			
			//BUILD A SELECT QUERY
			$query1 = "DELETE FROM photoSubcategory WHERE categoryID=$categoryID";
		
			//TRY AND DELETE THE RECORDS
			$result1 = mysqli_query($dbc, $query1) or die('delete query failed 5'); 
			
			
	
		
		//REDIRECT
		header("Location: adminPhotoGalleryDeleteCategory.php");
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM photoCategory WHERE id=$category_id";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
?>

<?php

	$page = admin; 
	require_once('header.php');

?>

<h1>Delete Category Confirmation</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php
//DISPLAY WHAT WE FOUND
echo '<div class="row">';
echo '<img class="col-xs-12 col-sm-6 col-md-4" src="images/gallery/photo/category/'.$found['photo'].'">';
echo '</div>';
echo '<h2>'.$found['category']. '</h2>';


?>

<input type="hidden" name="photo" value="images/gallery/photo/category/<?php echo $found['photo'];?>">
<input type="hidden" name="id" value="<?php echo $found['id'];?>">

<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminPhotoGalleryDeleteCategory.php"> Cancel</a>
<p class="help-block">This will also delete all associated subcategories and their photos</p>
</fieldset>
</form>


<?php require_once('footer.php'); ?>