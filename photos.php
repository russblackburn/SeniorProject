<?php
$page = gallery;
$secondaryPage = photos;

require_once('header.php'); 
require_once('adminVariables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM photoCategory ORDER BY category ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<h1>Photos</h1>

<hr>

<div class="row">

	<?php
		while($row = mysqli_fetch_array($result)){
			echo '<div class="grid col-xs-12 col-sm-4">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/gallery/photo/category/'.$row['photo'].'">';
					echo '<figcaption>';
						echo '<h2>'.$row['category'].'<span></span></h2>';
						echo '<p></p>';
						echo '<a href="photosSubcategory.php?id='. $row['id'].'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>

</div><!-- end of row -->




<?php require_once('footer.php'); ?>