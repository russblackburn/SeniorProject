<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$faq_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current faq
$query = "SELECT * FROM faq WHERE id=$faq_id";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$question = mysqli_real_escape_string($dbc, trim($_POST[question]));
	$answer= mysqli_real_escape_string($dbc, trim($_POST[answer]));
	
	
		//build the query
		$query = "UPDATE faq SET question='$question', answer='$answer' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		// redirect to the adminLanind page
			header('Location: adminFAQUpdate.php');
		
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update <?php echo $found['first_name'].' '.$found['last_name'];?></h1>

<hr>
<?php echo $feedback;?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_personnel">

<div class="form-group">
    <label for="question">Question</label>
    <textarea class="form-control" rows="2" name="question" placeholder="Add Question"><?php echo $found['question']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="answer">Answer</label>
    <textarea class="form-control" rows="2" name="answer" placeholder="Add Answer"><?php echo $found['answer']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update FAQ</button>
</form>

<?php require_once('footer.php'); ?>