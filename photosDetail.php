<?php
$page = gallery;
$secondaryPage = photos;

require_once('header.php'); 
require_once('adminVariables.php');

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
	
	//TRY AND TALK TO THE DB
	$result3 = mysqli_query($dbc, $query2) or die('query failed');
	
	
?>

<div class="pagePadding">
<h1><?php echo $found1['subcategory']; ?></h1>


<hr>


<div class="row">

	<?php
	$x = 0;
	
		while($row2 = mysqli_fetch_array($result2)){
			echo '<div class="grid col-xs-12 col-sm-6 col-md-4">';
				echo '<figure class="effect-lily3">';
					echo '<img src="images/gallery/photo/photo/'.$row2['photo'].'">';
					echo '<figcaption>';
						echo '<h2><span></span></h2>';
						echo '<p>'.$row2['photoDescription'].'</p>';
						echo '<a href="#lightbox" data-toggle="modal" data-slide-to="'.$x.'">View</a>';
					echo '</figcaption>';		
				echo '</figure>';
			echo '</div>';
			
			$x++;
			}
		?>

</div><!-- end of row -->
</div>

<div class="modal fade and carousel slide" tabindex="-1" id="lightbox" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $found1['subcategory']; ?></h4>
      </div>
      
        <div class="modal-body">
          <div class="carousel-inner">
          
          <?php 
		  $i = 0;
		  
		  	while($row3 = mysqli_fetch_array($result3)){
				echo '<div class="item';
				if($i == 0){echo ' active';}
				echo '">';
				echo '<img src="images/gallery/photo/photo/'.$row3['photo'].'" alt="">';
				echo '<div class="text-center mobileHidden"><p>'.$row3['photoDescription'].'</p></div>';
				echo '</div>';
				
				if($i == 0){
					$i++;
				}
			}
		  ?>
            
          </div><!-- /.carousel-inner -->
          <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div><!-- /.modal-body -->
        <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->




<?php require_once('footer.php'); ?>