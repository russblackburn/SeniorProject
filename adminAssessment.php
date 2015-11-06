<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// when submit is pressed
if(isset($_POST['submitButton'])){
	// pull the items from the form
	$id = $_POST[id];
	$registration_instructions = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[registration_instructions])));
	
		//loop through the $paragraph array for paragraphs
		$paragraph = $_POST["paragraph"];
		
		$i = 1;
		foreach ($paragraph as $eachInput) {
			 if($eachInput != ''){
			 ${'paragraph' . $i} = stripslashes(mysqli_real_escape_string($dbc, trim($eachInput)));
			 $i++;
			 }
		}
	
	//build the query
		$query = "UPDATE assessment SET paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10', registration_instructions='$registration_instructions' WHERE id=$id ";
	
	// talk with the database
	$result = mysqli_query($dbc, $query) or die('your query has failed');
	
	$feedback = '<p class="adminGreen">The Assessment page has been updated. <a href="assessment.php">&#8617; View ASSESSMENT Page</a></p>';

}// end of isset

// build the query to display the current mission statement
$query01 = "SELECT * FROM assessment";

//communicate with the database
$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result01);

// terminate the connection
mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = services;
$adminSecondaryPage = services7;
?>
<?php require_once('header.php'); ?>

<h1>Update Assessment</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_assessment">

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
    <label for="registrationInstructions" data-toggle="popover" title="Registration Instructions" data-content="Instructions for registration. If there are no instructions needed, leave this blank.">Registration Instructions</label>
    <textarea class="form-control" rows="2" name="registration_instructions" placeholder="Registration Instructions"><?php echo $found['registration_instructions']; ?></textarea>
  </div>
  
  <br>
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-primary" name="submitButton">Update Assessment</button>
</form>

<?php require_once('footer.php'); ?>