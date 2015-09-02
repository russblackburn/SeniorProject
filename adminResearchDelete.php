<?php require_once('adminAuthorize.php'); ?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Delete Research</h1>

<hr>

<form>

  <div class="form-group">
  	<label for="exampleInputFile">Select Research</label>
  		<select class="form-control">
    		<option>Select...</option>
  			<option>Research 1</option>
  			<option>Research 2</option>
  			<option>Research 3</option>
  			<option>Research 4</option>
  			<option>Research 5</option>
		</select>
  </div>
  
  <button type="submit" class="btn btn-danger" name="submitButton">Delete Research</button>
  <a href="adminLanding.php" class="btn btn-link" role="button">Cancel</a>
</form>

<?php require_once('footer.php'); ?>