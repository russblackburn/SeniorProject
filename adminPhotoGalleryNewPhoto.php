<?php
require_once('adminAuthorize.php');
require_once('adminRuss.php');
$page = admin; 
require_once('header.php');

	// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query1 = "SELECT * FROM photoSubcategory";

	//communicate with the database
	$result1 = mysqli_query($dbc, $query1) or die('The query has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$photoDescription = mysqli_real_escape_string($dbc, trim($_POST[photoDescription]));
	$photo = $_POST[photo];
	$image_name = 'newPhoto';
	$subcategoryID = $_POST[subcategoryID];
	
	
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
	
	// build the query
	$query = "INSERT INTO photoGallery(photoDescription, photo, subcategoryID)". 
	"VALUES ('$photoDescription','$filename','$subcategoryID')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	echo '<p>';
	echo 'The photo is now in the directory.';
	echo '</p>';
	
	}else{
		//let the user try again
		echo ' Please Try Again';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>

<h1>Add a New Photo</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_photo">

	<div class="form-group">
    	<label for="category">Select a Subcategory</label>
        <select class="form-control" name="subcategoryID">
        <?php
        while($row = mysqli_fetch_array($result1)){
            echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
		}
		?>
        </select>
	</div>

  <div class="form-group">
    <label for="exampleInputFile">New Photo</label>
    <input type="file" id="galleryImage" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <div class="form-group">
    <label for="photoDescription">Photo Description</label>
    <textarea class="form-control" rows="2" name="photoDescription" placeholder="Photo Description"></textarea>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Photo</button>
</form>

<?php require_once('footer.php'); ?>