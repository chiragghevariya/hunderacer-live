<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>

<div class="AdminWrap">
	<div class="width-100 float-left" style="padding: 0 0 20px 0; margin: 0 0 20px 0; border-bottom: 1px solid #e2e2e2;">
		<div style="width: 500px; margin: 0 50px 0 0; float: left;">
			<form method="post" id="form" action="king-kong-dog-gallery-check.php" enctype="multipart/form-data">
				<p>Upload nyt billede til galleri</p>
				<p><input type="text" name="picture_name" id="picture_name" placeholder="Billedets navn" /></p>
				<p><textarea rows="1" name="picture_tags" id="picture_tags" placeholder="Tags til billedet"></textarea></p>
				<p><input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);" /></p>
				<p><input type="submit" value="Upload billede" name="submit_picture" /></p>
			</form>
		</div>
		<div style="width: 650px; float: left;">
			<label for="fileToUpload">
				<img id="blah" src="images/upload.svg" alt="your image" width="200" style="display: block; margin: 0 auto;" />
			</label>
		</div>
	</div>
	
	<?php
		$queryGG = "SELECT 
			g_id, 
			title,
			billede
			FROM new_gallery ORDER BY g_id DESC";
		if ($stmtGG = $con->prepare($queryGG)) {

			/* execute statement */
			$stmtGG->execute();

			/* bind result variables */
			$stmtGG->bind_result($g_id, $title, $billede);
			
			/* fetch values */
			while ($stmtGG->fetch()) {
	?>
				<div style="width: 25%; float: left;">
					<div style="border: 1px solid #e2e2e2; float: left; margin: 10px;padding: 10px;  border-radius: 5px;">
						<img loading="lazy" src='gallery_296/<?php echo $billede; ?>' style="width: 100%; height: 250px; border-radius: 5px; object-fit: cover;" />
						<input type="text" readonly="readonly" value="<?php echo $billede; ?>" style="border: 0; height: 40px; width: 100%; float: left;" />
					</div>
				</div>
				
				
				
				<!--<div style="position: relative;border: 1px solid #e2e2e2; float: left; border-radius: 5px; width: 300px; height: 340px; margin: 0 20px 20px 0;">
					<img src='gallery_296/<?php echo $billede; ?>' width="298" height="160" style="border-radius: 5px 5px 0 0; object-fit: cover;" />
					<input type="text" readonly="readonly" value="<?php echo $billede; ?>" style="border: 0; height: 40px; position: absolute; bottom: 0; left: 0;" />
				</div>-->
	<?php
			}
		}
	?>
</div>

<script src='js/autosize.min.js'></script>
<script>
$(document).ready(function() {
	autosize($('#picture_tags'));
	
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

     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(650)
                        .height(auto);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</div>
</div>