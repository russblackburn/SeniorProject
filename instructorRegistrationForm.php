	<div class="entireForm">
    
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" name="instructor_registration">
    
    <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" required>
  	</div>
    
    <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" required>
  	</div>
    
    <div class="form-group">
    <label for="mailingAddress">Mailing Address</label>
    <input type="text" class="form-control" id="mailingAddress" name="mailing_address" placeholder="Mailing Address">
  	</div>
    
    <div class="form-group">
    <label for="city">City</label>
    <input type="text" class="form-control" id="city" name="city" placeholder="City">
  	</div>
    
    <div class="form-group">
    <label for="state">State</label>
    <input type="text" class="form-control" id="state" name="state" placeholder="State">
  	</div>
    
    <div class="form-group">
    <label for="zipCode">Zip Code</label>
    <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="Zip Code">
  	</div>
  
	<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
	</div>
    
    <div class="form-group">
    <label for="telephone">Telephone</label>
    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone">
  	</div>
    
    <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
  	</div>
    
    <div class="form-group">
    <label for="certificationHistory">Certification History</label>
    <textarea class="form-control" rows="3" name="certification_history" placeholder="List all Instructor or Train-the-Trainer certifications. Separate with a comma."></textarea>
	</div>
    
    <div class="form-group">
    <label for="certificationHistory">Courses/Topics of Interest
    <?php
	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//BUILD THE QUERY
	$query = "SELECT * FROM instructor_form_elements ORDER BY form_element ASC";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	while($row = mysqli_fetch_array($result)){
    echo '<div class="checkbox">';
		echo '<label class="gray">';
		echo '<input type="checkbox" name="form_element_checkbox[]" value="'.$row['form_element'].' - "> '.$row['form_element'].'';
		echo '</label>';
  	echo '</div>';
	}
	?>
    </label>
    </div>
    
    <div class="form-group">
    <label for="topiceOfInterest">Topics of Interest</label>
    <textarea class="form-control" rows="3" name="topics_of_interest" placeholder="Provide subject matter topics you would be interested in teaching."></textarea>
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