<?php
$page = about;
$secondaryPage = personnel;
require_once('header.php');
require_once('adminVariables.php');

	$personnelID = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM personnel WHERE id=$personnelID";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<h1><?php echo $found[first_name].' '.$found[last_name].' <span class="thinText"> | '.$found[qualifications];?></span></h1>

<hr>

<img class="col-xs-12 col-sm-6 pull-right paddingBottom" src="images/personnel/<?php echo $found['photo']; ?>" alt="personnel">

<?php

if($found['paragraph_1'] != NULL) {
	// CHECK PARAGRAPH 1
	echo '<p>'.$found['paragraph_1'].'</p>';
	
	// CHECK PARAGRAPH 2
	if($found['paragraph_2'] != NULL) {
		echo '<p>'.$found['paragraph_2'].'</p>';
			
		// CHECK PARAGRAPH 3
		if($found['paragraph_3'] != NULL) {
			echo '<p>'.$found['paragraph_3'].'</p>';
				
			// CHECK PARAGRAPH 4
			if($found['paragraph_4'] != NULL) {
				echo '<p>'.$found['paragraph_4'].'</p>';
				
				// CHECK PARAGRAPH 5
				if($found['paragraph_5'] != NULL) {
					echo '<p>'.$found['paragraph_5'].'</p>';
					
					// CHECK PARAGRAPH 6
					if($found['paragraph_6'] != NULL) {
						echo '<p>'.$found['paragraph_6'].'</p>';
						
						// CHECK PARAGRAPH 7
						if($found['paragraph_7'] != NULL) {
							echo '<p>'.$found['paragraph_7'].'</p>';
							
							// CHECK PARAGRAPH 8
							if($found['paragraph_8'] != NULL) {
								echo '<p>'.$found['paragraph_8'].'</p>';
								
								// CHECK PARAGRAPH 9
								if($found['paragraph_9'] != NULL) {
									echo '<p>'.$found['paragraph_9'].'</p>';
									
									// CHECK PARAGRAPH 10
									if($found['paragraph_10'] != NULL) {
										echo '<p>'.$found['paragraph_10'].'</p>';
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


<?php require_once('footer.php'); ?>