<?php
	$artikel = $_POST['artikel'];
	
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
	
	echo "[toc-wrap]<br />";

		if (preg_match_all("/<h\d id='.*'>([^<]*)<\/h\d>/iU", $artikel, $m ) ) {
			$i = "1";
			foreach ( $m[1] as $link ) {
				$AnchorLinkLowerCase = strtolower($link);
				$AnchorLinkNoSpaces = str_replace(" ", "-", $AnchorLinkLowerCase);
				
				$healthy = array("Æ","Ø","Å","æ","ø","å","?",'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
				$yummy = array("ae","o","a","ae","o","a","",'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');

				$AnchorLinkNoSpecialChar = str_replace($healthy, $yummy, $AnchorLinkNoSpaces);
				
				echo htmlentities("[toc1]".$i." <a href='#".clean($AnchorLinkNoSpecialChar)."'>".$link."</a>[/toc1]")."<br />";
				$i++;
			}
			
		}

	echo "[/toc-wrap]";
?>