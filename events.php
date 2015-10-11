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
	$query01 = "SELECT * FROM events WHERE hide='F' ORDER BY dateOrder ASC";

	//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
?>

<ul class="list-group">
<?php
$i = 0;// keep track of the count
	while($row01 = mysqli_fetch_array($result01)){
		if ($i < 8){// set the number of events that will show on the events page
			if ($row01['dateOrder'] >= '20151010'){// check the database date against the current date
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
					$i++;// count increment for the conditional
			}// check the database date against the current date
		}// end of the if statement for the loop check conditional
		else{
			break;
			}// end of the else statement for the loop check conditional
	}// end of while loop
?>
</ul>

<!-- build the modal that will show all of the events that are in the database------------------------------------- >
<!-- Button trigger modal -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
  View all upcoming events
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upcoming Events</h4>
      </div>
      <div class="modal-body">
      
        <ul class="list-group"><!-- begin the items in the database -->
<?php
//TRY AND TALK TO THE DB
	$result01 = mysqli_query($dbc, $query01) or die('query failed');
	
	while($row01 = mysqli_fetch_array($result01)){
		if ($row01['dateOrder'] >= '20151010'){// check the database date against the current date
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
		}// check the database date against the current date
	}// end of while loop
?>
</ul><!-- end of the items in the database -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



</div><!-- end of pagePadding -->

<?php require_once('footer.php'); ?>