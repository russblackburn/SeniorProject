<?php
require_once('adminAuthorize.php');
require_once('adminRuss.php');

$research_id = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current mission statement
$query = "SELECT * FROM newResearch WHERE id=$research_id";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$id = $_POST[id];
	$hide = mysqli_real_escape_string($dbc, trim($_POST[hide]));
	
	
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//build the query
		$query = "UPDATE newResearch SET hide='$hide' WHERE id=$id ";
		
		// talk with the database
		$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		
		// terminate the connection
		mysqli_close($dbc);
		
		header('Location: adminResearchHide.php');
	
	};//end of if submit/isset

?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Hide/Un-hide</h1>

<hr>

<p><?php echo $found['researchTitle'];?> is currently <?php if($found['hide'] == T){ echo 'hidden';}else{echo 'visible';} ?></p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="hide_research">
  
  <?php
  
  if($found['hide'] == T){
	  echo '<input type="hidden" name="hide" value="F">';
	  }else{
		  echo '<input type="hidden" name="hide" value="T">';
		  }
  
  ?>
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton"><?php
  
  if($found['hide'] == T){
	  echo 'Un-hide';
	  }else{
		  echo 'Hide';
		  }
  
  ?></button>
</form>

<?php require_once('footer.php'); ?>