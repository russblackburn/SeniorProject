<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Intermountain Center for Disaster Preparedness | <?php if($page=='index' && $secondaryPage == false){echo 'Home';} 
	else if($page=='about' && $secondaryPage == false){echo 'About';} 
	else if($secondaryPage=='purpose'){echo 'Purpose';} 
	else if($secondaryPage=='personnel'){echo 'Personnel';} 
	else if($page=='services' && $secondaryPage == false){echo 'Services';} 
	else if($secondaryPage=='training'){echo 'Training';} 
	else if($secondaryPage=='exercises'){echo 'Exercises';} 
	else if($secondaryPage=='assessment'){echo 'Assessment';} 
	else if($secondaryPage=='research'){echo 'Research';} 
	else if($page=='events' && $secondaryPage == false){echo 'Events';} 
	else if($page=='gallery' && $secondaryPage == false){echo 'Gallery';} 
	else if($secondaryPage=='photos'){echo 'Photos';} 
	else if($secondaryPage=='videos'){echo 'Videos';} 
	else if($secondaryPage=='virtualTour'){echo 'Virtual Tour';} 
	else if($page=='register' && $secondaryPage == false){echo 'Register';} 
	else if($secondaryPage=='studentRegistration'){echo 'Student Registration';} 
	else if($secondaryPage=='instructorRegistration'){echo 'Instructor Registration';} 
	else if($secondaryPage=='requestServiceProposal'){echo 'Request Service Proposal';} 
	else if($page=='contact' && $secondaryPage == false){echo 'Contact';} 
	else if($page=='faq' && $secondaryPage == false){echo 'FAQ';} 
	else {echo 'ICDP';}?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    
    <!-- Social icon stylesheets -->
    <link href="css/facebook.css" rel="stylesheet">
    <link href="css/twitter.css" rel="stylesheet">
    
    <!-- Google fonts open sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <header>
        <div class="container">
        	<a href="index.php"><img class="logo" src="images/header/logo.png"></a>
        </div>
    </header>
    
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
              </ul>
            </li>
            <!-- end of register -->
            
            <!-- contact -->
            <li class="<?php if($page=='contact'){echo 'active';}?>"><a href="contact.php">Contact</a></li>
            <!-- end of contact -->
            
            <!-- faq -->
            <li class="<?php if($page=='faq'){echo 'active';}?>"><a href="faq.php">FAQ</a></li>
            <!-- end of faq -->
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="container">