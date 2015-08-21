<?php require_once('adminAuthorize.php'); ?>
<?php $page = admin; ?>
<?php require_once('header.php'); ?>

<h1>Update Mission Statement</h1>

<hr>

<form>
  
  <div class="form-group">
    <label for="missionStatement">Mission Statement</label>
    <textarea class="form-control" rows="3" name="mission_statement" placeholder="Mission Statement"></textarea>
  </div>
  
  <button type="submit" class="btn btn-default" name="submitButton">Update</button>
</form>

<?php require_once('footer.php'); ?>