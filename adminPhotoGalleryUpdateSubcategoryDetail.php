<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$category_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$subcategory = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[subcategory])));
	$photo = $_POST[photo];
	$image_name = 'newPhotoSubcategory';
	$old_image = $_POST[old_image];
	
	if($_FILES['photo']['size'] == 0){
		
		//build the query
		$query = "UPDATE photoSubcategory SET subcategory='$subcategory' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		$feedback = '<p class="adminGreen">'.$subcategory.' has been updated. <a href="photosSubcategory.php?id='.$found['id'].'">&#8617; View Photo Subcategory</a></p>';
		}
		
		else{
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/gallery/photo/subcategory/';
			
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

			if ($width != 715 && $height != 572){
				$feedback =  '<p class="adminRed">Upload failed, the image needs to be 715w X 572h.</p>';
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
				@unlink('images/gallery/photo/subcategory/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE photoSubcategory SET subcategory='$subcategory', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			$feedback = '<p class="adminGreen">'.$subcategory.' has been updated. <a href="photosSubcategory.php?id='.$found['id'].'">&#8617; View Photo Subcategory</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset
	
	// build the query to display the current mission statement
	$query01 = "SELECT * FROM photoSubcategory WHERE id=$category_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = gallery;
$adminSecondaryPage = gallery5;
?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['subcategory'];?> Subcategory</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_subcategory">

<div class="form-group">
    <label for="subcategory" data-toggle="popover" title="Subcategory Title" data-content="Title for the subcategory.">Subcategory Title</label>
    <input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="Subcategory Title" value="<?php echo $found['subcategory']; ?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Subcategory Image" data-content="Update the image. If the image does not need to be updated, skip this section and the current image will be used.">Subcategory Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update <?php echo $found['subcategory']; ?></button>
</form>

<?php require_once('footer.php'); ?>