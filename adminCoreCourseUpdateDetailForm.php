<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$course_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$courseTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[courseTitle])));
	$registrationInstructions = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[registrationInstructions])));
	$includeOnForm = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[includeOnForm])));
	$photo = $_POST[photo];
	$image_name = 'coreCourse';
	$old_image = $_POST[old_image];
	
		//loop through the $paragraph array for paragraphs
		$paragraph = $_POST["paragraph"];
		
		$i = 1;
		foreach ($paragraph as $eachInput) {
			 if($eachInput != ''){
			 ${'paragraph' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
		//loop through the $myInputs array for list items
		$myInputs = $_POST["myInputs"];
		
		$i = 1;
		foreach ($myInputs as $eachInput) {
			 if($eachInput != ''){
			 ${'listItem' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
		
		//loop through the $linkTitle array for list items
		$linkTitle = $_POST["linkTitle"];
		
		$i = 1;
		foreach ($linkTitle as $eachInput) {
			 if($eachInput != ''){
			 ${'linkTitle' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
		
		//loop through the $link array for list items
		$link = $_POST["link"];
		
		$i = 1;
		foreach ($link as $eachInput) {
			 if($eachInput != ''){
			 ${'link' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
	//determine if the checkbox is checked
	if($includeOnForm == yes){
			$includeOnForm = yes;
		}
		else{
			$includeOnForm = no;
			}
	
	if($_FILES['photo']['size'] == 0){
		
		//build the query
		$query = "UPDATE coreCourse SET courseTitle='$courseTitle', paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10', listItem1='$listItem1', listItem2='$listItem2', listItem3='$listItem3', listItem4='$listItem4', listItem5='$listItem5', listItem6='$listItem6', listItem7='$listItem7', listItem8='$listItem8', listItem9='$listItem9', listItem10='$listItem10', listItem11='$listItem11', listItem12='$listItem12', listItem13='$listItem13', listItem14='$listItem14', listItem15='$listItem15', listItem16='$listItem16', listItem17='$listItem17', listItem18='$listItem18', listItem19='$listItem19', listItem20='$listItem20', registrationInstructions='$registrationInstructions', linkTitle1='$linkTitle1', link1='$link1', linkTitle2='$linkTitle2', link2='$link2', linkTitle3='$linkTitle3', link3='$link3', includeOnForm='$includeOnForm' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
				// UPDATE THE ASSOCIATED EVENTS SO THAT THE NEW COURSETITLE MATCHES ON THE EVENTS PAGE
					$query03 = "UPDATE events SET courseTitle='$courseTitle' WHERE courseID=$id AND thirdParty='1'";
					// talk with the database
					$result03 = mysqli_query($dbc, $query03) or die('your query has failed 1');
				
		
		$feedback = '<p class="adminGreen">'.$courseTitle.' has been updated. <a href="training.php">&#8617; View Training Page</a></p>';
			
			
		}
		
		else{
			//------original photo upload code starts here-------------------------------------------------------
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
				
				//delete the photo associated with the old slider
				@unlink('images/training/course/'.$old_image);
				
			//upload the information to the database since all photo conditions are met and true
			 
			 //build the query
		$query = "UPDATE coreCourse SET courseTitle='$courseTitle', paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10', listItem1='$listItem1', listItem2='$listItem2', listItem3='$listItem3', listItem4='$listItem4', listItem5='$listItem5', listItem6='$listItem6', listItem7='$listItem7', listItem8='$listItem8', listItem9='$listItem9', listItem10='$listItem10', listItem11='$listItem11', listItem12='$listItem12', listItem13='$listItem13', listItem14='$listItem14', listItem15='$listItem15', listItem16='$listItem16', listItem17='$listItem17', listItem18='$listItem18', listItem19='$listItem19', listItem20='$listItem20', registrationInstructions='$registrationInstructions', linkTitle1='$linkTitle1', link1='$link1', linkTitle2='$linkTitle2', link2='$link2', linkTitle3='$linkTitle3', link3='$link3', photo='$filename', includeOnForm='$includeOnForm' WHERE id=$id ";
			
			// communicate the query with the database
			$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
			
					// UPDATE THE ASSOCIATED EVENTS SO THAT THE NEW COURSETITLE MATCHES ON THE EVENTS PAGE
						$query03 = "UPDATE events SET courseTitle='$courseTitle' WHERE courseID=$id AND thirdParty='1'";
						// talk with the database
						$result03 = mysqli_query($dbc, $query03) or die('your query has failed 1');
			
			$feedback = '<p class="adminGreen">'.$courseTitle.' has been updated. <a href="training.php">&#8617; View Training Page</a></p>';
			
			}else{
				//let the user try again
				$feedback2 =  '<p class="adminRed">Please Try Again</p>';
				};//end of upload the file if everything is ok
			}//end of else statement
	
	};//end of if submit/isset
	
	// build the query to display the current mission statement
	$query01 = "SELECT * FROM coreCourse WHERE id=$course_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = services;
$adminSecondaryPage = services3;
?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['courseTitle'];?></h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_research">

<div class="form-group">
    <label for="courseTitle" data-toggle="popover" title="Course Title" data-content="Title for the course.">Course Title</label>
    <input type="text" class="form-control" id="courseTitle" name="courseTitle" placeholder="Course Title" value="<?php echo $found['courseTitle']; ?>">
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="paragraph1" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the course. Click the + Add a paragraph button for up to 10 paragraphs.">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph[0]" placeholder="Paragraph 1"><?php echo $found['paragraph1']; ?></textarea>
  </div>
  
  <?php
  $paragraphCount = 1;
  
  for ($x = 2; $x <= 10; $x++) {
	  
	  $paragraphNumber = 'paragraph' . $x;
	  
	  if($found[$paragraphNumber] != ''){
	  
	  echo '<div class="form-group">';
		echo '<label for="listItem" data-toggle="popover" title="Paragraphs" data-content="Paragraphs for the page. Must have at least one paragraph. This is a description of the course. Click the + Add a paragraph button for up to 10 paragraphs. If there is no paragraph needed, leave this blank.">Paragraph '.$x.'</label>';
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
  
  <!-- begin the list items ---------------------------------->
  
  <div class="form-group">
    <label for="listItem" data-toggle="popover" title="Objective Items" data-content="Update the unordered list that will display after the paragraphs. Click the + Add another objective button for up to 20 objectives. If there are no objectives needed, leave this blank.">Objective 1</label>
    <textarea class="form-control" rows="2" name="myInputs[0]" placeholder="Objective 1"><?php echo $found['listItem1']; ?></textarea>
  </div>
  
  <?php
  $listItemCount = 1;
  
  for ($x = 2; $x <= 20; $x++) {
	  
	  $listItemNumber = 'listItem' . $x;
	  
	  if($found[$listItemNumber] != ''){
	  
	  echo '<div class="form-group">';
		echo '<label for="listItem" data-toggle="popover" title="Objective Items" data-content="Update the unordered list that will display after the paragraphs. Click the + Add another objective button for up to 20 objectives. If there are no objectives needed, leave this blank.">Objective '.$x.'</label>';
		echo '<textarea class="form-control" rows="2" name="myInputs['.$x.']" placeholder="Objective '.$x.'">'.$found[$listItemNumber].'</textarea>';
	  echo '</div>';
	  
	  $listItemCount++;
	  
	  }
  
  }
  
  ?>
  
  <script>
var counter = <?php echo $listItemCount; ?>;
var limit = 20;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<div class='form-group'><label for='listItem' >Objective " + (counter + 1) + "</label><textarea class='form-control' rows='2' name='myInputs[" + (counter + 1) + "]' placeholder='Objective " + (counter + 1) + "'></textarea></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
  </script>
  
  <div id="dynamicInput"></div>
  
  <button type="button" class="btn btn-info" value="Add another text input" onClick="addInput('dynamicInput');">+ Add another objective</button>
  
  <!-- end of the dynamic list -------------------------------------------->
  
  
  
  <hr>
  
  <div class="form-group">
    <label for="registrationInstructions" data-toggle="popover" title="Registration Instructions" data-content="Instructions for registering for this course. If there are no instructions needed, leave this blank.">Registration Instructions</label>
    <textarea class="form-control" rows="2" name="registrationInstructions" placeholder="Registration Instructions"><?php echo $found['registrationInstructions']; ?></textarea>
  </div>
  
  <hr>
  
  <!-- begin the list items ---------------------------------->
  
  <div class="form-group">
    <label for="listItem" data-toggle="popover" title="Link Title" data-content="Label the button that is displayed on the page (i.e. Name of the company or course you are creating the link for). If there is no link, leave this blank. Click the + Add another link button for up to 3 links.">Link Title</label>
    <input type="text" class="form-control" id="linkTitle" name="linkTitle[0]" placeholder="Link Title" value="<?php echo $found['linkTitle1']; ?>">
  </div>
  
  <div class="form-group">
    <label for="link" data-toggle="popover" title="Link" data-content="Copy and paste the link to the page or site that you want to display. Click the + Add another link button for up to 3 links.">Link</label>
    <input type="text" class="form-control" id="link" name="link[0]" placeholder="Link" value="<?php echo $found['link1']; ?>">
  </div>
  
  <?php
  $linkTitleCount = 1;
  
  for ($x = 2; $x <= 3; $x++) {
	  
	  $linkTitleNumber = 'linkTitle' . $x;
	  $linkNumber = 'link' .$x;
	  
	  if($found[$linkTitleNumber] != ''){
		  
		  echo '<hr>';
	  
	  echo '<div class="form-group">';
		echo '<label for="listItem" data-toggle="popover" title="Link Title" data-content="Label the button that is displayed on the page (i.e. Name of the company or course you are creating the link for). If there is no link, leave this blank. Click the + Add another link button for up to 3 links.">Link Title</label>';
		echo '<input type="text" class="form-control" id="linkTitle" name="linkTitle['.$x.']" placeholder="Link Title" value="'.$found[$linkTitleNumber].'">';
	  echo '</div>';
	  
	  	echo '<div class="form-group">';
		echo '<label for="link" data-toggle="popover" title="Link" data-content="Copy and paste the link to the page or site that you want to display. Click the + Add another link button for up to 3 links.">Link</label>';
		echo '<input type="text" class="form-control" id="link" name="link['.$x.']" placeholder="Link" value="'.$found[$linkNumber].'">';
	  	echo '</div>';
	  
	  $linkTitleCount++;
	  
	  }
  
  }
  
  ?>
  
  <script>
var counter2 = <?php echo $linkTitleCount; ?>;
var limit2 = 3;
function addInput2(divName){
     if (counter2 == limit2)  {
          alert("You have reached the limit of adding " + counter2 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<hr><div class='form-group'><label for='listItem' >Link Title</label><textarea class='form-control' rows='2' name='linkTitle[" + (counter2 + 1) + "]' placeholder='Link Title'></textarea></div><div class='form-group'><label for='listItem' >Link</label><textarea class='form-control' rows='2' name='link[" + (counter2 + 1) + "]' placeholder='Link'></textarea></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter2++;
     }
}
  </script>
  
  <div id="dynamicInput2"></div>
  
  <button type="button" class="btn btn-info" value="Add another text input" onClick="addInput2('dynamicInput2');">+ Add another link</button>
  
  <!-- end of the dynamic list -------------------------------------------->
  
  
  <hr>
  
  <!-- choose to include a registration form with the course -->
  <label for="checkbox" data-toggle="popover" title="Include in Registration Form" data-content="Check this box if you want to include this course on the student registration form (this will also add a form directly to the bottom of the course page).">Include in Registration Form</label>
  <div class="checkbox">
  <label>
    <input type="checkbox" value="yes" name="includeOnForm" <?php if($found['includeOnForm'] == 'yes'){echo 'checked';} ?>>
    Include
  </label>
</div>
  
  <hr>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Course Image" data-content="Update the image. If the image does not need to be updated, skip this section and the current image will be used.">Course Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height)</p>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <input type="hidden" name="old_image" value="<?php echo $found['photo']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update <?php echo $found['courseTitle']; ?></button>
</form>

<?php //WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>