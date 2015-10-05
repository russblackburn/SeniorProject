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

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$photoDescription = mysqli_real_escape_string($dbc, trim($_POST[photoDescription]));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'newPhoto';
	
	if($_FILES['photo']['size'] == 0){
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE photoGallery SET photoDescription='$photoDescription' WHERE id=$id";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		header('Location: adminPhotoGalleryUpdatePhotoStep3.php?id='.$n2.'&n1='.$n1.'');
		}
		
		else{
			//delete the photo associated with the old slider
			@unlink('images/gallery/photo/photo/'.$old_image);
			
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/gallery/photo/photo/';
			
			//--------------verify the image is valid-----------------------
			$validImage = true;
			//check to see if the image is missing
			if($_FILES['photo']['size'] == 0){
				echo 'You did not select an image!';
				$validImage = false;
				};
				
			//check to see if the image size is to large
			if($_FILES['photo']['size'] > 1000000){
				echo 'Your image is to large, it must be smaller than 1MB.';
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
		$query = "UPDATE photoGallery SET photoDescription='$photoDescription', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			// terminate the connection with the database
			mysqli_close($dbc);
			
			// redirect to the adminLanind page
			header('Location: adminPhotoGalleryUpdatePhotoStep3.php?id='.$n2.'&n1='.$n1.'');
			
			}else{
				//let the user try again
				echo ' Please Try Again';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<p><a href="adminPhotoGalleryUpdatePhoto.php">Select the Photo's Category</a> ><a href="adminPhotoGalleryUpdatePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Photo's Subcategory</a> ><a href="adminPhotoGalleryUpdatePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Photo</a> > Update the Photo</p>

<h1>Update a Photo</h1>

<hr>

<h3>Update the Photo</h3>


<label for="oldImage">Old Image</label>
<div class="row">
<img class="col-xs-12 col-sm-4" src="images/gallery/photo/photo/<?php echo $found['photo'];?>">
</div>

<br>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_photo">

<div class="form-group">
    <label for="photoDescription">Photo Description</label>
    <textarea class="form-control" rows="2" name="photoDescription" placeholder="Photo Description"><?php echo $found['photoDescription']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">New Image</label>
    <input type="file" id="photoGallery" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <input type="hidden" name="getSubcategoryID" value="<?php echo $subcategoryID; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update</button>
</form>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>