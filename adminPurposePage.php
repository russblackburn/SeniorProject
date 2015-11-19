<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$photo = $_POST[photo];
	$old_image = $_POST[old_image];
	$image_name = 'purpose';
	
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
		$query = "UPDATE purpose SET paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">The purpose has been updated. <a href="purpose.php">&#8617; View Purpose Page</a></p>';
		}
		
		else{		
			//------original photo upload code starts here-------------------------------------------------------
			//--------make dynamic photo path and name-------------
			$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$filename = $image_name . time() . '.' . $ext;
			$filepath = 'images/purpose/';
			
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
				
				//delete the photo associated with the old slider
				@unlink('images/purpose/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE purpose SET paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10', purpose_image='$filename' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
			$feedback = '<p class="adminGreen">The purpose has been updated. <a href="purpose.php">&#8617; View Purpose Page</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset
	
	// build the query to display the current mission statement
	$query01 = "SELECT * FROM purpose";
	
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
$adminSecondaryPage = about1; 
?>
<?php require_once('header.php'); ?>

<h1>Update Purpose</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_purpose">

	<div class="form-group">
    <label for="paragraph1" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the page. Click the + Add a paragraph button for up to 10 paragraphs.">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph[0]" placeholder="Paragraph 1"><?php echo $found['paragraph1']; ?></textarea>
  </div>
  
  <?php
  $paragraphCount = 1;
  
  for ($x = 2; $x <= 10; $x++) {
	  
	  $paragraphNumber = 'paragraph' . $x;
	  
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
    <label for="exampleInputFile" data-toggle="popover" title="Purpose Image" data-content="Update the image. If the image does not need to be updated, skip this section and the current image will be used.">Purpose Image</label>
    <input type="file" id="purposeImage" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height)<br>Image format must be (jpeg, png, gif)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['purpose_image']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update Purpose</button>
</form>

<?php require_once('footer.php'); ?>