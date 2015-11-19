<?php
require_once('../adminAuthorize.php');
require_once('../adminVariables.php');
	
	$courseContentID = $_GET[id];

	//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
	$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');
	
	//--------DELETE THE SELECTED RECORDS (IN FROM THE POST)--------

	if (isset($_POST['submit'])){
		
		
		//BUILD A SELECT QUERY
		$query = "DELETE FROM courseContent WHERE id=$_POST[id]";
		
		
		//TRY AND DELETE THE RECORD
		$result = mysqli_query($dbc, $query) or die('delete query failed'); 
		
		// deleteDirectory function to delete all files and folder associated with the folder deleted
		function deleteDirectory($dirPath) {
			if (is_dir($dirPath)) {
				$objects = scandir($dirPath);
				foreach ($objects as $object) {
					if ($object != "." && $object !="..") {
						if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
							deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
						} else {
							unlink($dirPath . DIRECTORY_SEPARATOR . $object);
						}
					}
				}
			reset($objects);
			rmdir($dirPath);
			}
		}// end of function
		
		// call the deleteDirectory function
		deleteDirectory($_POST['deleteURL']);
	
		
		//REDIRECT
		header("Location: adminZipperDelete.php");
		
		//MAKE SURE THE CODE BELOW DOES NOT GET EXECUTED WHEN WE REDIRECT
		exit;
		
		};
	
	
	//--------DISPLAY THE SELECTED RECORDS--------
	//BUILD THE QUERY
	$query = "SELECT * FROM courseContent WHERE id=$courseContentID";

	//TRY AND TALK TO THE DB
	$result = mysqli_query($dbc, $query) or die('query failed');
	
	//PUT THE RESULT IN A VARIABLE
	$found = mysqli_fetch_array($result);
?>

<?php
$page = admin;
$adminPage = zip;
$adminSecondaryPage = zip2;
require_once('../header.php'); 
?>

<h1>Delete Course Content Confirmation</h1>

<hr>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<?php
//DISPLAY WHAT WE FOUND
echo '<p>';
echo $found['contentTitle'];
echo ' - ';
echo '<a href="'.$found['fullURL'].'" target="_blank">';
echo $found['fullURL'];
echo '</a>';
echo '</p>';
?>

<input type="hidden" name="id" value="<?php echo $found['id'];?>">
<input type="hidden" name="deleteURL" value="<?php echo $found['deleteURL'];?>">
<button type="submit" class="btn btn-danger" name="submit">DELETE</button>
&nbsp; <a href="adminZipperDelete.php"> Cancel</a>
</fieldset>
</form>

<script>
function myFunction() {
    alert("You are about to delete the course content for the selected course!");
}
</script>


<?php require_once('../footer.php'); ?>