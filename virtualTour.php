<?php 
	$page = gallery;
	$secondaryPage = virtualTour;
	require_once('adminVariables.php');
	require_once('header.php');

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM virtualTour";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');

?>

<div class="pagePadding">
<h1>Virtual Tour</h1>


<hr>


<div class="centeriFrame">
<iframe class="videoiFrame paddingTop" src="virtualTour/" frameborder="0"></iframe>
</div>

<!-- Button trigger modal -->
<div class="row">
<div class="text-center buttonVR">
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
  <div class="vrPadding">View Map</div>
</button>
</div>
</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="myModalLabel">Virtual Tour Map</h4>
      	</div>
      	<div class="modal-body">
        	<img class="img-responsive-height text-center" src="images/gallery/vrMap/VRMap.png">
      	</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    	</div>
  	</div>
	</div>
<?php

	//DISPLAY WHAT WE FOUND
	while($row = mysqli_fetch_array($result)){
		echo '<div class="centeriFrame alignLeft">';
		echo '<p>';
		echo $row['description'];
		echo '</p>';
		echo '</div><!-- end of centeriFrame -->';
	};

	//WE'RE DONE SO HANG UP
	mysqli_close($dbc);
?>

</div>

<?php require_once('footer.php'); ?>