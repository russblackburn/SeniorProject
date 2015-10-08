<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');


// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// build the query to display the categories statement
	$query = "SELECT * FROM photoCategory ORDER BY id DESC";

	//communicate with the database
	$result = mysqli_query($dbc, $query) or die('The query has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$subcategory = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[subcategory])));
	$photo = $_POST[photo];
	$categoryID = $_POST[categoryID];
	$image_name = 'newPhotoSubcategory';
	
	
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
		
	//upload the information to the database since all photo conditions are met and true
	
	// build the query
	$query = "INSERT INTO photoSubcategory(subcategory, photo, categoryID)".
	"VALUES ('$subcategory','$filename','$categoryID')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	header('Location: adminPhotoGalleryNewPhoto.php');
	
	}else{
		//let the user try again
		$feedback2 =  '<p class="adminRed">Please Try Again</p>';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>
    <?php
$page = admin; 
require_once('header.php');
?>

<h1>Add a New Subcategory (Photo)</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

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
    <p class="help-block">Image size must be (715 Width X 572 Height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Add Subcategory</button>
</form>

<?php require_once('footer.php'); ?>