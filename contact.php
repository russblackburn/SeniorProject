<?php 	
	$page = contact;
	$secondaryPage = false;
	require_once('header.php');
?>

<div class="pagePadding">
<h1>Contact</h1>


<hr>


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


<hr>


<div class="entireForm">
<form>
  <div class="form-group">
    <label for="name">Full Name</label>
    <input type="text" class="form-control" id="name" placeholder="Jane Smith" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" placeholder="Email" required>
  </div>
  <div class="form-group">
    <label for="phoneNumber">Phone Number</label>
    <input type="tel" class="form-control" id="phoneNumber" placeholder="8015556789">
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" rows="4" name="message" placeholder="Type your message..."></textarea>
  </div>


  <button type="submit" class="btn btn-default">Send Message</button>
</form>

</div> <!--end of form div-->
</div>

<?php require_once('footer.php'); ?>