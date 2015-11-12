<?php $page = services; ?>
<?php $secondaryPage = exercises; ?>


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
			require_once('requestServiceProposalProcess.php');
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
	$query = "SELECT * FROM exercises";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<div class="pagePadding">
<h1>Exercises</h1>


<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<img class="col-xs-12 col-sm-6 pull-right paddingBottom" src="images/home/exercises.jpg" alt="exercises">

<!-- paragraphs -->
<?php
if($found['paragraph1'] != NULL) {
	// CHECK PARAGRAPH 1
	echo '<p>'.$found['paragraph1'].'</p>';
	
	// CHECK PARAGRAPH 2
	if($found['paragraph2'] != NULL) {
		echo '<p>'.$found['paragraph2'].'</p>';
			
		// CHECK PARAGRAPH 3
		if($found['paragraph3'] != NULL) {
			echo '<p>'.$found['paragraph3'].'</p>';
				
			// CHECK PARAGRAPH 4
			if($found['paragraph4'] != NULL) {
				echo '<p>'.$found['paragraph4'].'</p>';
				
				// CHECK PARAGRAPH 5
				if($found['paragraph5'] != NULL) {
					echo '<p>'.$found['paragraph5'].'</p>';
					
					// CHECK PARAGRAPH 6
					if($found['paragraph6'] != NULL) {
						echo '<p>'.$found['paragraph6'].'</p>';
						
						// CHECK PARAGRAPH 7
						if($found['paragraph7'] != NULL) {
							echo '<p>'.$found['paragraph7'].'</p>';
							
							// CHECK PARAGRAPH 8
							if($found['paragraph8'] != NULL) {
								echo '<p>'.$found['paragraph8'].'</p>';
								
								// CHECK PARAGRAPH 9
								if($found['paragraph9'] != NULL) {
									echo '<p>'.$found['paragraph9'].'</p>';
									
									// CHECK PARAGRAPH 10
									if($found['paragraph10'] != NULL) {
										echo '<p>'.$found['paragraph10'].'</p>';
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	else {
		echo '<p>Page needs content</p>';
	}
?>
<!-- end of paragraphs -->


<!-- registration instructions -->
<?php
if($found[registration_instructions] != NULL) {
	echo '<h2 class="thinText">Registration Instructions</h2>';
	echo '<hr>';
	echo '<p>'.$found[registration_instructions].'</p>';
	}
?>
<!-- end of registration instructions -->


<!-- registration form -->
<div class="clear"></div>
<hr>
<?php require_once('requestServiceProposalForm.php'); ?>
<!-- end of registration form -->



</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>