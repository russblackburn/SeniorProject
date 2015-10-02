<?php 
	$page = about;
	$secondaryPage = personnel;
	require_once('adminVariables.php');
	require_once('header.php');

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM personnel ORDER BY priority";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');

?>

<div class="pagePadding">
<h1>Personnel</h1>


<hr>


<div class="row">
<?php

	//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
		echo '<div class="grid col-xs-12 col-sm-6 col-md-4">';
                echo '<figure class="effect-lily2">';
                    echo '<img src="images/personnel/'.$row['photo'].'" alt="exercises">';
                    echo '<figcaption>';
					echo '<div class="hoverDiv">';
                        echo '<h2>'.$row['first_name'].' <span>'.$row['last_name'].'</span></h2>';
                        echo '<p>'.$row['position'].'</p>';
						echo '</div>';
                        echo '<a href="personnelDetail.php?id='. $row['id'].'">View</a>';
                    echo '</figcaption>';			
                echo '</figure>';
            echo '</div>';
	};

	//WE'RE DONE SO HANG UP
	mysqli_close($dbc);
?>
</div>
</div>

<?php require_once('footer.php'); ?>