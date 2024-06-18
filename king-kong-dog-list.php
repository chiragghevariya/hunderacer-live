<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
?>

<style>
	a.sortlink:link,a.sortlink:visited,a.sortlink:active,a.sortlink:hover {
		border: 0;
		text-decoration: none;
		display: block;
		height: 20px;
		width: 20px;
		background: url("images/down.svg") center center no-repeat;
		background-size: 14px;
		float: left;
		margin: 0 0 0 10px;
	}
	a.admLinkBtn:link,a.admLinkBtn:visited,a.admLinkBtn:active {
		border: 0;
		text-decoration: none;
		width: 30px;
		height: 30px;
		display: block;
		float: left;
	}
		a.admLinkBtn:hover {
			background-color: #e2e2e2;
			border-radius: 5px;
		}
		.admLinkEdit {
			background: url("images/_edit.svg") center center no-repeat;
			background-size: 14px;
		}
		.admLinkTranslate {
			background: url("images/_translate.svg") center center no-repeat;
			background-size: 14px;
		}
		.admLinkKeyword {
			background: url("images/_keyword.svg") center center no-repeat;
			background-size: 14px;
		}
</style>


<div class="WidthHundred FloatLeft" style="padding: 0 0 10px 0; margin: 0 0 10px 0; border-bottom: 1px solid #e2e2e2;">
	<div style="width: 20%; float: left;"><strong>Rediger</strong></div>
	<div style="width: 40%; float: left;"><div class="FloatLeft"><strong>Navn</strong></div><a class="sortlink" href="index.php?page=king-kong-dog-list&sort=name"></a></div>
	<div style="width: 20%; float: left;"><div class="FloatLeft"><strong>Ord</strong></div><a class="sortlink" href="index.php?page=king-kong-dog-list&sort=words"></a></div>
	<div style="width: 20%; float: left;"><div class="FloatLeft"><strong>Søgninger</strong></div><a class="sortlink" href="index.php?page=king-kong-dog-list&sort=searches"></a></div>
</div>
<?php
	if(isset($_GET['sort'])) {
		if($_GET['sort'] == "words") {
			$OrderBY = "ORDER BY h.words DESC";
		}
		else if($_GET['sort'] == "searches") {
			$OrderBY = "ORDER BY h.monthly_searches DESC";
		}
		else {
			$OrderBY = "ORDER BY h.hunderace ASC";
		}
	}
	else {
		$OrderBY = "ORDER BY h.hunderace ASC";
	}

	$i = 1;
	include ("connect.php");
	$queryGDL = "SELECT
		h.h_id,
		h.hunderace,
		h.hunderace_engelsk,
		h.hunderace_fci,
		h.allergivenlig,
		h.levetid,
		h.oprindelse,
		h.oprindelse_two,
		h.billede_headshot,
		h.linktitel AS Hlinktitel,
		h.ulovlig,
		h.public,
		h.words,
		h.monthly_searches,
		h.images_added,
		c1.l_id AS l_id_one,
		c1.navn AS landenavn_one,
		c1.linktitel AS Clinktitel_one,
		c2.l_id AS l_id_two,
		c2.navn AS landenavn_two,
		c2.linktitel AS Clinktitel_two
			FROM hunde AS h
		INNER JOIN 
			lande AS c1 on c1.l_id = h.oprindelse
		INNER JOIN
			lande AS c2 on c2.l_id = h.oprindelse_two
			
			
	"." ".$OrderBY;
		
	if ($stmtGDL = $con->prepare($queryGDL)) {
		/* execute statement */
		$stmtGDL->execute();

		/* bind result variables */
		$stmtGDL->bind_result($h_id, $hunderace, $hunderace_engelsk, $hunderace_fci, $allergivenlig, $levetid, $oprindelse, $oprindelse_two, $billede_headshot, $Hlinktitel, $ulovlig, $public, $words, $monthly_searches, $images_added, $l_id_one, $landenavn_one, $Clinktitel_one, $l_id_two, $landenavn_two, $Clinktitel_two);
		
		/* fetch values */
		while ($stmtGDL->fetch()) {
			//Allergivenlig?
			if($allergivenlig == "Ja") {
				$allergivenlig = "Ja";
			}
			else {
				$allergivenlig = "Nej";
			}
			//2 Oprindelseslande?
			if($oprindelse_two != "0") {
				$oprindelse = $landenavn_one.", ".$landenavn_two;
			}
			else {
				$oprindelse = $landenavn_one;
			}
			
			if($public == "1") {
				$DotOnline = "<div style='margin: 10px 20px 0 0; width:10px; height: 10px; border-radius: 50px; float: left; background: darkgreen;'></div>";
			}
			else {
				$DotOnline = "<div style='margin: 10px 20px 0 0; width:10px; height: 10px; border-radius: 50px; float: left; background: darkred;'></div>";
			}

?>

<div class="WidthHundred FloatLeft" style="padding: 0 0 10px 0; margin: 0 0 10px 0; border-bottom: 1px solid #e2e2e2;">
	<div style="width: 20%; float: left;">
		<a class="admLinkBtn admLinkEdit" href="index.php?page=testedit&id=<?php echo $h_id; ?>"></a>
		<a class="admLinkBtn admLinkKeyword" href="index.php?page=king-kong-dog-keywords&keyword=<?php echo $hunderace; ?>"></a>

	</div>
	<div style="width: 40%; float: left; line-height: 30px;"><span style="display: block; float: left;"><?php echo $DotOnline; ?> <?php echo $hunderace; ?></span><a href="<?php echo $Hlinktitel; ?>" target="_blank"><span style="display: block; float: left; width: 12px; height: 12px; background: url('images/ekstern-link.svg') center center no-repeat; background-size: 12px; margin: 10px 0 0 5px;"></span></a> <span style="display: block; float: right; width: 20px; height: 20px; background: url('images/image.svg') center center no-repeat; background-size: 20px; margin: 7px 20px 0 0; position: relative;"><span style="width: 12px; height: 12px; display: block; position: absolute; top: -2px; right: -2px; background: url('images/<?php if($images_added == "1") { echo "checkmark.svg"; } else { echo "red-x.svg"; }?>') center center no-repeat; background-size: 12px;"></span></span></div>
	<div style="width: 20%; float: left; line-height: 30px;"><?php echo number_format($words,0,",","."); ?></div>
	<div style="width: 20%; float: left; line-height: 30px;"><?php echo number_format($monthly_searches,0,",","."); ?></div>
</div>
<!--
<p><a href="index.php?page=king-kong-dog-edit&id=<?php echo $h_id; ?>">Rediger</a> - <a href="index.php?page=king-kong-dog-translate&id=<?php echo $h_id; ?>">Oversæt</a> - <?php echo $hunderace; ?> - <?php echo $monthly_searches; ?></p>
-->
<?php
			$i++;
		}
	}
?>
</div>
</div>