<?php
	include ("connect.php");
	include ("format-text.php");
	
	$get_a_id = addslashes($_GET['id']);
	
	//Check if thought exist
	$sqlNumArticles = "SELECT COUNT(1) FROM articles WHERE linktitle = ?";
	$stmtNumArticles = $con->prepare($sqlNumArticles);
	$stmtNumArticles->bind_param("s", $get_a_id);
	$stmtNumArticles->execute();
	$rowNumArticles = $stmtNumArticles->get_result()->fetch_row();
	$NumRowsArticles = $rowNumArticles[0];
	
	if($NumRowsArticles == "0") {
		include ("404.php");
		$pageIndex = "noindex, follow";
	}
	else if($NumRowsArticles > "0") {	
		
		//Link med hashtag
		$actual_link_hashtag = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."#";
		
		//HENT HUND
		$query = "SELECT 
			a_id,
			title,
			meta_description,
			linktitle,
			article,
			thedate,
			cover,
			public
				FROM
			articles
				WHERE linktitle=?";
		if ($stmt = $con->prepare($query)) {
			
			$stmt->bind_param('s', $get_a_id);

			/* execute statement */
			$stmt->execute();

			/* bind result variables */
			$stmt->bind_result($a_id,
			$title,
			$meta_description,
			$linktitle,
			$article,
			$thedate,
			$billede_cover,
			$public);

			/* fetch values */
			$stmt->fetch();				

			/* close statement */
			$stmt->close();
		}
		
		//METAS
		$pageMeta  = $meta_description;
		$pageTitle = $title;
		$pageImage = "https://hunderacer.dk/gallery_1600/".$billede_cover;
		$pageType = "article";
		$pageCanonical = "https://hunderacer.dk/artikel/".$linktitle;
	?>

	<div class="layout-wrapper">
		<div class="layout-content">
		<div class="floating-share-button">
			<div class="floating-share-button-img">
				<svg x="0px" y="0px" width="26" height="26" viewBox="0 0 24 24"> <path d="M 18 2 A 3 3 0 0 0 15 5 A 3 3 0 0 0 15.054688 5.5605469 L 7.9394531 9.7109375 A 3 3 0 0 0 6 9 A 3 3 0 0 0 3 12 A 3 3 0 0 0 6 15 A 3 3 0 0 0 7.9355469 14.287109 L 15.054688 18.439453 A 3 3 0 0 0 15 19 A 3 3 0 0 0 18 22 A 3 3 0 0 0 21 19 A 3 3 0 0 0 18 16 A 3 3 0 0 0 16.0625 16.712891 L 8.9453125 12.560547 A 3 3 0 0 0 9 12 A 3 3 0 0 0 8.9453125 11.439453 L 16.060547 7.2890625 A 3 3 0 0 0 18 8 A 3 3 0 0 0 21 5 A 3 3 0 0 0 18 2 z"></path></svg>
			</div>
		</div>
		<script>
			const shareData = {
				title: '<?php echo $pageTitle; ?>',
				text: '<?php echo $pageMeta; ?>',
				url: '<?php echo $pageCanonical; ?>'
			}

			const btn = document.querySelector('.floating-share-button');

			btn.addEventListener('click', async () => {
				try {
					await navigator.share(shareData)
				} catch(err) {
					console.error("Fejl:", err.message);
				}
			});
		</script>
			<header>
				<!--BREADCRUMBS-->
				<div class="breadcrumb-wrap only-desktop">
					<ol class="breadcrumb">
						<li>
							<a href="https://hunderacer.dk/artikler">
								<span>Artikler</span>
							</a>
						</li>
						<li>
							<span><?php echo $title; ?></span>
						</li>
					</ol>
				</div>
				
				<h1><?php echo $title; ?></h1>
			</header>
			
			<article class="main-content">	
				<figure>
					<img src="gallery_964/<?php echo $billede_cover; ?>" class="dog-cover" alt="<?php echo $title; ?>" height="480" width="964" decoding="async" sizes="(min-width: 800px) 800px, calc(100vw - 48px)" class="dog-image" srcset="gallery_200/<?php echo $billede_cover; ?> 200w, gallery_228/<?php echo $billede_cover; ?> 228w, gallery_260/<?php echo $billede_cover; ?> 260w, gallery_296/<?php echo $billede_cover; ?> 296w, gallery_338/<?php echo $billede_cover; ?> 338w, gallery_385/<?php echo $billede_cover; ?> 385w, gallery_439/<?php echo $billede_cover; ?> 439w, gallery_500/<?php echo $billede_cover; ?> 500w, gallery_571/<?php echo $billede_cover; ?> 571w, gallery_650/<?php echo $billede_cover; ?> 650w, gallery_741/<?php echo $billede_cover; ?> 741w, gallery_845/<?php echo $billede_cover; ?> 845w, gallery_964/<?php echo $billede_cover; ?> 964w" />
				</figure>
				<div class="dog-article">
					<?php
						$artikel_formateret = FormatText($article);
						$artikel_formateret = FormatTextFurther($artikel_formateret);
						echo $artikel_formateret;
					?>
				</div>
			</article>
			<div class="main-sidebar">
				<?php
					if(isset($_SESSION["myusername"])) {
						if($_SESSION["admin"] == "fuckyeah") {
				?>
				<aside class="dog-technical-details">
					<h2>Admin</h2>
					<dl>
						<dt>Indstillinger</dt>
						<dd>
							- <a target="_blank" href="index.php?page=testedit_article&id=<?php echo $a_id; ?>">Rediger</a><br /><br />
							- <a target="_blank" href="https://validator.schema.org/#url=https://hunderacer.dk/artikel/<?php echo $linktitle; ?>">Schema check</a><br /><br />
							- <a target="_blank" href="https://search.google.com/test/rich-results?url=https://hunderacer.dk/artikel/<?php echo $linktitle; ?>">Rich results check</a>
						</dd>
					</dl>
				</aside>
				<?php
						}
					}
				?>
				
				<aside class="dog-other-articles">
					<?php
						//ARTIKLER
						$queryGRA = "SELECT
							title,
							linktitle,
							cover
								FROM articles WHERE public = '1' AND cover != ''
							ORDER BY rand()
								LIMIT 5
						";
							
						if ($stmtGRA = $con->prepare($queryGRA)) {
							/* execute statement */
							$stmtGRA->execute();

							/* bind result variables */
							$stmtGRA->bind_result($RA_title, $RA_linktitle, $RA_cover);
							
							/* fetch values */
							while ($stmtGRA->fetch()) {
					?>		
								<article class="main-sidebar-related-content">
									<figure>
										<a href="artikel/<?php echo $RA_linktitle ?>" aria-label="<?php echo $RA_title; ?>">
											<img loading="lazy" alt="<?php echo $RA_title; ?>" class="main-sidebar-related-content-cover" src="gallery_338/<?php echo $RA_cover; ?>" width="300" height="180" />
										</a>
									</figure>
									<div class="main-sidebar-related-content-details">
										<p class="bold">Artikel</p>
										<p><a href="artikel/<?php echo $RA_linktitle ?>"><?php echo $RA_title; ?></a></p>
									</div>
								</article>
					<?php
							}
						}
					?>
					<?php
						//HUNDERACER
						$queryGRD = "SELECT
							h_id,
							hunderace,
							billede_cover,
							linktitel
								FROM hunde WHERE public = '1' AND billede_cover != ''
							ORDER BY rand()
								LIMIT 10
						";
							
						if ($stmtGRD = $con->prepare($queryGRD)) {
							/* execute statement */
							$stmtGRD->execute();

							/* bind result variables */
							$stmtGRD->bind_result($RD_h_id, $RD_hunderace, $RD_billede_cover, $RD_linktitel);
							
							/* fetch values */
							while ($stmtGRD->fetch()) {
					?>		
								<article class="main-sidebar-related-content">
									<figure>
										<a href="<?php echo $RD_linktitel ?>" aria-label="<?php echo $RD_hunderace; ?>">
											<img loading="lazy" alt="<?php echo $RD_hunderace; ?>" class="main-sidebar-related-content-cover" src="gallery_338/<?php echo $RD_billede_cover; ?>" width="300" height="180" />
										</a>
									</figure>
									<div class="main-sidebar-related-content-details">
										<p class="bold">Hunderace</p>
										<p><a href="<?php echo $RD_linktitel ?>"><?php echo $RD_hunderace; ?></a></p>
									</div>
								</article>
					<?php
							}
						}
					?>
				</aside>
			</div>
		</div>
	</div>
	
<?php
	//LAD OS LAVE SCHEMA
	if (strpos($article, "[faq]") !== false) {
		//if (preg_match('#[\s*?faq\b[^>]*\](.*?)[\/faq\b[^>]*\]#s', $artikel, $arr)) {
			if (preg_match('/\[faq\](.*?)\[\/faq\]/ism', $artikel, $arr)) {
		   //echo "image: ".$arr[1]."\n";
			  
			$html = $arr[1];
			
			$array = [];

			$dom = new DomDocument();
			
			libxml_use_internal_errors(true);
			
			// Load the HTML, don't worry about it being a fragment
			$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
			
			libxml_clear_errors();

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
			
			//FAQ SCHEMA
			$faq_schema = ',{"@context": "https://schema.org",';
			$faq_schema .= '"@type": "FAQPage","mainEntity": ';
			//Vi kan tilføje |JSON_PRETTY_PRINT| til nedenstående hvis vi ønsker, at json står flot
			$faq_schema .= json_encode($array,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
			$faq_schema .="}";	   
		}
	}
	else {
		//Hvis der intet schema er - så vis tom schema
		$faq_schema = "";
	}
	
	//BREADCRUMB SCHEMA
	$breadcrumb_schema = ',{';
	$breadcrumb_schema .= '"@context": "https://schema.org",';
    $breadcrumb_schema .= '"@type": "BreadcrumbList",';
    $breadcrumb_schema .= '"description": "Breadcrumbs list",';
    $breadcrumb_schema .= '"itemListElement": [{';
    $breadcrumb_schema .= '"@type": "ListItem",';
    $breadcrumb_schema .= '"item": "https://hunderacer.dk/artikler",';
	$breadcrumb_schema .= '"position": 1,';
    $breadcrumb_schema .= '"name": "Artikler"';
    $breadcrumb_schema .= '}, {';
    $breadcrumb_schema .= '"@type": "ListItem",';
	$breadcrumb_schema .= '"position": 2,';
    $breadcrumb_schema .= '"name": "'.$title.'"';
    $breadcrumb_schema .= '}]';
    $breadcrumb_schema .= '}';
	
	
	//KOMBINER SCHEMA
	$pageSchema = $faq_schema.$breadcrumb_schema;
?>
	
<?php
	}
?>