<?php
require_once('variables.php');
require_once('header.php');

// build the database connection with host, user, password, database for the forms database
$dbc1 = mysqli_connect(HOST1,USER1,PASSWORD1,DATABASE1) or die('The database connection has failed!');

// get all of the elements from the form
$name = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[name])));//comes through as the full name
$email = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[email])));//comes through as email
$service = stripslashes(mysqli_real_escape_string($dbc1, trim($_POST[service])));


//SET THE DATE THAT THE USER HAS REGISTERED ON -----------
		$registered_on = date('Y\-m\-d');

if($service == 'Exercises'){
		// build the query
		$query1 = "INSERT INTO exercises(name, email, registered_on)". 
		"VALUES ('$name','$email','$registered_on')";
	}
if($service == 'Assessment'){
		// build the query
		$query1 = "INSERT INTO assessment(name, email, registered_on)". 
		"VALUES ('$name','$email','$registered_on')";
	}
if($service == 'Research'){
		// build the query
		$query1 = "INSERT INTO research(name, email, registered_on)". 
		"VALUES ('$name','$email','$registered_on')";
	}

	// communicate the query with the database // SAVE THE FORM ELEMENTS INTO THE FORMS DATABASE
	$result1 = mysqli_query($dbc1, $query1) or die('The databse query has failed! 1');

// terminate the connection for the forms database
mysqli_close($dbc1);
?>

<div class="pagePadding">

<h1>Form Submitted</h1>
<hr>

<p>Request Service Proposal form message here.</p>



</div><!-- end of pagePadding -->
<?php require_once('footer.php'); ?>