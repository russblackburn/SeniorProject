<?php
require_once('adminAuthorize.php');
require_once('adminRuss.php');

$category_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current mission statement
$query = "SELECT * FROM videoCategory WHERE id=$category_id";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$category = mysqli_real_escape_string($dbc, trim($_POST[category]));
	$photo = $_POST[photo];
	$image_name = 'newVideoCategory';
	$old_image = $_POST[old_image];
	
	if($_FILES['photo']['size'] == 0){
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE videoCategory SET category='$category' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		header('Location: adminVideoGalleryUpdateCategory.php');
		}
		
		else{
			//delete the photo associated with the old slider
			@unlink('images/gallery/video/category/'.$old_image);
			
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/gallery/video/category/';
			
			//--------------verify the image is valid-----------------------
			$validImage = true;
			//check to see if the image is missing
			if($_FILES['photo']['size'] == 0){
				echo 'You did not select an image!';
				$validImage = false;
				};
				
			//check to see if the image size is to large
			if($_FILES['photo']['size'] > 204800){
				echo 'Your image is to large, it must be smaller than 200KB.';
				$validImage = false;
				};
				
			//check the file type
			if($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
				//that must be a proper format
				}else{
					//tell the user the file type is not correct
					echo 'That is not the correct file format!';
					$validImage = false;
					};
					
			//upload the file if everything is ok		
			if ($validImage == true){
				//upload the file
				$tmp_name = $_FILES['photo']['tmp_name'];
				move_uploaded_file($tmp_name, "$filepath$filename");
				@unlink($_FILES['photo']['tmp_name']);
				
			//upload the information to the database since all photo conditions are met and true
			
			// build the database connection with host, user, password, database
			$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
			 
			 //build the query
		$query = "UPDATE videoCategory SET category='$category', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			// terminate the connection with the database
			mysqli_close($dbc);
			
			// redirect to the adminLanind page
			header('Location: adminVideoGalleryUpdateCategory.php');
			
			}else{
				//let the user try again
				echo ' Please Try Again';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['category'];?> Category</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_category">

<div class="form-group">
    <label for="category">Category Title</label>
    <input type="text" class="form-control" id="category" name="category" placeholder="Course Title" value="<?php echo $found['category']; ?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">New Category Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update <?php echo $found['category']; ?></button>
</form>

<?php require_once('footer.php'); ?>