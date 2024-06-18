<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>

<div class="AdminWrap">
	<form method="post" id="form" action="king-kong-dog-gallery-check.php" enctype="multipart/form-data" style="padding: 0 0 20px 0; margin: 0 0 20px 0; border-bottom: 1px solid #e2e2e2;">
		<p>Upload nyt billede til galleri</p>
		<p><input type="text" name="picture_name" id="picture_name" placeholder="Billedets navn" /></p>
		<p><input type="text" name="picture_tags" id="picture_tags" placeholder="Tags til billedet" /></p>
		<p><input type="file" name="fileToUpload" id="fileToUpload"></p>
		<p><input type="submit" value="Upload billede" name="submit_picture" /></p>
	</form>
	
	<?php
		$queryGG = "SELECT 
			g_id, 
			title,
			billede
			FROM gallery ORDER BY g_id DESC";
		if ($stmtGG = $con->prepare($queryGG)) {

			/* execute statement */
			$stmtGG->execute();

			/* bind result variables */
			$stmtGG->bind_result($g_id, $title, $billede);
			
			/* fetch values */
			while ($stmtGG->fetch()) {
	?>
				<div style="position: relative;border: 1px solid #e2e2e2; float: left; border-radius: 5px; width: 300px; height: 340px; margin: 0 20px 20px 0;">
					<img src='gallery_images_small/<?php echo $billede; ?>' style="border-radius: 5px 5px 0 0;" />
					<input class="lol" onclick="myFunction()" type="text" readonly="readonly" value="<?php echo $billede; ?>" style="border: 0; height: 40px; position: absolute; bottom: 0; left: 0;" />
				</div>
	<?php
			}
		}
	?>
</div>

<script>
	
	$("#form").submit(function(){
		var title = $("#picture_name").val();
		if(title.length<2) {
			$("#picture_name").css("border-color", "#eb5155");
			$("#picture_name").focus();
			return false;
		}
		else {
			return true;
		}
	});
});
</script>
</div>
</div>