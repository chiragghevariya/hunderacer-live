<?php
	$html = "
	<h1>This is my title</h1>

	<p>This is a text right under my h1 title.</p>
	<p>This is some more text under my h1 title</p>

	<h2>This is my level 2 heading</h2>
	<p>This is text right under my level 2 heading</p>

	<h3>First h3</h3>
	<p>First paragraph for the first h3</p>

	<h3>Second h3</h3>
	<p>First paragraph for the second h3</p>

	<h3>Third h3</h3>
	<p>First paragraph for the third h3</p>
	<p>Second paragraph for the third h3</p>

	<h2>This is my level 2 heading</h2>
	<p>This is text right under my level 2 heading</p>
	";


	$dom = new DomDocument();
	// Load the HTML, don't worry about it being a fragment
	$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

	$xpath = new DOMXPath($dom);

	// Grab all H3 tags. This might need to be adjusted if there's more to the depth
	$results = $xpath->query("//h3");
	foreach ($results as $result) {
		//var_dump(sprintf('<h3>%1$s</h3>', $result->textContent));
		echo "<p><strong>SPØRGSMÅL</strong>: ".$result->textContent."</p>";
		
		// See if the next element is a P tag
		$next = $result->nextElementSibling;
		if ($next && 'p' === $next->nodeName) {
			//var_dump(sprintf('<p>%1$s</p>', $next->textContent));
			echo "<p><strong>SVAR</strong>: ".$next->textContent."</p>";
		}
	}

?>