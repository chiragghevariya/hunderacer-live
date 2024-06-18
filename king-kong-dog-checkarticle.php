<?php
	include ("connect.php");
	
	if($_GET['id']) {
		$a_id 				= addslashes($_GET['id']);
		
		$title 				= $_POST['article_title'];
		$cover 				= $_POST['article_cover'];
		$meta_description 	= $_POST['article_short_description'];
		$linktitle 			= $_POST['article_linktitle'];
		$toc 				= $_POST['article_toc'];
		$article 			= $_POST['artikel'];
		$public 			= $_POST['article_public'];
		$timestamp			= time();
		
		function wpautop($pee, $br = 1) {
			$pee = $pee . "\n"; // just to make things a little easier, pad the end
			$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
			// Space things out a little
			$allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
			$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
			$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
			$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
			$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
			$pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
			$pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
			$pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
			$pee = preg_replace( '|<p>|', "$1<p>", $pee );
			$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
			$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
			$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
			$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
			$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
			$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
			if ($br) {
				$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			}
			$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
			$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
			$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
			return $pee;
		}
		
		$Submit_artikel	= wpautop($article);
		
		//TÆL ORD ARTIKEL
		$Submit_artikel_strip = strip_tags($_POST['artikel']);
		$Submit_artikel_strip = trim($Submit_artikel_strip);
		$Submit_artikel_Words = preg_replace('/[0-9,.]+/', '', $Submit_artikel_strip);
		$Submit_artikel_NumberOfWords = count(explode(' ', preg_replace('/\s+/', ' ', trim($Submit_artikel_Words))));
		
		//TÆL ORD INTRO
		$Submit_intro_strip = strip_tags($_POST['article_short_description']);
		$Submit_intro_strip = trim($Submit_intro_strip);
		$Submit_intro_Words = preg_replace('/[0-9,.]+/', '', $Submit_intro_strip);
		$Submit_intro_NumberOfWords = count(explode(' ', preg_replace('/\s+/', ' ', trim($Submit_intro_Words))));
		
		//ORD I ALT
		$WordsInTotal = ($Submit_intro_NumberOfWords+$Submit_artikel_NumberOfWords);
		
		$stmtUpdate = $con->prepare("UPDATE articles SET title = ?, meta_description = ?, linktitle = ?, toc = ?, article = ?, updated_timestamp = ?, cover = ?, words = ?, public = ?
		   WHERE a_id = ?");
		$stmtUpdate->bind_param('ssssssssss', $title, $meta_description, $linktitle, $toc, $Submit_artikel, $timestamp, $cover, $WordsInTotal, $public, $a_id);
		$stmtUpdate->execute(); 
		$stmtUpdate->close();
		
		header('Location: index.php?page=testedit_article&id='.$a_id);
	}
	else {
		$art_title 			= $_POST['article_title'];
							
		$stmt = $con->prepare("INSERT INTO articles (title) VALUES (?)");
		$stmt->bind_param("s", $art_title);
		$stmt->execute();  
		$lastId = $con->insert_id;
		$stmt->close();
				
		header('Location: index.php?page=testedit_article&id='.$lastId);
		}
?>