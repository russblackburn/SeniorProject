<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$personnel_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current personnel
$query = "SELECT * FROM personnel WHERE id=$personnel_id";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$firstName = mysqli_real_escape_string($dbc, trim($_POST[firstName]));
	$lastName = mysqli_real_escape_string($dbc, trim($_POST[lastName]));
	$qualifications = mysqli_real_escape_string($dbc, trim($_POST[qualifications]));
	$paragraph1 = mysqli_real_escape_string($dbc, trim($_POST[paragraph1]));
	$paragraph2 = mysqli_real_escape_string($dbc, trim($_POST[paragraph2]));
	$paragraph3 = mysqli_real_escape_string($dbc, trim($_POST[paragraph3]));
	$paragraph4 = mysqli_real_escape_string($dbc, trim($_POST[paragraph4]));
	$paragraph5 = mysqli_real_escape_string($dbc, trim($_POST[paragraph5]));
	$paragraph6 = mysqli_real_escape_string($dbc, trim($_POST[paragraph6]));
	$paragraph7 = mysqli_real_escape_string($dbc, trim($_POST[paragraph7]));
	$paragraph8 = mysqli_real_escape_string($dbc, trim($_POST[paragraph8]));
	$paragraph9 = mysqli_real_escape_string($dbc, trim($_POST[paragraph9]));
	$paragraph10 = mysqli_real_escape_string($dbc, trim($_POST[paragraph10]));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'personnel';
	
	if($_FILES['photo']['size'] == 0){
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE personnel SET first_name='$firstName', last_name='$lastName', qualifications='$qualifications', paragraph_1='$paragraph1', paragraph_2='$paragraph2', paragraph_3='$paragraph3', paragraph_4='$paragraph4', paragraph_5='$paragraph5', paragraph_6='$paragraph6', paragraph_7='$paragraph7', paragraph_8='$paragraph8', paragraph_9='$paragraph9', paragraph_10='$paragraph10' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		$feedback = '<p style="color:#5fb760">'.$firstName.' '.$lastName.' has been updated. <a href="adminPersonnelUpdateText.php">&#8617; Personnel List</a></p>';
		}
		
		else{
			//delete the photo associated with the old slider
			@unlink('images/personnel/'.$old_image);
			
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/personnel/';
			
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
		$query = "UPDATE personnel SET first_name='$firstName', last_name='$lastName', qualifications='$qualifications', paragraph_1='$paragraph1', paragraph_2='$paragraph2', paragraph_3='$paragraph3', paragraph_4='$paragraph4', paragraph_5='$paragraph5', paragraph_6='$paragraph6', paragraph_7='$paragraph7', paragraph_8='$paragraph8', paragraph_9='$paragraph9', paragraph_10='$paragraph10', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			// terminate the connection with the database
			mysqli_close($dbc);
			
			$feedback = '<p style="color:#5fb760">'.$firstName.' '.$lastName.' has been updated. <a href="adminPersonnelUpdateText.php">&#8617; Personnel List</a></p>';
			
			}else{
				//let the user try again
				$feedback =  ' Please Try Again';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['first_name'].' '.$found['last_name'];?></h1>

<hr>
<?php echo $feedback;?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_personnel">

<div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Jane" value="<?php echo $found['first_name']; ?>">
  </div>
  
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" value="<?php echo $found['last_name']; ?>">
  </div>
  
  <div class="form-group">
    <label for="qualifications">Qualifications</label>
    <textarea class="form-control" rows="2" name="qualifications" placeholder="Qualifications"><?php echo $found['qualifications']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph1">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph1" placeholder="Paragraph 1"><?php echo $found['paragraph_1']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph2">Paragraph 2</label>
    <textarea class="form-control" rows="2" name="paragraph2" placeholder="Paragraph 2"><?php echo $found['paragraph_2']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph3">Paragraph 3</label>
    <textarea class="form-control" rows="2" name="paragraph3" placeholder="Paragraph 3"><?php echo $found['paragraph_3']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph4">Paragraph 4</label>
    <textarea class="form-control" rows="2" name="paragraph4" placeholder="Paragraph 4"><?php echo $found['paragraph_4']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph5">Paragraph 5</label>
    <textarea class="form-control" rows="2" name="paragraph5" placeholder="Paragraph 5"><?php echo $found['paragraph_5']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph6">Paragraph 6</label>
    <textarea class="form-control" rows="2" name="paragraph6" placeholder="Paragraph 6"><?php echo $found['paragraph_6']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph7">Paragraph 7</label>
    <textarea class="form-control" rows="2" name="paragraph7" placeholder="Paragraph 7"><?php echo $found['paragraph_7']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph8">Paragraph 8</label>
    <textarea class="form-control" rows="2" name="paragraph8" placeholder="Paragraph 8"><?php echo $found['paragraph_8']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph9">Paragraph 9</label>
    <textarea class="form-control" rows="2" name="paragraph9" placeholder="Paragraph 9"><?php echo $found['paragraph_9']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph10">Paragraph 10</label>
    <textarea class="form-control" rows="2" name="paragraph10" placeholder="Paragraph 10"><?php echo $found['paragraph_10']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">New Image</label>
    <input type="file" id="purposeImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update <?php echo $found['first_name']; ?></button>
</form>

<?php require_once('footer.php'); ?>