<?php $page = index; ?>
<?php $secondaryPage = false; ?>
<?php 
require_once('header.php'); 
require_once('adminVariables.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// mission statement connection---------------------------------------------------------------------
// build the query to display the current mission statement
$query = "SELECT * FROM mission_statement";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

// slider connection for slide 1---------------------------------------------------------------------
// build the query to display the current slide
$query1 = "SELECT * FROM slider WHERE id='1'";

//communicate with the database
$result1 = mysqli_query($dbc, $query1) or die('The query has failed!');

//put what is found from the query into a variable
$found1 = mysqli_fetch_array($result1);

// slider connection for slide 3---------------------------------------------------------------------
// build the query to display the current slide
$query2 = "SELECT * FROM slider WHERE id='2'";

//communicate with the database
$result2 = mysqli_query($dbc, $query2) or die('The query has failed!');

//put what is found from the query into a variable
$found2 = mysqli_fetch_array($result2);

// slider connection for coreCourse slides---------------------------------------------------------------------
// build the query to display the current course slide
$query3 = "SELECT * FROM coreCourse WHERE slide_hidden='F'";

//communicate with the database
$result3 = mysqli_query($dbc, $query3) or die('The query has failed!');

// slider connection for thirdPartyCourse slides---------------------------------------------------------------------
// build the query to display the current third party slide
$query4 = "SELECT * FROM thirdPartyCourse WHERE slide_hidden='F'";

//communicate with the database
$result4 = mysqli_query($dbc, $query4) or die('The query has failed!');
?>

        <!-- slider -->
        <!-- div to hide slider on mobile -->
        <div class="mobileHidden">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img class="first-slide" src="images/home/<?php echo $found1['slider_image']; ?>" alt="First slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1><?php echo $found1['slider_title']; ?></h1>
                      <p class="smallTabletHidden"><?php echo $found1['slider_description']; ?></p>
                      <p><a class="btn btn-lg btn-primary" href="<?php echo $found1['slider_link']; ?>" role="button"><?php echo $found1['slider_button_description']; ?></a></p>
                    </div>
                  </div>
                </div>
                <?php
				while($row3 = mysqli_fetch_array($result3)){
                echo '<div class="item">';
                  echo '<img class="second-slide" src="images/training/slider/'.$row3['slide_image'].'" alt="course slide">';
                  echo '<div class="container">';
                    echo '<div class="carousel-caption">';
                      echo '<h1>'.$row3['courseTitle'].'</h1>';
                      echo '<p class="smallTabletHidden">'.$row3['slider_description'].'</p>';
                      echo '<p><a class="btn btn-lg btn-primary" href="'.$row3['slider_link'].'" role="button">'.$row3['slider_button_description'].'</a></p>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
				}
				?>
                <?php
				while($row4 = mysqli_fetch_array($result4)){
                echo '<div class="item">';
                  echo '<img class="second-slide" src="images/training/slider/'.$row4['slide_image'].'" alt="course slide">';
                  echo '<div class="container">';
                    echo '<div class="carousel-caption">';
                      echo '<h1>'.$row4['courseTitle'].'</h1>';
                      echo '<p class="smallTabletHidden">'.$row4['slider_description'].'</p>';
                      echo '<p><a class="btn btn-lg btn-primary" href="'.$row4['slider_link'].'" role="button">'.$row4['slider_button_description'].'</a></p>';
                    echo '</div>';
                  echo '</div>';
                echo '</div>';
				}
				?>
                <div class="item">
                  <img class="third-slide" src="images/home/<?php echo $found2['slider_image']; ?>" alt="Third slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1><?php echo $found2['slider_title']; ?></h1>
                      <p class="smallTabletHidden"><?php echo $found2['slider_description']; ?></p>
                      <p><a class="btn btn-lg btn-primary" href="<?php echo $found2['slider_link']; ?>" role="button"><?php echo $found2['slider_button_description']; ?></a></p>
                    </div>
                  </div>
                </div>
              </div>
              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- end of slider -->
        </div><!-- end of hide slider -->
        
        <!-- mission statement -->
        <div class="row mobileHidden">
            <p class="col-xs-12 missonStatement"><?php echo $found['mission_statement']; ?><a href="purpose.php"> Learn more about us...</a></p>
        </div><!-- end of mission statement -->
        
        <!-- four images row -->
        <div class="row">
        
        	<!-- training image -->
            <div class="grid col-xs-12 col-sm-6 col-lg-3">
                <figure class="effect-lily">
                    <img src="images/home/training.jpg" alt="training">
                    <figcaption>
                        <h2>Training <span></span></h2>
                        <p>Small amount of training text here.</p>
                        <a href="training.php">View</a>
                    </figcaption>			
                </figure>
            </div>
            <!-- end of training image -->
        
            <!-- exercises image -->
            <div class="grid col-xs-12 col-sm-6 col-lg-3">
                <figure class="effect-lily">
                    <img src="images/home/exercises.jpg" alt="exercises">
                    <figcaption>
                        <h2>Exercises <span></span></h2>
                        <p>Small amount of training text here.</p>
                        <a href="exercises.php">View</a>
                    </figcaption>			
                </figure>
            </div>
            <!-- end of exercises image -->
            
            <!-- assessment image -->
            <div class="grid col-xs-12 col-sm-6 col-lg-3">
                <figure class="effect-lily">
                    <img src="images/home/assessment.jpg" alt="assessment">
                    <figcaption>
                        <h2>Assessment <span></span></h2>
                        <p>Small amount of training text here.</p>
                        <a href="assessment.php">View</a>
                    </figcaption>			
                </figure>
            </div>
            <!-- end of assessment image -->
            
            <!-- research image -->
            <div class="grid col-xs-12 col-sm-6 col-lg-3">
                <figure class="effect-lily">
                    <img src="images/home/research.jpg" alt="research">
                    <figcaption>
                        <h2>Research <span></span></h2>
                        <p>Small amount of training text here.</p>
                        <a href="research.php">View</a>
                    </figcaption>			
                </figure>
            </div>
            <!-- end of research image -->
        
        </div><!-- end of four images row -->
        
        <!-- start two images row -->
        	<!-- create space between previous section -->
            <div class="paddingTop"></div>
            
            <!-- first image -->
            <div class="floatImage rowTwoSize">
                <a class="noUnderline" href="instructorRegistration.php">
                    <div class="border">
                        <img class="img-circle floatImage imagePadding sizeImage" src="images/home/assessment.jpg" alt="Volunteer">
                        <h3 class="firstImageVerticalAlign">Volunteer to Teach</h3>
                        <div class="clear"></div>
                    </div>
                </a>
            </div><!-- end of first image -->
            
            <!-- clear float to keep mobile version stacked hide on desktop to keep side by side -->
            <div class="clear desktopHidden"></div>
            
            <!-- add padding between images on mobile hide on desktop -->
            <div class="paddingTop desktopHidden"></div>
            
            <!-- second image -->
            <a class="noUnderline" href="virtualTour.php">
                <div class="border pull-right rowTwoSize">
                    <img class="img-circle floatImage imagePadding sizeImage" src="images/home/assessment.jpg" alt="Virtual Tour">
                    <h3 class="secondImageVerticalAlign paddingRight">Take a Virtual Tour of our Facility</h3>
                    <div class="clear"></div>
                </div>
            </a><!-- end of second image -->
            
            <!-- clear both sides to prevent collapsing with items below -->
            <div class="clear"></div>
        <!-- end of two images row -->
        
<?php
//WE'RE DONE SO HANG UP
mysqli_close($dbc);
require_once('footer.php');
?>