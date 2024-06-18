<div class="layout-wrapper">
	<div class="layout-content">
	
		<?php
			include ("king-kong-dog-include-check.php");
			include ("connect.php");
		?>
		<div class="AdminWrap">
			<div style="width: 400px;" class="FloatLeft">
				<p>Liste med artikler</p>
				
				<?php
					$queryGG = "SELECT 
						a_id, title
						FROM articles";
					if ($stmtGG = $con->prepare($queryGG)) {

						/* execute statement */
						$stmtGG->execute();

						/* bind result variables */
						$stmtGG->bind_result($a_id, $title);
						
						/* fetch values */
						while ($stmtGG->fetch()) {
							echo "<p><a href='index.php?page=testedit_article&id=".$a_id."'>".$title."</a></p>";
						}
					}
				?>
			</div>

			<div style="width: 358px; border: 1px solid #e2e2e2; border-radius: 5px; padding: 20px;" class="FloatRight">
				<form method="post" action="king-kong-dog-checkarticle.php" enctype="multipart/form-data">
					<p>Ny artikel</p>
					<p><input type="text" name="article_title" placeholder="Titel" /></p>
					<p><input type="submit" value="Opret artikel" name="submit_article" /></p>
				</form>
			</div>
		</div>
	</div>
</div>