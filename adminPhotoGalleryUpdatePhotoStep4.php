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
	// load the data from the form
	$id = $_POST[id];
	$photoDescription = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[photoDescription])));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'newPhoto';
	
	if($_FILES['photo']['size'] == 0){
		
		//build the query
		$query = "UPDATE photoGallery SET photoDescription='$photoDescription' WHERE id=$id";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">The photo has been updated. <a href="photos.php">&#8617; View PHOTOS Page</a></p>';
		}
		
		else{
			
			
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/gallery/photo/photo/';
			
			//--------------verify the image is valid-----------------------
			$validImage = true;
			//check to see if the image is missing
			if($_FILES['photo']['size'] == 0){
				$feedback =  '<p class="adminRed">You did not select an image!</p>';
				$validImage = false;
				};
				
			//check to see if the image size is to large
			if($_FILES['photo']['size'] > 1000000){
				$feedback =  '<p class="adminRed">Your image is to large, it must be smaller than 1MB.</p>';
				$validImage = false;
				};
				
			//check to see if the image dimensions match 715 x 572
			$filetmpname=$_FILES['photo']['tmp_name'];
			$dimension=getimagesize($filetmpname);
			$width = $dimension[0];
			$height = $dimension[1];

			if (($width == 715 && $height == 572) || ($width == 572 && $height == 715)){
				}else{
				$feedback =  '<p class="adminRed">Upload failed, the image must be 715w X 572h or 572w X 715h.</p>';
				$validImage = false;
				};
				
			//check the file type
			if($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
				//that must be a proper format
				}else{
					//tell the user the file type is not correct
					$feedback =  '<p class="adminRed">That is not the correct file format!</p>';
					$validImage = false;
					};
					
			//upload the file if everything is ok		
			if ($validImage == true){
				//upload the file
				$tmp_name = $_FILES['photo']['tmp_name'];
				move_uploaded_file($tmp_name, "$filepath$filename");
				@unlink($_FILES['photo']['tmp_name']);
				//delete the photo associated with the old slider
				@unlink('images/gallery/photo/photo/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE photoGallery SET photoDescription='$photoDescription', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			$feedback = '<p class="adminGreen">The photo has been updated. <a href="photos.php">&#8617; View PHOTOS Page</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset
	
	//BUILD THE QUERY
	$query01 = "SELECT * FROM photoGallery WHERE id=$photo_id";

	//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery6;
?>
<?php require_once('header.php'); ?>

<p><a href="adminPhotoGalleryUpdatePhoto.php">Select the Photo's Category</a> ><a href="adminPhotoGalleryUpdatePhotoStep2.php?id=<?php echo $n1; ?>"> Select the Photo's Subcategory</a> ><a href="adminPhotoGalleryUpdatePhotoStep3.php?id=<?php echo $n2; ?>&n1=<?php echo $n1; ?>"> Select the Photo</a> > Update the Photo</p>

<h1>Update a Photo</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<h3>Update the Photo</h3>


<label for="oldImage" data-toggle="popover" title="Old Image" data-content="This is the current image being used. If the photo does not need to be updated, skip the photo section at the bottom.">Old Image</label>
<div class="row">
<img class="col-xs-12 col-sm-6 col-md-4" src="images/gallery/photo/photo/<?php echo $found['photo'];?>">
</div>

<br>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_photo">

<div class="form-group">
    <label for="photoDescription" data-toggle="popover" title="Photo Description" data-content="Add a photo description (i.e. Left to right: name, name, name.). If there is no needed description, leave this blank.">Photo Description</label>
    <textarea class="form-control" rows="2" name="photoDescription" placeholder="Photo Description"><?php echo $found['photoDescription']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Photo" data-content="Update the photo. If the photo does not need to be updated, skip this section and the current photo will be used.">Photo</label>
    <input type="file" id="photoGallery" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height -or- 572 Width X 715 Height)</p>
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