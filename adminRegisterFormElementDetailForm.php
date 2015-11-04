<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$form_element_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$form_element = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[form_element])));
		
		//build the query
		$query = "UPDATE instructor_form_elements SET form_element='$form_element' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">'.$form_element.' has been updated. <a href="adminRegisterUpdateFormElement.php">&#8617; Form Element List</a></p>';
		
	
	};//end of if submit/isset
	
	// build the query to display the current personnel
	$query01 = "SELECT * FROM instructor_form_elements WHERE id=$form_element_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = register;
$adminSecondaryPage = register5;
?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['form_element']?></h1>

<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>
<?php
$feedback2 = stripslashes($feedback2);
echo $feedback2;
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_form_element">

<div class="form-group">
    <label for="firstName" data-toggle="popover" title="Form Element" data-content="Update a form element on the instuctor registration form.">Form Element</label>
    <input type="text" class="form-control" id="formElement" name="form_element" placeholder="Form Element" value="<?php echo $found['form_element']; ?>">
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update <?php echo $found['form_element']; ?></button>
</form>

<?php require_once('footer.php'); ?>