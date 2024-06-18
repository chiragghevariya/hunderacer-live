<div class="layout-wrapper">
	<div class="layout-content">
		<?php
			include("aside-menu.php");
		?>
		<section class="home-main-content">
		
			<?php
				//Indsæt søgefelt
				include("main-search-field.php");
			?>
		
			<?php
				if(isset($_POST['searchphrase'])) {
					$phrase = addslashes(trim($_POST['searchphrase']));
					
					header('Location: search/'.urlencode($_POST['searchphrase']).'');
				}
				else if(isset($_GET['q'])) {
					$phrase = addslashes(trim($_GET['q']));
					
			?>
					
			<?php
					include ("connect.php");
					
					$timestamp = time();
					
					
					//Registrer søgning
					$stmt_in = $con->prepare("INSERT INTO searches (timestamp, search_query) VALUES (?, ?)");
					$stmt_in->bind_param("ss", $timestamp, $phrase);
					$stmt_in->execute();  
					//$lastId = $con->insert_id;
					$stmt_in->close();
					
					$SearchStringFull = "%".$phrase."%";
					$SearchStringFirst = $phrase."%";
					$SearchStringLast = "%".$phrase;
					$Public = "1";
					
					$query = "SELECT 
						hunderace,
						pagemeta,
						billede_cover,
						linktitel
							FROM
						hunde
							WHERE (hunderace LIKE ? OR artikel LIKE ?) AND public = ? ORDER BY
			  CASE
				WHEN (hunderace LIKE ? OR artikel LIKE ?) THEN 1
				WHEN (hunderace LIKE ? OR artikel LIKE ?) THEN 3
				ELSE 2
			  END LIMIT 21";
					if ($stmt = $con->prepare($query)) {
						$stmt->bind_param('sssssss', $SearchStringFull, $SearchStringFull, $Public, $SearchStringFirst, $SearchStringFirst, $SearchStringLast, $SearchStringLast);
						$stmt->execute();
						$stmt->bind_result($a_hunderace, $a_pagemeta, $a_billede, $a_linktitle);
						
						$stmt->store_result();
						$number_of_records = $stmt->num_rows;
						
						if($number_of_records == "1") {
							$ResultatTxt = "resultat";
						}
						else {
							$ResultatTxt = "resultater";
						}
						
						$hONE = $number_of_records.' '.$ResultatTxt.' for "'.$phrase.'"';
						
			?>
			<header class="text-center margin-bottom-30">
				<h1><?php echo $hONE; ?></h1>
			</header>
			
			<div class="dog-card-wrap" role="list">
			<?php
						
						if($number_of_records == "0") {
							echo "<p>Der er desværre ingen artikler der matcher din søgning</p>";
						}
						else {
							while ($stmt->fetch()) {
			?>								
								<div class="dog-card" role="listitem">
									<article>
										<figure>
											<a class="display-block float-left width-100" href="<?php echo $a_linktitle; ?>">
												<img loading="lazy" src="gallery_338/<?php echo $a_billede; ?>" width="200" height="200" alt="<?php echo $a_hunderace; ?>" />
											</a>
										</figure>
										<h2 class="dog-card-title"><a href="<?php echo $a_linktitle; ?>"><?php echo $a_hunderace; ?></a></h2>
										<p><?php echo $a_pagemeta; ?></p>
										<div class="dog-card-read-more">
											<a class="dog-card-read-more-link" href="<?php echo $a_linktitle; ?>">
												<div class="dog-card-read-more-btn">+</div>
												<span>Læs mere</span>
											</a>
										</div>
									</article>
								</div>
			<?php
							}
						}
						
						$stmt->close();
					}


					$pageTitle 		= "Søgeresultat for ".$phrase;
					$pageMeta 		= "Her kan du se søgeresultaterne for ".$phrase; 
					$pageCanonical 	= "https://hunderacer.dk/search/";
					$pageIndex 		= "noindex,follow";
				}
			?>
			</div>
		</section>
	</div>
</div>