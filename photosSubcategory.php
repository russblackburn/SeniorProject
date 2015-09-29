<?php
$page = gallery;
$secondaryPage = photos;

require_once('header.php'); 
require_once('adminVariables.php');

$category_id = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// BUILD THE QUERY TO KEEP TRACK OF THE CATEGORY SELECTED
		//BUILD THE QUERY
		$query1 = "SELECT * FROM photoCategory WHERE id=$category_id";
	
		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
		// PUT WHAT WAS FOUND FROM THE QUERY INTO A VARIABLE
		$found1 = mysqli_fetch_array($result1);
	
	//BUILD THE QUERY
	$query2 = "SELECT * FROM photoSubcategory WHERE categoryID=$category_id ORDER BY subcategory ASC";

	//TRY AND TALK TO THE DB
	$result2 = mysqli_query($dbc, $query2) or die('query failed');
	
?>

<h1><?php echo $found1['category']; ?></h1>

<hr>

<div class="row">

	<?php
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-4">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/gallery/photo/subcategory/'.$row2['photo'].'">';
					echo '<figcaption>';
						echo '<h2>'.$row2['subcategory'].'<span></span></h2>';
						echo '<p></p>';
						echo '<a href="photosDetail.php?id='. $row2['id'].'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>

</div><!-- end of row -->




<?php require_once('footer.php'); ?>