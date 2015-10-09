<?php
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM events WHERE hide='F'";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>
<?php
	$return_arr = array();

    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['title'] = $row['courseTitle'];
    $row_array['start'] = ''.$row['yearStart'].'-'.$row['monthStart'].'-'.$row['dayStart'].''.$row['startTime'].'';
    $row_array['end'] = ''.$row['yearEnd'].'-'.$row['monthEnd'].'-'.$row['dayEnd'].''.$row['endTime'].'';
	$row_array['url'] = $row['url'];

    array_push($return_arr,$row_array);
   }
   
mysqli_close($dbc);
?>
<link rel='stylesheet' href='calendar/fullcalendar.css'>
<script src='calendar/jquery.min.js'></script>
<script src='calendar/moment.min.js'></script>
<script src='calendar/fullcalendar.js'></script>
<script>
$(document).ready(function() {
    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
		eventLimit: true, // allow "more" link when too many events
		events: <?php echo json_encode($return_arr); ?>
    })

});
</script>