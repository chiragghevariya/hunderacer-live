<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
	
	//HENT ANTAL ARTIKLER DER ER PUBLIC
	$queryPA = "SELECT 
		a_id
			FROM
		articles
			WHERE public='1'";
	if ($stmtPA = $con->prepare($queryPA)) {
		//$stmt->bind_param('s', $get_a_id);
		/* execute statement */
		$stmtPA->execute();
		$stmtPA->store_result();
		$antal_artikler_udgivet = $stmtPA->num_rows;
		/* bind result variables */
		$stmtPA->bind_result($a_id);
		/* fetch values */
		$stmtPA->fetch();				
		/* close statement */
		$stmtPA->close();
	}
	
	//HENT ANTAL HUNDERACER DER --ER-- PUBLIC
	$queryPD = "SELECT 
		h_id
			FROM
		hunde
			WHERE public='1'";
	if ($stmtPD = $con->prepare($queryPD)) {
		//$stmt->bind_param('s', $get_a_id);
		/* execute statement */
		$stmtPD->execute();
		$stmtPD->store_result();
		$antal_hunderacer_udgivet = $stmtPD->num_rows;
		/* bind result variables */
		$stmtPD->bind_result($a_id);
		/* fetch values */
		$stmtPD->fetch();				
		/* close statement */
		$stmtPD->close();
	}
	
	//HENT ANTAL HUNDERACER DER ER --IKKE-- PUBLIC
	$queryUPD = "SELECT 
		h_id
			FROM
		hunde
			WHERE public='0'";
	if ($stmtUPD = $con->prepare($queryUPD)) {
		//$stmt->bind_param('s', $get_a_id);
		/* execute statement */
		$stmtUPD->execute();
		$stmtUPD->store_result();
		$antal_hunderacer_ikke_udgivet = $stmtUPD->num_rows;
		/* bind result variables */
		$stmtUPD->bind_result($a_id);
		/* fetch values */
		$stmtUPD->fetch();				
		/* close statement */
		$stmtUPD->close();
	}

	/*****************************************************************/
	//Hent samlet antal ord for hunderacer
	$queryWordsDogs = "SELECT SUM(words) FROM hunde WHERE public='1'";
	if ($stmtWordsDogs = $con->prepare($queryWordsDogs)) {
		//$stmtWords->bind_param("s", $user);
		$stmtWordsDogs->execute();
		$stmtWordsDogs->bind_result($totalWordsDogs);

		$stmtWordsDogs->fetch();
		
		$stmtWordsDogs->close();
	}
	
	//Gennemsnit for ord per hunderace
	$averageWordsDogs = ($totalWordsDogs/$antal_hunderacer_udgivet);
	$averageWordsDogs = round($averageWordsDogs);
	
	/*****************************************************************/
	//Hent samlet antal ord for artikler
	$queryWordsArticles = "SELECT SUM(words) FROM articles WHERE public='1'";
	if ($stmtWordsArticles = $con->prepare($queryWordsArticles)) {
		//$stmtWords->bind_param("s", $user);
		$stmtWordsArticles->execute();
		$stmtWordsArticles->bind_result($totalWordsArticles);

		$stmtWordsArticles->fetch();
		
		$stmtWordsArticles->close();
	}
	
	//Gennemsnit for ord per artikel
	$averageWordsArticles = ($totalWordsArticles/$antal_artikler_udgivet);
	$averageWordsArticles = round($averageWordsArticles);
	
	/*****************************************************************/
	//ORD I ALT
	$WordsTotal = ($totalWordsDogs+$totalWordsArticles);
	//ORD I Gennemsnit
	$NumberOfContentPieces = ($antal_artikler_udgivet+$antal_hunderacer_udgivet);
	$WordsAverage = round($WordsTotal/$NumberOfContentPieces);
?>

<style>
	.WidthHundred {
		width: 100%;
	}
	.FloatLeft {
		float: left;
	}
	a.admin-menu-tab:link,a.admin-menu-tab:visited,a.admin-menu-tab:active,a.admin-menu-tab:hover {
		width: 148px;
		height: 98px;
		border: 1px solid #e2e2e2;
		text-align: center;
		line-height: 100px;
		margin: 0 20px 20px 0;
		border-radius: 5px;
		background: #f6f8fc;
		display: block;
		float: left;
		color: #222;
	}
	.AdminStats {
		width: 400px;
		padding: 20px;
		border-radius: 5px;
		background: #f6f8fc;
		border: 1px solid #e2e2e2;
	}
		.AdminStats p.borderYES {
			padding: 0 0 10px 0;
			margin: 0 0 10px 0;
			border-bottom: 1px solid #e2e2e2;
		}
		.AdminStats p.borderNO {
			margin: 0;
		}
</style>
<div class="WidthHundred FloatLeft" style="Margin: 0 0 20px 0;">
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-articles">Artikel-sektion</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-pages">Sider</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-list">Liste med hunde</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-new-gallery"><span class="bold">Nyt Galleri</span></a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-tags">Tags</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-keywords">Find nøgleord</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-search-queries">Søgetermer</a>
	<a class="admin-menu-tab" href="index.php?page=king-kong-dog-user-settings">Bruger indstillinger</a>
	<a class="admin-menu-tab" href="king-kong-dog-logout.php">Log ud</a>
</div>
<div class="WidthHundred AdminStats FloatLeft">
	<p class="borderYES"><strong>Hunderacer udgivet:</strong> <span style="float: right;"><?php echo $antal_hunderacer_udgivet." / ".$antal_hunderacer_ikke_udgivet; ?></span></p>
	<p class="borderYES"><strong>Artikler udgivet:</strong> <span style="float: right;"><?php echo $antal_artikler_udgivet; ?></span></p>
	<p class="borderYES"><strong>Ord udgivet (hunderacer):</strong> <span style="float: right;"><?php echo number_format($totalWordsDogs,0,",","."); ?> (<?php echo $averageWordsDogs; ?>)</span></p>
	<p class="borderYES"><strong>Ord udgivet (artikler):</strong> <span style="float: right;"><?php echo number_format($totalWordsArticles,0,",","."); ?> (<?php echo $averageWordsArticles; ?>)</span></p>
	<p class="borderNO"><strong>Ord udgivet i alt:</strong> <span style="float: right;"><?php echo number_format($WordsTotal,0,",","."); ?> (<?php echo $WordsAverage; ?>)</span></p>
</div>

	</div>
</div>
