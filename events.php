<?php $page = events; ?>
<?php $secondaryPage = false; ?>
<?php require_once('header.php'); ?>

<div class="pagePadding">
<h1>Events</h1>
<hr>

<div id='calendar' class="mobileHidden"></div>

<hr class="mobileHidden">

<?php
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query01 = "SELECT * FROM events WHERE hide='F'";

	//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
?>

<ul class="list-group">
<?php
	while($row01 = mysqli_fetch_array($result01)){
		if($row01['url'] == NULL){
				echo '<div class="list-group-item">';
			}
			else{
				echo '<a href="'.$row01['url'].'" class="list-group-item">';
			}
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
		if($row01['url'] == NULL){
				echo '</div>';
			}
			else{
				echo '</a>';
			}
	}// end of while loop
?>
</ul>

</div><!-- end of pagePadding -->

<?php require_once('footer.php'); ?>