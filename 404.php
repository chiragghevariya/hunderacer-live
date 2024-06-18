<?php
	http_response_code(404);
	$pageMeta  = "Hov - den side kan vi ikke finde";
	$pageTitle = "Hov - den side kan vi ikke finde";
	$pageCanonical = "https://hunderacer.dk/404";
?>

<div class="layout-wrapper">
	<div class="layout-content">
	
		<?php
			include("aside-menu.php");
		?>
		<section class="home-main-content">
			<header class="text-center">
				<h1>Hov - den side kan vi ikke finde</h1>
				<img src="images/dog-digging.svg" width="200" height="200" alt="Hund graver" class="margin-auto margin-bottom-30 margin-top-30 display-block" />
			</header>
			
			<?php
				//Indsæt søgefelt
				include("main-search-field.php");
			?>
		</section>
	</div>
</div>