<?php
	include ("connect.php");
	$pageCanonical = "https://hunderacer.dk/artikler";
	$pageMeta = "Her vil du kunne læse artikler og blogindlæg omkring hunde. Artikler omkring sygdomme hos hunde, gode råd omkring hygiejne og pleje samt meget andet.";
	$pageTitle = "Artikler og blogindlæg om hunde";
?>
<div class="layout-wrapper">
	<div class="layout-content">
		
	
		<?php
			include("aside-menu.php");
		?>
		<section class="home-main-content">
			<header class="text-center margin-bottom-30">
				<h1>Artikler</h1>
			</header>
			
			<div class="dog-card-wrap" role="list">
				<?php
					$queryNT = "SELECT
					a_id,
					title,
					meta_description,
					linktitle,
					thedate,
					cover,
					public
						FROM articles
					WHERE public='1' AND cover != ''
						";
					if ($stmtNT = $con->prepare($queryNT)) {
						
						//$stmtNT->bind_param('s', $a_id);

						/* execute statement */
						$stmtNT->execute();

						/* bind result variables */
						$stmtNT->bind_result($a_id,
					$title,
					$meta_description,
					$linktitle,
					$thedate,
					$cover,
					$public);
						
						/* fetch values */
						while ($stmtNT->fetch()) {
				?>
						<div class="dog-card" role="listitem">
							<article>
								<figure>
									<a class="display-block float-left width-100" href="artikel/<?php echo $linktitle; ?>" aria-label="<?php echo $title; ?>">
										<img loading="lazy" src="gallery_338/<?php echo $cover; ?>" width="200" height="200" alt="<?php echo $title; ?>" />
									</a>
								</figure>
								<h2 class="dog-card-title"><a href="artikel/<?php echo $linktitle; ?>"><?php echo $title; ?></a></h2>
								<p><?php echo $meta_description; ?></p>
								<div class="dog-card-read-more">
									<a class="dog-card-read-more-link" href="artikel/<?php echo $linktitle; ?>">
										<div class="dog-card-read-more-btn">+</div>
										<span>Læs mere</span>
									</a>
								</div>
							</article>
						</div>
				<?php
						}
					}
				?>
			</div>
		</section>
		
		
		
		
		
		
		
		
		<!--<div class="d-card-wrap" role="list">
			<?php
				$i = 0;
				include ("connect.php");
				$queryGDL = "SELECT
					a_id,
					title,
					linktitle,
					thedate,
					cover,
					public
						FROM articles
					WHERE public='1'
				";
					
				if ($stmtGDL = $con->prepare($queryGDL)) {
					/* execute statement */
					$stmtGDL->execute();

					/* bind result variables */
					$stmtGDL->bind_result($a_id,
					$title,
					$linktitle,
					$thedate,
					$cover,
					$public);
					
					/* fetch values */
					while ($stmtGDL->fetch()) {
			?>
				<div class="d-card" role="listitem">
					<article>
						<a href="artikel/<?php echo $linktitle; ?>" aria-label="<?php echo $title; ?>">
							<figure>
								<img loading="lazy" src="gallery_images_big/<?php echo $cover; ?>" width="500" height="240" alt="<?php echo $title; ?>" />
							</figure>
						</a>
						<a href="artikel/<?php echo $linktitle; ?>">
							<h2><?php echo $title; ?></h2>
						</a>
						<p>Det her er noget brødtekst der gerne skulle se om det virker fint eller hvad</p>
					</article>
				</div>
			<?php
						$i++;
					}
				}
			?>
		</div>-->
	</div>
</div>