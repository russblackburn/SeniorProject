<?php $page = services; ?>
<?php $secondaryPage = training; ?>
<?php require_once('header.php');
require_once('adminVariables.php');

// GET THE SELECTED COURSE FROM THE URL
$courseID = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM thirdPartyCourse WHERE id=$courseID";

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
<?php
	//BUILD THE QUERY
	$query01 = "SELECT * FROM events WHERE courseID=$courseID AND thirdParty='2' AND hide='F' ORDER BY dateOrder ASC";

	//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
	
	//TRY AND TALK TO THE DB
	$result02 = mysqli_query($dbc, $query01) or die('query failed');
	
	$checkResult = false;
	
	// GET THE CURRENT DATE
	date_default_timezone_set('America/Denver');
	$date = date('Ymd');
	
	// check to see if there is data to display
	while($row02 = mysqli_fetch_array($result02)){
		if($row02['dateOrder'] >= $date){
				$checkResult = true;
				break;
			}
	}

if($checkResult == true) {
echo '<div class="clear"></div>';
echo '<h2 class="thinText">Upcoming Events</h2>';
echo '<hr>';

echo '<ul class="list-group">';

$i = 0;// keep track of the count
	while($row01 = mysqli_fetch_array($result01)){
		if ($i < 3){// set the number of events that will show on the events page --------------------********
			if ($row01['dateOrder'] >= $date){// check the database date against the current date
				
						echo '<div class="list-group-item">';
					
			// BUILD THE SECTION FOR THE START DATE AND TIME -----------------------	
			// BREAK THE TIME INTO SEPERATE PIECES
				$myArray = explode(':', $row01['startTime']);
				$hour = str_replace('T', '', $myArray[0]);
				
				switch ($hour) {
					case ($hour < 12):
						$ampm = 'am';
						break;
					case ($hour >= 12):
						$ampm = 'pm';
						break;
					default:
						$ampm = '';
				}
				
				switch ($hour) {
					case ($hour < 10):
						$hour = str_replace('0', '', $hour);
						break;
					case ($hour > 12):
						$hour = $hour - 12;
						break;
					default:
						$hour == $hour;
				}
		
				echo '<h4 class="list-group-item-heading">'.$row01['courseTitle'].'</h4>';
				// display start date and time
				$startString = '<p class="list-group-item-text">'.$row01['monthStart'].'/'.$row01['dayStart'].'/'.$row01['yearStart'].' · '.$hour.':'.$myArray[1].' '.$ampm;
				
				// BUILD THE SECTION FOR THE END DATE AND TIME ---------------------------
				// BREAK THE TIME INTO SEPERATE PIECES
				$myArray = explode(':', $row01['endTime']);
				$hour = str_replace('T', '', $myArray[0]);
				
				switch ($hour) {
					case ($hour < 12):
						$ampm = 'am';
						break;
					case ($hour >= 12):
						$ampm = 'pm';
						break;
					default:
						$ampm = '';
				}
				
				switch ($hour) {
					case ($hour < 10):
						$hour = str_replace('0', '', $hour);
						break;
					case ($hour > 12):
						$hour = $hour - 12;
						break;
					default:
						$hour == $hour;
				}
				if($row01['monthStart'].$row01['dayStart'].$row01['yearStart'] == $row01['monthEnd'].$row01['dayEnd'].$row01['yearEnd']){
					// display date and time without the ending date (ending date is on the same date as starting date)
							echo $startString.' - '.$hour.':'.$myArray[1].' '.$ampm.'</p>';
					}
					else{
							// display date and time with an ending date
							echo $startString.' - '.$row01['monthEnd'].'/'.$row01['dayEnd'].'/'.$row01['yearEnd'].' · '.$hour.':'.$myArray[1].' '.$ampm.'</p>';
						}
				
						echo '</div>';
					
					$i++;// count increment for the conditional
			}// check the database date against the current date
		}// end of the if statement for the loop check conditional
		else{
			break;
			}// end of the else statement for the loop check conditional
	}// end of while loop
	echo '</ul>';
	
	
	
	//<!-- build the modal that will show all of the events that are in the database------------------------------------- >
//<!-- Button trigger modal -->
echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">';
echo '  View all events for this course';
echo '</button>';

//<!-- Modal -->
echo '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
  echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
      echo '<div class="modal-header">';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        echo '<h4 class="modal-title" id="myModalLabel">Upcoming Events</h4>';
      echo '</div>';
      echo '<div class="modal-body">';
      
        echo '<ul class="list-group"><!-- begin the items in the database -->';

//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
	
	while($row01 = mysqli_fetch_array($result01)){
		if ($row01['dateOrder'] >= $date){// check the database date against the current date
			
					echo '<div class="list-group-item">';
				
		// BUILD THE SECTION FOR THE START DATE AND TIME -----------------------	
		// BREAK THE TIME INTO SEPERATE PIECES
			$myArray = explode(':', $row01['startTime']);
			$hour = str_replace('T', '', $myArray[0]);
			
			switch ($hour) {
				case ($hour < 12):
					$ampm = 'am';
					break;
				case ($hour >= 12):
					$ampm = 'pm';
					break;
				default:
					$ampm = '';
			}
			
			switch ($hour) {
				case ($hour < 10):
					$hour = str_replace('0', '', $hour);
					break;
				case ($hour > 12):
					$hour = $hour - 12;
					break;
				default:
					$hour == $hour;
			}
	
			echo '<h4 class="list-group-item-heading">'.$row01['courseTitle'].'</h4>';
			// display start date and time
			$startString = '<p class="list-group-item-text">'.$row01['monthStart'].'/'.$row01['dayStart'].'/'.$row01['yearStart'].' · '.$hour.':'.$myArray[1].' '.$ampm;
			
			// BUILD THE SECTION FOR THE END DATE AND TIME ---------------------------
			// BREAK THE TIME INTO SEPERATE PIECES
			$myArray = explode(':', $row01['endTime']);
			$hour = str_replace('T', '', $myArray[0]);
			
			switch ($hour) {
				case ($hour < 12):
					$ampm = 'am';
					break;
				case ($hour >= 12):
					$ampm = 'pm';
					break;
				default:
					$ampm = '';
			}
			
			switch ($hour) {
				case ($hour < 10):
					$hour = str_replace('0', '', $hour);
					break;
				case ($hour > 12):
					$hour = $hour - 12;
					break;
				default:
					$hour == $hour;
			}
			if($row01['monthStart'].$row01['dayStart'].$row01['yearStart'] == $row01['monthEnd'].$row01['dayEnd'].$row01['yearEnd']){
				// display date and time without the ending date (ending date is on the same date as starting date)
						echo $startString.' - '.$hour.':'.$myArray[1].' '.$ampm.'</p>';
				}
				else{
						// display date and time with an ending date
						echo $startString.' - '.$row01['monthEnd'].'/'.$row01['dayEnd'].'/'.$row01['yearEnd'].' · '.$hour.':'.$myArray[1].' '.$ampm.'</p>';
					}
			
			
			// close the div or anchor
					echo '</div>';
				
		}// check the database date against the current date
	}// end of while loop

echo '</ul><!-- end of the items in the database -->';

      echo '</div>';
      echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</div><!-- end of the modal-->';
	
	
	
	
	
	
}// end of the check to see if there is data to display

?>
<!-- end of upcoming events -->


<!-- registration instructions -->
<?php
if($found[registrationInstructions] != NULL || $found[link1] != NULL) {
	echo '<h2 class="thinText">Registration Instructions</h2>';
	echo '<hr>';
	if($found[registrationInstructions] != NULL) {
		echo '<p>'.$found[registrationInstructions].'</p>';
		}
		
	// -- links --
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
		}// -- end of links --
	}// end of first conditional
?>
<!-- end of registration instructions -->


</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>