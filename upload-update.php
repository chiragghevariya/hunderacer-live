<a href="upload.php">Upload</a> | <a href="upload-update.php">Liste</a>
<hr/>

<form method="post" action="">

<?php
	include ("connect.php");
	
	//VED POST
	if(isset($_POST['update']))	{
		
					function thumbNail ($imgWidth, $imgPath, $imgFile, $imgName, $imgType, $imgQuality) {
						$image_name = $imgFile;
						list($width, $height) = getimagesize($image_name);
						$height_width_comparison = ($height/$width);
						$new_height = round($imgWidth*$height_width_comparison);
						
						if($imgType == "jpg" || $imgType == "jpeg") {
							$image_p = imagecreatetruecolor($imgWidth, $new_height);							
							$image = imagecreatefromjpeg($image_name);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $imgWidth, $new_height, $width, $height);
							imagejpeg($image_p, $imgPath."/".$imgName, $imgQuality);
						}
						else if($imgType == "gif") {
							$image_p = imagecreatetruecolor($imgWidth, $new_height);							
							$image = imagecreatefromgif($image_name);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $imgWidth, $new_height, $width, $height);
							imagegif($image_p, $imgPath."/".$imgName, $imgQuality);
						}
						else if($imgType == "png") {
							$image_p = imagecreatetruecolor($imgWidth, $new_height);							
							$image = imagecreatefrompng($image_name);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $imgWidth, $new_height, $width, $height);
							imagepng($image_p, $imgPath."/".$imgName, 7);
						}
						else if($imgType == "webp") {
							$image_p = imagecreatetruecolor($imgWidth, $new_height);							
							$image = imagecreatefromwebp($image_name);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $imgWidth, $new_height, $width, $height);
							imagewebp($image_p, $imgPath."/".$imgName, $imgQuality);
						}
					}
		
		for($i=0;$i<count($_POST['id']);$i++){  
			//echo "opdateret - ". $_POST['title'][$i] . "<br />";
			
			
		$pic_title 			= $_POST['title'][$i];
		$pic_tags 			= $_POST['tags'][$i];
		$target_dir			= "gallery_holder/";

		$target_file 		= $target_dir . $_POST['billede'][$i];
		$uploadOk 			= 1;
		//UNIK NAVN TIL BILLEDE
		$healthy = array("Æ","Ø","Å","æ","ø","å","?",'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
		$yummy = array("ae","o","a","ae","o","a","",'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');

		$linktitle = str_replace($healthy, $yummy, $pic_title);
		
		$linktitle = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $linktitle)));

		$RandNo = rand(0, 999999);
		
		$imageFileType 			= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$timestamp 				= time();
		$UniquePicName 			= strtolower($linktitle."-".$RandNo.".".$imageFileType);
		$UniquePicPath 			= $target_dir.$UniquePicName;


				
				/****************************************/
				/*****LAV FLERE FORSKELLIGE BILLEDER*****/
				/****************************************/
				
				//$imgWidth 	= bredden
				//imgPath 		= mappen hvor billedet skal gemmes
				//imgFile		= billed-filen
				//imgName		= det unikke billed-navn med filtypen (extension)
				
				//Brug af funktion:
				//thumbNail("BREDDE", "Stien/til/mappen", $DenUploadedeFil, $NyeNavnTilDenUploadedeFil, $Filtypen.|png|webp|gif|jpeg|jpg, $Kvalitet_fra_1-100);
					
					list($IMG_width, $IMG_height) = getimagesize($target_file);
					
					if($IMG_width >= "200") {
						thumbNail("200", "gallery_200", $target_file, $UniquePicName, $imageFileType, "90");
					}
					if($IMG_width >= "228") {
						thumbNail("228", "gallery_228", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "260") {
						thumbNail("260", "gallery_260", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "296") {
						thumbNail("296", "gallery_296", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "338") {
						thumbNail("338", "gallery_338", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "385") {
						thumbNail("385", "gallery_385", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "439") {
						thumbNail("439", "gallery_439", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "500") {
						thumbNail("500", "gallery_500", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "571") {
						thumbNail("571", "gallery_571", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "650") {
						thumbNail("650", "gallery_650", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "741") {
						thumbNail("741", "gallery_741", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "845") {
						thumbNail("845", "gallery_845", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "964") {
						thumbNail("964", "gallery_964", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "1098") {
						thumbNail("1098", "gallery_1098", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "1252") {
						thumbNail("1252", "gallery_1252", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "1428") {
						thumbNail("1428", "gallery_1428", $target_file, $UniquePicName, $imageFileType, "80");
					}
					if($IMG_width >= "1600") {
						thumbNail("1600", "gallery_1600", $target_file, $UniquePicName, $imageFileType, "80");
					}
					
					unlink($target_file);	
			
					$stmtUpdate = $con->prepare("UPDATE new_gallery SET title = ?, tags = ?, billede = ?
					   WHERE g_id = ?");
					$stmtUpdate->bind_param('ssss', $_POST['title'][$i], $_POST['tags'][$i], $UniquePicName, $_POST['id'][$i]);
					$stmtUpdate->execute(); 
					$stmtUpdate->close();
			}
			
		
		
	}
	
	$title = "UNTITLED";
	
	$queryGG = "SELECT 
		g_id,
		title,
		tags,
		billede
		FROM new_gallery WHERE title = ? LIMIT 25";
	if ($stmtGG = $con->prepare($queryGG)) {
		
		$stmtGG->bind_param('s', $title);
		
		/* execute statement */
		$stmtGG->execute();

		/* bind result variables */
		$stmtGG->bind_result($g_id,
		$title,
		$tags,
		$billede);
		
		/* fetch values */
		while ($stmtGG->fetch()) {
			echo "<div style='width: 100%; float: left; padding: 20px 0; border-bottom: 1px solid black;'>";
			echo "<div style='width: 800px; float: left;'>";
			echo "<img src='gallery_holder/".$billede."' width='800px' />";
			echo "</div>";
			echo "<div style='width: 400px; padding: 400px 0 0 0; float: left;'>";
			echo "<input type='text' name='title[]' style='width: 800px; padding: 10px;' placeholder='Titel: ".$tags."' /><br /><br />";
			echo "<input type='text' name='tags[]' style='width: 800px; padding: 10px;' placeholder='Tags: ".$tags."' value='".$tags.", ' /><br />";
			echo "<input type='hidden' name='id[]' value='".$g_id."' />";
			echo "<input type='hidden' name='billede[]' value='".$billede."' />";
			echo "</div>";
			echo "</div>";
		}
	}
?>

<input type="submit" name="update" value="Opdater" />
</form>