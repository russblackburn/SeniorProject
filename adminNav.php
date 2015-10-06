<!-- Static navbar for the admin section -->
    <nav class="navbar navbar-default navbar-static-top adminNav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><span class="adminWhite">Exit Admin</span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
          	<!-- home page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">Home <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Home (Update/Hide)</li>
                <li><a href="adminSlideOne.php">Update Slide 1</a></li>
                <li><a href="adminUpdateCourseSlide.php">Update/Add a Course Slide</a></li>
                <li><a href="adminSlideThree.php">Update Slide 3</a></li>
                <li><a href="adminMissionStatement.php">Update Mission Statement</a></li>
                <li><a href="adminHideCourseSlide.php">Hide/Un-hide a Course Slide</a></li>
              </ul>
            </li>
            <!-- end of home page admin -->
            
            <!-- about page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">About <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Purpose (Update)</li>
                <li><a href="adminPurposePage.php">Update Purpose</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Personnel (Add/Update/Change/Delete)</li>
                <li><a href="adminPersonnelAdd.php">Add a New Personnel Record</a></li>
                <li><a href="adminPersonnelUpdateText.php">Update a Personnel Record</a></li>
                <li><a href="adminPersonnelOrder.php">Change the Personnel List Order</a></li>
                <li><a href="adminPersonnelDelete.php">Delete a Personnel Record</a></li>
              </ul>
            </li>
            <!-- end of about page admin -->
            
            <!-- services page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">Services <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Training (Add/Update/Hide/Delete)</li>
                <li><a href="adminCoreCourseForm.php">Add a New Core Course</a></li>
                <li><a href="adminThirdPartyCoursesForm.php">Add a New Third Party Course</a></li>
                <li><a href="adminTrainingUpdateText.php">Update a Course</a></li>
                <li><a href="adminTrainingHide.php">Hide/Un-hide a Course</a></li>
                <li><a href="adminTrainingDelete.php">Delete a Course</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Exercises (Update)</li>
                <li><a href="adminExercisePage.php">Update Exercises</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Assessment (Update)</li>
                <li><a href="adminAssessment.php">Update Assessment</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Research (Add/Update/Hide/Delete)</li>
                <li><a href="adminResearchAdd.php">Add New Research</a></li>
                <li><a href="adminResearchUpdateText.php">Update Existing Research</a></li>
                <li><a href="adminResearchPage.php">Update Research Page</a></li>
                <li><a href="adminResearchHide.php">Hide/Un-hide Research</a></li>
                <li><a href="adminResearchDelete.php">Delete Research</a></li>
              </ul>
            </li>
            <!-- end of services page admin -->
            
            <!-- events page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">Events <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Events (Add/Update/Change/Delete)</li>
                <li><a href="adminEventAdd.php">Add a New Event</a></li>
                <li><a href="#">stuff</a></li>
                <li><a href="#">stuff</a></li>
                <li><a href="#">stuff</a></li>
              </ul>
            </li>
            <!-- end of events page admin -->
            
            <!-- gallery page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">Gallery <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Photos (Add/Update/Delete)</li>
                <li><a href="adminPhotoGalleryNewCategory.php">Add a New Category</a></li>
                <li><a href="adminPhotoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li><a href="adminPhotoGalleryNewPhoto.php">Add a New Photo</a></li>
                <li><a href="adminPhotoGalleryUpdateCategory.php">Update a Category</a></li>
                <li><a href="adminPhotoGallerySubcategory.php">Update a Subcategory</a></li>
                <li><a href="adminPhotoGalleryUpdatePhoto.php">Update a Photo</a></li>
                <li><a href="adminPhotoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li><a href="adminPhotoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li><a href="adminPhotoGalleryDeletePhoto.php">Delete a Photo</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Videos (Add/Update/Delete)</li>
                <li><a href="adminVideoGalleryNewCategory.php">Add a New Category</a></li>
                <li><a href="adminVideoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li><a href="adminVideoGalleryNewVideo.php">Add a New Video</a></li>
                <li><a href="adminVideoGalleryUpdateCategory.php">Update a Category</a></li>
                <li><a href="adminVideoGallerySubcategory.php">Update a Subcategory</a></li>
                <li><a href="adminVideoGalleryUpdateVideo.php">Update a Video</a></li>
                <li><a href="adminVideoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li><a href="adminVideoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li><a href="adminVideoGalleryDeleteVideo.php">Delete a Video</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Virtual Tour (Update)</li>
                <li><a href="adminVirtualTourGalleryUpdate.php">Update Virtual Tour Description</a></li>
              </ul>
            </li>
            <!-- end of gallery page admin -->
            
            <!-- FAQ page admin -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="adminWhite">FAQ <span class="caret"></span></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">FAQ (Add/Update/Change/Delete)</li>
                <li><a href="adminFAQAdd.php">Add a New FAQ</a></li>
                <li><a href="adminFAQUpdate.php">Update a FAQ</a></li>
                <li><a href="adminFAQOrder.php">Change the FAQ List Order</a></li>
                <li><a href="adminFAQDelete.php">Delete a FAQ</a></li>
              </ul>
            </li>
            <!-- end of FAQ page admin -->

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    