<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>
<div class="AdminWrap">
	<form method="post" action="" enctype="multipart/form-data">
		<p>Søg efter nøgleord</p>
		<p><input type="text" name="keyword" placeholder="Nøgleord" value="" /></p>
		<p><input type="submit" value="Søg efter nøgleord" name="submit_keyword" /></p>
	</form>
	
	<?php
		if(isset($_POST['submit_keyword']) || isset($_GET['keyword'])) {
			if(isset($_GET['keyword'])) {
				$keyword = $_GET['keyword'];
			}
			else if($_POST['keyword']) {
				$keyword = $_POST['keyword'];
			}
			$like_keyword = "%".$keyword."%";
	?>
			<!--HUNDERACER-->
			<div style="width: 400px;" class="FloatLeft">
				<p><strong>Hunderacer med dette nøgleord</strong></p>
				
				<?php				
					$queryGG = "SELECT 
						h_id,
						hunderace,
						artikel
							FROM hunde
						WHERE artikel LIKE ?
						ORDER BY h_id DESC";
					if ($stmtGG = $con->prepare($queryGG)) {

						$stmtGG->bind_param('s', $like_keyword);
					
						/* execute statement */
						$stmtGG->execute();

						/* bind result variables */
						$stmtGG->bind_result($h_id, $hunderace, $artikel);
						
						/* fetch values */
						while ($stmtGG->fetch()) {
							echo "<p><a target='_blank' href='index.php?page=testedit&id=".$h_id."'>".$hunderace."</a></p>";
						}
					}
				?>
			</div>
			
			<!--ARTIKLER-->
			<div style="width: 400px;" class="FloatLeft">
				<p><strong>Artikler med dette nøgleord</strong></p>
				
				<?php				
					$queryGG = "SELECT 
						a_id,
						title,
						article
							FROM articles
						WHERE article LIKE ?
						ORDER BY a_id DESC";
					if ($stmtGG = $con->prepare($queryGG)) {

						$stmtGG->bind_param('s', $like_keyword);
					
						/* execute statement */
						$stmtGG->execute();

						/* bind result variables */
						$stmtGG->bind_result($a_id, $a_title, $a_article);
						
						/* fetch values */
						while ($stmtGG->fetch()) {
							echo "<p><a target='_blank' href='index.php?page=testedit_article&id=".$a_id."'>".$a_title."</a></p>";
						}
					}
				?>
			</div>
			
			<!--TAGS-->
			<div style="width: 400px;" class="FloatLeft">
				<p><strong>Tags med dette nøgleord</strong></p>
				
				<?php				
					$queryGG = "SELECT 
						t_id,
						tag_name,
						article
							FROM tags
						WHERE article LIKE ?
						ORDER BY t_id DESC";
					if ($stmtGG = $con->prepare($queryGG)) {

						$stmtGG->bind_param('s', $like_keyword);
					
						/* execute statement */
						$stmtGG->execute();

						/* bind result variables */
						$stmtGG->bind_result($t_id, $t_tag_name, $t_article);
						
						/* fetch values */
						while ($stmtGG->fetch()) {
							echo "<p><a target='_blank' href='index.php?page=king-kong-edit-tag&id=".$t_id."'>".$t_tag_name."</a></p>";
						}
					}
				?>
			</div>
	<?php
		}
	?>
</div>
</div>
</div>