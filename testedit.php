<?php
	include ("connect.php");
	
	if(isset($_POST['add_tag'])) {
		include ("connect.php");
		
		$hunde_id = $_GET['id'];
		$tag_name = $_POST['tag_name'];
		
		$stmt = $con->prepare("INSERT INTO hunde_tags (h_id, t_id) VALUES (?, ?)");
		$stmt->bind_param("ss", $hunde_id, $tag_name);
		$stmt->execute();  
		//$lastId = $con->insert_id;
		$stmt->close();
	}
	
	$get_h_id = $_GET['id'];
	
	//HENT HUND
	$query = "SELECT 
		h_id,
		pagetitle,
		pagemeta,
		hunderace,
		hunderace_fci,
		intro,
		fci_nummer,
		gruppe,
		oprindelse,
		oprindelse_two,
		vaegt,
		farver,
		andre_navne,
		dkk_specialklub,
		avlsrestriktioner,
		racestandard,
		hojde,
		billede_headshot,
		billede_cover,
		linktitel,
		levetid,
		allergivenlig,
		ulovlig,
		toc,
		artikel,
		artikel_schema,
		public,
		images_added,
		ai_text
			FROM
		hunde
			WHERE h_id=?";
	if ($stmt = $con->prepare($query)) {
		
		$stmt->bind_param('s', $get_h_id);

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($h_id,
		$pagetitle,
		$pagemeta,
		$hunderace,
		$hunderace_fci,
		$intro,
		$fci_nummer,
		$gruppe,
		$oprindelse,
		$oprindelse_two,
		$vaegt,
		$farver,
		$andre_navne,
		$dkk_specialklub,
		$avlsrestriktioner,
		$racestandard,
		$hojde,
		$billede_headshot,
		$billede_cover,
		$linktitel,
		$levetid,
		$allergivenlig,
		$ulovlig,
		$toc,
		$artikel,
		$artikel_schema,
		$public,
		$images_added,
		$ai_text);

		/* fetch values */
		$stmt->fetch();				

		/* close statement */
		$stmt->close();
	}
	
	//"rengør artikel"
	$healthy = array("<p>", "</p>", "</h2>", "</h3>", "</h4>", "</h5>", "<br />", "<br/>", "<br>");
	$yummy   = array("", "\n", "</h2>\n", "</h3>\n", "</h4>\n", "</h5>\n","" ,"" ,"");

	$artikel = str_replace($healthy, $yummy, $artikel);

	$article_clean = trim($artikel);
?>
<div class="layout-wrapper">
	<div class="layout-content">
		<!--MAIN CONTENT-->
		<div class="admin-main-content">
			<form method="post" id="dog-form" action="king-kong-dog-checkedit.php?id=<?php echo $get_h_id; ?>">
				<!--NAVN-->
				<textarea class="article-title" type="text" name="navn" rows="1" placeholder="Navn på hunderace"><?php echo $hunderace; ?></textarea>

				<!--DIVERSE FAKTUELLE OPLYSNINGER-->
				<div class="article-dog-facts">
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>FCI navn</p>
							<textarea rows="1" class="admin-dog-fci-navn" name="fci_navn" placeholder="FCI navn"><?php echo $hunderace_fci; ?></textarea>
						</div>
						<div class="article-dog-facts-block-two">
							<p>FCI nummer</p>
							<input type="text" name="fci_nummer" placeholder="FCI nummer" value="<?php echo $fci_nummer; ?>" />
						</div>
						<div class="article-dog-facts-block-three">
							<p>FCI gruppe</p>
							<select name="gruppe">
								<?php
									$queryGG = "SELECT 
										fci_id, navn
										FROM fci_grupper";
									if ($stmtGG = $con->prepare($queryGG)) {

										/* execute statement */
										$stmtGG->execute();

										/* bind result variables */
										$stmtGG->bind_result($fci_id, $fci_navn);
										
										/* fetch values */
										while ($stmtGG->fetch()) {
											if($fci_id == $gruppe) {
												$selectgroup = "selected";
											}
											else {
												$selectgroup = "";
											}
											echo '<option value="'.$fci_id.'" '.$selectgroup.'>Gruppe '.$fci_id.' - '.$fci_navn.'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>Oprindelsesland</p>
							<select name="oprindelse_one">
								<option value="">Land 1</option>
								<?php
									$queryGC = "SELECT 
										l_id, navn
										FROM lande";
									if ($stmtGC = $con->prepare($queryGC)) {

										/* execute statement */
										$stmtGC->execute();

										/* bind result variables */
										$stmtGC->bind_result($l_id_et, $land_et);
										
										/* fetch values */
										while ($stmtGC->fetch()) {
											if($l_id_et == $oprindelse) {
												$selectoprindelse = "selected";
											}
											else {
												$selectoprindelse = "";
											}
											echo '<option value="'.$l_id_et.'" '.$selectoprindelse.'>'.$land_et.'</option>';
										}
									}
								?>
							</select>
							<select name="oprindelse_two">
								<option value="">Land 2</option>
								<?php
									$queryGCC = "SELECT 
										l_id, navn
										FROM lande";
									if ($stmtGCC = $con->prepare($queryGCC)) {

										/* execute statement */
										$stmtGCC->execute();

										/* bind result variables */
										$stmtGCC->bind_result($l_id_to, $land_to);
										
										/* fetch values */
										while ($stmtGCC->fetch()) {
											if($l_id_to == $oprindelse_two) {
												$selectoprindelse_two = "selected";
											}
											else {
												$selectoprindelse_two = "";
											}
											echo '<option value="'.$l_id_to.'" '.$selectoprindelse_two.'>'.$land_to.'</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="article-dog-facts-block-two">
							<p>Farver</p>
							<textarea name="farver" class="admin-dog-farver" placeholder="Farver" rows="1"><?php echo $farver; ?></textarea>
						</div>
						<div class="article-dog-facts-block-three">
							<p>Andre navne</p>
							<textarea rows="1" name="andre_navne" class="admin-dog-andre-navne" placeholder="Andre navne"><?php echo $andre_navne; ?></textarea>
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>Vægt</p>
							<textarea rows="1" name="vaegt" class="admin-dog-vaegt" placeholder="Vægt"><?php echo $vaegt; ?></textarea>
						</div>
						<div class="article-dog-facts-block-two">
							<p>Højde</p>
							<textarea rows="1" name="hojde" class="admin-dog-hojde" placeholder="Højde"><?php echo $hojde; ?></textarea>
						</div>
						<div class="article-dog-facts-block-three">
							<p>Levetid</p>
							<input type="text" name="levetid" placeholder="Levetid" value="<?php echo $levetid; ?>" />
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>Linktitel</p>
							<input type="text" name="linktitel" placeholder="Linktitel" value="<?php echo $linktitel; ?>" />
						</div>
						<div class="article-dog-facts-block-two">
							<p>Allergivenlig</p>
							<select name="allergivenlig">
								<option value="Nej" <?php if($allergivenlig == "nej") { echo "selected"; } ?>>Nej</option>
								<option value="Ja" <?php if($allergivenlig == "ja") { echo "selected"; } ?>>Ja</option>
							</select>
						</div>
						<div class="article-dog-facts-block-three">
							<p>Ulovlig i Danmark</p>
							<select name="ulovlig">
								<option value="0" <?php if($ulovlig == "0") { echo "selected"; } ?>>Nej</option>
								<option value="1" <?php if($ulovlig == "1") { echo "selected"; } ?>>Ja</option>
							</select>
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>DKK specialklub</p>
							<select name="dkk_specialklub">
								<option value="">Vælg</option>
								<?php
									$queryGSK = "SELECT
										sk_id,
										navn
										FROM specialklubber";
									if ($stmtGSK = $con->prepare($queryGSK)) {

										/* execute statement */
										$stmtGSK->execute();

										/* bind result variables */
										$stmtGSK->bind_result($sk_id, $specialklub);
										
										/* fetch values */
										while ($stmtGSK->fetch()) {
											if($sk_id == $dkk_specialklub) {
												$selectdkk = "selected";
											}
											else {
												$selectdkk = "";
											}
											echo '<option value="'.$sk_id.'" '.$selectdkk.'>'.$specialklub.'</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="article-dog-facts-block-two">
							<p>Avlsrestriktioner</p>
							<textarea rows="1" name="avlsrestriktioner" class="admin-dog-avlsrestriktioner" placeholder="link til Avlsrestriktioner"><?php echo $avlsrestriktioner; ?></textarea>
						</div>
						<div class="article-dog-facts-block-three">
							<p>Racestandard</p>
							<textarea rows="1" name="racestandard" class="admin-dog-racestandard" placeholder="link til Racestandard"><?php echo $racestandard; ?></textarea>
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-one">
							<p>Coverbillede</p>
							<textarea class="admin-dog-cover" rows="1" name="billede_cover" placeholder="Coverbillede"><?php echo $billede_cover; ?></textarea>
						</div>
						<div class="article-dog-facts-block-two">
							<p>Er artiklen online?</p>
							<select name="public">
								<option value="0" <?php if($public != "1") {echo "selected"; } ?>>Nej</option>
								<option value="1" <?php if($public == "1") {echo "selected"; } ?>>Ja</option>
							</select>
						</div>
						<div class="article-dog-facts-block-three">
							<p>Billeder tilføjet?</p>
							<select name="images_added">
								<option value="0" <?php if($images_added != "1") {echo "selected"; } ?>>Nej</option>
								<option value="1" <?php if($images_added == "1") {echo "selected"; } ?>>Ja</option>
							</select>
						</div>
					</div>
					<div class="width-100 float-left margin-bottom-30">
						<div class="article-dog-facts-block-four">
							<p>SEO: Page Title</p>
							<span class="article-dog-facts-span">** Titlen som bliver vist på Google og i Googles søgeresultater</span>
							<span class="article-dog-facts-span">- Vigtige keywords nær starten</span>
							<span class="article-dog-facts-span">- 50-60 karakterer</span>
							<span class="article-dog-facts-span">- Skriv en tiltrækkende titel da det øger CTR</span>
							<textarea name="pagetitle" class="admin-dog-page-title" id="pagetitle" rows="4" maxlength="60"><?php echo $pagetitle; ?></textarea><br />
							<span class="article-dog-facts-span" id="count-pagetitle"></span>
						</div>
						<div class="article-dog-facts-block-five">
							<p>SEO: Meta beskrivelse</p>
							<span class="article-dog-facts-span">** Beskrivelse som bliver vist på Google og som fungerer som "teaser" på hjemmesiden</span>
							<span class="article-dog-facts-span">- Vigtige keywords nær starten</span>
							<span class="article-dog-facts-span">- omkring 150-160 karakterer</span>
							<span class="article-dog-facts-span">- Skriv en tiltrækkende beskrivelse da det øger CTR</span>
							<textarea name="pagemeta" class="admin-dog-page-meta" id="pagemeta" rows="4" maxlength="160"><?php echo $pagemeta; ?></textarea>
							<span class="article-dog-facts-span" id="count-pagemeta"></span>
						</div>
					</div>
				</div>
				
				<!--Her vil AUTOgenereret TOC blive vist ved klik-->
				<div class="auto-toc-wrap"></div>
				
				<!--ARTIKEL-->
				<div class="article-wrapper">
					<div class="article-toolbar">
						<a href="javascript:void(0);" onclick="javascript:bbcoder('B')">B</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('INTRO')">Intro</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('A')">Link</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('IMG')">Img</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('H2')">H2</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('H3')">H3</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('H4')">H4</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('UL')">ul</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('OL')">ol</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('LI')">li</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('TOC')">TOC</a>
						<a href="" id="auto-toc">Auto TOC</a>
						<a href="javascript:void(0);" onclick="javascript:bbcoder('FAQ')">FAQ</a>
					</div>
					<textarea id="artikel" name="artikel" class="article-textarea width-100"><?php echo $article_clean; ?></textarea>
				</div>
				
				<!--Artikel schema-->
				<div class="width-100 float-left">
					<p>Schema (<a href="https://technicalseo.com/tools/schema-markup-generator/" target="_blank">Schema Markup Generator</a>)</p>
					<textarea id="artikel_schema" name="artikel_schema" class="article-textarea width-100" placeholder="Koden til schema.."><?php echo $artikel_schema; ?></textarea>
				</div>
				
				<?php

	$html = $article_clean;
	
	$array = [];

	$dom = new DomDocument();
	// Load the HTML, don't worry about it being a fragment
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

	$xpath = new DOMXPath($dom);

	// Grab all H3 tags. This might need to be adjusted if there's more to the depth
	$results = $xpath->query("//h3");
	foreach ($results as $result) {
		//var_dump(sprintf('<h3>%1$s</h3>', $result->textContent));
		//echo '<p><strong>SPØRGSMÅL</strong>: '.$result->textContent.'</p>';
		
		// See if the next element is a P tag
		$next = $result->nextElementSibling;
		if ($next && 'p' === $next->nodeName) {
			//var_dump(sprintf('<p>%1$s</p>', $next->textContent));
			//echo "<p><strong>SVAR</strong>: ".$next->textContent."</p>";
		}
		
    $array[] = array(
                '@type' => 'Question', 
                'name' => trim($result->textContent),
                'acceptedAnswer' => array(

                                            '@type' => 'Answer',
                                            'text' => trim($next->textContent)

                            )
            );
	}
	$faq_schema = '<script type="application/ld+json">{"@context": "https://schema.org",';
	$faq_schema .= '"@type": "FAQPage","mainEntity": ';
	//Vi kan tilføje |JSON_PRETTY_PRINT| til nedenstående hvis vi ønsker, at json står flot
	$faq_schema .= json_encode($array,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
	$faq_schema .="}";
	$faq_schema .="</script>";
	
	echo $faq_schema;
?>


				<div class="width-100 float-left margin-top-30">
					<input class="green-btn" type="submit" name="submit" id="opdater-artikel" value="Opdatér" />
				</div>
			</form>
		</div>
		<div class="admin-sidebar">
			<!--COVERBILLEDE + DIVERSE INFO-->
			<div class="article-cover-info-wrap">
				<?php
					if ($billede_cover != "") {
				?>
					<img class="article-cover" src="gallery_338/<?php echo $billede_cover; ?>" />
				<?php
					}
				?>
			</div>
			
			<!--TAGS-->
			<div class="width-100 float-left admin-article-tags-wrap">
				<p class="admin-article-tags-header">Tags</p>
				<div class="width-100 float-left">
					<?php
						$queryNT = "SELECT
							ht.h_id,
							ht.t_id AS HT_t_id,
							t.t_id AS T_t_id,
							t.tag_name
							FROM hunde_tags AS ht
								INNER JOIN tags AS t ON t.t_id = ht.t_id
							WHERE ht.h_id = ?";
						if ($stmtNT = $con->prepare($queryNT)) {
							
							$stmtNT->bind_param('s', $get_h_id);

							/* execute statement */
							$stmtNT->execute();

							/* bind result variables */
							$stmtNT->bind_result($HT_h_id, $HT_t_id, $T_t_id, $T_tag_name);
							
							/* fetch values */
							while ($stmtNT->fetch()) {
								echo "<p class='admin-tag-wrap'>".$T_tag_name."</p>";
							}
						}
					?>
				</div>
				<form method="post" class="margin-top-30 display-block float-left">
					<select name="tag_name">
						<option value="">Vælg tag</option>
						<?php
							$queryGT = "SELECT
								t_id,
								tag_name
								FROM tags";
							if ($stmtGT = $con->prepare($queryGT)) {

								/* execute statement */
								$stmtGT->execute();

								/* bind result variables */
								$stmtGT->bind_result($t_id, $tag_name);
								
								/* fetch values */
								while ($stmtGT->fetch()) {
									echo '<option value="'.$t_id.'">'.$tag_name.'</option>';
								}
							}
						?>
					</select>
					<input type="submit" name="add_tag" value="Tilføj tag" class="margin-top-10 display-block float-left green-btn" />
				</form>
			</div>
			
			<!--KOPIER AI ARTIKEL-->
			<?php
				//fjern evt 1. 2. 3. osv. fra headers
				
				$healthy_re = array("<h3>1. ", "<h3>2. ", "<h3>3. ", "<h3>4. ", "<h3>5. ", "<h3>6. ", "<h3>7. ", "<h3>8. ", "<h3>9. ", "<h3>10. ", "<h3>11. ", "<h3>12. ", "<h3>13. ", "<h3>14. ", "<h3>15. ", "<h3>16. ", "<h3>17. ", "<h3>18. ", "<h3>19. ", "<h3>20. ", "<h3>1.", "<h3>2.", "<h3>3.", "<h3>4.", "<h3>5.", "<h3>6.", "<h3>7.", "<h3>8.", "<h3>9.", "<h3>10.", "<h3>11.", "<h3>12.", "<h3>13.", "<h3>14.", "<h3>15.", "<h3>16.", "<h3>17.", "<h3>18.", "<h3>19.", "<h3>20.","<p>","</p>","<br />","<br/>","<br>","</h2>.","<li", "</li", "</ul", "</h2", "</h3", "</h4");
				$yummy_re = array("<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>", "<h3>","","","","","","</h2>","<li>", "</li>", "</ul>", "</h2>", "</h3>", "</h4>");


				$ai_text = str_replace($healthy_re, $yummy_re, $ai_text);
				
				
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
										"årvågenhed",
										"læreneme",
										"specielt formuleret ørerens",
										"gøadfærd",
										"legetøjshund",
										"specielt formuleret",
										"et must",
										"dollars",
										"pose sukker",
										"gøvaner",
										"et rengøringsmiddel",
										"Tandtygge",
										"tandtygge",
										"fjerene",
										"tæt på den hurtige",
										"en dyrlægegodkendt ørerengøringsopløsning",
										"tyggegummi",
										"Løbeperioden",
										"specialiseret ørerenser",
										"legetøjsrace",
										"dufthund",
										"dufthunde",
										"hundespecifik tandbørste",
										"Allmindelige",
										"Allmindelig",
										"allmindelige",
										"allmindelig",
										"professionelle hundesalone",
										"din hvalp",
										"byttedrift",
										"ørerensningsopløsning",
										"hundevenlig tandbørste",
										"stærkt aktivitetsdrive",
										"Tandgodbidder",
										"tandgodbidder",
										"sofakammerat",
										"et mildt rengøringsmiddel",
										"tyggebenr",
										"elskelige hund",
										"disse små hvalpe",
										"hundespecifik ørerens",
										"Tandbidder",
										"Selvom disse hvalpe",
										"Oral hygiejne",
										"dyrepasser",
										"elskelig",
										"slicker",
										"hundespecifik tandpasta",
										"negleklipper til kæledyr",
										"professionel trimmer",
										"elskelige race",
										"adrætte hvalpe",
										">>",
										"</li>."
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
										"opmærksomhed",
										"lærenemme",
										"ørerens beregnet til hunde",
										"gøen",
										"miniature hunderace",
										"specielt lavet",
										"en nødvendighed",
										"danske kroner",
										"stor pose mel",
										"gøen",
										"ørerens",
										"Tyggeben",
										"tyggeben",
										"pelsen",
										"tæt på neglens blodkar/nerve",
										"en ørerens beregnet til hunde - gerne dyrlægegodkendt",
										"tyggeben",
										"Løbetiden",
										"ørerens beregnet til hunde",
										"hunderace",
										"sporhund",
										"sporhunde",
										"tandbørste lavet til hunde",
										"Almindelige",
										"Almindelig",
										"almindelige",
										"almindelig",
										"professionel hundesalon",
										"din hund",
										"jagtinstinkt",
										"ørerens",
										"hundetandbørste",
										"højt aktivitetsniveau",
										"tyggeben",
										"Tyggeben",
										"sofakartoffel",
										"en mild ørerens til hunde",
										"tyggeben",
										"elskværdige og dejlige hund",
										"disse små hunde",
										"ørerens til hunde",
										"Tyggeben",
										"Selvom disse hunde",
										"Mundhygiejne",
										"hundepasser",
										"elskværdig",
										"hundebørste",
										"hundetandpasta",
										"negleklipper til hunde",
										"hundefrisør",
										"elskværdige hunderace",
										"adrætte hunde",
										">",
										"</li>"
										);

				$ai_text = str_replace($healthy_re_words, $yummy_re_words, $ai_text);
				
				//h2 replace
				//$ai_text = preg_replace("#<h2([^>]*)>(.*)</h2>#m","<h2 id='clean($2)'>$2</h2>", $input_text);
			
	
				function clean($ai_text) {
				   $string = str_replace(' ', '-', $ai_text); // Replaces all spaces with hyphens.
				   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

				   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
				}
				
				function callback($ai_text) {
					
					$match = $ai_text;
					
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

				$subjecth2 = $ai_text;
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
				
				$resultsh3 = preg_replace("/\*\*(.+)\*\*/sU","<strong>$1</strong>", $resultsh3);
				$resultsh3 = str_replace("- <strong>","<strong>", $resultsh3);
			?>
			
			<!--<div class="width-100 float-left admin-article-tags-wrap">
				<textarea class="width-100 float-left" id="ai-text-id"><?php echo $resultsh3; ?></textarea>
				<button class='copy'>Kopier</button>
			</div>-->
			
		<script>
		//kopier
		$(".copy").click(function(){
			var the_id = $(this).data("theid");
		  // Get the text field
		  var copyText = document.getElementById("ai-text-id");

		  // Select the text field
		  copyText.select();
		  copyText.setSelectionRange(0, 99999); // For mobile devices

		   // Copy the text inside the text field
		  navigator.clipboard.writeText(copyText.value);

		  // Alert the copied text
		  //alert("Copied the text: " + copyText.value);
		});
		</script>
			
			<!--SØGNING EFTER BILLEDE-->
			<div class="admin-search-image-wrap">
				<input id="admin-searchBox" class="admin-search-image-field" type="text" placeholder="Søg efter et billede" />
				<div class="admin-search-image-results" id="result"></div>
			</div>
			
			<!--SØGNING EFTER LINK-->
			<div class="admin-search-link-wrap">
				<input id="admin-searchlinkBox" class="admin-search-link-field" type="text" placeholder="Søg efter et link" />
				<div class="admin-search-link-results" id="result_links"></div>
			</div>
		</div>
	</div>
</div>

<div class="admin-save-succes-box">Ændringer gemt</div>

<script src='js/autosize.min.js'></script>
<script>
	$(document).ready(function() {
		autosize($('.article-title'));
		autosize($('.admin-dog-farver'));
		autosize($('.admin-dog-cover'));
		autosize($('.admin-dog-andre-navne'));
		autosize($('.admin-dog-fci-navn'));
		autosize($('.admin-dog-vaegt'));
		autosize($('.admin-dog-hojde'));
		autosize($('.admin-dog-avlsrestriktioner'));
		autosize($('.admin-dog-racestandard'));
		autosize($('.admin-dog-page-title'));
		autosize($('.admin-dog-page-meta'));
		
		
		//Klik på ctrl+s for at gemme ændringerne indtil videre
		$(window).bind('keydown', function(event) {
			if (event.ctrlKey || event.metaKey) {
				switch (String.fromCharCode(event.which).toLowerCase()) {
				case 's':
					event.preventDefault();
					var myform = document.getElementById("dog-form");
					var fd = new FormData(myform );
					$.ajax({
						url: "king-kong-dog-checkedit.php?id="+<?php echo $get_h_id; ?>,
						data: fd,
						cache: false,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function (dataofconfirm) {
						$(".admin-save-succes-box").show();
						setTimeout(function() { $(".admin-save-succes-box").hide(); }, 2000);
						}
					});
				}
			}
		});
		
		//Klik på knappen "opdatér" for at gemme ændringerne indtil videre
		$(document).on('click','#opdater-artikel',function(event){
			event.preventDefault();
			var myform = document.getElementById("dog-form");
			var fd = new FormData(myform );
			$.ajax({
				url: "king-kong-dog-checkedit.php?id="+<?php echo $get_h_id; ?>,
				data: fd,
				cache: false,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (dataofconfirm) {
				$(".admin-save-succes-box").show();
				setTimeout(function() { $(".admin-save-succes-box").hide(); }, 2000);
				}
			});
		});
		
		//Lav automatisk table of contents
		$(document).on('click','#auto-toc',function(event){
			event.preventDefault();
			var myform = document.getElementById("dog-form");
			var fd = new FormData(myform );
			$.ajax({
				url: "king-kong-dog-make-toc.php",
				data: fd,
				cache: false,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (dataofconfirm) {
					$(".auto-toc-wrap").show();
					$('.auto-toc-wrap').html(dataofconfirm);
				}
			});
		});
		
		//Karaktertæller for title
		var current_characters_pagetitle = $('#pagetitle').val().length;
		var characters_left_pagetitle = (60-current_characters_pagetitle);
		
		$("#count-pagetitle").text("Anslag tilbage: "+characters_left_pagetitle);
		$("#pagetitle").keyup(function(){
		  $("#count-pagetitle").text("Anslag tilbage: " + (60 - $(this).val().length));
		});
		
		//Karaktertæller for meta beskrivelse
		var current_characters_pagemeta = $('#pagemeta').val().length;
		var characters_left_pagemeta = (160-current_characters_pagemeta);
		
		$("#count-pagemeta").text("Anslag tilbage: "+characters_left_pagemeta);
		$("#pagemeta").keyup(function(){
		  $("#count-pagemeta").text("Anslag tilbage: " + (160 - $(this).val().length));
		});
		
		//jQuery function to get the keys entered by keyboard
		$('#admin-searchBox').keyup(function(){   
			var query = $('#admin-searchBox').val();
			//check whether the entered word phrase contains at least one character
			if(query.length>1){             
				// start Ajax call to get the suggestions
				$.ajax({
					//Path for PHP file to fetch suggestion from DB
					url: "king-kong-dog-gallery-fetch.php", 
					//Fetching method       
					method: "POST",
					//Data send to the server to get the results
					data: {
					   search : 1,             
					   q: query 
					},
					//If data fetched successfully from the server, execute this function
					success:function(data){   
						//Print the fetched suggestion results in the section wih ID - #result      
						$('#result').html(data); 
						$('#result').show(); 
					},
					//Type of data sent to the server
					dataType: "text"                
				});
				// end Ajax call to get the suggestions
			}
			else {   
				$('#result').html("");
				$('#result').hide(); 	
			}
		});
		//If clicked on searchbox
		$("#admin-searchBox").click(function(event) {
			event.preventDefault();
			var queryVal = $('#admin-searchBox').val();
			if(queryVal.length>1){
				$("#result").show();
			}
		});
		
		//Søg efter et link
		$('#admin-searchlinkBox').keyup(function(){   
			var query = $('#admin-searchlinkBox').val();
			//check whether the entered word phrase contains at least one character
			if(query.length>1){             
				// start Ajax call to get the suggestions
				$.ajax({
					//Path for PHP file to fetch suggestion from DB
					url: "king-kong-dog-link-fetch.php", 
					//Fetching method       
					method: "POST",
					//Data send to the server to get the results
					data: {
					   search : 1,             
					   q: query 
					},
					//If data fetched successfully from the server, execute this function
					success:function(data){   
						//Print the fetched suggestion results in the section wih ID - #result      
						$('#result_links').html(data); 
						$('#result_links').show(); 
					},
					//Type of data sent to the server
					dataType: "text"                
				});
				// end Ajax call to get the suggestions
			}
			else {   
				$('#result_links').html("");
				$('#result_links').hide(); 	
			}
		});
		//If clicked on searchbox
		$("#admin-searchlinkBox").click(function(event) {
			event.preventDefault();
			var queryVal = $('#admin-searchlinkBox').val();
			if(queryVal.length>1){
				$("#result_links").show();
			}
		});
		
		$('.admin-search-image-select').click(function(){
			$(this).select(); 
		});
	});
</script>

<script>
function bbcoder(code) {
  try {
    var old = "";
    var textarea = document.getElementsByName("artikel")[0];
    var value = textarea.value;
    var startPos = textarea.selectionStart;
    var endPos = textarea.selectionEnd;
    var selectedText = value.substring(startPos, endPos);

    switch (code) {
      case 'B':
        bbbold(textarea, value, startPos, endPos, selectedText);
        break;
      case 'A':
        bblink(textarea, value, startPos, endPos, selectedText);
        break;
      case 'IMG':
        bbimg(textarea, value, startPos, endPos, selectedText);
        break;
      case 'H2':
        bbh2(textarea, value, startPos, endPos, selectedText);
        break;
      case 'H3':
        bbh3(textarea, value, startPos, endPos, selectedText);
        break;
      case 'H4':
        bbh4(textarea, value, startPos, endPos, selectedText);
        break;
      case 'OL':
        bbol(textarea, value, startPos, endPos, selectedText);
        break;
      case 'UL':
        bbul(textarea, value, startPos, endPos, selectedText);
        break;
      case 'LI':
        bbli(textarea, value, startPos, endPos, selectedText);
        break;
      case 'INTRO':
        bbintro(textarea, value, startPos, endPos, selectedText);
        break;
      case 'TOC':
        bbtoc(textarea, value, startPos, endPos, selectedText);
        break;
      case 'FAQ':
        bbfaq(textarea, value, startPos, endPos, selectedText);
        break;
      default:
        alert('Invalid argument');
        break;
    }
  } catch (e) {
    alert(e.toString());
  }

}
//FED SKRIFT <strong>
function bbbold(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<strong>" + selectedText + "</strong>");
  textarea.focus({preventScroll: true});
  //+17 fordi der er 17 karakterer i alt i <strong></strong> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 17;
}
//LINK <a href="">
function bblink(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<a href=''>" + selectedText + "</a>");
  textarea.focus({preventScroll: true});
  //+9 fordi der er 9 karakterer til følgende: <a href='
  textarea.selectionEnd = startPos + 9;
}
//BILLEDE <img src> / [img alt=][/img]
function bbimg(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "[img alt=]" + selectedText + "[/img]");
  textarea.focus({preventScroll: true});
  //+16 fordi der er 16 karakterer til følgende: [img alt=][/img] og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 16;
}
//HEADER 2 <h2>
function bbh2(textarea, value, startPos, endPos, selectedText) {
  //Vi gør alle bogstaver til lowercase og tilføjer bindestreg i stedet for mellemrum og selvfølgelig et hashtag
  var HeaderToLowercaseWithHyphens = selectedText.replace(/\s+/g, '-').toLowerCase();
  textarea.value = value.replaceBetween(startPos, endPos, "<h2 id='" + HeaderToLowercaseWithHyphens + "'>" + selectedText + "</h2>");
  textarea.focus({preventScroll: true});
  //+15 fordi der er 15 karakterer i alt i <h2></h2> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + HeaderToLowercaseWithHyphens.length + selectedText.length + 15;
}
//HEADER 3 <h3>
function bbh3(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<h3>" + selectedText + "</h3>");
  textarea.focus({preventScroll: true});
  //+9 fordi der er 9 karakterer i alt i <h3></h3> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 9;
}
//HEADER 4 <h4>
function bbh4(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<h4>" + selectedText + "</h4>");
  textarea.focus({preventScroll: true});
  //+9 fordi der er 9 karakterer i alt i <h4></h4> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 9;
}
//ORDNET LISTE <ol>
function bbol(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<ol>\n" + selectedText + "\n</ol>");
  textarea.focus({preventScroll: true});
  //+5 fordi vi gerne vil ramme midten af listen
  textarea.selectionEnd = startPos + selectedText.length + 5;
}
//UORDNET LISTE <ul>
function bbul(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<ul>\n" + selectedText + "\n</ul>");
  textarea.focus({preventScroll: true});
  //+5 fordi vi gerne vil ramme midten af listen
  textarea.selectionEnd = startPos + selectedText.length + 5;
}
//LISTEPUNKT <li>
function bbli(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "<li>" + selectedText + "</li>");
  textarea.focus({preventScroll: true});
  //+5 fordi vi gerne vil ramme midten af listepunktet
  textarea.selectionEnd = startPos + selectedText.length + 4;
}
//INTRO [intro] [/intro]
function bbintro(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "[intro]" + selectedText + "[/intro]");
  textarea.focus({preventScroll: true});
  //+15 fordi vi gerne flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 15;
}
//TABLE OF CONTENTS 
function bbtoc(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "[toc-wrap]\n[toc1]1 <a href='#'></a>[/toc1]\n[toc2]1.1 <a href='#'></a>[/toc2]\n[toc1]2 <a href='#'></a>[/toc1]\n[/toc-wrap]");
  textarea.focus({preventScroll: true});
  //+9 fordi der er 9 karakterer i alt i <h4></h4> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos;;
}
//FAQ [faq] [/faq]
function bbfaq(textarea, value, startPos, endPos, selectedText) {
  textarea.value = value.replaceBetween(startPos, endPos, "[faq]\n\n" + selectedText + "\n\n[/faq]");
  textarea.focus({preventScroll: true});
  //+13 fordi vi gerne flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + 13;
}
String.prototype.replaceBetween = function(start, end, what) {
  return this.substring(0, start) + what + this.substring(end);
};

//tilføj strong med genvejstaster
jQuery('textarea').on('keydown', function(e) {

  // If key press combination is CTRL+i
  if (e.ctrlKey && e.key == 'b') {

    //getting length of text
    var length = $('#artikel').val().length;
    //starting text
    var start_point = $('#artikel')[0].selectionStart;
    //ending text
    var end_point = $('#artikel')[0].selectionEnd;

    //getting selected text
    var selectedText = $('#artikel').val().substring(start_point, end_point);
    console.log(selectedText);
    var replacement = "<strong>" + selectedText + "</strong>";
    $('#artikel').val($('#artikel').val().substring(0, start_point) + replacement + $('#artikel').val().substring(end_point, length));

  }

});
</script>































<script>
////////FIX!!!!!!!
////////Når man klikker "ENTER" i textarea midt på en lang tekst
////////Så vil den scrolle til toppen. Scriptet herunder forhindrer det
function getChromeType() {
  //source: https://stackoverflow.com/questions/4565112/javascript-how-to-find-out-if-the-user-browser-is-chrome/13348618#13348618
  // please note, 
  // that IE11 now returns undefined again for window.chrome
  // and new Opera 30 outputs true for window.chrome
  // but needs to check if window.opr is not undefined
  // and new IE Edge outputs to true now for window.chrome
  // and if not iOS Chrome check
  // so use the below updated condition
  var isChromium = window.chrome;
  var winNav = window.navigator;
  var vendorName = winNav.vendor;
  var isOpera = typeof window.opr !== "undefined";
  var isIEedge = winNav.userAgent.indexOf("Edge") > -1;
  var isIOSChrome = winNav.userAgent.match("CriOS");

  if (isIOSChrome) {
    // is Google Chrome on IOS
    return 1;
  } else if (
    isChromium !== null &&
    typeof isChromium !== "undefined" &&
    vendorName === "Google Inc." &&
    isOpera === false &&
    isIEedge === false
  ) {
    // is Google Chrome
    return 2;
  } else {
    // not Google Chrome 
    return 0;
  };
};

function handleChromeTextarea(el, useScroll) {
  let getNoLineBreaks = () => {
    //source: https://stackoverflow.com/questions/10950538/how-to-detect-line-breaks-in-a-text-area-input
    return (el.value.match(/\n/g) || []).length;
  };

  let getScrollPos = () => {
    return el.scrollTop;
  };

  let onInput = (e) => {
    const newNoLineBreaks = getNoLineBreaks();

    if (noLineBreaks < newNoLineBreaks) {
      el.scrollTop = scrollPos;
    };

    noLineBreaks = newNoLineBreaks;
  };

  let onBeforeInput = (e) => {
    scrollPos = getScrollPos();
  };

  let noLineBreaks = getNoLineBreaks();
  let scrollPos = getScrollPos();

  el.addEventListener("input", onInput);
  el.addEventListener("beforeinput", onBeforeInput); //Already supported by Chrome - you may wish to use this without the scroll event

  if (useScroll) {
    el.addEventListener("scroll", onBeforeInput);
  };
};


const chromeType = getChromeType();

if (0 < chromeType) {
  handleChromeTextarea(document.getElementById("artikel"), (chromeType === 1));
};
</script>