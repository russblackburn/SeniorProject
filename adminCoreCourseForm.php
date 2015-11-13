<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin; 
$adminPage = services;
$adminSecondaryPage = services1;
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$courseTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[courseTitle])));
	$registrationInstructions = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[registrationInstructions])));
	$hide = 'F';
	$includeOnForm = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[includeOnForm])));
	$photo = $_POST[photo];
	$image_name = 'coreCourse';
	
		//loop through the $myInputs array for list items
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
		
		//loop through the $linkTitle array for list items
		$link = $_POST["link"];
		
		$i = 1;
		foreach ($link as $eachInput) {
			 if($eachInput != ''){
			 ${'link' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
	//load the data for the slider
	$slide_hidden = 'T';
	
	//determine if the checkbox is checked
	if($includeOnForm == yes){
			$includeOnForm = yes;
		}
		else{
			$includeOnForm = no;
			}
	
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
	$query = "INSERT INTO coreCourse(courseTitle, paragraph1, paragraph2, paragraph3, paragraph4, paragraph5, paragraph6, paragraph7, paragraph8, paragraph9, paragraph10, listItem1, listItem2, listItem3, listItem4, listItem5, listItem6, listItem7, listItem8, listItem9, listItem10, listItem11, listItem12, listItem13, listItem14, listItem15, listItem16, listItem17, listItem18, listItem19, listItem20, registrationInstructions, linkTitle1, link1, linkTitle2, link2, linkTitle3, link3, photo, hide, slide_hidden, includeOnForm)". 
	"VALUES ('$courseTitle','$paragraph1','$paragraph2','$paragraph3','$paragraph4','$paragraph5','$paragraph6','$paragraph7','$paragraph8','$paragraph9','$paragraph10','$listItem1','$listItem2','$listItem3','$listItem4','$listItem5','$listItem6','$listItem7','$listItem8','$listItem9','$listItem10','$listItem11','$listItem12','$listItem13','$listItem14','$listItem15','$listItem16','$listItem17','$listItem18','$listItem19','$listItem20','$registrationInstructions','$linkTitle1','$link1','$linkTitle2','$link2','$linkTitle3','$link3','$filename','$hide','$slide_hidden','$includeOnForm')";
	
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

<h1>Add a New Course</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_course">

  <div class="form-group">
    <label for="courseTitle" data-toggle="popover" title="Course Title" data-content="Title for the course.">Course Title</label>
    <input type="text" class="form-control" id="courseTitle" name="courseTitle" placeholder="Course Title">
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
  
	<button type="button" class="btn btn-info" value="Add another text input" onClick="addInput1('dynamicInput1');">+ Add another paragraph</button>
    
<!-- end of the paragraph list -->
  
  <hr>
  
  <!-- adding the unordered list for the course -->
  
  <script>
var counter = 1;
var limit = 20;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<div class='form-group'><label for='listItem' >Objective " + (counter + 1) + "</label><textarea class='form-control' rows='2' name='myInputs[]' placeholder='Objective " + (counter + 1) + "'></textarea></div>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
  </script>
  
  <div class="form-group">
    <label for="listItem" data-toggle="popover" title="List Items" data-content="Create an unordered list that will display after the paragraphs. Click the + Add another list item button for up to 20 list items. ">Objective 1</label>
    <textarea class="form-control" rows="2" name="myInputs[]" placeholder="Objective 1"></textarea>
  </div>
  
  <div id="dynamicInput"></div>
  
	<button type="button" class="btn btn-info" value="Add another text input" onClick="addInput('dynamicInput');">+ Add another objective</button>
    
<!-- end of the unordered list -->

  <hr>
  
  <div class="form-group">
    <label for="registrationInstructions" data-toggle="popover" title="Registration Instructions" data-content="Instructions for registering for this course. If there are no instructions needed, leave this blank.">Registration Instructions</label>
    <textarea class="form-control" rows="2" name="registrationInstructions" placeholder="Registration Instructions"></textarea>
  </div>
  
  <hr>
  
  <!-- adding the link list for the course -->
  
  <script>
var counter2 = 1;
var limit2 = 3;
function addInput2(divName){
     if (counter2 == limit2)  {
          alert("You have reached the limit of adding " + counter2 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = '<hr><div class="form-group"><label for="linkTitle" data-toggle="popover" title="Link Title" data-content="Label the button that is displayed on the page (i.e. Name of the company or course you are creating the link for). If there is no link, leave this blank.">Link Title</label><input type="text" class="form-control" id="linkTitle" name="linkTitle[]" placeholder="Link Title"></div><div class="form-group"><label for="link" data-toggle="popover" title="Link" data-content="Copy and paste the link to the page or site that you want to display.">Link</label><input type="text" class="form-control" id="link" name="link[]" placeholder="Link"></div>';
          document.getElementById(divName).appendChild(newdiv);
          counter2++;
     }
}
  </script>
  
  <div class="form-group">
    <label for="linkTitle" data-toggle="popover" title="Link Title" data-content="Label the button that is displayed on the page (i.e. Name of the company or course you are creating the link for). If there is no link, leave this blank. Click the + Add another link button for up to 3 links.">Link Title</label>
    <input type="text" class="form-control" id="linkTitle" name="linkTitle[]" placeholder="Link Title">
  </div>
  
  <div class="form-group">
    <label for="link" data-toggle="popover" title="Link" data-content="Copy and paste the link to the page or site that you want to display. Click the + Add another link button for up to 3 links.">Link</label>
    <input type="text" class="form-control" id="link" name="link[]" placeholder="Link">
  </div>
  
  <div id="dynamicInput2"></div>
  
	<button type="button" class="btn btn-info" value="Add another text input" onClick="addInput2('dynamicInput2');">+ Add another link</button>
    
<!-- end of the link list -->
  
  <hr>
  
  <!-- choose to include a registration form with the course -->
  <label for="checkbox" data-toggle="popover" title="Include in Registration Form" data-content="Check this box if you want to include this course on the student registration form (this will also add a form directly to the bottom of the course page).">Include in Registration Form</label>
  <div class="checkbox">
  <label>
    <input type="checkbox" value="yes" name="includeOnForm">
    Include
  </label>
</div>
  
  <hr>
  
  <div class="form-group">
    <label for="exampleInputFile" data-toggle="popover" title="Course Image" data-content="Add the course image. An image must be uploaded at this time.">Course Image</label>
    <input type="file" id="slideImage" name="photo">
    <p class="help-block">Image size must be (715 Width X 572 Height)</p>
  </div>
  
  <button type="submit" class="btn btn-primary" name="submitButton">Add Core Course</button>
</form>

<?php require_once('footer.php'); ?>