<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if($page=='index' && $secondaryPage == false){echo 'Home';} 
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
	else if($page=='contact' && $secondaryPage == 'contact1'){echo 'Contact Us';} 
	else if($secondaryPage=='newsletter'){echo 'Subscribe for Information and Updates';}
	else if($page=='faq' && $secondaryPage == false){echo 'FAQ';}
	else if($page=='siteMap'){echo 'Site Map';}
	else {echo 'ICDP';}?> | Intermountain Center for Disaster Preparedness</title>

    <!-- Bootstrap -->
    <link href="<?php if($adminPage == zip){echo '../';} ?>css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?php if($adminPage == zip){echo '../';} ?>css/custom.css" rel="stylesheet">
    
    <!-- Newsletter Panel -->
    <link href="<?php if($adminPage == zip){echo '../';} ?>css/BootSideMenu.css" rel="stylesheet">
    
    <?php
	if($page != 'admin'){
			echo '<link href="css/customNav.css" rel="stylesheet">';
		}
		
	if($secondaryPage == 'photos'){
			echo '<link href="css/photoModal.css" rel="stylesheet">';
		}
	?>
    
    <!-- CSS transitions for images -->
    <link href="<?php if($adminPage == zip){echo '../';} ?>css/transitionsCSS/set1.css" rel="stylesheet" type="text/css">
    
    <!-- Google fonts open sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- if the event page is loaded, load the header information for the calendar -->
    <?php
	if($page == events) {
		require_once('calendar.php');
		}
	?>
    
  </head>
  <body <?php if($adminSecondaryPage == services5){ echo 'onload="myFunction()"';}else if($adminSecondaryPage == gallery7){echo 'onload="myFunction()"';}else if($adminSecondaryPage == gallery8){echo 'onload="myFunction()"';}else if($adminSecondaryPage == gallery16){echo 'onload="myFunction()"';}else if($adminSecondaryPage == gallery17){echo 'onload="myFunction()"';}else if($adminSecondaryPage == zip2){echo 'onload="myFunction()"';} ?>>
  	<div id="wrap">
    <header>
        <div class="container">
        	<a href="<?php if($adminPage == zip){echo '../';} ?>index.php"><img class="logo" src="<?php if($adminPage == zip){echo '../';} ?>images/header/logoHighRes.png"></a>
        </div>
    </header>
    
    <!-- navigation -->
    
    <?php
    if($page == admin)
		{
			require_once('adminNav.php');
		}
		else
		{
			require_once('navigation.php');
		}
	?>
    
    <div class="container">