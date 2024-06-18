<?php
	include ("connect.php");
	$t_id = addslashes($_GET['id']);
	
	//HENT TAG
	$queryTag = "SELECT
		t_id,
		tag_name,
		meta_description,
		linktitle,
		article,
		readmore
			FROM
		tags
			WHERE linktitle=?";
	if ($stmtTag = $con->prepare($queryTag)) {
		
		$stmtTag->bind_param('s', $t_id);

		/* execute statement */
		$stmtTag->execute();

		/* bind result variables */
		$stmtTag->bind_result($t_id,
			$tag_name,
			$meta_description,
			$linktitle,
			$article,
			$readmore);

		/* fetch values */
		$stmtTag->fetch();				

		/* close statement */
		$stmtTag->close();
	}

	$pageMeta  = $meta_description;
	$pageTitle = $tag_name;
	$pageCanonical = "https://hunderacer.dk/tag/".$linktitle;
?>

<div class="layout-wrapper">
	<div class="layout-content">
	
		<?php
			include("aside-menu.php");
		?>
		<section class="home-main-content">
			<header class="text-center">
				<h1><?php echo $tag_name; ?></h1>
			</header>
			
			<div class="expanding-box-hide" id="expanding-box">
				<?php echo $article; ?>
				<span id="expanding-box-btn">... <span id="expanding-box-btn-txt">læs mere</span></span>
			</div>
			
			<script>
				const elementClicked = document.querySelector("#expanding-box-btn");
				const elementYouWantToShow = document.querySelector("#expanding-box");

				elementClicked.addEventListener("click", ()=>{
				  elementYouWantToShow.classList.toggle("expanding-box-show");
				  
				  var x = document.getElementById("expanding-box-btn-txt");
				  if (x.innerHTML === "læs mere") {
					x.innerHTML = "læs mindre";
				  } else {
					x.innerHTML = "læs mere";
				  }
				});
			</script>
			
			<div class="dog-card-wrap" role="list">
				<?php
					$queryNT = "SELECT
						hund.h_id,
						hund.hunderace,
						hund.pagemeta,
						hund.billede_cover,
						hund.linktitel,
						hund.public,
						tag.t_id,
						tag.h_id AS TAG_h_id
						FROM hunde AS hund
							INNER JOIN hunde_tags AS tag ON tag.h_id = hund.h_id
						WHERE tag.t_id = ? AND hund.public = '1'
						";
					if ($stmtNT = $con->prepare($queryNT)) {
						
						$stmtNT->bind_param('s', $t_id);

						/* execute statement */
						$stmtNT->execute();

						/* bind result variables */
						$stmtNT->bind_result($HUND_h_id, $HUND_hunderace, $HUND_pagemeta, $HUND_billede_cover, $HUND_linktitel, $HUND_public, $TAG_t_id, $TAG_h_id);
						
						/* fetch values */
						while ($stmtNT->fetch()) {
				?>
						<div class="dog-card" role="listitem">
							<article>
								<figure>
									<a class="display-block float-left width-100" href="<?php echo $HUND_linktitel; ?>" aria-label="<?php echo $HUND_hunderace; ?>">
										<img loading="lazy" src="gallery_338/<?php echo $HUND_billede_cover; ?>" width="200" height="200" alt="<?php echo $HUND_hunderace; ?>" />
									</a>
								</figure>
								<h2 class="dog-card-title"><a href="<?php echo $HUND_linktitel; ?>"><?php echo $HUND_hunderace; ?></a></h2>
								<p><?php echo $HUND_pagemeta; ?></p>
								<div class="dog-card-read-more">
									<a class="dog-card-read-more-link" href="<?php echo $HUND_linktitel; ?>">
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
	</div>
</div>