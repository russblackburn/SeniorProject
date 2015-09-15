<?php
require_once('adminAuthorize.php');
require_once('adminJake.php');

$page = admin; 
require_once('header.php');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$firstName = $_POST[firstName];
	$lastName= $_POST[lastName];
	$qualifications = $_POST[qualifications];
	$paragraph1 = $_POST[paragraph1];
	$paragraph2 = $_POST[paragraph2];
	$paragraph3 = $_POST[paragraph3];
	$paragraph4 = $_POST[paragraph4];
	$paragraph5 = $_POST[paragraph5];
	$paragraph6 = $_POST[paragraph6];
	$paragraph7 = $_POST[paragraph7];
	$paragraph8 = $_POST[paragraph8];
	$paragraph9 = $_POST[paragraph9];
	$paragraph10 = $_POST[paragraph10];
	$photo = $_POST[photo];
	
	//--------make dynamic photo path and name-------------
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = $firstName . $lastName . time() . '.' . $ext;
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
		echo ' Your image is to large, it must be smaller than 200KB.';
		$validImage = false;
		};
		
	//check the file type
	if($_FILES['photo']['type'] == 'image/gif' || $_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/pjpeg' || $_FILES['photo']['type'] == 'image/png'){
		//that must be a proper format
		}else{
			//tell the user the file type is not correct
			echo ' That is not the correct file format!';
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
	
	// build the query
	$query = "INSERT INTO personnel(first_name, last_name, qualifications, paragraph_1, paragraph_2, paragraph_3, paragraph_4, paragraph_5, paragraph_6, paragraph_7, paragraph_8, paragraph_9, paragraph_10, photo)". 
	"VALUES ('$firstName','$lastName','$qualifications','$paragraph1','$paragraph2','$paragraph3','$paragraph4','$paragraph5','$paragraph6','$paragraph7','$paragraph8','$paragraph9','$paragraph10','$filename')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	echo '<p>';
	echo $firstName.' '.$lastName.' is now in the directory.';
	echo '</p>';
	
	}else{
		//let the user try again
		echo ' Please Try Again';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>

<h1>Add New Personnel</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_personnel">

  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Jane">
  </div>
  
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe">
  </div>
  
  <div class="form-group">
    <label for="qualifications">Qualifications</label>
    <textarea class="form-control" rows="2" name="qualifications" placeholder="Qualifications"></textarea>
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
  
  <div class="form-group">
    <label for="exampleInputFile">New Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Personnel</button>
</form>

<?php require_once('footer.php'); ?>