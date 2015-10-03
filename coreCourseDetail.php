<?php $page = services; ?>
<?php $secondaryPage = training; ?>
<?php require_once('header.php');
require_once('adminVariables.php');

// GET THE SELECTED COURSE FROM THE URL
$courseID = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM coreCourse WHERE id=$courseID";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//put what is found from the query into a variable
	$found = mysqli_fetch_array($result);
?>

<div class="pagePadding">
<h1><?php echo $found[courseTitle]; ?></h1>


<hr>

<img class="col-xs-12 col-sm-6 pull-right paddingBottom" src="images/training/course/<?php echo $found['photo']; ?>" alt="course photo">

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


<!-- upcoming events -->
<h2 class="thinText">Upcoming Events</h2>
<hr>
<p>Page events here</p>
<!-- end of upcoming events -->


<!-- registration instructions -->
<h2 class="thinText">Registration Instructions</h2>
<hr>
<p><?php echo $found[registrationInstructions]; ?></p>
<!-- end of registration instructions -->


<!-- links -->
<?php
// CHECK LINKTITLE 1
if($found[linkTitle1] != NULL) {
	echo '<p><a href="'.$found[link1].'"><button type="button" class="btn btn-primary">'.$found[linkTitle1].'</button></a></p>';
	
	// CHECK LINKTITLE 2
	if($found[linkTitle2] != NULL) {
		echo '<p><a href="'.$found[link2].'"><button type="button" class="btn btn-primary">'.$found[linkTitle2].'</button></a></p>';
		
		// CHECK LINKTITLE 3
		if($found[linkTitle2] != NULL) {
			echo '<p><a href="'.$found[link3].'"><button type="button" class="btn btn-primary">'.$found[linkTitle3].'</button></a></p>';
			}
		}
	}


?>
<!-- end of links -->


</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>