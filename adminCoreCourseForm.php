<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin; 
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$courseTitle = mysqli_real_escape_string($dbc, trim($_POST[courseTitle]));
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
	$registrationInstructions = mysqli_real_escape_string($dbc, trim($_POST[registrationInstructions]));
	$linkTitle1 = mysqli_real_escape_string($dbc, trim($_POST[linkTitle1]));
	$link1 = mysqli_real_escape_string($dbc, trim($_POST[link1]));
	$linkTitle2 = mysqli_real_escape_string($dbc, trim($_POST[linkTitle2]));
	$link2 = mysqli_real_escape_string($dbc, trim($_POST[link2]));
	$linkTitle3 = mysqli_real_escape_string($dbc, trim($_POST[linkTitle3]));
	$link3 = mysqli_real_escape_string($dbc, trim($_POST[link3]));
	$hide = 'F';
	$photo = $_POST[photo];
	$image_name = 'coreCourse';
	
	//load the data for the slider
	$slide_hidden = 'T';
	
	//-----------------------------------------------------upload the first photo------------------------------------------
	//--------make dynamic photo path and name-------------
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = $image_name . time() . '.' . $ext;
	$filepath = 'images/training/course/';
	
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
	//upload the information to the database since all photo conditions are met and true
	
	// build the query
	$query = "INSERT INTO coreCourse(courseTitle, paragraph1, paragraph2, paragraph3, paragraph4, paragraph5, paragraph6, paragraph7, paragraph8, paragraph9, paragraph10, registrationInstructions, linkTitle1, link1, linkTitle2, link2, linkTitle3, link3, photo, hide, slide_hidden)". 
	"VALUES ('$courseTitle','$paragraph1','$paragraph2','$paragraph3','$paragraph4','$paragraph5','$paragraph6','$paragraph7','$paragraph8','$paragraph9','$paragraph10','$registrationInstructions','$linkTitle1','$link1','$linkTitle2','$link2','$linkTitle3','$link3','$filename','$hide','$slide_hidden')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	$feedback = '<p class="adminGreen">'.$courseTitle.' is now in the directory. <a href="training.php">&#8617; View Training Page</a></p>';
	
	}else{
		//let the user try again
		$feedback2 =  '<p class="adminRed">Please Try Again</p>';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>

<h1>Add a New Core Course</h1>

<hr>

<?php echo $feedback;?>
<?php echo $feedback2;?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_course">

  <div class="form-group">
    <label for="courseTitle">Course Title</label>
    <input type="text" class="form-control" id="courseTitle" name="courseTitle" placeholder="Course Title">
  </div>
  
  <div class="form-group">
    <label for="paragraph1">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph1" placeholder="Paragraph 1"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph2">Paragraph 2</label>
    <textarea class="form-control" rows="2" name="paragraph2" placeholder="Paragraph 2"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph3">Paragraph 3</label>
    <textarea class="form-control" rows="2" name="paragraph3" placeholder="Paragraph 3"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph4">Paragraph 4</label>
    <textarea class="form-control" rows="2" name="paragraph4" placeholder="Paragraph 4"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph5">Paragraph 5</label>
    <textarea class="form-control" rows="2" name="paragraph5" placeholder="Paragraph 5"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph6">Paragraph 6</label>
    <textarea class="form-control" rows="2" name="paragraph6" placeholder="Paragraph 6"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph7">Paragraph 7</label>
    <textarea class="form-control" rows="2" name="paragraph7" placeholder="Paragraph 7"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph8">Paragraph 8</label>
    <textarea class="form-control" rows="2" name="paragraph8" placeholder="Paragraph 8"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph9">Paragraph 9</label>
    <textarea class="form-control" rows="2" name="paragraph9" placeholder="Paragraph 9"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph10">Paragraph 10</label>
    <textarea class="form-control" rows="2" name="paragraph10" placeholder="Paragraph 10"></textarea>
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="registrationInstructions">Registration Instructions</label>
    <textarea class="form-control" rows="2" name="registrationInstructions" placeholder="Registration Instructions"></textarea>
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="linkTitle">Link Title</label>
    <input type="text" class="form-control" id="linkTitle" name="linkTitle1" placeholder="Link Title">
  </div>
  
  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link" name="link1" placeholder="Link">
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="linkTitle">Link Title</label>
    <input type="text" class="form-control" id="linkTitle" name="linkTitle2" placeholder="Link Title">
  </div>
  
  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link" name="link2" placeholder="Link">
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="linkTitle">Link Title</label>
    <input type="text" class="form-control" id="linkTitle" name="linkTitle3" placeholder="Link Title">
  </div>
  
  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link" name="link3" placeholder="Link">
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="exampleInputFile">New Course Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Core Course</button>
</form>

<?php require_once('footer.php'); ?>