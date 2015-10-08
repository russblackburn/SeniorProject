<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// when submit is pressed
if(isset($_POST['submitButton'])){
	// pull the items from the form
	$id = $_POST[id];
	$paragraph1 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph1])));
	$paragraph2 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph2])));
	$paragraph3 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph3])));
	$paragraph4 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph4])));
	$paragraph5 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph5])));
	$paragraph6 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph6])));
	$paragraph7 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph7])));
	$paragraph8 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph8])));
	$paragraph9 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph9])));
	$paragraph10 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[paragraph10])));
	$registration_instructions = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[registration_instructions])));
	
	//build the query
		$query = "UPDATE exercises SET paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3', paragraph4='$paragraph4', paragraph5='$paragraph5', paragraph6='$paragraph6', paragraph7='$paragraph7', paragraph8='$paragraph8', paragraph9='$paragraph9', paragraph10='$paragraph10', registration_instructions='$registration_instructions' WHERE id=$id ";
	
	// talk with the database
	$result = mysqli_query($dbc, $query) or die('your query has failed');
	
	$feedback = '<p class="adminGreen">The Exercise page has been updated. <a href="exercises.php">&#8617; View EXERCISE Page</a></p>';

}// end of isset

// build the query to display the current mission statement
$query01 = "SELECT * FROM exercises";

//communicate with the database
$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result01);

// terminate the connection
mysqli_close($dbc);

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update Exercises</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_exercises">

  <div class="form-group">
    <label for="paragraph1">Paragraph 1</label>
    <textarea class="form-control" rows="2" name="paragraph1" placeholder="Paragraph 1"><?php echo $found['paragraph1']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph2">Paragraph 2</label>
    <textarea class="form-control" rows="2" name="paragraph2" placeholder="Paragraph 2"><?php echo $found['paragraph2']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph3">Paragraph 3</label>
    <textarea class="form-control" rows="2" name="paragraph3" placeholder="Paragraph 3"><?php echo $found['paragraph3']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph4">Paragraph 4</label>
    <textarea class="form-control" rows="2" name="paragraph4" placeholder="Paragraph 4"><?php echo $found['paragraph4']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph5">Paragraph 5</label>
    <textarea class="form-control" rows="2" name="paragraph5" placeholder="Paragraph 5"><?php echo $found['paragraph5']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph6">Paragraph 6</label>
    <textarea class="form-control" rows="2" name="paragraph6" placeholder="Paragraph 6"><?php echo $found['paragraph6']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph7">Paragraph 7</label>
    <textarea class="form-control" rows="2" name="paragraph7" placeholder="Paragraph 7"><?php echo $found['paragraph7']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph8">Paragraph 8</label>
    <textarea class="form-control" rows="2" name="paragraph8" placeholder="Paragraph 8"><?php echo $found['paragraph8']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph9">Paragraph 9</label>
    <textarea class="form-control" rows="2" name="paragraph9" placeholder="Paragraph 9"><?php echo $found['paragraph9']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="paragraph10">Paragraph 10</label>
    <textarea class="form-control" rows="2" name="paragraph10" placeholder="Paragraph 10"><?php echo $found['paragraph10']; ?></textarea>
  </div>
  
  <hr>
  
  <div class="form-group">
    <label for="registrationInstructions">Registration Instructions</label>
    <textarea class="form-control" rows="2" name="registration_instructions" placeholder="Registration Instructions"><?php echo $found['registration_instructions']; ?></textarea>
  </div>
  
  <br>
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update Exercises</button>
</form>

<?php require_once('footer.php'); ?>