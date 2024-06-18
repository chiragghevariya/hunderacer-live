<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>
<div class="AdminWrap">
	<div style="width: 400px;" class="FloatLeft">
		<p>Liste med tags</p>
		
		<?php
			$queryGG = "SELECT 
				t_id,
				tag_name
				FROM tags
				ORDER BY t_id DESC";
			if ($stmtGG = $con->prepare($queryGG)) {

				/* execute statement */
				$stmtGG->execute();

				/* bind result variables */
				$stmtGG->bind_result($t_id, $tag);
				
				/* fetch values */
				while ($stmtGG->fetch()) {
					echo "<p><a href='index.php?page=king-kong-edit-tag&id=".$t_id."'>".$tag."</a></p>";
				}
			}
		?>
	</div>

	<div style="width: 358px; border: 1px solid #e2e2e2; border-radius: 5px; padding: 20px;" class="FloatRight">
		<form method="post" action="king-kong-dog-checktag.php" enctype="multipart/form-data">
			<p>Nyt tag</p>
			<p><input type="text" name="tag_title" placeholder="Titel på tag" value="" /></p>
			<p><input type="submit" value="Opret tag" name="submit_tag" /></p>
		</form>
	</div>
</div>
</div>
</div>