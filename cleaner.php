<?php
	if(isset($_POST['convert'])) {		
		$input_text = $_POST['input_text'];
		
		//fjern evt 1. 2. 3. osv. fra headers
		
		$healthy_re = array("<h3>1. ", "<h3>2. ", "<h3>3. ", "<h3>4. ", "<h3>5. ", "<h3>6. ", "<h3>7. ", "<h3>8. ", "<h3>9. ", "<h3>10. ", "<h3>11. ", "<h3>12. ", "<h3>13. ", "<h3>14. ", "<h3>15. ", "<h3>16. ", "<h3>17. ", "<h3>18. ", "<h3>19. ", "<h3>20. ", "<h3>1.", "<h3>2.", "<h3>3.", "<h3>4.", "<h3>5.", "<h3>6.", "<h3>7.", "<h3>8.", "<h3>9.", "<h3>10.", "<h3>11.", "<h3>12.", "<h3>13.", "<h3>14.", "<h3>15.", "<h3>16.", "<h3>17.", "<h3>18.", "<h3>19.", "<h3>20.");
		$yummy_re = array("<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>");


		$input_text = str_replace($healthy_re, $yummy_re, $input_text);
		
		
		$healthy_re_words = array(
								"otterhound",
								"familiedyr",
								"kraftige gåture",
								"en ørerengøringsmiddel",
								"plejeartikler",
								"hundeborgere",
								"nysugede",
								"et bundt energi",
								"trænbarhed",
								"passende udlæb",
								"passende udløb",
								"hundespecifikke shampooer",
								"den hurtige del",
								"tandbidder",
								"pelsven",
								"hundespecifik shampoo",
								"person til person",
								"stærke flokinstinkter",
								"jagtlyst",
								"dyrlæge-godkendt ørerenser",
								"ved basis",
								"en vedligeholdelsesfattig pels",
								"en hundespecifik ørerenser",
								"hundevenlig tandpasta",
								"hjælpehunde",
								"lugteevne",
								"dyrlægehjælp",
								"verbal ros",
								"gøtendenser",
								"Hvor meget koster en",
								"Hvornår bliver en",
								"kærligt kendt",
								"denne modige hvalp",
								"byttedrev",
								"jordhundekonkurrencer",
								"groomer",
								"hundevenlige shampooer",
								"trænbar",
								"flokbaggrund",
								"ondskabsfuld",
								"hårfjerningsspray",
								"ind i det hurtige",
								"Oralhygiejne",
								"adoptionsmuligheder",
								"fitnessniveau",
								"årvågenhed"
								);
		$yummy_re_words = array(
								"Odderhund",
								"familiehunde",
								"raske gåture",
								"ørerens beregnet til hunde",
								"plejeredskaber",
								"hunde",
								"rene",
								"en energibombe",
								"træning",
								"passende afløb",
								"passende afløb",
								"shampooer der er lavet til hunde",
								"neglens blodkar/nerve",
								"tyggeben",
								"kæledyr",
								"shampoo der er lavet specielt til hunde",
								"hund til hund",
								"et stærkt flokinstinkt",
								"jagtinstinkt",
								"ørerens beregnet til hunde",
								"ved basen",
								"en pels, der er nem at vedligeholde",
								"ørerens beregnet til hunde",
								"hundetandpasta",
								"servicehunde",
								"lugtesans",
								"besøg hos en dyrlæge",
								"ros",
								"tendens til at gø",
								"Hvad koster en",
								"Hvornår er en",
								"også kendt",
								"denne hunderace",
								"jagtinstinkt",
								"Earthdog",
								"hundesalon",
								"shampooer der er lavet specielt til hunde",
								"lærenem",
								"baggrund som hyrdehund",
								"drilagtig",
								"udredningsspray",
								"ind i neglens blodkar/nerve",
								"Mundhygiejne",
								"dyreinternater",
								"fysik",
								"opmærksomhed"
								);

		$input_text = str_replace($healthy_re_words, $yummy_re_words, $input_text);
		
		//h2 replace
		//$input_text = preg_replace("#<h2([^>]*)>(.*)</h2>#m","<h2 id='clean($2)'>$2</h2>", $input_text);
	
	
function clean($input_text) {
   $string = str_replace(' ', '-', $input_text); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}	

	}
?>


<form method="post" action="" style="width: 100%; float: left;">
	<div style="width: 100%; float: left;">
		<input style="border: 1px solid #e2e2e2; padding: 5px 10px; border-radius: 5px;" type="submit" name="convert" value="Clean" />
	</div>
	<div style="width: 50%; float: left;">
		<textarea style="width: 100%; float: left; height: 600px;" name="input_text"></textarea>
	</div>
	<div style="width: 50%; float: left;">
		<?php
			if(isset($_POST['convert'])) {
				// $search = "#<h2([^>]*)>(.*)</h2>#m";
				// $replace = "<h2 id='<tag>$2</tag>'>$2</h2>";
				// $string = $input_text;
				// $addtag = preg_replace_callback($search,"clean",$string);
				
				// echo $addtag;
				
				
				function callback($input_text) {
					
					$match = $input_text;
					
					$match_txt = $match[2];

					$healthy = array("Æ","Ø","Å","æ","ø","å","?",'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
					$yummy = array("ae","o","a","ae","o","a","",'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');

					$match = str_replace($healthy, $yummy, $match[2]);
					
					$match = strtolower($match);
					$match = str_replace(" ", "-", $match);
					
					$match = str_replace(' ', '-', $match); // Replaces all spaces with hyphens.
					$match = preg_replace('/[^A-Za-z0-9\-]/', '', $match); // Removes special chars.

					$match = preg_replace('/-+/', '-', $match); // Replaces multiple hyphens with single one.

					return "<h2 id='".$match."'>".$match_txt."</h2>";
				}

				$subjecth2 = $input_text;
				$patternh2 = "#<h2([^>]*)>(.*)</h2>#m";
				$resultsh2 = preg_replace_callback($patternh2, "callback", $subjecth2);
				
				function callbackTwo($resultsh2) {
					
					$match = $resultsh2;
					
					$match_txt = $match[2];

					$healthy = array("Æ","Ø","Å","æ","ø","å","?",'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
					$yummy = array("ae","o","a","ae","o","a","",'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');

					$match = str_replace($healthy, $yummy, $match[2]);
					
					$match = strtolower($match);
					$match = str_replace(" ", "-", $match);
					
					$match = str_replace(' ', '-', $match); // Replaces all spaces with hyphens.
					$match = preg_replace('/[^A-Za-z0-9\-]/', '', $match); // Removes special chars.

					$match = preg_replace('/-+/', '-', $match); // Replaces multiple hyphens with single one.

					return "<h3 id='".$match."'>".$match_txt."</h3>";
				}
				
				$subjecth3 = $resultsh2;
				$patternh3 = "#<h3([^>]*)>(.*)</h3>#m";
				$resultsh3 = preg_replace_callback($patternh3, "callbackTwo", $subjecth3);
			}
		?>
		<textarea style="width: 100%; float: left; height: 600px;" name="output_text"><?php echo $resultsh3; ?></textarea>
	</div>
</form>