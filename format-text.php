<?php
	function FormatText ($string) {
		$actual_link_hashtag = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."#";
		
		//Billede
		$string 		= preg_replace(
								'/\[img alt=(.+?)\](.+?)\[\/img\]/', 
								'<figure class="figure-in-article"><img src="gallery_964/\2" alt="\1" height="300" width="964" decoding="async" loading="lazy" sizes="(min-width: 800px) 800px, calc(100vw - 48px)" class="dog-image" srcset="gallery_200/\2 200w, gallery_228/\2 228w, gallery_260/\2 260w, gallery_296/\2 296w, gallery_338/\2 338w, gallery_385/\2 385w, gallery_439/\2 439w, gallery_500/\2 500w, gallery_571/\2 571w, gallery_650/\2 650w, gallery_741/\2 741w, gallery_845/\2 845w, gallery_964/\2 964w" /><figcaption>\1</figcaption></figure>', $string);
		
		
		//Tags
		$ReplaceThis 	= array(
								"[br]",
								"[toc-wrap]",
								"[/toc-wrap]",
								"[toc1]",
								"[/toc1]",
								"[toc2]",
								"[/toc2]",
								"#",
								"<p>[intro]",
								"[/intro]</p>",
								"<p>[faq]</p>",
								"<p>[/faq]</p>"
								);
		$WithThis   	= array(
								'<br />',
								'<div class="toc-wrap"> <p class="toc-header bold">I denne artikel</p>',
								'</div>',
								'<p class="toc-primary">',
								'</p>',
								'<p class="toc-secondary">',
								'</p>',
								$actual_link_hashtag,
								"<p class='font-18'>",
								"</p>",
								"",
								""
								);
		$string			= str_replace($ReplaceThis, $WithThis , $string);
		
		return $string;
	}
	
	function FormatTextFurther ($string) {
		$ReplaceThis 	= array(
								"<p><div",
								"</p><br />",
								"</p><br/>",
								"</p><br>",
								"<p><figure",
								"</figure></p>",
								"</div></p>",
								""
								);
		$WithThis   	= array(
								"<div",
								"</p>",
								"</p>",
								"</p>",
								"<figure",
								"</figure>",
								"</div>",
								""
								);
		$string			= str_replace($ReplaceThis, $WithThis , $string);
		
		return $string;
	}
	
	function FormatDate ($string) {
		$ReplaceThis 	= array(
								"January",
								"February",
								"March",
								"May",
								"June",
								"July",
								"October"
								);
		$WithThis   	= array(
								"januar",
								"februar",
								"marts",
								"maj",
								"juni",
								"juli",
								"oktober"
								);
		$string			= str_replace($ReplaceThis, $WithThis , $string);
		
		return $string;
	}
?>