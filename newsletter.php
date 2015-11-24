<?php
// init variables
	$min_number = 0;
	$max_number = 8;

	// generating random numbers
	//$random_number1 = mt_rand($min_number, $max_number);
	
	switch ($random_number1 = mt_rand($min_number, $max_number)) {
    case "0":
        $feedback2 = "What digit comes after zero?";
        break;
    case "1":
        $feedback2 = "What digit comes after one?";
        break;
	case "2":
        $feedback2 = "What digit comes after two?";
        break;
	case "3":
        $feedback2 = "What digit comes after three?";
        break;
	case "4":
        $feedback2 = "What digit comes after four?";
        break;
	case "5":
        $feedback2 = "What digit comes after five?";
        break;
	case "6":
        $feedback2 = "What digit comes after six?";
        break;
	case "7":
        $feedback2 = "What digit comes after seven?";
        break;
	case "8":
        $feedback2 = "What digit comes after eight?";
        break;
	}


if(isset($_POST['submitButton'])){
	
	// include the variables for the forms database
	require_once('variables.php');
	
	// build the database connection with host, user, password, database to make sure there is not a duplicate email
	$dbc = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');
	
	// make sure someone isn't already registered using this email
		$query = "SELECT email FROM newsletter WHERE email='".mysqli_real_escape_string($dbc, trim($_POST[email]))."'";
		$result = mysqli_query($dbc, $query) or die('query to check for existing email has failed!');
	
	$captchaResult = $_POST["captchaResult"];
		$firstNumber = $_POST["firstNumber"];

		$checkTotal = $firstNumber + 1;

		if ($captchaResult == $checkTotal) {
			// happens if true
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
	
		} else {
			$feedback = '<p class="adminRed">Wrong Digit Entered. Please Try Again.</p>';
		}
	}
	
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
        
        <div class="form-group">
			<label for="message"><?php
			$feedback2 = stripslashes($feedback2);
			echo $feedback2;
			?></label>
            
            <div class="row">
            <div class="col-md-2">
			<input name="captchaResult" class="form-control" type="text" size="2" maxlength="1" />
            <input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
            </div></div>

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