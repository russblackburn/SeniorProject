<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$personnel_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$firstName = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[firstName])));
	$lastName = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[lastName])));
	$position = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[position])));
	$qualifications = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[qualifications])));
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'personnel';
	
		//loop through the $paragraph array for paragraphs
		$paragraph = $_POST["paragraph"];
		
		$i = 1;
		foreach ($paragraph as $eachInput) {
			 if($eachInput != ''){
			 ${'paragraph' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
	
	if($_FILES['photo']['size'] == 0){
		
		//build the query
		$query = "UPDATE personnel SET first_name='$firstName', last_name='$lastName', position='$position', qualifications='$qualifications', paragraph_1='$paragraph1', paragraph_2='$paragraph2', paragraph_3='$paragraph3', paragraph_4='$paragraph4', paragraph_5='$paragraph5', paragraph_6='$paragraph6', paragraph_7='$paragraph7', paragraph_8='$paragraph8', paragraph_9='$paragraph9', paragraph_10='$paragraph10' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">'.$firstName.' '.$lastName.' has been updated. <a href="adminPersonnelUpdateText.php">&#8617; Personnel List</a></p>';
		}
		
		else{
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/personnel/';
			
			//--------------verify the image is valid-----------------------
			$validImage = true;
			//check to see if the image is missing
			if($_FILES['photo']['size'] == 0){
				$feedback =  '<p>You did not select an image!</p>';
				$validImage = false;
				};
				
			//check to see if the image size is to large
			if($_FILES['photo']['size'] > 1000000){
				$feedback =  '<p>Your image is to large, it must be smaller than 1MB.</p>';
				$validImage = false;
				};
				
			//check to see if the image dimensions match 715 x 572
			$filetmpname=$_FILES['photo']['tmp_name'];
			$dimension=getimagesize($filetmpname);
			$width = $dimension[0];
			$height = $dimension[1];

			if ($width != 572 && $height != 715){
				$feedback =  '<p class="adminRed">Upload failed, the image needs to be 572w X 715h</p>';
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
				@unlink('images/personnel/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE personnel SET first_name='$firstName', last_name='$lastName', position='$position', qualifications='$qualifications', paragraph_1='$paragraph1', paragraph_2='$paragraph2', paragraph_3='$paragraph3', paragraph_4='$paragraph4', paragraph_5='$paragraph5', paragraph_6='$paragraph6', paragraph_7='$paragraph7', paragraph_8='$paragraph8', paragraph_9='$paragraph9', paragraph_10='$paragraph10', photo='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			$feedback = '<p class="adminGreen">'.$firstName.' '.$lastName.' has been updated. <a href="adminPersonnelUpdateText.php">&#8617; Personnel List</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset
	
	// build the query to display the current personnel
	$query01 = "SELECT * FROM personnel WHERE id=$personnel_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = about;
$adminSecondaryPage = about3;
?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['first_name'].' '.$found['last_name'];?></h1>

<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_personnel">

<div class="form-group">
    <label for="firstName" data-toggle="popover" title="First Name" data-content="Update the first name.">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Jane" value="<?php echo $found['first_name']; ?>">
  </div>
  
  <div class="form-group">
    <label for="lastName" data-toggle="popover" title="Last Name" data-content="Update the last name.">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" value="<?php echo $found['last_name']; ?>">
  </div>
  
  <div class="form-group">
    <label for="position" data-toggle="popover" title="Position" data-content="Update the position.">Position</label>
    <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="<?php echo $found['position']; ?>">
  </div>
  
  <div class="form-group">
    <label for="qualifications" data-toggle="popover" title="Qualifications" data-content="Update the qualifications.">Qualifications</label>
    <textarea class="form-control" rows="2" name="qualifications" placeholder="Qualifications"><?php echo $found['qualifications']; ?></textarea>
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="paragraph1" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the page. Click the + Add a paragraph button for up to 10 paragraphs.">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph[0]" placeholder="Paragraph 1"><?php echo $found['paragraph_1']; ?></textarea>
  </div>
  
  <?php
  $paragraphCount = 1;
  
  for ($x = 2; $x <= 10; $x++) {
	  
	  $paragraphNumber = 'paragraph_' . $x;
	  
	  if($found[$paragraphNumber] != ''){
	  
	  echo '<div class="form-group">';
		echo '<label for="listItem" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the page. Click the + Add a paragraph button for up to 10 paragraphs. If there is no paragraph needed, leave this blank.">Paragraph '.$x.'</label>';
		echo '<textarea class="form-control" rows="2" name="paragraph['.$x.']" placeholder="Paragraph '.$x.'">'.$found[$paragraphNumber].'</textarea>';
	  echo '</div>';
	  
	  $paragraphCount++;
	  
	  }
  
  }
  
  ?>
  
  <script>
var counter1 = <?php echo $paragraphCount; ?>;
var limit1 = 10;
function addInput1(divName){
     if (counter1 == limit1)  {
          alert("You have reached the limit of adding " + counter1 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<div class='form-group'><label for='listItem' >Paragraph " + (counter1 + 1) + "</label><textarea class='form-control' rows='2' name='paragraph[" + (counter1 + 1) + "]' placeholder='Paragraph " + (counter1 + 1) + "'></textarea></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter1++;
     }
}
  </script>
  
  <div id="dynamicInput1"></div>
  
  <button type="button" class="btn btn-info" value="Add another text input" onClick="addInput1('dynamicInput1');">+ Add another paragraph</button>
  
  <!-- end of the dynamic list -------------------------------------------->
  
  <hr>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Personnel Image" data-content="Update the image. If the image does not need to be updated, skip this section and the current image will be used.">Personnel Image</label>
    <input type="file" id="purposeImage" name="photo">
    <p class="help-block">Image size must be (572 Width X 715 Height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update <?php echo $found['first_name']; ?></button>
</form>

<?php require_once('footer.php'); ?>