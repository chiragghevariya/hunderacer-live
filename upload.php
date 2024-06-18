<?php
	if(isset($_POST['submit'])) {
		include ("connect.php");
		//$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.

		// Count # of uploaded files in array
		$total = count($_FILES['upload']['name']);

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ ) {

		//Get the temp file path
		$tmpFilePath = $_FILES['upload']['tmp_name'][$i];

			//Make sure we have a file path
			if ($tmpFilePath != ""){
			//Setup our new file path
			$newFilePath = "gallery_holder/" . $_FILES['upload']['name'][$i];

				//Upload the file into the temp dir
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					
				$imgName = $_FILES['upload']['name'][$i];
				$tags = $_POST['tag'];

				$stmt = $con->prepare("INSERT INTO new_gallery (tags, billede) VALUES (?, ?)");
				$stmt->bind_param("ss", $tags, $imgName);
				$stmt->execute();  
				//$lastId = $con->insert_id;
				$stmt->close();

				}
			}
		}
	}
?>

<a href="upload.php">Upload</a> | <a href="upload-update.php">Liste</a>
<hr/>

<form method="post" action=""  enctype='multipart/form-data'>
	<input name="upload[]" type="file" multiple="multiple" /><br />
	<input type="text" name="tag" placeholder="Tag! Eksempel: Bulldog" /><br />
	<input type="submit" name="submit" value="upload" />
</form>