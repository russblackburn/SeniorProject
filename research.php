<?php $page = services; ?>
<?php $secondaryPage = research; ?>
<?php
// init variables
	$min_number = 0;
	$max_number = 8;

	// generating random numbers
	$random_number1 = mt_rand($min_number, $max_number);
	
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
	$query = "SELECT * FROM research";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
	
	// BUILD THE QUERY FOR THE RESEARCH TITLE BAR AND <HR>
		//BUILD THE QUERY
		$query1 = "SELECT * FROM newResearch WHERE hide='F'";

		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
		// put what is found from the query into a variable
		$found1 = mysqli_fetch_array($result1);
		
	// BUILD THE QUERY FOR THE RESEARCH
		//BUILD THE QUERY
		$query2 = "SELECT * FROM newResearch WHERE hide='F'";

		//TRY AND TALK TO THE DB
		$result2 = mysqli_query($dbc, $query2) or die('query failed');
?>

<div class="pagePadding">
<h1>Research</h1>


<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<img class="col-xs-12 col-sm-6 pull-right paddingBottom" src="images/home/research.jpg" alt="research">

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

<?php
// DISPLAY THE TITLE AND <HR> IF THERE IS A RESEARCH PROJECT TO DISPLAY
if($found1[id] != NULL) {
	echo '<h2 class="thinText">Research Projects</h2>';
	echo '<hr>';
	}
?>

<!-- display research -->
<div class="row">
<?php
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-6 col-md-4">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/research/'.$row2['photo'].'">';
					echo '<figcaption>';
						echo '<h2>'.$row2['researchTitle'].'<span></span></h2>';
						echo '<a href="researchDetail.php?id='. $row2['id'].'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>
</div>
<!-- end of display research -->


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