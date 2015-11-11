<?php 	
	$page = contact;
	$secondaryPage = false;
	
	
	// init variables
	$min_number = 0;
	$max_number = 8;

	// generating random numbers
	$random_number1 = mt_rand($min_number, $max_number);
	
	if(isset($_POST['submitButton']))
	{
	
	$captchaResult = $_POST["captchaResult"];
		$firstNumber = $_POST["firstNumber"];

		$checkTotal = $firstNumber + 1;

		if ($captchaResult == $checkTotal) {
			
			require_once('mail/ifElseEmail.php');

			header("Location: contactThanks.php");
		} else {
			$feedback = '<p class="adminRed">Wrong Answer. Please Try Again.</p>';
		}
	};
	
	require_once('header.php');
?>

<div class="pagePadding">
<h1>Contact</h1>


<hr>
<?php
$feedback = stripslashes($feedback);
echo $feedback;
?>

<div class="row">
<iframe class="col-md-6 col-sm-12 maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.2518725525597!2d-111.88191758461325!3d40.77847654148298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8752f59f58e48fd7%3A0x24e765972779cb6f!2sLDS+Hospital!5e0!3m2!1sen!2sus!4v1443722440869" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>

<div class="col-md-6 col-sm-12 addressPhone">
<div class="address">
<h3>Intermountain Center for Disaster Preparedness</h3>
<p>8th Ave C St</p>
<p>Salt Lake City, UT, 84143</p>
<p>801.408.7061</p>
</div>
</div>
</div>


<hr id="contactform">


<div class="entireForm">
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="name">Full Name</label>
    <input type="text" class="form-control" name="Name" id="name" placeholder="Maggie Smith" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="Email" id="email" placeholder="maggies@icdp.org" required>
  </div>
  <div class="form-group">
    <label for="phoneNumber">Phone Number</label>
    <input type="tel" class="form-control" name="Phone_Number" id="phoneNumber" placeholder="801-555-6789">
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" rows="4" name="Message" placeholder="Type your message..."></textarea>
  </div>
  
  
  		<div class="form-group">
			<?php
				echo '<label for="test">What number comes after '.$random_number1 . ' ?</label>';
			?>
			<input name="captchaResult" type="text" size="2" />

			<input name="firstNumber" type="hidden" value="<?php echo $random_number1; ?>" />
		</div>
        

  


  <button type="submit" name="submitButton" class="btn btn-primary">Send Message</button>
	<!-- <input name="redirect" type="hidden" value="/contactThanks.php"> -->
</form>

</div> <!--end of form div-->
</div>

<?php require_once('footer.php'); ?>