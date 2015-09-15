<?php $page = index; ?>
<?php $secondaryPage = false; ?>
<?php 
require_once('header.php'); 
require_once('adminRuss.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

// build the query to display the current mission statement
$query = "SELECT * FROM mission_statement";

//communicate with the database
$result = mysqli_query($dbc, $query) or die('The query has failed!');

//put what is found from the query into a variable
$found = mysqli_fetch_array($result);

// terminate the connection
mysqli_close($dbc);
?>

        <!-- slider -->
        <!-- div to hide slider on mobile -->
        <div class="mobileHidden">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img class="first-slide" src="images/home/slider.jpg" alt="First slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>Example headline.</h1>
                      <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                      <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <img class="second-slide" src="images/home/slider.jpg" alt="Second slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>Another example headline.</h1>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <img class="third-slide" src="images/home/slider.jpg" alt="Third slide">
                  <div class="container">
                    <div class="carousel-caption">
                      <h1>One more for good measure.</h1>
                      <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
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
        
        <!-- three images row -->
        <div class="row">
        
        	<!-- training image -->
            <a href="training.php">
            <img class="col-xs-12 col-sm-3 marginTop" src="images/home/training.jpg" alt="training">
            </a>
            <!-- end of training image -->
        
            <!-- exercises image -->
            <a href="exercises.php">
            <img class="col-xs-12 col-sm-3 marginTop" src="images/home/exercises.jpg" alt="exercises">
            </a>
            <!-- end of exercises image -->
            
            <!-- assessment image -->
            <a href="assessment.php">
            <img class="col-xs-12 col-sm-3 marginTop" src="images/home/assessment.jpg" alt="assessment">
            </a>
            <!-- end of assessment image -->
            
            <!-- research image -->
            <a href="research.php">
            <img class="col-xs-12 col-sm-3 marginTop" src="images/home/research.jpg" alt="research">
            </a>
            <!-- end of research image -->
        
        </div><!-- end of three images row -->
        
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
        
<?php require_once('footer.php'); ?>