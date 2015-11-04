<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');
$page = admin;
$adminPage = register;
$adminSecondaryPage = register4; 
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$form_element = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[form_element])));
	
	// build the query
	$query = "INSERT INTO instructor_form_elements(form_element)". 
	"VALUES ('$form_element')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);
	
	$feedback = '<p class="adminGreen">The form element has been added to the form. <a href="instructorRegistration.php">&#8617; View INSTRUCTOR REGISTRATION Page</a></p>';
	
	};//end of if submit/isset
	
	?>

<h1>Add a New Course/Topic of Interest</h1>

<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_form_element">

  <div class="form-group">
    <label for="formElement" data-toggle="popover" title="Form Element" data-content="Add a new form element to the instuctor registration form.">Form Element</label>
    <input type="text" class="form-control" id="formElement" name="form_element" placeholder="Form Element">
  </div>
  
  <button type="submit" class="btn btn-primary" name="submitButton">Add Form Element</button>
</form>

<?php require_once('footer.php'); ?>