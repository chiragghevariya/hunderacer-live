<?php
	include ("king-kong-dog-include-check.php");
?>
<?php
	include ("connect.php");
	
	$get_h_id = $_GET['id'];
	
	if(isset($_POST['submit'])) {
		
		$postcomment = $_POST['kommentar'];
		
		$stmtUpdate = $con->prepare("UPDATE egenskaber SET kommentar = ?, oversat = '1'
		   WHERE e_id = ?");
		$stmtUpdate->bind_param('ss', $postcomment, $_POST['theid']);
		$stmtUpdate->execute(); 
		$stmtUpdate->close();
	}
	
		// 1 = Gøen
		// 2 = God til lejligheder
		// 3 = Kattevenlig
		// 4 = Børnevenlig
		// 5 = Hundevenlig
		// 6 = venlig mod fremmede
		// 7 = Motionsbehov
		// 8 = pelspleje
		// 9 = Intelligents
		//10 = Fældning
		//11 = Træning
		//12 = legelyst
	
	//GØEN
	$query = "SELECT 
		e_id,
		egenskab,
		antal_poter,
		kommentar
			FROM
		egenskaber
			WHERE h_id=? AND oversat = '0' ORDER BY e_id ASC LIMIT 1";
	if ($stmt = $con->prepare($query)) {
		
		$stmt->bind_param('s', $get_h_id);

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($e_id, $egen_id, $antal_poter, $kommentar);

		/* fetch values */
		$stmt->fetch();				

		/* close statement */
		$stmt->close();
		
		if($egen_id == 1) {
			$Egenskab = "Gøen";
		}
		if($egen_id == 2) {
			$Egenskab = "God til lejligheder";
		}
		if($egen_id == 3) {
			$Egenskab = "Kattevenlig";
		}
		if($egen_id == 4) {
			$Egenskab = "Børnevenlig";
		}
		if($egen_id == 5) {
			$Egenskab = "Hundevenlig";
		}
		if($egen_id == 6) {
			$Egenskab = "Venlig mod fremmede";
		}
		if($egen_id == 7) {
			$Egenskab = "Motionsbehov";
		}
		if($egen_id == 8) {
			$Egenskab = "Pelspleje";
		}
		if($egen_id == 9) {
			$Egenskab = "Intelligents";
		}
		if($egen_id == 10) {
			$Egenskab = "Fældning";
		}
		if($egen_id == 11) {
			$Egenskab = "Træning";
		}
		if($egen_id == 12) {
			$Egenskab = "Legelyst";
		}
		
	}
?>
<form method="post" action="" class="WidthHundred FloatLeft AdminWrap">
	<div class="WidthHalf">
		<p><span class="Bold"><?php echo $Egenskab." - ".$antal_poter; ?></span><br /><?php echo $kommentar; ?></p>
		<input type="hidden" name="theid" value="<?php echo $e_id; ?>" />
		<p><textarea name="kommentar"></textarea></p>
		<p><input type="submit" name="submit" value="Opdater" class="SubmitBtn BorderRound" /></p>
	</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='js/autosize.min.js'></script>
<script>
	$(document).ready(function() {
		autosize($('textarea'));
	});
</script>