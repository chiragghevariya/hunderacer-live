<div class="layout-wrapper">
	<div class="layout-content">
<?php
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
?>

<?php
	include ("king-kong-dog-include-check.php");
?>
<?php
	include ("connect.php");
	
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
		public
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
		$public);

		/* fetch values */
		$stmt->fetch();				

		/* close statement */
		$stmt->close();
	}
?>




<!--<form action="king-kong-dog-uploadbillede.php?func=hoved&id=<?php echo $get_h_id; ?>" method="post" enctype="multipart/form-data">
	<p>Billede af hovedet:<br />
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit"><p>
	<?php
		if($billede_headshot != "") {
	?>
		<img style="height: 150px;" src="gallery_images_small/<?php echo $billede_headshot; ?>" />
	<?php
		}
	?>
</form>
<form action="king-kong-dog-uploadbillede.php?func=krop&id=<?php echo $get_h_id; ?>" method="post" enctype="multipart/form-data">
	<p>Billede af hele hunden:<br />
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit"></p>
	<?php
		if ($billede_cover != "") {
	?>
		<img style="height: 150px;" src="gallery_images_small/<?php echo $billede_cover; ?>" />
	<?php
		}
	?>
</form>-->
<form method="post" id="dog-form" action="king-kong-dog-checkedit.php?id=<?php echo $get_h_id; ?>" style="width: 700px; float: left;" class="AdminWrap">
	<?php
		if($billede_headshot != "") {
	?>
		<img style="height: 150px;" src="gallery_images_small/<?php echo $billede_headshot; ?>" />
	<?php
		}
	?>
	<?php
		if ($billede_cover != "") {
	?>
		<img style="height: 150px;" src="gallery_images_small/<?php echo $billede_cover; ?>" />
	<?php
		}
	?>
	<p>Billede af hovedet<br /><input type="text" name="billede_headshot" placeholder="Billede af hovedet" value="<?php echo $billede_headshot; ?>" /></p>
	<p>Coverbillede<br /><input type="text" name="billede_cover" placeholder="Coverbillede" value="<?php echo $billede_cover; ?>" /></p>
	<p>Navn<br /><input type="text" name="navn" placeholder="Navn" value="<?php echo $hunderace; ?>" /></p>
	<p>FCI navn<br /><input type="text" name="fci_navn" placeholder="FCI navn" value="<?php echo $hunderace_fci; ?>" /></p>
	<p>FCI nummer<br /><input type="text" name="fci_nummer" placeholder="FCI nummer" value="<?php echo $fci_nummer; ?>" /></p>
	<p>Gruppe<br />
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
	</p>
	<p>Oprindelse<br />
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
	</p>
	<p>Vægt<br /><input type="text" name="vaegt" placeholder="Vægt" value="<?php echo $vaegt; ?>" /></p>
	<p>Højde<br /><input type="text" name="hojde" placeholder="Højde" value="<?php echo $hojde; ?>" /></p>
	<p>Levetid<br /><input type="text" name="levetid" placeholder="Levetid" value="<?php echo $levetid; ?>" /></p>
	<p>Allergivenlig<br />
		<select name="allergivenlig">
			<option value="Nej" <?php if($allergivenlig == "nej") { echo "selected"; } ?>>Nej</option>
			<option value="Ja" <?php if($allergivenlig == "ja") { echo "selected"; } ?>>Ja</option>
		</select>
	</p>
	<p>Ulovlig i DK?<br />
		<select name="ulovlig">
			<option value="0" <?php if($ulovlig == "0") { echo "selected"; } ?>>Nej</option>
			<option value="1" <?php if($ulovlig == "1") { echo "selected"; } ?>>Ja</option>
		</select>
	</p>
	<p>Farver<br /><input type="text" name="farver" placeholder="Farver" value="<?php echo $farver; ?>" /></p>
	<p>Andre navne<br /><input type="text" name="andre_navne" placeholder="Andre navne" value="<?php echo $andre_navne; ?>" /></p>
	<p>
		DKK specialklub<br />
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
	</p>
	<p>Avlsrestriktioner<br /><input type="text" name="avlsrestriktioner" placeholder="link til Avlsrestriktioner" value="<?php echo $avlsrestriktioner; ?>" /></p>
	<p>Racestandard<br /><input type="text" name="racestandard" placeholder="link til Racestandard" value="<?php echo $racestandard; ?>" /></p>
	<p>Linktitel<br /><input type="text" name="linktitel" placeholder="Linktitel" value="<?php echo $linktitel; ?>" /></p>
	
<!--	<hr />
	
	<p>Gøen<br />
		<select name="goen">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="goen_text" placeholder="Kommentar?" />
	</p>
	
	<p>God til lejligheder<br />
		<select name="lejligheder">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="lejligheder_text" placeholder="Kommentar?" />
	</p>
	
	<p>Kattevenlig<br />
		<select name="kattevenlig">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="kattevenlig_text" placeholder="Kommentar?" />
	</p>
	
	<p>Børnevenlig<br />
		<select name="bornevenlig">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="bornevenlig_text" placeholder="Kommentar?" />
	</p>
	
	<p>Hundevenlig<br />
		<select name="hundevenlig">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="hundevenlig_text" placeholder="Kommentar?" />
	</p>
	
	<p>Venlig mod fremmede<br />
		<select name="fremmede">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="fremmede_text" placeholder="Kommentar?" />
	</p>
	
	<p>Motionsbehov<br />
		<select name="motionsbehov">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="motionsbehov_text" placeholder="Kommentar?" />
	</p>
	
	<p>Pelspleje<br />
		<select name="pelspleje">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="pelspleje_text" placeholder="Kommentar?" />
	</p>
	
	<p>Intelligents<br />
		<select name="intelligents">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="intelligents_text" placeholder="Kommentar?" />
	</p>
	
	<p>Fældning<br />
		<select name="faeldning">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="faeldning_text" placeholder="Kommentar?" />
	</p>
	
	<p>Træning<br />
		<select name="traening">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="traening_text" placeholder="Kommentar?" />
	</p>
	
	<p>Legelyst<br />
		<select name="legelyst">
			<option value="">Vælg antal poter</option>
			<option value="1">1 pote</option>
			<option value="2">2 poter</option>
			<option value="3">3 poter</option>
			<option value="4">4 poter</option>
			<option value="5">5 poter</option>
		</select>
		<br />
		<input type="text" name="legelyst_text" placeholder="Kommentar?" />
	</p>
	
	<hr />-->
	
	<p><span class="bold">Page Title</span><br />
	** Titlen som bliver vist på Google/overskrift.<br />
	- Vigtige keywords nær starten<br />
	- 50-60 karakterer<br />
	- Skriv en tiltrækkende titel da det øger CTR<br />
	<textarea name="pagetitle" id="pagetitle" rows="2" maxlength="60"><?php echo $pagetitle; ?></textarea><br />
	<span id="count-pagetitle"></span>
	</p>
	
	<p><span class="bold">Meta beskrivelse</span><br />
	** Beksrivelse som bliver vist på Google og som fungerer som "teaser" på hjemmesiden<br />
	- Vigtige keywords nær starten<br />
	- omkring 150-160 karakterer<br />
	- Skriv en tiltrækkende beskrivelse da det øger CTR<br />
	<textarea name="pagemeta" id="pagemeta" rows="2" maxlength="160"><?php echo $pagemeta; ?></textarea>
	<span id="count-pagemeta"></span>
	</p>

	<p>Intro<br />
	<textarea name="intro" rows="2"><?php echo $intro; ?></textarea>
	</p>
	
	<p>Indholdsfortegnelse<br />
	<?php
		if(trim($toc) == "") {
	?>
	<xmp>[toc]1 <a href="#intro">Intro</a>[/toc]</xmp><br />
	<xmp>[toc2]1.1 <a href="#historie">Historie part 2</a>[/toc2]</xmp><br />
	<textarea name="toc" rows="10"></textarea></p>
	<?php
		}
		else {
	?>
	<textarea name="toc" rows="10"><?php echo $toc; ?></textarea>
	<?php
		}
	?>
	</p>
	
	<p>Artikel<br />
	<?php
		if(trim($artikel) == "") {
	?>
<textarea name="artikel" rows="40">
[section]
<h2 id="intro" class="HeaderSimple">Intro</h2>
<p>text</p>
[/section]

[section]
<h2 id="#historie" class="HeaderSimple">Historie</h2>
<p>text</p>
[/section]

[section]
<h2 id="#temperament" class="HeaderSimple">Temperament</h2>
<p>text</p>
[/section]

[section]
<h2 id="#aktivitet-og-motionsbehov" class="HeaderSimple">Aktivitet og motionsbehov</h2>
<p>text</p>
[/section]

[section]
<h2 id="#pels-og-pleje" class="HeaderSimple">Pels og pleje</h2>
<p>text</p>
[/section]

[section]
<h2 id="#helbred-og-sygdomme" class="HeaderSimple">Helbred og sygdomme</h2>
<p>text</p>
[/section]
	</textarea>
	<?php
		}
		else {
	?>
<textarea id="message" style="display: none;"><script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "FAQPage",
"mainEntity": [
{
"@type": "Question",
"name": "spørgsmål",
"acceptedAnswer": {
"@type": "Answer",
"text": "svar"
}
}, 
{
"@type": "Question",
"name": "spørgsmål",
"acceptedAnswer": {
"@type": "Answer",
"text": "svar"
}
}, 
{
"@type": "Question",
"name": "spørgsmål",
"acceptedAnswer": {
"@type": "Answer",
"text": "svar"
}
}, 
{
"@type": "Question",
"name": "spørgsmål",
"acceptedAnswer": {
"@type": "Answer",
"text": "svar"
}
},
{
"@type": "Question",
"name": "spørgsmål",
"acceptedAnswer": {
"@type": "Answer",
"text":"svar"
}
}]
}
</script></textarea>
	<textarea name="artikel" rows="40"><?php echo $artikel; ?></textarea>
	<?php
		}
	?>
	</p>
	
    <script>
        $(document).ready(function(){
			var schemaVar = $('textarea#message').val();
			$(document).on('click', '#insert-faq', function(event) {
				event.preventDefault();
				$('#artikel_schema').val(schemaVar);
				$('#artikel_schema').height( $('#artikel_schema')[0].scrollHeight );
			});
		});
	</script>
	<p>Schema  <span style="float: right;"><span onclick="insertAtCaret(document.getElementById('artikel_schema'),document.getElementById('txt').value);">toc</span><a href='#' id="insert-faq">Indsæt FAQ</a></span><br />
	<textarea name="artikel_schema" id="artikel_schema" rows="2"><?php echo $artikel_schema; ?></textarea>
	</p>
	
	<p>Offentlig<br /><input type="text" name="public" placeholder="Offentlig?" value="<?php echo $public; ?>" /></p>
	
	<p><input type="submit" name="submit" value="Tilføj hund" /></p>
</form>
<style>
				.SearchBarWrap {
					position: relative;
					display: inline-block;
				}
					.SearchLogo {
						width: -moz-calc(100% - 40px);
						width: -webkit-calc(100% - 40px);
						width: -o-calc(100% - 40px);
						width: calc(100% - 40px);
						height: 100px;
						background: url("../images/logo.png") center center no-repeat;
						margin: 0 20px;
						background-size: 300px;
					}
					.SearchBar {
						width: -moz-calc(100% - 62px);
						width: -webkit-calc(100% - 62px);
						width: -o-calc(100% - 62px);
						width: calc(100% - 62px);
						padding: 15px 30px;
						margin: 10px 0 0 0;
						/*box-shadow: 0 0 8px #e2e2e2;*/
						font-size: 1.500em;
						border-radius: 5px 5px 0 0;
					}
					.sSearchBarResults {
					  display: none;
					  position: absolute;
					  background-color: #fff;
					  min-width: 160px;
					  max-width: 252px;
					  z-index: 1;
					  border-right: 1px solid #e2e2e2;
					  border-bottom: 1px solid #e2e2e2;
					  border-left: 1px solid #e2e2e2;
					  margin: 0 0 0 20px;
					}
					.SearchBarResults {
						display: none;
						width: -moz-calc(100% - 42px);
						width: -webkit-calc(100% - 42px);
						width: -o-calc(100% - 42px);
						width: calc(100% - 42px);
						border: 1px solid #e2e2e2;
						padding: 20px;
						float: left;
						overflow:auto;
						height: calc(100vh - 150px);
					}
						a.SearchBarResultUnitWrap:link,a.SearchBarResultUnitWrap:visited,a.SearchBarResultUnitWrap:active {
							width: 100%;
							border-bottom: 1px solid #e2e2e2;
							text-decoration: none;
						}
							a.SearchBarResultUnitWrap:hover {
								background: #f9f9f9;
							}
							.SearchBarResultUnitName {
								width: 200px;
								height: auto;
								color: #333;
								padding: 15px 0 15px 10px;
							}
							.SearchBarUnitFlag {
								width: 32px;
								height: 20px;
								position: relative;
								padding: 15px 0 0 0;
							}
								.SearchBarUnitFlag img {
									position: absolute;
									bottom: 0;
									right: 0;
									width: 30px;
									height: 18px;
									border: 1px solid #e2e2e2;
								}
</style>

<div style="width: 400px; float: right; margin: 27px 0 0 0; position: relative; height: 10000px;">
	<p><strong>Nuværende tags</strong></p>
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
				echo "<p>- ".$T_tag_name."</p>";
			}
		}
	?>
	<hr />
	<p><strong>Tilføj tag</strong></p>
	<form class="AdminWrap" method="post">
		<p><select name="tag_name">
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
		</select></p>
		<p><input type="submit" name="add_tag" value="Tilføj tag" /></p>
	</form>
	<hr />
	<div style="position: -webkit-sticky;position: sticky;top: 70px;">
		<input id="searchBox" class="SearchBar BorderFull" type="text" placeholder="Søg efter et billede" />
		<div class="SearchBarResults DisplayNone" id="result"></div>
	</div>
		<textarea id="txt" style="display: none;">YEAH</textarea>
    <script>
				//Indsæt Table of Contents
function insertAtCaret(element, text) {
  if (document.selection) {
    element.focus({preventScroll: true});
    var sel = document.selection.createRange();
    sel.text = text;
    element.focus({preventScroll: true});
  } else if (element.selectionStart || element.selectionStart === 0) {
    var startPos = element.selectionStart;
    var endPos = element.selectionEnd;
    var scrollTop = element.scrollTop;
    element.value = element.value.substring(0, startPos) +
      text + element.value.substring(endPos, element.value.length);
    element.focus({preventScroll: true});
    element.selectionStart = startPos + text.length;
    element.selectionEnd = startPos + text.length;
    element.scrollTop = scrollTop;
  } else {
    element.value += text;
    element.focus({preventScroll: true});
  }
}
        $(document).ready(function(){
			
			
			
			
			
			$("#btn").on('click', function(event) {
				event.preventDefault();
			   var caretPos =document.getElementById("artikel_schema").selectionStart;
			   var caretEnd = document.getElementById("artikel_schema").selectionEnd;
			   var textAreaTxt = $("#artikel_schema").val();
			   var txtToAdd = "stuff";
			   
			   $("#artikel_schema").val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring( caretEnd ) );
			   
			   $('#artikel_schema').focus();
			   document.getElementById('artikel_schema').selectionStart = caretPos + txtToAdd.length
			   document.getElementById('artikel_schema').selectionEnd = caretPos + txtToAdd.length
			   
			});

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
								alert('GEMT');
							}
						});
					}
				}
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
            $('#searchBox').keyup(function(){   
                var query = $('#searchBox').val();
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
			//If clicked outside resultbox
			// $(document).mouseup(function(e) {
				// var container = $("#searchBox,#result");
				// if (!container.is(e.target) && container.has(e.target).length === 0) 
				// {
					// $("#result").hide();
				// }
			// });
			//If clicked on searchbox
			$("#searchBox").click(function(event) {
				event.preventDefault();
				var queryVal = $('#searchBox').val();
				if(queryVal.length>1){
					$("#result").show();
				}
			});
        });
		
    $('.lol').click(function(){
		$(this).select(); 
    });
    </script>
</div>

<script src='js/autosize.min.js'></script>
<script>
	$(document).ready(function() {
		autosize($('textarea'));
	});
</script>
</div>
</div>