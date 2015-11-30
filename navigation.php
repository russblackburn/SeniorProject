    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
          	<!-- home -->
            <li class="<?php if($page=='index'){echo 'active';}?>"><a href="index.php">Home</a></li>
            <!-- end of home -->
            
            <!-- about -->
            <li class="dropdown <?php if($page=='about'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php if($secondaryPage=='purpose'){echo 'active';}?>"><a href="purpose.php">Purpose</a></li>
                <li class="<?php if($secondaryPage=='personnel'){echo 'active';}?>"><a href="personnel.php">Personnel</a></li>
                <li role="separator" class="divider desktopHidden"></li>
              </ul>
            </li>
            <!-- end of about -->
            
            <!-- services -->
            <li class="dropdown <?php if($page=='services'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php if($secondaryPage=='training'){echo 'active';}?>"><a href="training.php">Training</a></li>
                <li class="<?php if($secondaryPage=='exercises'){echo 'active';}?>"><a href="exercises.php">Exercises</a></li>
                <li class="<?php if($secondaryPage=='assessment'){echo 'active';}?>"><a href="assessment.php">Assessment</a></li>
                <li class="<?php if($secondaryPage=='research'){echo 'active';}?>"><a href="research.php">Research</a></li>
                <li role="separator" class="divider desktopHidden"></li>
              </ul>
            </li>
            <!-- end of services -->
            
            <!-- events -->
            <li class="<?php if($page=='events'){echo 'active';}?>"><a href="events.php">Events</a></li>
            <!-- end of events -->
            
            <!-- gallery -->
            <li class="dropdown <?php if($page=='gallery'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php if($secondaryPage=='photos'){echo 'active';}?>"><a href="photos.php">Photos</a></li>
                <li class="<?php if($secondaryPage=='videos'){echo 'active';}?>"><a href="videos.php">Videos</a></li>
                <li class="<?php if($secondaryPage=='virtualTour'){echo 'active';}?>"><a href="virtualTour.php">Virtual Tour</a></li>
                <li role="separator" class="divider desktopHidden"></li>
              </ul>
            </li>
            <!-- end of gallery -->
            
            <!-- register -->
            <li class="dropdown <?php if($page=='register'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php if($secondaryPage=='studentRegistration'){echo 'active';}?>"><a href="studentRegistration.php">Student Registration</a></li>
                <li class="<?php if($secondaryPage=='instructorRegistration'){echo 'active';}?>"><a href="instructorRegistration.php">Instructor Registration</a></li>
                <li class="<?php if($secondaryPage=='requestServiceProposal'){echo 'active';}?>"><a href="requestServiceProposal.php">Request Service Proposal</a></li>
                <li role="separator" class="divider desktopHidden"></li>
              </ul>
            </li>
            <!-- end of register -->
            
            <!-- contact -->
            <li class="dropdown <?php if($page=='contact'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php if($secondaryPage=='contact1'){echo 'active';}?>"><a href="contact.php">Contact Us</a></li>
                <li class="<?php if($secondaryPage=='newsletter'){echo 'active';}?>"><a href="newsletter.php">Subscribe for Information and Updates</a></li>
              </ul>
            </li>
            <!-- end of contact -->
      
            
            <!-- faq -->
            <li class="<?php if($page=='faq'){echo 'active';}?>"><a href="faq.php">FAQ</a></li>
            <!-- end of faq -->
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>