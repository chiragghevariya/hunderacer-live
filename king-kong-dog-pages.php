<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>
<div class="AdminWrap">
	<div style="width: 400px;" class="FloatLeft">
		<p>Liste med sider</p>
		
		<?php
			$queryGG = "SELECT 
				p_id, title
				FROM pages";
			if ($stmtGG = $con->prepare($queryGG)) {

				/* execute statement */
				$stmtGG->execute();

				/* bind result variables */
				$stmtGG->bind_result($p_id, $title);
				
				/* fetch values */
				while ($stmtGG->fetch()) {
					echo "<p><a href='index.php?page=king-kong-edit-page&id=".$p_id."'>".$title."</a></p>";
				}
			}
		?>
	</div>

	<div style="width: 358px; border: 1px solid #e2e2e2; border-radius: 5px; padding: 20px;" class="FloatRight">
		<form method="post" action="king-kong-dog-checkpage.php" enctype="multipart/form-data">
			<p>Ny side</p>
			<p><input type="text" name="page_title" placeholder="Titel" value="" /></p>
			<p><input type="submit" value="Opret side" name="submit_page" /></p>
		</form>
	</div>
</div>
</div>
</div>