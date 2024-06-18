<?php 
	session_start();
	date_default_timezone_set('Europe/Copenhagen');
	ob_start (); // Buffer output
	$actual_link = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="da" xml:lang="da"> 
<head>
	<base href="https://hunderacer.dk/" />
	<meta charset="UTF-8" />
	<meta name="theme-color" content="#36465d" />
	<title>%HUNDERACER%</title>
	<meta name="description" content="%META%" />
	<meta name="robots" content="%INDEX%, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
	
	<meta property="og:title" content="%HUNDERACER%" />
	<meta property="og:type" content="%OGTYPE%" />
	<meta property="og:description" content="%META%" />
	<meta property="og:image" content="%OGIMAGE%" />
	<meta property="og:url" content="<?php echo $actual_link; ?>" />
	<meta property="og:site_name" content="Hunderacer.dk" />
	<meta property="og:locale" content="da_DK" />
	
	<meta name="twitter:title" content="%HUNDERACER%" />
	<meta name="twitter:description" content="%META%" />
	<meta name="twitter:image" content="%OGIMAGE%" />
	<meta name="twitter:card" content="summary_large_image" />
	
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png" />
	<link rel="manifest" href="images/site.webmanifest" />
	<link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<meta name="msapplication-TileColor" content="#0fa867" />
	<meta name="msapplication-config" content="images/browserconfig.xml" />
	<meta name="theme-color" content="#ffffff" />
	
	<link rel="canonical" href="%CANONICAL%" />
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="style/style.css" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2715747792484344" crossorigin="anonymous"></script>

	<?php
	$schema = '<script type="application/ld+json">';
	$schema .= '[';
	$schema .= '{';
	$schema .= '"@context": "https://schema.org",';
	$schema .= '"@type": "Organization",';
	$schema .= '"@id": "https://hunderacer.dk/#organization",';
	$schema .= '"url": "https://hunderacer.dk",';
	$schema .= '"sameAs": ["https://www.facebook.com/Hunderacer"],';
	$schema .= '"name": "Hunderacer.dk",';
	$schema .= '"logo": [{';
	$schema .= '"@type": "ImageObject",';
	$schema .= '"@id": "https://hunderacer.dk/#logo",';
	$schema .= '"inLanguage": "da-DK",';
	$schema .= '"url": "https://hunderacer.dk/images/logo5.svg",';
	$schema .= '"width": 510,';
	$schema .= '"height": 72,';
	$schema .= '"caption": "Hunderacer"';
	$schema .= '}]';
	$schema .= '},';
	$schema .= '{';
	$schema .= '"@context": "https://schema.org",';
	$schema .= '"@type": "WebSite",';
	$schema .= '"@id": "https://hunderacer.dk/#website",';
	$schema .= '"url": "https://hunderacer.dk/",';
	$schema .= '"name": "Hunderacer.dk",';
	$schema .= '"description": "Læs og lær om alverdens hunderacer",';
	$schema .= '"inLanguage": "da-DK",';
	$schema .= '"publisher": {';
	$schema .= '"@id": "https://hunderacer.dk/#organization"';
	$schema .= '},';
	$schema .= '"copyrightHolder": {';
	$schema .= '"@id": "https://hunderacer.dk/#organization"';
	$schema .= '}';
	$schema .= '}';
	$schema .= '%SCHEMA%';
	$schema .= ']';
	$schema .= '</script>';
	
	echo $schema;
	?>
	
	<?php
		if(isset($_SESSION["myusername"])) {
			if($_SESSION["admin"] == "fuckyeah") {
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style/admin.css" />
	<?php
			}
		}
	?>
</head>
<body>
	<div class="top-header">
		<div class="top-header-inner">
			<a class="display-block float-left" href="index.php" aria-label="Logo link">
			<img class="top-header-logo" src="images/logo5.svg" width="170" height="24" alt="Logo for hunderacer.dk" />
			</a>
			
			<nav class="top-header-nav only-desktop">
				<a class="top-header-standard-link" href="index.php" <?php $currentpage = $_SERVER['REQUEST_URI']; if($currentpage=="/" || $currentpage=="/index.php" || $currentpage=="/index" || $currentpage=="" ) { echo 'active'; } ?>>Forsiden</a>
				<a class="top-header-standard-link" href="artikler" <?php if(isset($_GET['page'])) { if($_GET['page'] == "articles") { echo "active"; } } ?>>Artikler</a>
				<a class="top-header-standard-link" href="tag/ulovlige-og-forbudte-hunderacer" <?php if(isset($_GET['id'])){ if($_GET['id'] == "ulovlige-og-forbudte-hunderacer") { echo "active"; } } ?>>Ulovlige hunde</a>
				<?php
					if(isset($_SESSION["myusername"])) {
						if($_SESSION["admin"] == "fuckyeah") {
				?>
					<a class="top-header-standard-link" href="index.php?page=kingkong-control-panel">Admin</a>
				<?php
						}
					}
				?>
			</nav>

			<div id="side-nav-btn" class="only-mobile" onclick="openNav()">
				<svg viewBox="0 0 100 80" width="24" height="64">
					<rect width="100" height="16" rx="8"></rect>
					<rect y="30" width="100" height="16" rx="8"></rect>
					<rect y="60" width="100" height="16" rx="8"></rect>
				</svg>
			</div>
		</div>
	</div>
	<div id="side-nav-overlay" onclick="closeNav()"></div>
	<div id="side-nav">
		<div id="side-nav-header">
			<div id="side-nav-exit" onclick="closeNav()">
				<svg viewBox="0 0 12 12" width="20" height="64">
					<g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
						<g fill="#000000" fill-rule="nonzero" transform="translate(-184.000000, -64.000000)">
							<path d="M185.626522,64.2114758 L185.721525,64.295367 L190,68.574 L194.278475,64.295367 C194.672297,63.9015443 195.31081,63.9015443 195.704633,64.295367 C196.068162,64.6588957 196.096125,65.2309177 195.788524,65.6265223 L195.704633,65.7215253 L191.426,70 L195.704633,74.2784747 C196.098456,74.6722974 196.098456,75.3108102 195.704633,75.704633 C195.341104,76.0681616 194.769082,76.0961254 194.373478,75.7885242 L194.278475,75.704633 L190,71.426 L185.721525,75.704633 C185.327703,76.0984557 184.68919,76.0984557 184.295367,75.704633 C183.931838,75.3411043 183.903875,74.7690823 184.211476,74.3734777 L184.295367,74.2784747 L188.574,70 L184.295367,65.7215253 C183.901544,65.3277026 183.901544,64.6891898 184.295367,64.295367 C184.658896,63.9318384 185.230918,63.9038746 185.626522,64.2114758 Z"/>
						</g>
					</g>
				</svg>
			</div>
		</div>
		<nav>
			<a class="side-nav-link side-nav-link-az" href="index.php">Alle hunderacer</a>
			<a class="side-nav-link side-nav-link-illegal" href="tag/ulovlige-og-forbudte-hunderacer">Ulovlige hunderacer</a>
			<a class="side-nav-link side-nav-link-articles" href="artikler">Artikler</a>
			<h3>Størrelse</h3>
			<a class="side-nav-link side-nav-link-undefined" href="tag/miniature-hunderacer">Miniature hunderacer</a>
			<a class="side-nav-link side-nav-link-undefined" href="tag/smaa-hunderacer">Små hunderacer</a>
			<a class="side-nav-link side-nav-link-undefined" href="tag/mellem-hunderacer">Mellem hunderacer</a>
			<a class="side-nav-link side-nav-link-undefined" href="tag/store-hunderacer">Store hunderacer</a>
			<a class="side-nav-link side-nav-link-undefined" href="tag/meget-store-hunderacer">Meget store hunderacer</a>
			<h3>Praktisk</h3>
			<a class="side-nav-link side-nav-link-about" href="om-os">Om os</a>
			<a class="side-nav-link side-nav-link-contact" href="kontakt">Kontakt</a>
			<a class="side-nav-link side-nav-link-privacy" href="privatpolitik">Persondata politik</a>
		</nav>
	</div>
	
<script>
	function openNav() {
		document.getElementById('side-nav-overlay').style.display = 'block';
		document.getElementById('side-nav').style.display = 'block';
		document.body.style.overflowY = "hidden";
	}
	function closeNav() {
		document.getElementById('side-nav-overlay').style.display = 'none';
		document.getElementById('side-nav').style.display = 'none';
		document.body.style.overflowY = "auto";
	}
	document.onclick = function (e) {
		if (e.target.id !== 'side-nav' && e.target.id !== 'side-nav-btn') {
			if (e.target.offsetParent && e.target.offsetParent.id !== 'side-nav')
			closeNav()
		}
	}
</script>	
	<main>
		<?php
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				$page = addslashes($page);
				$page = strip_tags($page);
				$extension = ".php";
				$fullURL = $page.$extension;
				if(file_exists($fullURL)) {
					include ($fullURL);
				}
				else {
					include ("404.php");
				}
			}
			else {
				include "forsiden.php";
			}
		?>
	</main>
	<footer>
		<div class="footer-inner">
			<img class="footer-dog-img" src="images/hoppende-hund-med-bold-i-munden.svg" width="100" height="100" loading="lazy" alt="Hoppende hund" />
			<nav class="footer-block">
				<p class="footer-copyright">&copy; <?php echo date("Y"); ?> Hunderacer.dk</p>
				<p><a href="kontakt">Kontakt</a></p>
				<p><a href="om-os">Om os</a></p>
				<p><a href="privatpolitik">Cookie- og privatpolitik</a></p>
			</nav>
		</div>
	</footer>
	
	<?php
		if(!isset($_SESSION["myusername"])) {
	?>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172749492-1"></script>

<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-172749492-1' , { 'anonymize_ip': true});
</script>
    <?php
		}
    ?>

</body>
</html>
<?php
$pageContents = ob_get_contents (); // Get all the page's HTML into a string
ob_end_clean (); // Wipe the buffer

if(!isset($pageTitle)) {
	$pageTitle = "Hunderacer - Beskrivelser og billeder af hunde fra A-Z";
}
if(!isset($pageMeta)) {
	$pageMeta = "Læs detaljerede beskrivelser af alverdens hunderacer. Find ud af hvilken hund der passer til dig og lær dens egenskaber at kende - gode såvel som dårlige.";
}
if(!isset($pageImage)) {
	$pageImage = "https://hunderacer.dk/images/standard.webp";
}
if(!isset($pageIndex)) {
	$pageIndex = "index, follow";
}
if(!isset($pageType)) {
	$pageType = "website";
}
if(!isset($pageCanonical)) {
	$pageCanonical = $actual_link;
}
if(!isset($pageSchema)) {
	$pageSchema = "";
}

$healthy = ["%HUNDERACER%","%META%","%OGIMAGE%","%INDEX%","%OGTYPE%","%CANONICAL%","%SCHEMA%"];
$yummy   = [$pageTitle, $pageMeta, $pageImage, $pageIndex, $pageType, $pageCanonical, $pageSchema];

// Replace <!--TITLE--> with $pageTitle variable contents, and print the HTML
echo str_replace($healthy, $yummy, $pageContents);
?>
