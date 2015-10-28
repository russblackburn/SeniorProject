	<div class="entireForm">
    
    <form action="requestServiceProposalProcess.php" method="POST" enctype="multipart/form-data" name="requestServiceProposal_registration">
    
    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
  	</div>
  
	<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
	</div>
    
    <?php
	
	if($secondaryPage == requestServiceProposal){
    echo '<label for="course">Service</label>';
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
    
    <button type="submit" class="btn btn-default" name="submitButton">Register</button>
    
    </form>
    
    </div><!-- end of entireForm -->