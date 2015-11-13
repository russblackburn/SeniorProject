<?php
require_once('variables.php');
require_once('adminVariables.php');
require_once('header.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the database connection with host, user, password, database for the forms database
$dbc1 = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');

// get all of the elements from the form
$name = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[name])));//comes through as the full name
$email = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[email])));//comes through as email
$course = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[course])));//comes through as the course ID
$date_time1 = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[date_time])));// comes through as the date and time
$date_time = str_replace('·', '--', $date_time1);

// FIND OUT IF THERE IS LINKED COURSE CONTENT WITH THE COURSE THAT THEY ARE REGISTERING FOR
	// build the query to display the current mission statement
	$query1 = "SELECT * FROM courseContent WHERE courseID=$course";
	
	//communicate with the database
	$result1 = mysqli_query($dbc, $query1) or die('The query has failed! 1');
	
	//put what is found from the query into a variable
	$found1 = mysqli_fetch_array($result1);
	
	//start the URL as false
	$URL = false;
	
	if($found1){
			$courseURL = $found1['fullURL'];
			$URL = true;
		}
	
// GET THE COURSE NAME FROM THE COURSE ID THAT WAS SENT		
	// build the query to display the current mission statement
	$query2 = "SELECT * FROM coreCourse WHERE id=$course";
	
	//communicate with the database
	$result2 = mysqli_query($dbc, $query2) or die('The query has failed! 2');
	
	//put what is found from the query into a variable
	$found2 = mysqli_fetch_array($result2);
	
	$course = $found2['courseTitle'];
	
		//SET THE DATE THAT THE USER HAS REGISTERED ON -----------
		$registered_on = date('Y\-m\-d');
		
	
// SAVE THE FORM ELEMENTS INTO THE FORMS DATABASE
	// build the query
	$query3 = "INSERT INTO student_registration(name, email, course, date_time, registered_on)". 
	"VALUES ('$name','$email','$course','$date_time','$registered_on')";
	
	// communicate the query with the database
	$result3 = mysqli_query($dbc1, $query3) or die('The databse query has failed! 3');
	
	
	
	
	
	
	//--------------------- START THE EMAIL ------------------------
	
	$to = $email;
	$subject = 'Intermountain Center for Disaster Preparedness';
	
	
	// BUILD THE EMAIL MESSAGE SO THAT CONFIRMATION IS SENT TO THE USER
	
	if($URL == true){// this message includes a link for the course content
		
			$message = "$name,\r\n\r\nThank you for registering.\r\n\r\n$course\r\n$courseURL\r\n\r\nThis email includes the course content link";
			
		}else{// this message does not include a link
				$message = "$name,\r\n\r\nThank you for registering.\r\n\r\n$course\r\n$date_time1\r\n\r\nThis email does not have a link, it has the course date and time";
			}
		
		// SEND THE EMAIL THAT WAS BUILT
		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 70, "\r\n");
		$sentFrom = 'someemail@gmail.com';//---------------PLACE YOUR EMAIL ADDRESS HERE------------------------------
		$headers = 'From: '.$sentFrom.'' . "\r\n" .
			   'Reply-To: '.$sentFrom.'' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
			// Send
			mail($to, $subject, $message, $headers);
		
	
	




// terminate the connection
mysqli_close($dbc);

// terminate the connection for the forms database
mysqli_close($dbc1);
?>

<div class="pagePadding">

<h1>Your Form Was Submitted</h1>
<hr>

<p>If you have any questions please send us a <a href="contact.php#contactform">message</a>.</p>





</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>