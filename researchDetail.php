<?php $page = services; ?>
<?php $secondaryPage = research; ?>
<?php require_once('header.php');
require_once('adminVariables.php');

// GET THE ID OF THE CHOOSEN RESEARCH
$researchID = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM newResearch WHERE id=$researchID";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<div class="pagePadding">
<h1><?php echo $found[researchTitle]; ?></h1>


<hr>


<img class="col-xs-12 col-sm-6 pull-right paddingBottom" src="images/research/<?php echo $found['photo']; ?>" alt="research">

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
</div>

<?php require_once('footer.php'); ?>