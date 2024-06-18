<!--<p class='admin-search-header'>Tags <img src='images/down.svg' /></p>
<p class='admin-search-header'>Artikler <img src='images/down.svg' /></p>-->
<?php
// Build up DB connection including cofiguration file
require ("connect.php");
if(isset($_POST['search'])){
	$Characters = strlen($_POST['q']);
	if($Characters > 1) {
		$SearchString = $_POST['q'];
		
		$SearchStringFull = "%".$SearchString."%";
		$SearchStringFirst = $SearchString."%";
		$SearchStringLast = "%".$SearchString;
		
		$Public = "1";
		
		//VI SØGER EFTER TAGS
		$query = "SELECT 
			tag_name,
			linktitle
				FROM
			tags
				WHERE (tag_name LIKE ?) AND public = ?
				ORDER BY 			 
				CASE
				WHEN (tag_name LIKE ?) THEN 1
				WHEN (tag_name LIKE ?) THEN 3
				ELSE 2 END LIMIT 50";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param('ssss', $SearchStringFull, $Public, $SearchStringFirst, $SearchStringLast);
			$stmt->execute();
			$stmt->bind_result($tag_name, $linktitel);
			
			$stmt->store_result();
			$number_of_records = $stmt->num_rows;
			
			echo "<p class='admin-search-header admin-tag-header'>Tags (".$number_of_records.") <img src='images/down.svg' /></p>";
			echo "<div id='search-tag-wrapper'>";
			
			if($number_of_records == "0") {
				echo "<p style='text-align: center; padding: 0 15px; display: block; width: 100%; float: left;'>Intet match :(</p>";
			}
			else {
				//echo "<p>".$number_of_records." resultater</p>";
				while ($stmt->fetch()) {
?>
					<div class="admin-search-single-link-wrap" >
						<div class="admin-search-single-link-plus" onclick="javascript:bbcoderDirectLink('IMGDirectLink','tag/<?php echo $linktitel; ?>')">+</div>
						<a class="admin-search-link" href="javascript:void(0);" onclick="javascript:bbcoderDirectLink('IMGDirectLink','tag/<?php echo $linktitel; ?>')"><?php echo $tag_name; ?></a>
					</div>
<?php
				}
			}	
			$stmt->close();
		}
		echo "</div>";
		
		
		//VI SØGER EFTER ARTIKLER
		$query = "SELECT 
			title,
			meta_description,
			linktitle
				FROM
			articles
				WHERE (title LIKE ? OR meta_description LIKE ?) AND public = ?
				ORDER BY 			 
				CASE
				WHEN (title LIKE ? OR meta_description LIKE ?) THEN 1
				WHEN (title LIKE ? OR meta_description LIKE ?) THEN 3
				ELSE 2 END LIMIT 50";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param('sssssss', $SearchStringFull, $SearchStringFull, $Public, $SearchStringFirst, $SearchStringFirst, $SearchStringLast, $SearchStringLast);
			$stmt->execute();
			$stmt->bind_result($title, $meta_description, $linktitel);
			
			$stmt->store_result();
			$number_of_records = $stmt->num_rows;
			
			echo "<p class='admin-search-header admin-article-header'>Artikler (".$number_of_records.") <img src='images/down.svg' /></p>";
			echo "<div id='search-articles-wrapper'>";
			
			if($number_of_records == "0") {
				echo "<p style='text-align: center; padding: 0 15px; display: block; width: 100%; float: left;'>Intet match :(</p>";
			}
			else {
				//echo "<p>".$number_of_records." resultater</p>";
				while ($stmt->fetch()) {
?>
					<div class="admin-search-single-link-wrap" >
						<div class="admin-search-single-link-plus" onclick="javascript:bbcoderDirectLink('IMGDirectLink','artikel/<?php echo $linktitel; ?>')">+</div>
						<a class="admin-search-link" href="javascript:void(0);" onclick="javascript:bbcoderDirectLink('IMGDirectLink','artikel/<?php echo $linktitel; ?>')"><?php echo $title; ?></a>
					</div>
<?php
				}
			}	
			$stmt->close();
		}
		echo "</div>";
		
		
		//VI SØGER EFTER HUNDERACER
		$query = "SELECT 
			hunderace,
			linktitel
				FROM
			hunde
				WHERE (hunderace LIKE ? OR pagetitle LIKE ?) AND public = ?
				ORDER BY 			 
				CASE
				WHEN (hunderace LIKE ? OR pagetitle LIKE ?) THEN 1
				WHEN (hunderace LIKE ? OR pagetitle LIKE ?) THEN 3
				ELSE 2 END LIMIT 50";
		if ($stmt = $con->prepare($query)) {
			$stmt->bind_param('sssssss', $SearchStringFull, $SearchStringFull, $Public, $SearchStringFirst, $SearchStringFirst, $SearchStringLast, $SearchStringLast);
			$stmt->execute();
			$stmt->bind_result($hunderace, $linktitel);
			
			$stmt->store_result();
			$number_of_records = $stmt->num_rows;
			
			echo "<p class='admin-search-header admin-dogs-header'>Hunderacer  (".$number_of_records.") <img src='images/down.svg' /></p>";
			echo "<div id='search-dogs-wrapper'>";
			
			if($number_of_records == "0") {
				echo "<p style='text-align: center; padding: 0 15px; display: block; width: 100%; float: left;'>Intet match :(</p>";
			}
			else {
				//echo "<p>".$number_of_records." resultater</p>";
				while ($stmt->fetch()) {
?>
					<div class="admin-search-single-link-wrap" >
						<div class="admin-search-single-link-plus" onclick="javascript:bbcoderDirectLink('IMGDirectLink','<?php echo $linktitel; ?>')">+</div>
						<a class="admin-search-link" href="javascript:void(0);" onclick="javascript:bbcoderDirectLink('IMGDirectLink','<?php echo $linktitel; ?>')"><?php echo $hunderace; ?></a>
					</div>
<?php
				}
			}	
			$stmt->close();
		}
		echo "</div>";
	}
}
?>

<script>
$(document).ready(function() {
	$(".admin-tag-header").click(function() {
		$("#search-tag-wrapper").toggle();
	});
	$(".admin-article-header").click(function() {
		$("#search-articles-wrapper").toggle();
	});
	$(".admin-dogs-header").click(function() {
		$("#search-dogs-wrapper").toggle();
	});
});
</script>

<script>
function bbcoderDirectLink(code, linktitel) {
  try {
    var old = "";
    var textarea = document.getElementsByName("artikel")[0];
    var value = textarea.value;
    var startPos = textarea.selectionStart;
    var endPos = textarea.selectionEnd;
    var selectedText = value.substring(startPos, endPos);

    switch (code) {
      case 'IMGDirectLink':
        bbimgdirectlink(textarea, value, startPos, endPos, selectedText, linktitel);
        break;
      default:
        alert('Invalid argument');
        break;
    }
  } catch (e) {
    alert(e.toString());
  }

}

//INDSÆT LINK DIRECTE
function bbimgdirectlink(textarea, value, startPos, endPos, selectedText, linktitel) {
  textarea.value = value.replaceBetween(startPos, endPos, "<a href='"+linktitel+"'>" + selectedText + "</a>");
  textarea.focus({preventScroll: true});
  //+15 fordi der er 15 karakterer til følgende: <a href=''></a> og vi flytte cursoren til slutningen
  textarea.selectionEnd = startPos + selectedText.length + linktitel.length + 15;
}
</script>