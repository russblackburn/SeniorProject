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
          <a class="navbar-brand" href="index.php">Exit Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
          	<!-- home page admin -->
            <li class="dropdown <?php if($adminPage=='home'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Home (Update/Hide)</li>
                <li class="<?php if($adminSecondaryPage=='home1'){echo 'active';}?>"><a href="adminSlideOne.php">Update Slide 1</a></li>
                <li class="<?php if($adminSecondaryPage=='home2'){echo 'active';}?>"><a href="adminUpdateCourseSlide.php">Update/Add a Course Slide</a></li>
                <li class="<?php if($adminSecondaryPage=='home3'){echo 'active';}?>"><a href="adminSlideThree.php">Update Slide 3</a></li>
                <li class="<?php if($adminSecondaryPage=='home4'){echo 'active';}?>"><a href="adminMissionStatement.php">Update Mission Statement</a></li>
                <li class="<?php if($adminSecondaryPage=='home5'){echo 'active';}?>"><a href="adminHideCourseSlide.php">Hide/Un-hide a Course Slide</a></li>
              </ul>
            </li>
            <!-- end of home page admin -->
            
            <!-- about page admin -->
            <li class="dropdown <?php if($adminPage=='about'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Purpose (Update)</li>
                <li class="<?php if($adminSecondaryPage=='about1'){echo 'active';}?>"><a href="adminPurposePage.php">Update Purpose</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Personnel (Add/Update/Change/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='about2'){echo 'active';}?>"><a href="adminPersonnelAdd.php">Add a New Personnel Record</a></li>
                <li class="<?php if($adminSecondaryPage=='about3'){echo 'active';}?>"><a href="adminPersonnelUpdateText.php">Update a Personnel Record</a></li>
                <li class="<?php if($adminSecondaryPage=='about4'){echo 'active';}?>"><a href="adminPersonnelOrder.php">Change the Personnel List Order</a></li>
                <li class="<?php if($adminSecondaryPage=='about5'){echo 'active';}?>"><a href="adminPersonnelDelete.php">Delete a Personnel Record</a></li>
              </ul>
            </li>
            <!-- end of about page admin -->
            
            <!-- services page admin -->
            <li class="dropdown <?php if($adminPage=='services'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Training (Add/Update/Hide/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='services1'){echo 'active';}?>"><a href="adminCoreCourseForm.php">Add a New Core Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services2'){echo 'active';}?>"><a href="adminThirdPartyCoursesForm.php">Add a New Third Party Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services3'){echo 'active';}?>"><a href="adminTrainingUpdateText.php">Update a Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services4'){echo 'active';}?>"><a href="adminTrainingHide.php">Hide/Un-hide a Course</a></li>
                <li class="<?php if($adminSecondaryPage=='services5'){echo 'active';}?>"><a href="adminTrainingDelete.php">Delete a Course</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Exercises (Update)</li>
                <li class="<?php if($adminSecondaryPage=='services6'){echo 'active';}?>"><a href="adminExercisePage.php">Update Exercises</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Assessment (Update)</li>
                <li class="<?php if($adminSecondaryPage=='services7'){echo 'active';}?>"><a href="adminAssessment.php">Update Assessment</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Research (Add/Update/Hide/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='services8'){echo 'active';}?>"><a href="adminResearchAdd.php">Add New Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services9'){echo 'active';}?>"><a href="adminResearchUpdateText.php">Update Existing Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services10'){echo 'active';}?>"><a href="adminResearchPage.php">Update Research Page</a></li>
                <li class="<?php if($adminSecondaryPage=='services11'){echo 'active';}?>"><a href="adminResearchHide.php">Hide/Un-hide Research</a></li>
                <li class="<?php if($adminSecondaryPage=='services12'){echo 'active';}?>"><a href="adminResearchDelete.php">Delete Research</a></li>
              </ul>
            </li>
            <!-- end of services page admin -->
            
            <!-- events page admin -->
            <li class="dropdown <?php if($adminPage=='events'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Events (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='events1'){echo 'active';}?>"><a href="adminEventAdd.php">Add a New Event</a></li>
                <li class="<?php if($adminSecondaryPage=='events2'){echo 'active';}?>"><a href="adminEventUpdate.php">Update a Event</a></li>
                <li class="<?php if($adminSecondaryPage=='events3'){echo 'active';}?>"><a href="adminEventDelete.php">Delete a Event</a></li>
              </ul>
            </li>
            <!-- end of events page admin -->
            
            <!-- gallery page admin -->
            <li class="dropdown <?php if($adminPage=='gallery'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Photos (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='gallery1'){echo 'active';}?>"><a href="adminPhotoGalleryNewCategory.php">Add a New Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery2'){echo 'active';}?>"><a href="adminPhotoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery3'){echo 'active';}?>"><a href="adminPhotoGalleryNewPhoto.php">Add a New Photo</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery4'){echo 'active';}?>"><a href="adminPhotoGalleryUpdateCategory.php">Update a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery5'){echo 'active';}?>"><a href="adminPhotoGallerySubcategory.php">Update a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery6'){echo 'active';}?>"><a href="adminPhotoGalleryUpdatePhoto.php">Update a Photo</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery7'){echo 'active';}?>"><a href="adminPhotoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery8'){echo 'active';}?>"><a href="adminPhotoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery9'){echo 'active';}?>"><a href="adminPhotoGalleryDeletePhoto.php">Delete a Photo</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Videos (Add/Update/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='gallery10'){echo 'active';}?>"><a href="adminVideoGalleryNewCategory.php">Add a New Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery11'){echo 'active';}?>"><a href="adminVideoGalleryNewSubcategory.php">Add a New Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery12'){echo 'active';}?>"><a href="adminVideoGalleryNewVideo.php">Add a New Video</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery13'){echo 'active';}?>"><a href="adminVideoGalleryUpdateCategory.php">Update a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery14'){echo 'active';}?>"><a href="adminVideoGallerySubcategory.php">Update a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery15'){echo 'active';}?>"><a href="adminVideoGalleryUpdateVideo.php">Update a Video</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery16'){echo 'active';}?>"><a href="adminVideoGalleryDeleteCategory.php">Delete a Category</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery17'){echo 'active';}?>"><a href="adminVideoGalleryDeleteSubcategory.php">Delete a Subcategory</a></li>
                <li class="<?php if($adminSecondaryPage=='gallery18'){echo 'active';}?>"><a href="adminVideoGalleryDeleteVideo.php">Delete a Video</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Virtual Tour (Update)</li>
                <li class="<?php if($adminSecondaryPage=='gallery19'){echo 'active';}?>"><a href="adminVirtualTourGalleryUpdate.php">Update Virtual Tour Description</a></li>
              </ul>
            </li>
            <!-- end of gallery page admin -->
            
            
            <!-- register admin -->
            <li class="dropdown <?php if($adminPage=='register'){echo 'active';}?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Register (Update)</li>
                <li class="<?php if($adminSecondaryPage=='register1'){echo 'active';}?>"><a href="adminRegisterStudent.php">Update Student Registration</a></li>
                <li class="<?php if($adminSecondaryPage=='register2'){echo 'active';}?>"><a href="adminRegisterInstructor.php">Update Instructor Registration</a></li>
                <li class="<?php if($adminSecondaryPage=='register3'){echo 'active';}?>"><a href="adminRegisterProposal.php">Update Request Service Proposal</a></li>
              </ul>
            </li>
            <!-- end of register admin -->
            
            
            <!-- FAQ page admin -->
            <li class="dropdown <?php if($adminPage=='faq'){echo 'active';}?>"">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FAQ <span class="caret"></span></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">FAQ (Add/Update/Change/Delete)</li>
                <li class="<?php if($adminSecondaryPage=='faq1'){echo 'active';}?>"><a href="adminFAQAdd.php">Add a New FAQ</a></li>
                <li class="<?php if($adminSecondaryPage=='faq2'){echo 'active';}?>"><a href="adminFAQUpdate.php">Update a FAQ</a></li>
                <li class="<?php if($adminSecondaryPage=='faq3'){echo 'active';}?>"><a href="adminFAQOrder.php">Change the FAQ List Order</a></li>
                <li class="<?php if($adminSecondaryPage=='faq4'){echo 'active';}?>"><a href="adminFAQDelete.php">Delete a FAQ</a></li>
              </ul>
            </li>
            <!-- end of FAQ page admin -->

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    