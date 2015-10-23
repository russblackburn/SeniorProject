<?php
require_once('adminAuthorize.php');
require_once('adminVariables.php');

$course_ID = $_GET[id];

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton']))
	{
	// load the data from the form
	$courseID = $_POST[id];
	$contentID = $_POST[contentID];
	$clear = 0;
	
	
			// clear the previous selection that the courseID was set too
				//build the query
				$query2 = "UPDATE courseContent SET courseID='$clear' WHERE courseID=$courseID";
				
				// talk with the database
				$result2 = mysqli_query($dbc, $query2) or die('your query has failed 1');
		
		// set the new selection choosen
		if($contentID == 0){
			//build the query
			$query = "UPDATE courseContent SET courseID='$clear' WHERE id=$contentID";
			
			// talk with the database
			$result = mysqli_query($dbc, $query) or die('your query has failed 1');
		}
		else{
			//build the query
			$query = "UPDATE courseContent SET courseID='$courseID' WHERE id=$contentID";
			
			// talk with the database
			$result = mysqli_query($dbc, $query) or die('your query has failed 1');
			}
		
		
		$feedback = '<p class="adminGreen">The course content and form have been linked to the course. <a href="adminTrainingLinkForm.php">&#8617; Link a Course Form List</a></p>';
		
		
		
	
	};//end of if submit/isset
	
	// build the query to display the current personnel
	$query01 = "SELECT * FROM coreCourse WHERE id=$course_ID";
	
	//communicate with the database
	$result01 = mysqli_query($dbc, $query01) or die('The query has failed!');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result01);
	
	// build the query to display the current personnel
	$query02 = "SELECT * FROM courseContent ORDER BY contentTitle ASC";
	
	//communicate with the database
	$result02 = mysqli_query($dbc, $query02) or die('The query has failed!');
	
	// terminate the connection with the database
	mysqli_close($dbc);

?>
<?php
$page = admin;
$adminPage = services;
$adminSecondaryPage = services13;
?>
<?php require_once('header.php'); ?>

<h1>Link <?php echo $found['courseTitle'];?> Form</h1>

<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="link_course">

<label for="link" data-toggle="popover" title="Link Course Content" data-content="Directions.">Link Course Content</label>
    <div class="form-group">
        <div class="form-group">
            <select class="form-control" name="contentID">
               <option value="0">None</option>
               <?php
				   while($row02 = mysqli_fetch_array($result02)){
					   $holder = $row02['id'];
					   
						echo '<option value="'.$holder.'"';
						if($found['id'] == $row02['courseID']){echo 'selected="selected"';}
						echo '>'.$row02['contentTitle'].'</option>';
				   }
			   ?>
            </select>
            
		</div>
	</div>
  
  
  <input type="hidden" name="id" value="<?php echo $found['id']; ?>">
  <button type="submit" class="btn btn-default" name="submitButton">Link</button>
</form>

<?php require_once('footer.php'); ?>