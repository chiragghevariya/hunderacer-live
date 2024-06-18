<?php
// Build up DB connection including cofiguration file
require ("connect.php");
if(isset($_POST['search'])){
	$Characters = strlen($_POST['q']);
	if($Characters > 1) {
		$SearchString = "%".$_POST['q']."%";
		
		$query = "SELECT 
			g_id,
			title,
			tags,
			billede
				FROM
			new_gallery
				WHERE tags LIKE ? ORDER BY g_id DESC LIMIT 50";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param('s', $SearchString);
			$stmt->execute();
			$stmt->bind_result($p_id, $title, $tags, $billede);
			
			$stmt->store_result();
			$number_of_records = $stmt->num_rows;
			
			if($number_of_records == "0") {
				echo "<p style='text-align: center; padding: 0 15px;'>Intet match :(</p>";
			}
			else {
				//echo "<p>".$number_of_records." resultater</p>";
				while ($stmt->fetch()) {
?>
				<div class="admin-search-image-single-result">
					<div class="admin-search-image-single-result-image-wrap">
						<img src='gallery_296/<?php echo $billede; ?>' />
						<a class="admin-search-image-single-result-image-add-btn" href="javascript:void(0);" onclick="javascript:bbcoderImage('IMGDirect','<?php echo $title; ?>','<?php echo $billede; ?>')">+</a>
					</div>
					
					<p class="admin-search-image-single-result-title"><?php echo $title; ?></p>
					<input class="admin-search-image-select" type="text" readonly="readonly" value="<?php echo $billede; ?>" />
				</div>
<?php
				}
			}
			
			$stmt->close();
		}
	}
}
?>
<script>
$( document ).ready(function() {
    $('.admin-search-image-select').click(function(){
		$(this).select(); 
    });
});
</script>

<script>
function bbcoderImage(code, alt_text, the_image) {
  try {
    var old = "";
    var textarea = document.getElementsByName("artikel")[0];
    var value = textarea.value;
    var startPos = textarea.selectionStart;
    var endPos = textarea.selectionEnd;
    var selectedText = value.substring(startPos, endPos);

    switch (code) {
      case 'IMGDirect':
        bbimgdirect(textarea, value, startPos, endPos, selectedText, alt_text, the_image);
        break;
      default:
        alert('Invalid argument');
        break;
    }
  } catch (e) {
    alert(e.toString());
  }

}

//INDSÆT BILLEDE DIRECTE
function bbimgdirect(textarea, value, startPos, endPos, selectedText, alt_text, the_image) {
  textarea.value = value.replaceBetween(startPos, endPos, "[img alt=" + alt_text + "]" + the_image + "[/img]");
  textarea.focus({preventScroll: true});
  //+16 fordi der er 16 karakterer til følgende: [img alt=][/img] og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + the_image.length + alt_text.length + 16;
}
</script>