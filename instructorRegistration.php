<?php $page = register; ?>
<?php $secondaryPage = instructorRegistration; ?>

<?php
//CODE FOR CAPTCHA
// init variables
	$min_number = 0;
	$max_number = 8;

	// generating random numbers
	//$random_number1 = mt_rand($min_number, $max_number);
	
	switch ($random_number1 = mt_rand($min_number, $max_number)) {
    case "0":
        $feedback2 = "What number comes after zero?";
        break;
    case "1":
        $feedback2 = "What number comes after one?";
        break;
	case "2":
        $feedback2 = "What number comes after two?";
        break;
	case "3":
        $feedback2 = "What number comes after three?";
        break;
	case "4":
        $feedback2 = "What number comes after four?";
        break;
	case "5":
        $feedback2 = "What number comes after five?";
        break;
	case "6":
        $feedback2 = "What number comes after six?";
        break;
	case "7":
        $feedback2 = "What number comes after seven?";
        break;
	case "8":
        $feedback2 = "What number comes after eight?";
        break;
	}
	
	if(isset($_POST['submitButton']))
	{
	
	$captchaResult = $_POST["captchaResult"];
		$firstNumber = $_POST["firstNumber"];

		$checkTotal = $firstNumber + 1;

		if ($captchaResult == $checkTotal) {
			require_once('instructorRegistrationProcess.php');
		} else {
			$feedback = '<p class="adminRed">Wrong Answer. Please Try Again.</p>';
		}
	};
?>


<?php require_once('header.php');
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM register WHERE id='2'";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<div class="pagePadding">
<h1>Instructor Registration</h1>
<hr>

<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<?php
if($found['description'] != NULL) {
	// CHECK description
	echo '<p>'.$found['description'].'</p>';
	echo '<hr>';
}
?>

<!-- begin form -->
<?php
require_once('instructorRegistrationForm.php');
?>

</div><!-- end of pagePadding -->

<?php
	// terminate the connection
	mysqli_close($dbc);
?>

<?php require_once('footer.php'); ?>