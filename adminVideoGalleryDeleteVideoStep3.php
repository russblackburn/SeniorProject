<?php 
	require_once('adminAuthorize.php'); 
	require_once('adminVariables.php');
	$page = admin;
	$adminPage = gallery;
	$adminSecondaryPage = gallery18;
	require_once('header.php');
	
	$subcategory_id = $_GET[id];
	$n1 = $_GET[n1];
	
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM videoGallery WHERE subcategoryID=$subcategory_id ORDER BY id ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
?>

<p><a href="adminVideoGalleryDeleteVideo.php">Select the Video's Category</a> ><a href="adminVideoGalleryDeleteVideoStep2.php?id=<?php echo $n1; ?>&n1=<?php echo $n1; ?>"> Select the Video's Subcategory</a> > Select the Video</p>

<h1>Delete a Video</h1>

<hr>

<h3>Select the Video</h3>

<?php

//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
			echo '<div class="centeriFrame">';
					echo '<iframe class="videoiFrame paddingTop"'. $row['videoLink'].' frameborder="0" allowfullscreen></iframe>';
			echo '</div><!-- end of centeriFrame -->';
			
			echo '<div class="centeriFrame">';
					echo '<a href="adminVideoGalleryDeleteVideoStep4.php?id='. $row['id'].'&subcategoryID='.$subcategory_id.'&n1='.$n1.'&n2='.$subcategory_id.'">[select]</a>';
			echo '</div><!-- end of centeriFrame -->';
			}
?>

<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
?>


<?php require_once('footer.php'); ?>