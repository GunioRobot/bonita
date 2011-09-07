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
		$t = new BonTemp();
		
	// For the purposes of this example, some GET line fun to choose which template
	// we're using
		$t->detectTemplateType();
		if ($_GET['t'] == 'rss') $t->setTemplateType('rss');
		if ($_GET['t'] == 'ipad') $t->setTemplateType('ipad');
		
	// Page contents:
	
	// Page title
		$t->title = 'Example page';
		
	// A link back to git
		$t->url = 'https://github.com/benwerd/bonita';
		
	// Page body
		$t->body = $t->draw('pages/example');
		
	// And finally, draw the page
		$t->drawPage();
