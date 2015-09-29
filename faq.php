<?php 
	$page = faq;
	$secondaryPage = false; 
	require_once('adminVariables.php');
	require_once('header.php');

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM faq ORDER BY priority";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Frequently Asked Questions</h1>

<hr>

<div class="bs-example">
    <div class="panel-group" id="accordion">

<?php

	//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
		
		echo '<div class="panel panel-default">';
		echo '<div class="panel-heading" style="background-color:#6b96c7">';
		echo '<h4 class="panel-title">';
		echo '<a data-toggle="collapse" data-parent="#accordion" style="color:#fff" href="#'.$row['id'].'">';
		echo $row['question'];
		echo '</a>';
		echo '</h4>';
		echo '</div>';
		
		echo '<div id="'.$row['id'].'" class="panel-collapse collapse">';
		echo '<div class="panel-body">';
		echo '<p>';
		echo $row['answer'];
		echo '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	
	};

	//WE'RE DONE SO HANG UP
	mysqli_close($dbc);
?>
        
    </div>
</div>


<?php require_once('footer.php'); ?>