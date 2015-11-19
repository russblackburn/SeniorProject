<?php
require_once('variables.php');
require_once('header.php');

// build the database connection with host, user, password, database for the forms database
$dbc1 = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');

// get all of the elements from the form
$service = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[service])));
$initiator = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[initiator])));
$organization_department = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[organization_department])));
$contact_information = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[contact_information])));
$details = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[details])));
$service_deadline = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[service_deadline])));


//SET THE DATE THAT THE USER HAS REGISTERED ON -----------
		$registered_on = date('Y\-m\-d');

if($service == 'Exercises'){
		// build the query
		$query1 = "INSERT INTO exercises(initiator, organization_department, contact_information, details, service_deadline, registered_on)". 
		"VALUES ('$initiator','$organization_department','$contact_information','$details','$service_deadline','$registered_on')";
	}
if($service == 'Assessment'){
		// build the query
		$query1 = "INSERT INTO assessment(initiator, organization_department, contact_information, details, service_deadline, registered_on)". 
		"VALUES ('$initiator','$organization_department','$contact_information','$details','$service_deadline','$registered_on')";
	}
if($service == 'Research'){
		// build the query
		$query1 = "INSERT INTO research(initiator, organization_department, contact_information, details, service_deadline, registered_on)". 
		"VALUES ('$initiator','$organization_department','$contact_information','$details','$service_deadline','$registered_on')";
	}

	// communicate the query with the database // SAVE THE FORM ELEMENTS INTO THE FORMS DATABASE
	$result1 = mysqli_query($dbc1, $query1) or die('The databse query has failed! 1');
	
	
	//--------------------- START THE EMAIL ------------------------
	
	$to = $email;
	$subject = 'Intermountain Center for Disaster Preparedness';
	
	
	// BUILD THE EMAIL MESSAGE SO THAT CONFIRMATION IS SENT TO THE USER
		
			$message = "$first_name,\r\n\r\nThank you for registering. If you have any questions reply to this email.\r\n\r\nICDP";
			
		
		
		// SEND THE EMAIL THAT WAS BUILT
		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 70, "\r\n");
		$sentFrom = 'intermountaincdp@imail.org';//---------------PLACE YOUR EMAIL ADDRESS HERE------------------------------
		$headers = 'From: '.$sentFrom.'' . "\r\n" .
			   'Reply-To: '.$sentFrom.'' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
			// Send
			mail($to, $subject, $message, $headers);

// terminate the connection for the forms database
mysqli_close($dbc1);
?>

<div class="pagePadding">

<h1>Your Form Was Submitted</h1>
<hr>

<p>If you have any questions please send us a <a href="contact.php#contactform">message</a>.</p>



</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>