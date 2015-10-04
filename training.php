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
	
	// BUILD THE QUERIES TO CHECK AND SEE IF THERE IS A COURSE IF THERE IS DISPLAY THE TITLE AND <HR>
		//BUILD THE QUERY TO CHECK CORE COURSES
		$query3 = "SELECT * FROM coreCourse WHERE hide='F'";
	
		//TRY AND TALK TO THE DB
		$result3 = mysqli_query($dbc, $query3) or die('query failed 3');
		
		//put what is found from the query into a variable
		$found3 = mysqli_fetch_array($result3);
		
		//BUILD THE QUERY TO CHECK THIRD PARTY COURSES
		$query4 = "SELECT * FROM thirdPartyCourse WHERE hide='F'";
	
		//TRY AND TALK TO THE DB
		$result4 = mysqli_query($dbc, $query4) or die('query failed 4');
		
		//put what is found from the query into a variable
		$found4 = mysqli_fetch_array($result4);
	
?>

<div class="pagePadding">

<?php
if($found3[id] != NULL) {
	echo '<h1>Training <span class="thinText">| Core Courses</span></h1>';
	echo '<hr>';
	echo '<div class="row">';

		while($row1 = mysqli_fetch_array($result1)){
			echo '<div class="grid col-xs-12 col-sm-6 col-md-4">';
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
	echo '</div><!-- end of row -->';
	}
?>
<?php
if($found4[id] != NULL) {
	echo '<h1>Training <span class="thinText">| Third Party Courses</span></h1>';
	echo '<hr>';
	echo '<div class="row">';
	
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-6 col-md-4">';
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
	echo '</div><!-- end of row -->';
	}
?>



</div>

<?php require_once('footer.php'); ?>