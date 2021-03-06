	<div class="entireForm">
    
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="requestServiceProposal_registration">
    
    <?php
	
	if($secondaryPage == requestServiceProposal){
    echo '<label for="course">Service Requested</label>';
				echo '<div class="form-group">';
					echo '<div class="form-group">';
						echo '<select class="form-control" name="service">';
							echo '<option value="0">Select</option>';   
							echo '<option value="Exercises">Exercises</option>';
							echo '<option value="Assessment">Assessment</option>';
							echo '<option value="Research">Research</option>';
						echo '</select>';
					echo '</div>';
				echo '</div>';
	}
	else if($secondaryPage == exercises){
			echo '<input type="hidden" name="service" value="Exercises">';
		}
		else if($secondaryPage == assessment){
				echo '<input type="hidden" name="service" value="Assessment">';
			}
			else if($secondaryPage == research){
					echo '<input type="hidden" name="service" value="Research">';
				}
	?>
    
    <div class="form-group">
    <label for="initiator">Initiator</label>
    <input type="text" class="form-control" id="initiator" name="initiator" placeholder="Initiator" required>
  	</div>
  
	<div class="form-group">
    <label for="organizationDepartment">Organization/Department</label>
    <input type="organizationDepartment" class="form-control" id="organizationDepartment" name="organization_department" placeholder="Organization/Department">
	</div>
    
    <div class="form-group">
    <label for="contactInformation">Contact Information</label>
    <input type="contactInformation" class="form-control" id="contactInformation" name="contact_information" placeholder="Contact Information">
	</div>
    
    <div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control" rows="3" name="details" placeholder="Details"></textarea>
	</div>
    
    <div class="form-group">
    <label for="serviceDeadline">Service Deadline</label>
    <input type="contactInformation" class="form-control" id="serviceDeadline" name="service_deadline" placeholder="Service Deadline">
	</div>
    
    <div class="form-group">
			<label for="message"><?php
			$feedback2 = stripslashes($feedback2);
			echo $feedback2;
			?></label>
            
            <div class="row">
            <div class="col-md-2">
			<input name="captchaResult" class="form-control" type="text" size="2" maxlength="1" />
            <input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
            </div></div>

		</div>
    
    <button type="submit" class="btn btn-primary" name="submitButton">Register</button>
    
    </form>
    
    </div><!-- end of entireForm -->