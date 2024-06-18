<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
?>

<?php
	include ("connect.php");
	
	$get_t_id = $_GET['id'];
	
	//HENT HUND
	$query = "SELECT 
		tag_name,
		meta_description,
		linktitle,
		article,
		readmore
			FROM
		tags
			WHERE t_id=?";
	if ($stmt = $con->prepare($query)) {
		
		$stmt->bind_param('s', $get_t_id);

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($tag_name,
		$meta_description,
		$linktitle,
		$article,
		$readmore
		);

		/* fetch values */
		$stmt->fetch();				

		/* close statement */
		$stmt->close();
	}
?>

<form style="width: 700px; float: left;" class="AdminWrap" method="post" action="king-kong-dog-checktag.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
	<p>
		Titel på side<br />
		<input type="text" name="tag_title" placeholder="Titlen på siden" value="<?php echo $tag_name; ?>" />
	</p>
	<p>
		Kort intro / meta beskrivelse<br />
		<textarea name="tag_short_description" rows="5" placeholder="Kort intro"><?php echo $meta_description; ?></textarea>
	</p>
	<p>
		Linktitel<br />
		<input type="text" name="tag_linktitle" placeholder="Eksempelvis: hunde-elsker-mad" value="<?php echo $linktitle; ?>" />
	</p>
	<p>
		Tekst på side<br />
		<label for="tag_readmore">Læs mere?</label> <input name="tag_readmore" type="checkbox" value="1" <?php if($readmore == "1") { echo "checked"; } ?> />
		<textarea name="tag_article" rows="20" placeholder="Skriv din tekst"><?php echo $article; ?></textarea>
	</p>
	<p><input type="submit" name="submit" value="Opdatér side" /></p>
</form>

<script src='js/autosize.min.js'></script>
<script>
	$(document).ready(function() {
		autosize($('textarea'));
	});
</script>
</div>
</div>