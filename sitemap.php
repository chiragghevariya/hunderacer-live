<?php header('Content-type: application/xml; charset=utf-8'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<url><loc>https://hunderacer.dk</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
<url><loc>https://hunderacer.dk/privatpolitik</loc></url>
<url><loc>https://hunderacer.dk/kontakt</loc></url>
<url><loc>https://hunderacer.dk/om-os</loc></url>

<?php
	include ("connect.php");
			
			//Hent hunderacer
			$queryDogs = "SELECT
				artikel,
				linktitel,
				updated_timestamp
					FROM hunde
				WHERE public = '1'
			";
				
			if ($stmtDogs = $con->prepare($queryDogs)) {
				$stmtDogs->execute();
				$stmtDogs->bind_result($artikel, $linktitel, $updated_timestamp);
				while ($stmtDogs->fetch()) {
	
					//XML creator
					$xml_timestamp = date('c',$updated_timestamp);
					
					preg_match_all('/\[img alt=(.*?)\](.+?)\[\/img\]/i', $artikel, $matches, PREG_SET_ORDER);
					
					if($matches != "") {
						$XML_image = "";
						foreach ($matches as $match){
							$img_alt_text = $match[1];
							$img_file = $match[2];
							
							$XML_image .= "<image:image><image:loc>https://hunderacer.dk/".$img_file."</image:loc><image:caption>".$img_alt_text."</image:caption></image:image>";
						}
					}
						
					$Submit_XML = '<url><loc>https://hunderacer.dk/'.$linktitel.'</loc><lastmod>'.$xml_timestamp.'</lastmod>'.$XML_image.'</url>';
					
					echo $Submit_XML;
	
				}
			}
			
			//Hent artikler
			$queryArticles = "SELECT
				linktitle,
				article,
				updated_timestamp
					FROM articles
				WHERE public = '1'
			";
				
			if ($stmtArticles = $con->prepare($queryArticles)) {
				$stmtArticles->execute();
				$stmtArticles->bind_result($linktitel, $article, $updated_timestamp);
				while ($stmtArticles->fetch()) {
	
					//XML creator
					$xml_timestamp = date('c',$updated_timestamp);
					
					preg_match_all('/\[img alt=(.*?)\](.+?)\[\/img\]/i', $artikel, $matches, PREG_SET_ORDER);
					
					if($matches != "") {
						$XML_image = "";
						foreach ($matches as $match){
							$img_alt_text = $match[1];
							$img_file = $match[2];
							
							$XML_image .= "<image:image><image:loc>https://hunderacer.dk/".$img_file."</image:loc><image:caption>".$img_alt_text."</image:caption></image:image>";
						}
					}
						
					$Submit_XML = '<url><loc>https://hunderacer.dk/artikel/'.$linktitel.'</loc><lastmod>'.$xml_timestamp.'</lastmod>'.$XML_image.'</url>';
					
					echo $Submit_XML;
	
				}
			}
			
			//Hent tags
			$queryTags = "SELECT
				linktitle,
				article
					FROM tags
				WHERE public = '1'
			";
				
			if ($stmtTags = $con->prepare($queryTags)) {
				$stmtTags->execute();
				$stmtTags->bind_result($linktitel, $article,);
				while ($stmtTags->fetch()) {
	
					//XML creator
					//$xml_timestamp = date('c',$timestamp);
					
					preg_match_all('/\[img alt=(.*?)\](.+?)\[\/img\]/i', $artikel, $matches, PREG_SET_ORDER);
					
					if($matches != "") {
						$XML_image = "";
						foreach ($matches as $match){
							$img_alt_text = $match[1];
							$img_file = $match[2];
							
							$XML_image .= "<image:image><image:loc>https://hunderacer.dk/".$img_file."</image:loc><image:caption><![CDATA[".$img_alt_text."]]></image:caption></image:image>";
						}
					}
						
					$Submit_XML = '<url><loc>https://hunderacer.dk/tag/'.$linktitel.'</loc>'.$XML_image.'</url>';
					
					echo $Submit_XML;
	
				}
			}
?>
</urlset>