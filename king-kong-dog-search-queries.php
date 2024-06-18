<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>

<div class="AdminWrap">
<h1>Seneste søgninger</h1>
	<ol>
<?php
	$queryGG = "SELECT 
		s_id,
		search_query
		FROM searches ORDER BY s_id DESC";
	if ($stmtGG = $con->prepare($queryGG)) {

		/* execute statement */
		$stmtGG->execute();

		/* bind result variables */
		$stmtGG->bind_result($s_id,
		$search_query);
		
		/* fetch values */
		while ($stmtGG->fetch()) {
			echo "<li>".$search_query."</li>";
		}
	}
?>
	</ol>
</div>
</div>