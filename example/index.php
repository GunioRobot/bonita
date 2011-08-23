<?php

	/**
	 * 	Hello!
	 
	 	This is the simplest of all possible examples (ish). It'll draw a
	 	page of text in two template types.
	 	
	 	Stick ?t=rss on the end of the URL to load the same page in RSS.
	 	
	 */

	// Load Bonita
		require_once dirname(dirname(__FILE__)) . '/start.php';
	
	// Add this directory as an additional path
		Bon::additionalPath(dirname(__FILE__));
		
	// Instantiate template
		$tmp = new BonTemp();
		
	// For the purposes of this example, some GET line fun to choose which template
	// we're using
		if ($_GET['t'] == 'rss') $tmp->setTemplateType('rss');
		
	// Page contents
		$tmp->title = 'Example page';						// Page title
		$tmp->url = 'https://github.com/benwerd/bonita';	// A link back to git
		$tmp->body = $tmp->draw('pages/example');			// Page body
		$tmp->drawPage();									// Draw the page