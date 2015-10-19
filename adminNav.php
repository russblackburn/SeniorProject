<!-- Static navbar for the admin section -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php if($adminPage == zip){echo '../';} ?>index.php">Exit Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
          	<!-- home page admin -->
            <li class="dropdown <?php if($adminPage=='home'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Home (Update/Hide)</li>
                <li class="<?php if($adminSecondaryPage=='home1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminSlideOne.php">Update Slide 1</a></li>
                <li class="<?php if($adminSecondaryPage=='home2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminUpdateCourseSlide.php">Update/Add a Course Slide</a></li>
                <li class="<?php if($adminSecondaryPage=='home3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminSlideThree.php">Update Slide 3</a></li>
                <li class="<?php if($adminSecondaryPage=='home4'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminMissionStatement.php">Update Mission Statement</a></li>
                <li class="<?php if($adminSecondaryPage=='home5'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminHideCourseSlide.php">Hide/Un-hide a Course Slide</a></li>
              </ul>
            </li>
            <!-- end of home page admin -->
            
            <!-- about page admin -->
            <li class="dropdown <?php if($adminPage=='about'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Purpose (Update)</li>
                <li class="<?php if($adminSecondaryPage=='about1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPurposePage.php">Update Purpose</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Personnel (Add/Update/Change/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='about2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPersonnelAdd.php">Add a New Personnel Record</a></li>
                <li class="<?php if($adminSecondaryPage=='about3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPersonnelUpdateText.php">Update a Personnel Record</a></li>
                <li class="<?php if($adminSecondaryPage=='about4'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPersonnelOrder.php">Change the Personnel List Order</a></li>
                <li class="<?php if($adminSecondaryPage=='about5'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPersonnelDelete.php">Delete a Personnel Record</a></li>
              </ul>
            </li>
            <!-- end of about page admin -->
            
            <!-- services page admin -->
            <li class="dropdown <?php if($adminPage=='services'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Training (Add/Update/Hide/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='services1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminCoreCourseForm.php">Add a New Core Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminThirdPartyCoursesForm.php">Add a New Third Party Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminTrainingUpdateText.php">Update a Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services4'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminTrainingHide.php">Hide/Un-hide a Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services5'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminTrainingDelete.php">Delete a Course</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Exercises (Update)</li>
                <li class="<?php if($adminSecondaryPage=='services6'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminExercisePage.php">Update Exercises</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Assessment (Update)</li>
                <li class="<?php if($adminSecondaryPage=='services7'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminAssessment.php">Update Assessment</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Research (Add/Update/Hide/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='services8'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminResearchAdd.php">Add New Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services9'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminResearchUpdateText.php">Update Existing Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services10'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminResearchPage.php">Update Research Page</a></li>
                <li class="<?php if($adminSecondaryPage=='services11'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminResearchHide.php">Hide/Un-hide Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services12'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminResearchDelete.php">Delete Research</a></li>
              </ul>
            </li>
            <!-- end of services page admin -->
            
            <!-- events page admin -->
            <li class="dropdown <?php if($adminPage=='events'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Events (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='events1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminEventAdd.php">Add a New Event</a></li>
                <li class="<?php if($adminSecondaryPage=='events2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminEventUpdate.php">Update a Event</a></li>
                <li class="<?php if($adminSecondaryPage=='events3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminEventDelete.php">Delete a Event</a></li>
              </ul>
            </li>
            <!-- end of events page admin -->
            
            <!-- gallery page admin -->
            <li class="dropdown <?php if($adminPage=='gallery'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Photos (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='gallery1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryNewCategory.php">Add a New Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryNewPhoto.php">Add a New Photo</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery4'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryUpdateCategory.php">Update a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery5'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGallerySubcategory.php">Update a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery6'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryUpdatePhoto.php">Update a Photo</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery7'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery8'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery9'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminPhotoGalleryDeletePhoto.php">Delete a Photo</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Videos (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='gallery10'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryNewCategory.php">Add a New Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery11'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery12'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryNewVideo.php">Add a New Video</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery13'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryUpdateCategory.php">Update a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery14'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGallerySubcategory.php">Update a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery15'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryUpdateVideo.php">Update a Video</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery16'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery17'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery18'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVideoGalleryDeleteVideo.php">Delete a Video</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Virtual Tour (Update)</li>
                <li class="<?php if($adminSecondaryPage=='gallery19'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminVirtualTourGalleryUpdate.php">Update Virtual Tour Description</a></li>
              </ul>
            </li>
            <!-- end of gallery page admin -->
            
            
            <!-- register admin -->
            <li class="dropdown <?php if($adminPage=='register'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Register (Update)</li>
                <li class="<?php if($adminSecondaryPage=='register1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminRegisterStudent.php">Update Student Registration</a></li>
                <li class="<?php if($adminSecondaryPage=='register2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminRegisterInstructor.php">Update Instructor Registration</a></li>
                <li class="<?php if($adminSecondaryPage=='register3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminRegisterProposal.php">Update Request Service Proposal</a></li>
              </ul>
            </li>
            <!-- end of register admin -->
            
            
            <!-- FAQ page admin -->
            <li class="dropdown <?php if($adminPage=='faq'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FAQ <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">FAQ (Add/Update/Change/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='faq1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminFAQAdd.php">Add a New FAQ</a></li>
                <li class="<?php if($adminSecondaryPage=='faq2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminFAQUpdate.php">Update a FAQ</a></li>
                <li class="<?php if($adminSecondaryPage=='faq3'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminFAQOrder.php">Change the FAQ List Order</a></li>
                <li class="<?php if($adminSecondaryPage=='faq4'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo '../';} ?>adminFAQDelete.php">Delete a FAQ</a></li>
              </ul>
            </li>
            <!-- end of FAQ page admin -->
            
            
            <!--  upload zipped course admin -->
            <li class="dropdown <?php if($adminPage=='zip'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Course Content <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Manage Course Content (Upload/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='zip1'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo 'zipper.php';}else{echo 'courses/zipper.php';} ?>">Upload Course Content</a></li>
                <li class="<?php if($adminSecondaryPage=='zip2'){echo 'active';}?>"><a href="<?php if($adminPage == zip){echo 'adminZipperDelete.php';}else{echo 'courses/adminZipperDelete.php';} ?>">Delete Course Content</a></li>
              </ul>
            </li>
            <!-- end of upload zipped course admin -->

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    