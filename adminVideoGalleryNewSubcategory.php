<?php
require_once('adminAuthorize.php');
require_once('adminRuss.php');


// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query = "SELECT * FROM videoCategory ORDER BY id DESC";

	//communicate with the database
	$result = mysqli_query($dbc, $query) or die('The query has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$subcategory = mysqli_real_escape_string($dbc, trim($_POST[subcategory]));
	$photo = $_POST[photo];
	$categoryID = $_POST[categoryID];
	$image_name = 'newVideoSubcategory';
	
	
	//--------make dynamic photo path and name-------------
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = $image_name . time() . '.' . $ext;
	$filepath = 'images/gallery/video/subcategory/';
	
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
	$query = "INSERT INTO videoSubcategory(subcategory, photo, categoryID)".
	"VALUES ('$subcategory','$filename','$categoryID')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	header('Location: adminVideoGalleryNewVideo.php');
	
	}else{
		//let the user try again
		echo ' Please Try Again';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>
    <?php
$page = admin; 
require_once('header.php');
?>

<h1>Add a New Subcategory (Video)</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_subcategory">

	<div class="form-group">
    	<label for="category">Select a Category</label>
        <select class="form-control" name="categoryID">
        <?php
        while($row = mysqli_fetch_array($result)){
            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
		}
		?>
        </select>
    </div>

  <div class="form-group">
    <label for="researchTitle">Subcategory Title</label>
    <input type="text" class="form-control" id="category" name="subcategory" placeholder="Subcategory">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">New Image</label>
    <input type="file" id="category" name="photo">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Subcategory</button>
</form>

<?php require_once('footer.php'); ?>