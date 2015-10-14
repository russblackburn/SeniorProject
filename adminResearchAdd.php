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
	$researchTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[researchTitle])));
	$paragraph1 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph1])));
	$paragraph2 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph2])));
	$paragraph3 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph3])));
	$paragraph4 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph4])));
	$paragraph5 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph5])));
	$paragraph6 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph6])));
	$paragraph7 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph7])));
	$paragraph8 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph8])));
	$paragraph9 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph9])));
	$paragraph10 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph10])));
	$hide = 'F';
	$photo = $_POST[photo];
	$image_name = 'newResearch';
	
	
	//--------make dynamic photo path and name-------------
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = $image_name . time() . '.' . $ext;
	$filepath = 'images/research/';
	
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
	$query = "INSERT INTO newResearch(researchTitle, paragraph1, paragraph2, paragraph3, paragraph4, paragraph5, paragraph6, paragraph7, paragraph8, paragraph9, paragraph10, photo, hide)". 
	"VALUES ('$researchTitle','$paragraph1','$paragraph2','$paragraph3','$paragraph4','$paragraph5','$paragraph6','$paragraph7','$paragraph8','$paragraph9','$paragraph10','$filename', '$hide')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	$feedback = '<p class="adminGreen">'.$researchTitle.' is now in the directory. <a href="research.php">&#8617; View RESEARCH Page</a></p>';

	}else{
		//let the user try again
		$feedback2 =  '<p class="adminRed">Please Try Again</p>';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>

<h1>Add Research</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_research">

  <div class="form-group">
    <label for="researchTitle" data-toggle="popover" title="Research Title" data-content="Title for the research.">Research Title</label>
    <input type="text" class="form-control" id="researchTitle" name="researchTitle" placeholder="Research Title">
  </div>
  
  <div class="form-group">
    <label for="paragraph1" data-toggle="popover" title="Paragraph 1" data-content="First paragraph for the page. Must have at least one paragraph. This is a description of the research.">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph1" placeholder="Paragraph 1"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph2" data-toggle="popover" title="Paragraph 2" data-content="Second paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 2</label>
    <textarea class="form-control" rows="2" name="paragraph2" placeholder="Paragraph 2"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph3" data-toggle="popover" title="Paragraph 3" data-content="Third paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 3</label>
    <textarea class="form-control" rows="2" name="paragraph3" placeholder="Paragraph 3"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph4" data-toggle="popover" title="Paragraph 4" data-content="Fourth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 4</label>
    <textarea class="form-control" rows="2" name="paragraph4" placeholder="Paragraph 4"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph5" data-toggle="popover" title="Paragraph 5" data-content="Fifth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 5</label>
    <textarea class="form-control" rows="2" name="paragraph5" placeholder="Paragraph 5"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph6" data-toggle="popover" title="Paragraph 6" data-content="Sixth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 6</label>
    <textarea class="form-control" rows="2" name="paragraph6" placeholder="Paragraph 6"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph7" data-toggle="popover" title="Paragraph 7" data-content="Seventh paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 7</label>
    <textarea class="form-control" rows="2" name="paragraph7" placeholder="Paragraph 7"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph8" data-toggle="popover" title="Paragraph 8" data-content="Eighth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 8</label>
    <textarea class="form-control" rows="2" name="paragraph8" placeholder="Paragraph 8"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph9" data-toggle="popover" title="Paragraph 9" data-content="Ninth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 9</label>
    <textarea class="form-control" rows="2" name="paragraph9" placeholder="Paragraph 9"></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph10" data-toggle="popover" title="Paragraph 10" data-content="Tenth paragraph for the page. If there is no needed paragraph, leave this blank.">Paragraph 10</label>
    <textarea class="form-control" rows="2" name="paragraph10" placeholder="Paragraph 10"></textarea>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Research Image" data-content="Add the research image. An image must be uploaded at this time.">Research Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Research</button>
</form>

<?php require_once('footer.php'); ?>