<?php
require_once('adminAuthorize.php');
require_once('adminJake.php');
$page = admin; 
require_once('header.php');

// build the database connection with host, user, password, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

	if(isset($_POST['submitButton']))
	{
	if(!empty($_POST['question']) and !empty($_POST['answer']))
	{
	// load the data from the form
	$question = mysqli_real_escape_string($dbc, trim($_POST[question]));
	$answer= mysqli_real_escape_string($dbc, trim($_POST[answer]));
	$priority=$_POST[priority];
	
	// build the query
	$query = "INSERT INTO faq (question, answer, priority)". "VALUES ('$question','$answer','$priority')";
	
	// communicate the query with the database
	$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);

	$feedback = '<p style="color:#5fb760">Your question has been added.</p>';
	
	}else{
	
	$feedback = '<p style="color:red">Please complete both boxes.</p>';
	};

	};//end of if submit/isset
	
	?>

<h1>Add New Question</h1>

<hr>

<?php echo $feedback;?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="add_personnel" data-toggle="validator">
  
  <div class="form-group">
    <label for="question">Question</label>
    <textarea class="form-control" rows="2" name="question" placeholder="Add Question" required="required" ></textarea>
  </div>
  
  <div class="form-group">
    <label for="answer">Answer</label>
    <textarea class="form-control" rows="2" name="answer" placeholder="Add Answer" required="required" ></textarea>
  </div>

  <input type="hidden" name="priority" value="99">
  
  <button type="submit" class="btn btn-default" name="submitButton">Add New FAQ</button>
</form>

<?php require_once('footer.php'); ?>