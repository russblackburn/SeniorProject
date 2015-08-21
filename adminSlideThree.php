<?php require_once('adminAuthorize.php'); ?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update Slide 3</h1>

<hr>

<form>

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
  </div>
  
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" rows="2" name="description" placeholder="Description"></textarea>
  </div>
  
  <div class="form-group">
    <label for="link">Link</label>
    <input type="text" class="form-control" id="link" name="link" placeholder="Link">
  </div>
  
  <div class="form-group">
    <label for="buttonText">Button Text</label>
    <input type="text" class="form-control" id="buttonText" name="button_text" placeholder="Button Text">
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">Slide Image</label>
    <input type="file" id="slideImage" name="image">
    <p class="help-block">Image size must be (width and height)</p>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Update</button>
</form>

<?php require_once('footer.php'); ?>