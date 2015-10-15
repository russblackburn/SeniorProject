<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$faq_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$question = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[question])));
	$answer= stripslashes(mysqli_real_escape_string($dbc, trim($_POST[answer])));
	
		//build the query
		$query = "UPDATE faq SET question='$question', answer='$answer' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		$feedback = '<p class="adminGreen">Your FAQ has been updated. <a href="faq.php">&#8617; View FAQ Page</a></p>';
		
	
	};//end of if submit/isset
	
	// build the query to display the current faq
	$query01 = "SELECT * FROM faq WHERE id=$faq_id";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// terminate the connection
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = faq;
$adminSecondaryPage = faq2;
?>
<?php require_once('header.php'); ?>

<h1>Update FAQ</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="update_personnel">

<div class="form-group">
    <label for="question" data-toggle="popover" title="Question" data-content="Update the frequently asked question.">Question</label>
    <textarea class="form-control" rows="2" name="question" placeholder="Add Question"><?php echo $found['question']; ?></textarea>
  </div>
  
  <div class="form-group">
    <label for="answer" data-toggle="popover" title="Answer" data-content="Update the answer for the question.">Answer</label>
    <textarea class="form-control" rows="2" name="answer" placeholder="Add Answer"><?php echo $found['answer']; ?></textarea>
  </div>
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Update FAQ</button>
</form>

<?php require_once('footer.php'); ?>