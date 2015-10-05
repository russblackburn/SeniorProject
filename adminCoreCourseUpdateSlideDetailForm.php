<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$course_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current mission statement
$query = "SELECT * FROM coreCourse WHERE id=$course_id";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$slider_description = mysqli_real_escape_string($dbc, trim($_POST[slider_description]));
	$slider_link = mysqli_real_escape_string($dbc, trim($_POST[slider_link]));
	$slider_button_description = mysqli_real_escape_string($dbc, trim($_POST[slider_button_description]));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'coreCourseSlide';
	
	if($old_image == NULL && $_FILES['photo']['size'] == 0){
		$feedback = 'Upload incomplete, you must add a slide image on the initial update/add';
	}else{
	if($_FILES['photo']['size'] == 0){
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE coreCourse SET slider_description='$slider_description', slider_link='$slider_link', slider_button_description='$slider_button_description' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		header('Location: adminUpdateCourseSlide.php');
		}
		
		else{
			//delete the photo associated with the old slider
			@unlink('images/training/slider/'.$old_image);
			
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/training/slider/';
			
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
		$query = "UPDATE coreCourse SET slider_description='$slider_description', slider_link='$slider_link', slider_button_description='$slider_button_description', slide_image='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			// terminate the connection with the database
			mysqli_close($dbc);
			
			// redirect to the adminLanind page
			header('Location: adminUpdateCourseSlide.php');
			
			}else{
				//let the user try again
				echo ' Please Try Again';
				};//end of upload the file if everything is ok
			}//end of else statement
	}//end of check for initial image conditional
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<?php echo $feedback; ?>

<h1>Update/Add <?php echo $found['courseTitle'];?> Slide</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_slide">
  
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" rows="2" name="slider_description" placeholder="Description"><?php echo $found['slider_description']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="buttonText">Button Text</label>
    <input type="text" class="form-control" id="buttonText" name="slider_button_description" placeholder="Button Text" value="<?php echo $found['slider_button_description']; ?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">Slide Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="slider_link" value="coreCourseDetail.php?id=<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['slide_image']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update/Add <?php echo $found['courseTitle']; ?> Slide</button>
</form>

<?php require_once('footer.php'); ?>