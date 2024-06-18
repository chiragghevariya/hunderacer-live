<?php
	include ("connect.php");
	
	if($_GET['id']) {
		$p_id 				= addslashes($_GET['id']);
		
		$title 				= $_POST['page_title'];
		$meta_description 	= $_POST['page_short_description'];
		$linktitle 			= $_POST['page_linktitle'];
		$article 			= $_POST['page_article'];
		$public 			= $_POST['page_public'];
		$readmore 			= $_POST['page_readmore'];
		
		$stmtUpdate = $con->prepare("UPDATE pages SET title = ?, meta_description = ?, linktitle = ?, article = ?, public = ?, readmore = ?
		   WHERE p_id = ?");
		$stmtUpdate->bind_param('sssssss', $title, $meta_description, $linktitle, $article, $public, $readmore,  $p_id);
		$stmtUpdate->execute(); 
		$stmtUpdate->close();
		
		header('Location: index.php?page=king-kong-edit-page&id='.$p_id);
	}
	else {
		$title 				= $_POST['page_title'];
		
		$stmt = $con->prepare("INSERT INTO pages (title) VALUES (?)");
		$stmt->bind_param("s", $title);
		$stmt->execute();  
		$lastId = $con->insert_id;
		$stmt->close();
		
		header('Location: index.php?page=king-kong-edit-page&id='.$lastId);
	}
?>