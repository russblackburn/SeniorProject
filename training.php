<?php
$page = services;
$secondaryPage = training;

require_once('header.php'); 
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query1 = "SELECT * FROM coreCourse WHERE hide='F' ORDER BY courseTitle ASC";

	//TRY AND TALK TO THE DB
	$result1 = mysqli_query($dbc, $query1) or die('query failed 1');
	
	//BUILD THE QUERY
	$query2 = "SELECT * FROM thirdPartyCourse WHERE hide='F' ORDER BY courseTitle ASC";

	//TRY AND TALK TO THE DB
	$result2 = mysqli_query($dbc, $query2) or die('query failed 2');
	
?>

<h1>Training Core Courses</h1>

<hr>

<div class="row">

	<?php
		while($row1 = mysqli_fetch_array($result1)){
			echo '<div class="grid col-xs-12 col-sm-4">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/training/course/'.$row1['photo'].'">';
					echo '<figcaption>';
						echo '<h2>'.$row1['courseTitle'].'<span></span></h2>';
						echo '<p></p>';
						echo '<a href="coreCourseDetail.php?id='. $row1['id'].'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>

</div><!-- end of row -->

<h1>Training Third Party Courses</h1>

<hr>

<div class="row">

	<?php
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-4">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/training/course/'.$row2['photo'].'">';
					echo '<figcaption>';
						echo '<h2>'.$row2['courseTitle'].'<span></span></h2>';
						echo '<p></p>';
						echo '<a href="thirdPartyCourseDetail.php?id='. $row2['id'].'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>

</div><!-- end of row -->




<?php require_once('footer.php'); ?>