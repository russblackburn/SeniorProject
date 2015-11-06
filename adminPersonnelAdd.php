<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin;
$adminPage = about;
$adminSecondaryPage = about2; 
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$firstName = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[firstName])));
	$lastName= stripslashes(mysqli_real_escape_string($dbc, trim($_POST[lastName])));
	$position = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[position])));
	$qualifications = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[qualifications])));
	$priority=$_POST[priority];
	$photo = $_POST[photo];
	$image_name = 'personnel';
	
		//loop through the $myInputs array for list items
		$paragraph = $_POST["paragraph"];
		
		$i = 1;
		foreach ($paragraph as $eachInput) {
			 if($eachInput != ''){
			 ${'paragraph' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
	//--------make dynamic photo path and name-------------
	$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
	$filename = $image_name . time() . '.' . $ext;
	$filepath = 'images/personnel/';
	
	//--------------verify the image is valid-----------------------
	$validImage = true;
	//check to see if the image is missing
	if($_FILES['photo']['size'] == 0){
		$feedback =  '<p class="adminRed">You did not select an image!</p>';
		$validImage = false;
		};
		
	//check to see if the image size is to large
	if($_FILES['photo']['size'] > 1000000){
		echo ' Your image is to large, it must be smaller than 1MB.';
		$feedback =  '<p class="adminRed">Your image is to large, it must be smaller than 1MB.</p>';
		$validImage = false;
		};
		
	//check to see if the image dimensions match 715 x 572
			$filetmpname=$_FILES['photo']['tmp_name'];
			$dimension=getimagesize($filetmpname);
			$width = $dimension[0];
			$height = $dimension[1];

			if ($width != 572 && $height != 715){
				$feedback =  '<p class="adminRed">Upload failed, the image needs to be 572w X 715h.</p>';
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
	$query = "INSERT INTO personnel(first_name, last_name, position, qualifications, paragraph_1, paragraph_2, paragraph_3, paragraph_4, paragraph_5, paragraph_6, paragraph_7, paragraph_8, paragraph_9, paragraph_10, priority, photo)". 
	"VALUES ('$firstName','$lastName','$position','$qualifications','$paragraph1','$paragraph2','$paragraph3','$paragraph4','$paragraph5','$paragraph6','$paragraph7','$paragraph8','$paragraph9','$paragraph10', '$priority', '$filename')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	$feedback = '<p class="adminGreen">'.$firstName.' '.$lastName.' is now in the directory. <a href="personnel.php">&#8617; View Personnel Page</a></p>';

	
	}else{
		//let the user try again
		$feedback2 =  '<p class="adminRed">Please Try Again</p>';
		};//end of upload the file if everything is ok
	
	};//end of if submit/isset
	
	?>

<h1>Add New Personnel</h1>

<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_personnel">

  <div class="form-group">
    <label for="firstName" data-toggle="popover" title="First Name" data-content="First name of the new personnel record.">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Jane">
  </div>
  
  <div class="form-group">
    <label for="lastName" data-toggle="popover" title="Last Name" data-content="Last name of the new personnel record.">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe">
  </div>
  
  <div class="form-group">
    <label for="position" data-toggle="popover" title="Position" data-content="Position of the new personnel record.">Position</label>
    <input type="text" class="form-control" id="position" name="position" placeholder="Position">
  </div>
  
  <div class="form-group">
    <label for="qualifications" data-toggle="popover" title="Qualifications" data-content="Qualifications of the new personnel record.">Qualifications</label>
    <textarea class="form-control" rows="2" name="qualifications" placeholder="Qualifications"></textarea>
  </div>
  
  <hr>
  <!-- adding the paragraph list for the course -->
  
  <script>
var counter1 = 1;
var limit1 = 10;
function addInput1(divName){
     if (counter1 == limit1)  {
          alert("You have reached the limit of adding " + counter1 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<div class='form-group'><label for='paragraph' >Paragraph " + (counter1 + 1) + "</label><textarea class='form-control' rows='2' name='paragraph[]' placeholder='Paragraph " + (counter1 + 1) + "'></textarea></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter1++;
     }
}
  </script>
  
  <div class="form-group">
    <label for="paragraph" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the course. Click the + Add another paragraph button for up to 10 paragraphs. ">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph[]" placeholder="Paragraph 1"></textarea>
  </div>
  
  <div id="dynamicInput1"></div>
  
	<button type="button" class="btn btn-default" value="Add another text input" onClick="addInput1('dynamicInput1');">+ Add another paragraph</button>
    
<!-- end of the paragraph list -->

<hr>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Personnel Image" data-content="Add the personnel image. An image must be uploaded at this time.">Personnel Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (572 Width X 715 Height)</p>
  </div>
  
  <input type="hidden" name="priority" value="99">
  
  <button type="submit" class="btn btn-primary" name="submitButton">Add Personnel</button>
</form>

<?php require_once('footer.php'); ?>