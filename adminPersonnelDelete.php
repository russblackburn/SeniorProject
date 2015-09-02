<?php require_once('adminAuthorize.php'); ?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Delete Personnel</h1>

<hr>

<form>

  <div class="form-group">
  	<label for="exampleInputFile">Select Personnel</label>
  		<select class="form-control">
    		<option>Select...</option>
  			<option>Name 1</option>
  			<option>Name 2</option>
  			<option>Name 3</option>
  			<option>Name 4</option>
  			<option>Name 5</option>
		</select>
  </div>
  
  <button type="submit" class="btn btn-danger" name="submitButton">Delete Personnel</button>
  <a href="adminLanding.php" class="btn btn-link" role="button">Cancel</a>
</form>

<?php require_once('footer.php'); ?>