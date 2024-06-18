<?php
	include ("connect.php");
	
	if(isset($_GET['id'])) {
		$t_id 				= addslashes($_GET['id']);
		
		$title 				= $_POST['tag_title'];
		$meta_description 	= $_POST['tag_short_description'];
		$linktitle 			= $_POST['tag_linktitle'];
		$article 			= $_POST['tag_article'];
		if(isset($_POST['tag_readmore'])) {
		    $readmore 		= $_POST['tag_readmore'];
		}
		else {
		     $readmore 		= "0";
		}
		
		$stmtUpdate = $con->prepare("UPDATE tags SET tag_name = ?, meta_description = ?, linktitle = ?, article = ?, readmore = ?
		   WHERE t_id = ?");
		$stmtUpdate->bind_param('ssssss', $title, $meta_description, $linktitle, $article, $readmore, $t_id);
		$stmtUpdate->execute(); 
		$stmtUpdate->close();
		
		header('Location: index.php?page=king-kong-edit-tag&id='.$t_id);
	}
	else {
		$title 				= $_POST['tag_title'];
		
		$stmt = $con->prepare("INSERT INTO tags (tag_name) VALUES (?)");
		$stmt->bind_param("s", $title);
		$stmt->execute();  
		$lastId = $con->insert_id;
		$stmt->close();
		
		header('Location: index.php?page=king-kong-edit-tag&id='.$lastId);
	}
?>