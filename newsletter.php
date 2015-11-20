<?php
if(isset($_POST['submitButton'])){
	
	// include the variables for the forms database
	require_once('variables.php');
	
	// build the database connection with host, user, password, database to make sure there is not a duplicate email
	$dbc = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');
	
	// make sure someone isn't already registered using this email
		$query = "SELECT email FROM newsletter WHERE email='".mysqli_real_escape_string($dbc, trim($_POST[email]))."'";
		$result = mysqli_query($dbc, $query) or die('query to check for existing email has failed!');
		
		
		if(!empty($_POST[email])){
			
			if(mysqli_num_rows($result) == 0) {
				// not in the database, add the email to the database and redirect to a thank you page
				
				// load the data from the form
				$email = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[email])));
	
				// build the query
				$query1 = "INSERT INTO newsletter(email)". 
				"VALUES ('$email')";
	
				// communicate the query with the database
				$result1 = mysqli_query($dbc, $query1) or die('The databse query has failed!');
				
				header("Location: newsletterThanks.php");
			}
			else{
				// already in the database, send feedback to the user so that they know they are already registered
				$feedback = '<span class="adminGreen">You have already subscribed to our Newsletter</span>';
			}// end of conditional with else statement
		}
		else{
				$feedback = '<span class="adminRed">Please type in your email</span>';
			}// end of check to make sure that the email is not empty
	}// end of isset
	
?>

<?php 
	$page = contact;
	$secondaryPage = newsletter;
	require_once('header.php');

	

?>

<div class="pagePadding">
<h1>Subscribe to our Newsletter</h1>


<hr>

<?php
	echo $feedback;
?>



<div class="break"></div>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="newsletterForm">

    <div class="newsletterStyle">
    
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        
        <button type="submit" class="btn btn-primary" name="submitButton">Subscribe</button>
        
    </div>
    
</form>

<div class="break"></div>
	


</div>

<?php
// terminate the connection with the database
mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>