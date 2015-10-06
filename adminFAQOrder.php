<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin; 
	require_once('header.php'); 
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM faq ORDER BY priority";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	
	// when submit is pressed
	if(isset($_POST['submitButton'])){
		// pull the items from the form
		$id = $_POST[id];
		$priority = $_POST[priority];
	
		// build the database connection with host, user, password, database
		$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
		
		//make sure someone isn't already registerd using this username
		$query = "SELECT * FROM faq WHERE priority = '$priority'";
		$alreadyexists = mysqli_query($dbc, $query) or die ('already exists query failed');
		
		if(mysqli_num_rows($alreadyexists) == 0){
	
			//build the query
			$query = "UPDATE faq SET priority='$priority' WHERE id=$id ";
	
			// talk with the database
			$result = mysqli_query($dbc, $query) or die('your update query has failed');
	
			// terminate the connection
			mysqli_close($dbc);
			
			$feedback = '<p>The FAQ order has been updated. <a href="adminFAQOrder.php">Change Order</a></p>';
		
		
		}else{
			//An account already exists for this username, so display an error message
			$feedback = '<p class="adminRed">That number is already selected. Please choose a different number.</p>';}
}
?>

<h1>Order FAQ</h1>

<hr>
<?php echo $feedback;?>
<?php

//DISPLAY WHAT WE FOUND
while($row = mysqli_fetch_array($result)){
	echo '<h4>';
	echo $row['question'].' | Priority: '. $row['priority'];
	echo '</h4>';
	//echo ' <a href="adminPersonnelOrderUpdate.php?id='. $row['id'].'">[update]</a>';
	echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data" name="update_priority">';
	
	echo '<div class="form-group">';
    //<label for="firstName">First Name</label>
    echo '<input type="number" size="2" min="1" max="99" class="form-control" id="priority" name="priority" placeholder="Needs Priority Number" value="'.$row['priority'].'">';
  	echo '</div>';
	
	
	echo '<input type="hidden" name="id" value="'.$row['id'].'">';
  	echo '<button type="submit" class="btn btn-primary" name="submitButton">Update</button>';
	echo '</form>';
	echo '<br>';

	};



//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>