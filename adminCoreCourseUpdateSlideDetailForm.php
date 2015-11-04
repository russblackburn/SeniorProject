<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$course_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$slider_description = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[slider_description])));
	$slider_link = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[slider_link])));
	$slider_button_description = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[slider_button_description])));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'coreCourseSlide';
	
	if($old_image == NULL && $_FILES['photo']['size'] == 0){
		$feedback = 'Upload incomplete, you must add a slide image on the initial update/add';
	}else{
	if($_FILES['photo']['size'] == 0){
		
		//build the query
		$query = "UPDATE coreCourse SET slider_description='$slider_description', slider_link='$slider_link', slider_button_description='$slider_button_description' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">The slider has been updated. <a href="index.php">&#8617; View HOME Page</a> &#8729; <a href="adminHideCourseSlide.php">Hide &#8260; Unhide Slide</a></p>';
		}
		
		else{
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/training/slider/';
			
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
				
			//check to see if the image dimensions match 1142 x 248
			$filetmpname=$_FILES['photo']['tmp_name'];
			$dimension=getimagesize($filetmpname);
			$width = $dimension[0];
			$height = $dimension[1];

			if ($width != 1142 && $height != 248){
				$feedback =  '<p class="adminRed">Upload failed, the image needs to be 1142w X 248h.</p>';
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
				@unlink('images/training/slider/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE coreCourse SET slider_description='$slider_description', slider_link='$slider_link', slider_button_description='$slider_button_description', slide_image='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			$feedback = '<p class="adminGreen">The slider has been updated. <a href="index.php">&#8617; View HOME Page</a> &#8729; <a href="adminHideCourseSlide.php">Hide &#8260; Unhide Slide</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	}//end of check for initial image conditional
	
	};//end of if submit/isset
	
	// build the query to display the current mission statement
	$query01 = "SELECT * FROM coreCourse WHERE id=$course_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = home;
$adminSecondaryPage = home2;
?>
<?php require_once('header.php'); ?>

<h1>Update/Add <?php echo $found['courseTitle'];?> Slide</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_slide">
  
  <div class="form-group">
    <label for="description" data-toggle="popover" title="Description" data-content="Description for the slide, keep this short. If it is to long some of the text will push outside of the slide image.">Description</label>
    <textarea class="form-control" rows="2" name="slider_description" placeholder="Description"><?php echo $found['slider_description']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="buttonText" data-toggle="popover" title="Button Text" data-content="Label the button that is displayed on the slide (i.e. Learn more).">Button Text</label>
    <input type="text" class="form-control" id="buttonText" name="slider_button_description" placeholder="Button Text" value="<?php echo $found['slider_button_description']; ?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Slide Image" data-content="Update/add the slide image, the first upload must have an image selected. If the image does not need to be updated, skip this section and the current image will be used.">Slide Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (1142 Width X 248 Height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="slider_link" value="coreCourseDetail.php?id=<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['slide_image']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update/Add <?php echo $found['courseTitle']; ?> Slide</button>
</form>

<?php require_once('footer.php'); ?>