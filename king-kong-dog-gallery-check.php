<?php
	if(isset($_POST['submit_picture'])) {
		include ("connect.php");
		$pic_title 			= $_POST['picture_name'];
		$pic_tags 			= $_POST['picture_tags'];
		$target_dir			= "gallery_holder/";

		$target_file 		= $target_dir . basename($_FILES["fileToUpload"]["name"]);
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

		// Check if file already exists
		if (file_exists($target_file)) {
			//echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
			//echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			//echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$FileName = basename( $_FILES["fileToUpload"]["name"]);
				
				/****************************************/
				/*****LAV FLERE FORSKELLIGE BILLEDER*****/
				/****************************************/
				
				//$imgWidth 	= bredden
				//imgPath 		= mappen hvor billedet skal gemmes
				//imgFile		= billed-filen
				//imgName		= det unikke billed-navn med filtypen (extension)
				
				//Brug af funktion:
				//thumbNail("BREDDE", "Stien/til/mappen", $DenUploadedeFil, $NyeNavnTilDenUploadedeFil, $Filtypen.|png|webp|gif|jpeg|jpg, $Kvalitet_fra_1-100);
				
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
				/****************************************/
				/****************************************/
				/****************************************/
							
							$stmt = $con->prepare("INSERT INTO new_gallery (title, tags, billede) VALUES (?, ?, ?)");
							$stmt->bind_param("sss", $pic_title, $pic_tags, $UniquePicName);
							$stmt->execute();  
							$lastId = $con->insert_id;
							$stmt->close();
				
				header('Location: index.php?page=king-kong-dog-new-gallery');
				//header('Location: https://hunderacer.dk/index.php?page=king-kong-dog-gallery');
				echo "done";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>