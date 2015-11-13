<?php
require_once('variables.php');
require_once('header.php');

// build the database connection with host, user, password, database for the forms database
$dbc1 = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');

// get all of the elements from the form
$first_name = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[first_name])));//comes through as the first name
$last_name = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[last_name])));
$mailing_address = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[mailing_address])));
$city = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[city])));
$state = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[state])));
$zip_code = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[zip_code])));
$email = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[email])));//comes through as email
$telephone = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[telephone])));
$mobile = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[mobile])));
$certification_history = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[certification_history])));
$form_element_checkbox = $_POST[form_element_checkbox];
$topics_of_interest = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[topics_of_interest])));


$courses_topics_of_interest = implode(',', $form_element_checkbox);
$courses_topics_of_interest = str_replace(',', '', $courses_topics_of_interest);
$courses_topics_of_interest = stripslashes(mysqli_real_escape_string($dbc1, trim($courses_topics_of_interest)));


//SET THE DATE THAT THE USER HAS REGISTERED ON -----------
		$registered_on = date('Y\-m\-d');
	
// SAVE THE FORM ELEMENTS INTO THE FORMS DATABASE
	// build the query
	$query1 = "INSERT INTO instructor_registration(first_name, last_name, mailing_address, city, state, zip_code, email, telephone, mobile, certification_history, courses_topics_of_interest, topics_of_interest, registered_on)". 
	"VALUES ('$first_name','$last_name','$mailing_address','$city','$state','$zip_code','$email','$telephone','$mobile','$certification_history','$courses_topics_of_interest','$topics_of_interest','$registered_on')";
	
	// communicate the query with the database
	$result1 = mysqli_query($dbc1, $query1) or die('The databse query has failed! 1');


// terminate the connection for the forms database
mysqli_close($dbc1);
?>

<div class="pagePadding">

<h1>Your Form Was Submitted</h1>
<hr>

<p>If you have any questions please send us a <a href="contact.php#contactform">message</a>.</p>



</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>