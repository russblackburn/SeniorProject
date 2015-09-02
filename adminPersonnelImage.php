<?php require_once('adminAuthorize.php'); ?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update Personnel Image</h1>

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
  
  <div class="form-group">
    <label for="exampleInputFile">New Image</label>
    <input type="file" id="slideImage" name="image">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Update Image</button>
</form>

<?php require_once('footer.php'); ?>