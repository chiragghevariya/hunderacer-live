<?php
	include ("connect.php");
	
	if(isset($_POST['navn'])){
		$get_h_id = $_GET['id'];
		
		$timestamp					= time();
		
		$Submit_hunderace 			= $_POST['navn'];
		$Submit_cover	 			= $_POST['billede_cover'];
		$Submit_pagemeta	 		= $_POST['pagemeta'];
		$Submit_pagetitle	 		= $_POST['pagetitle'];
		$Submit_hunderace_fci 		= $_POST['fci_navn'];
		$Submit_fci_nummer 			= $_POST['fci_nummer'];
		$Submit_gruppe 				= $_POST['gruppe'];
		$Submit_oprindelse 			= $_POST['oprindelse_one'];
		$Submit_oprindelse_two		= $_POST['oprindelse_two'];
		$Submit_vaegt 				= $_POST['vaegt'];
		$Submit_farver 				= $_POST['farver'];
		$Submit_andre_navne 		= $_POST['andre_navne'];
		$Submit_dkk_specialklub 	= $_POST['dkk_specialklub'];
		$Submit_avlsrestriktioner 	= $_POST['avlsrestriktioner'];
		$Submit_racestandard 		= $_POST['racestandard'];
		$Submit_hojde 				= $_POST['hojde'];
		$Submit_linktitel 			= $_POST['linktitel'];
		$Submit_levetid 			= $_POST['levetid'];
		$Submit_allergivenlig		= $_POST['allergivenlig'];
		$Submit_artikel				= $_POST['artikel'];
		$Submit_artikel_schema		= $_POST['artikel_schema'];
		$Submit_ulovlig				= $_POST['ulovlig'];
		$Submit_public				= $_POST['public'];
		$Submit_images_added		= $_POST['images_added'];
		
		//TÆL ORD ARTIKEL
		$Submit_artikel_strip = strip_tags($_POST['artikel']);
		$Submit_artikel_strip = trim($Submit_artikel_strip);
		$Submit_artikel_Words = preg_replace('/[0-9,.]+/', '', $Submit_artikel_strip);
		$Submit_artikel_NumberOfWords = count(explode(' ', preg_replace('/\s+/', ' ', trim($Submit_artikel_Words))));
		
		//TÆL ORD INTRO
		$Submit_intro_strip = strip_tags($_POST['intro']);
		$Submit_intro_strip = trim($Submit_intro_strip);
		$Submit_intro_Words = preg_replace('/[0-9,.]+/', '', $Submit_intro_strip);
		$Submit_intro_NumberOfWords = count(explode(' ', preg_replace('/\s+/', ' ', trim($Submit_intro_Words))));
		
		//ORD I ALT
		$WordsInTotal = ($Submit_intro_NumberOfWords+$Submit_artikel_NumberOfWords);
		
		//HUNDENSEGENSKABER
		$Submit_goen 				= $_POST['goen'];
		$Submit_lejligheder 		= $_POST['lejligheder'];
		$Submit_kattevenlig 		= $_POST['kattevenlig'];
		$Submit_bornevenlig 		= $_POST['bornevenlig'];
		$Submit_hundevenlig 		= $_POST['hundevenlig'];
		$Submit_fremmede 			= $_POST['fremmede'];
		$Submit_motionsbehov 		= $_POST['motionsbehov'];
		$Submit_pelspleje 			= $_POST['pelspleje'];
		$Submit_intelligents 		= $_POST['intelligents'];
		$Submit_faeldning 			= $_POST['faeldning'];
		$Submit_traening 			= $_POST['traening'];
		$Submit_legelyst 			= $_POST['legelyst'];
		
		//HUNDENSEGENSKABER KOMMENTARER
		$Submit_goen_text 				= $_POST['goen_text'];
		$Submit_lejligheder_text 		= $_POST['lejligheder_text'];
		$Submit_kattevenlig_text 		= $_POST['kattevenlig_text'];
		$Submit_bornevenlig_text 		= $_POST['bornevenlig_text'];
		$Submit_hundevenlig_text 		= $_POST['hundevenlig_text'];
		$Submit_fremmede_text 			= $_POST['fremmede_text'];
		$Submit_motionsbehov_text 		= $_POST['motionsbehov_text'];
		$Submit_pelspleje_text 			= $_POST['pelspleje_text'];
		$Submit_intelligents_text 		= $_POST['intelligents_text'];
		$Submit_faeldning_text 			= $_POST['faeldning_text'];
		$Submit_traening_text 			= $_POST['traening_text'];
		$Submit_legelyst_text 			= $_POST['legelyst_text'];
		
		//VARS
		$Submit_Egenskab_one 			= "1";
		$Submit_Egenskab_two 			= "2";
		$Submit_Egenskab_three 			= "3";
		$Submit_Egenskab_four 			= "4";
		$Submit_Egenskab_five 			= "5";
		$Submit_Egenskab_six 			= "6";
		$Submit_Egenskab_seven 			= "7";
		$Submit_Egenskab_eight 			= "8";
		$Submit_Egenskab_nine 			= "9";
		$Submit_Egenskab_ten 			= "10";
		$Submit_Egenskab_eleven 		= "11";
		$Submit_Egenskab_twelve 		= "12";
		
		
		//OPRET HUND
		// prepare and bind
		//$stmt = $con->prepare("INSERT INTO hunde (hunderace,hunderace_fci,fci_nummer,gruppe,oprindelse,oprindelse_two,vaegt,farver,andre_navne,dkk_specialklub,avlsrestriktioner,racestandard,hojde,linktitel,levetid,allergivenlig,ulovlig,toc,artikel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		//$stmt->bind_param("sssssssssssssssssss", $Submit_hunderace,$Submit_hunderace_fci,$Submit_fci_nummer,$Submit_gruppe,$Submit_oprindelse,$Submit_oprindelse_two,$Submit_vaegt,$Submit_farver,$Submit_andre_navne,$Submit_dkk_specialklub,$Submit_avlsrestriktioner,$Submit_racestandard,$Submit_hojde,$Submit_linktitel,$Submit_levetid,$Submit_allergivenlig,$Submit_ulovlig,$Submit_toc,$Submit_artikel);
		
		//$stmt->execute();
		
		//$stmt->close();
		
		function wpautop($pee, $br = 1) {
			$pee = $pee . "\n"; // just to make things a little easier, pad the end
			$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
			// Space things out a little
			$allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
			$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
			$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
			$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
			$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
			$pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
			$pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
			$pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
			$pee = preg_replace( '|<p>|', "$1<p>", $pee );
			$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
			$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
			$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
			$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
			$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
			$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
			if ($br) {
				$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			}
			$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
			$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
			$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
			return $pee;
		}
		
		
		$Submit_artikel	= wpautop($Submit_artikel);
		
		$stmtUpdate = $con->prepare("UPDATE hunde SET pagetitle = ?, pagemeta = ?, hunderace = ?,hunderace_fci = ?, fci_nummer = ?,gruppe = ?,oprindelse = ?,oprindelse_two = ?,vaegt = ?,farver = ?,andre_navne = ?,dkk_specialklub = ?,avlsrestriktioner = ?,racestandard = ?,hojde = ?, billede_cover = ?, linktitel = ?,levetid = ?,allergivenlig = ?,ulovlig = ?,artikel = ?, artikel_schema = ?, public = ?, words = ?, images_added = ?, updated_timestamp = ?
		   WHERE h_id = ?");
		   
		$stmtUpdate->bind_param("sssssssssssssssssssssssssss", 
		$Submit_pagetitle,
		$Submit_pagemeta,
		$Submit_hunderace,
		$Submit_hunderace_fci,
		$Submit_fci_nummer,
		$Submit_gruppe,
		$Submit_oprindelse,
		$Submit_oprindelse_two,
		$Submit_vaegt,
		$Submit_farver,
		$Submit_andre_navne,
		$Submit_dkk_specialklub,
		$Submit_avlsrestriktioner,
		$Submit_racestandard,
		$Submit_hojde,
		$Submit_cover,
		$Submit_linktitel,
		$Submit_levetid,
		$Submit_allergivenlig,
		$Submit_ulovlig,
		$Submit_artikel,
		$Submit_artikel_schema,
		$Submit_public,
    	$WordsInTotal,
		$Submit_images_added,
		$timestamp,
		$get_h_id);
		$stmtUpdate->execute(); 
		$stmtUpdate->close();
		
		//HENT HUND
		// $queryHund = "SELECT 
			// h_id
				// FROM
			// hunde
				// WHERE linktitel=?";
		// if ($stmtHund = $con->prepare($queryHund)) {
			
			// $stmtHund->bind_param('s', $Submit_linktitel);

			// /* execute statement */
			// $stmtHund->execute();

			// /* bind result variables */
			// $stmtHund->bind_result($h_id);

			// /* fetch values */
			// $stmtHund->fetch();				

			// /* close statement */
			// $stmtHund->close();
		// }
		
		/*if($Submit_goen != "") {
			$stmt_goen = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_goen->bind_param("ssss", $h_id, $Submit_Egenskab_one, $Submit_goen, $Submit_goen_text);
			
			$stmt_goen->execute();
			
			$stmt_goen->close();
		}
		
		if($Submit_lejligheder != "") {
			$stmt_lejligheder = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_lejligheder->bind_param("ssss", $h_id, $Submit_Egenskab_two, $Submit_lejligheder, $Submit_lejligheder_text);
			
			$stmt_lejligheder->execute();
			
			$stmt_lejligheder->close();
		}
		
		if($Submit_kattevenlig != "") {
			$stmt_kattevenlig = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_kattevenlig->bind_param("ssss", $h_id, $Submit_Egenskab_three, $Submit_kattevenlig, $Submit_kattevenlig_text);
			
			$stmt_kattevenlig->execute();
			
			$stmt_kattevenlig->close();
		}
		
		if($Submit_bornevenlig != "") {
			$stmt_bornevenlig = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_bornevenlig->bind_param("ssss", $h_id, $Submit_Egenskab_four, $Submit_bornevenlig, $Submit_bornevenlig_text);
			
			$stmt_bornevenlig->execute();
			
			$stmt_bornevenlig->close();
		}
		
		if($Submit_hundevenlig != "") {
			$stmt_hundevenlig = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_hundevenlig->bind_param("ssss", $h_id, $Submit_Egenskab_five, $Submit_hundevenlig, $Submit_hundevenlig_text);
			
			$stmt_hundevenlig->execute();
			
			$stmt_hundevenlig->close();
		}
		
		if($Submit_fremmede != "") {
			$stmt_fremmede  = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_fremmede->bind_param("ssss", $h_id, $Submit_Egenskab_six, $Submit_fremmede, $Submit_fremmede_text);
			
			$stmt_fremmede->execute();
			
			$stmt_fremmede->close();
		}
		
		if($Submit_motionsbehov != "") {
			$stmt_motionsbehov = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_motionsbehov->bind_param("ssss", $h_id, $Submit_Egenskab_seven, $Submit_motionsbehov, $Submit_motionsbehov_text);
			
			$stmt_motionsbehov->execute();
			
			$stmt_motionsbehov->close();
		}
		
		if($Submit_pelspleje != "") {
			$stmt_pelspleje = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_pelspleje->bind_param("ssss", $h_id, $Submit_Egenskab_eight, $Submit_pelspleje, $Submit_pelspleje_text);
			
			$stmt_pelspleje->execute();
			
			$stmt_pelspleje->close();
		}
		
		if($Submit_intelligents != "") {
			$stmt_intelligents = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_intelligents->bind_param("ssss", $h_id, $Submit_Egenskab_nine, $Submit_intelligents, $Submit_intelligents_text);
			
			$stmt_intelligents->execute();
			
			$stmt_intelligents->close();
		}
		
		if($Submit_faeldning != "") {
			$stmt_faeldning  = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_faeldning->bind_param("ssss", $h_id, $Submit_Egenskab_ten, $Submit_faeldning, $Submit_faeldning_text);
			
			$stmt_faeldning->execute();
			
			$stmt_faeldning->close();
		}
		
		if($Submit_traening != "") {
			$stmt_traening = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_traening->bind_param("ssss", $h_id, $Submit_Egenskab_eleven, $Submit_traening, $Submit_traening_text);
			
			$stmt_traening->execute();
			
			$stmt_traening->close();
		}
		
		if($Submit_legelyst != "") {
			$stmt_legelyst = $con->prepare("INSERT INTO egenskaber (h_id,egenskab,antal_poter,kommentar) VALUES (?, ?, ?, ?)");
			$stmt_legelyst->bind_param("ssss", $h_id, $Submit_Egenskab_twelve, $Submit_legelyst, $Submit_legelyst_text);
			
			$stmt_legelyst->execute();
			
			$stmt_legelyst->close();
		}*/
		
		//header('Location: index.php?page=king-kong-dog-edit&id='.$get_h_id);
	}
?>