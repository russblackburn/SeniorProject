<?php
$page = gallery;
$secondaryPage = videos;

require_once('header.php'); 
require_once('adminVariables.php');

$subcategory_id = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	// BUILD THE QUERY TO KEEP TRACK OF THE CATEGORY SELECTED
		//BUILD THE QUERY
		$query1 = "SELECT * FROM videoSubcategory WHERE id=$subcategory_id";
	
		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
		// PUT WHAT WAS FOUND FROM THE QUERY INTO A VARIABLE
		$found1 = mysqli_fetch_array($result1);
	
	//BUILD THE QUERY
	$query2 = "SELECT * FROM videoGallery WHERE subcategoryID=$subcategory_id ORDER BY id ASC";

	//TRY AND TALK TO THE DB
	$result2 = mysqli_query($dbc, $query2) or die('query failed');
	
?>

<div class="pagePadding">
<h1><?php echo $found1['subcategory']; ?></h1>


<hr>



	<?php
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="centeriFrame">';
					echo '<iframe class="videoiFrame paddingTop"'. $row2['videoLink'].' frameborder="0" allowfullscreen></iframe>';
			echo '</div><!-- end of centeriFrame -->';
			
			echo '<div class="centeriFrame alignLeft">';
				echo '<p>';
					echo $row2['videoDescription'];
				echo '</p>';
			echo '</div><!-- end of centeriFrame -->';
			}
	?>

</div>




<?php require_once('footer.php'); ?>