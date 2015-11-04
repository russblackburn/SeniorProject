<?php
require_once('../adminAuthorize.php');
require_once('../adminVariables.php');

$page = admin;
$adminPage = zip;
$adminSecondaryPage = zip1;
require_once('../header.php');

// build the database connection with host, user, password, database
$dbc = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('The database connection has failed!');

if(isset($_POST['submitButton'])){

	/* Simple script to upload a zip file to the webserver and have it unzipped
	   Saves tons of time, think only of uploading Wordpress to the server
	   Thanks to c.bavota (www.bavotasan.com)
	   I have modified the script a little to make it more convenient
	   Modified by: Johan van de Merwe (12.02.2013)
	*/   
		// check the database to make sure there isn't an existing file with the same name
		//BUILD THE QUERY
		$query1 = "SELECT * FROM courseContent";
	
		//TRY AND TALK TO THE DB
		$result1 = mysqli_query($dbc, $query1) or die('query failed');
		
		$checkFile = $_FILES["zip_file"]["name"];
		$checkName = explode(".", $checkFile);
		
		$sameName = false;
		
		while($row1 = mysqli_fetch_array($result1)){
			if($row1[deleteURL] == $checkName[0]){
					$sameName = true;
					break;
				}
		}
	
	if($sameName == false){
	 
		function rmdir_recursive($dir) {
			foreach(scandir($dir) as $file) {
			   if ('.' === $file || '..' === $file) continue;
			   if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
			   else unlink("$dir/$file");
		   }
		 
		   rmdir($dir);
		}
		 
		if($_FILES["zip_file"]["name"]) {
			$filename = $_FILES["zip_file"]["name"];
			$source = $_FILES["zip_file"]["tmp_name"];
			$type = $_FILES["zip_file"]["type"];
		 
			$name = explode(".", $filename);
			$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
			foreach($accepted_types as $mime_type) {
				if($mime_type == $type) {
					$okay = true;
					break;
				} 
			}
		 
			$continue = strtolower($name[1]) == 'zip' ? true : false;
			if(!$continue) {
				$message = "The file you are trying to upload is not a .zip file. Please try again.";
			}
		 
		  /* PHP current path */
		  $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
		  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
		  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
		 
		  $targetdir = $path . $filenoext; // target directory
		  $targetzip = $path . $filename; // target zip file
		 
		  /* create directory if not exists', otherwise overwrite */
		  /* target directory is same as filename without extension */
		 
		  if (is_dir($targetdir))  rmdir_recursive ( $targetdir);
		 
		 
		  mkdir($targetdir, 0777);
		 
		 
		  /* here it is really happening */
		 
			if(move_uploaded_file($source, $targetzip)) {
				$zip = new ZipArchive();
				$x = $zip->open($targetzip);  // open the zip file to extract
				if ($x === true) {
					$zip->extractTo($targetdir); // place in the directory with same name  
					$zip->close();
		 
					unlink($targetzip);
				}
				$message = "Your .zip file was uploaded and unpacked.";
				
				// -------------------------- creating the path for the database ------------------------------------
				$contentTitle = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[contentTitle])));
				
				$customTarget = stripslashes(mysqli_real_escape_string($dbc, trim($_POST[customTarget])));
				$fullURL = 'http://'.$_SERVER['SERVER_NAME'].'/courses/'.$name[0].'/'.$customTarget.'';
				$deleteURL = $name[0];
				
					// build the query
					$query = "INSERT INTO courseContent(contentTitle, fullURL, deleteURL)". 
					"VALUES('$contentTitle','$fullURL','$deleteURL')";
		
					// communicate the query with the database
					$result = mysqli_query($dbc, $query) or die('The databse query has failed!');
				
				
				
					//create a test message so that the user can verify the link that was created
					$message1 = '<a href="'.$fullURL.'" target="_blank">'.$fullURL.'</a>';
				
			} else {	
				$message2 = "There was a problem with the upload. Please try again.";
			}
		}
	}// end of check for same name
	else{
			$message2 = "A file with the same name already exists. Change the name of the zip file that you are uploading.";
		}// end of else statement for same name
}//end of isset

// terminate the connection with the database
mysqli_close($dbc);
 
 
?>

<h1>Upload Course Content</h1>
<hr>

<?php
if($message) echo '<p class="adminGreen">'.$message.'</p>';
if($message1) echo '<p>'.$message1.'</p>';
if($message2) echo '<p class="adminRed">'.$message2.'</p>';
?>
<form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

<div class="form-group">
    <label for="title" data-toggle="popover" title="Content Title" data-content="Give the content a title." required>Content Title</label>
    <input type="text" class="form-control" id="contentTitle" name="contentTitle" placeholder="Content Title">
  </div>

<div class="form-group">
    <label for="customTarget" data-toggle="popover" title="Custom Target" data-content="Target the file that runs the course. If the target file is named index, no custom target is needed.">Custom Target</label>
    <input type="text" class="form-control" id="customTarget" name="customTarget" placeholder="targetfile.htm">
  </div>

<div class="form-group">
<label for="exampleInputFile" data-toggle="popover" title="Zip File" data-content="Select the course zip file.">Zip File</label>
<input type="file" id="zipFile" name="zip_file"></label>
<p class="help-block">Must be a zip file format</p>
</div>

<input type="submit" class="btn btn-primary" name="submitButton" value="Upload">
</form>


<?php require_once('../footer.php'); ?>