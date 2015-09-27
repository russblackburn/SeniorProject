<?php
$page = gallery;
$secondaryPage = photos;

require_once('header.php'); 
require_once('adminRuss.php');

$subcategory_id = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// BUILD THE QUERY TO KEEP TRACK OF THE CATEGORY SELECTED
		//BUILD THE QUERY
		$query1 = "SELECT * FROM photoSubcategory WHERE id=$subcategory_id";
	
		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
		// PUT WHAT WAS FOUND FROM THE QUERY INTO A VARIABLE
		$found1 = mysqli_fetch_array($result1);
	
	//BUILD THE QUERY
	$query2 = "SELECT * FROM photoGallery WHERE subcategoryID=$subcategory_id ORDER BY id ASC";

	//TRY AND TALK TO THE DB
	$result2 = mysqli_query($dbc, $query2) or die('query failed');
	
?>

<h1><?php echo $found1['subcategory']; ?></h1>

<hr>

<div class="row">

	<?php
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-3">';
				echo '<figure class="effect-lily">';
					echo '<img src="images/gallery/photo/photo/'.$row2['photo'].'">';
					echo '<figcaption>';
						echo '<h2><span></span></h2>';
						echo '<p>'.$row2['photoDescription'].'</p>';
						echo '<a href="#">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			}
		?>

</div><!-- end of row -->




<?php require_once('footer.php'); ?>