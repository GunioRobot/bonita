<?php

	/**
	
		The main Bonita template class.
		
		Handles templating.
		
		@package Bonita
		@subpackage Templating
	
	*/

		class BonTemp {
		
			public $templateType = 'default';		// Which template are we using?
			public $vars = array();				// Template variables
			
			/**
			 * Constructor allows copying; we're shunning use of clone here
			 */
				function __construct($initial = false) {
					if ($initial instanceof BonTemp) {
						$this->vars = $initial->vars;
						$this->templateType = $initial->templateType;
					}
				}
			
			/**
			 * Magic method to set template variables
			 * @param $name Name of variable to set
			 * @param $value Value
			 */
				function __set($name, $value) {
					if (!empty($name)) {
						$this->vars[$name] = $value;
					}
				}
			
			/**
			 * Magic method to get stored template variable
			 * @param $name Name of variable to retrieve
			 * @return mixed Variable value or null on failure
			 */
				function __get($name) {
					if (array_key_exists($name,$this->vars)) {
						return $this->vars[$name];
					}
					return null;
				}
				
			/**
			 * Method to draw an actual template element
			 * @param string Name of the template element to draw
			 * @return string Rendered template element
			 */
				function draw($templateName) {
					$templateName = preg_replace('/^_[A-Z0-9\/]+/i','',$templateName);
					if (!empty($templateName)) {
					
						// Add the Bonita base path to our additional paths list
						$paths = Bon::getAdditionalPaths();
						$paths[] = Bon::$path;
						
						// Add template types to an array; ensure we revert to default
						$templateTypes = array($this->getTemplateType());
						if ($this->getTemplateType() != 'default') $templateTypes[] = 'default';
						
						// Cycle through the additional paths and check for the template file
						// - if it exists, break out of the foreach
						foreach($templateTypes as $templateType)
						foreach($paths as $basepath) {
							$path = $basepath . '/templates/'.$templateType.'/' . $templateName . '.tpl.php';
							if (file_exists($path)) {
						
								// Special vars:
								$vars = $this->vars;
								$t = $this;
							
								ob_start();
								@include $path;
								return ob_get_clean();
								
								// Break out of the foreach path
								// (although this code should be unreachable)
								break;
								
							}
						}
					}
					// If we've got here, just return a blank string; the template doesn't exist
					return '';
				}
				
			/**
			 * Draws a list of PHP objects using a specified list template. Objects
			 * must have a template of the form object/classname
			 * @param $items An array of PHP objects
			 * @return string
			 */
				function drawList($items, $style = 'stream') {
					if (is_array($items) && !empty($items) && !empty($style)) {
						$t = new BonTemp($this);
						$t->items = $items;
						return $t->draw('list/'. $style);
					}
					return '';
				}
				
			/**
			 * Draws a single supplied PHP object. Objects should have a corresponding template
			 * of the form object/classname
			 * @param $item PHP object
			 * @return string
			 */
				function drawObject($object) {
					if (is_object($object)) {
						$t = new BonTemp($this);
						$t->object = $object;
						return $t->draw('object/' . get_class($object));
					}
					return '';
				}
				
			/**
			 * Returns the value of a stored variable
			 * @param $name The name of the variable
			 * @return mixed
			 */
				function vars($name) {
					if (isset($this->vars[$name]))
						return $this->vars[$name];
					else
						return false;
				}
				
			/**
			 * Draws the shell template
			 * @param $echo If set to true (by default), echoes the page; otherwise returns it
			 */
				function drawPage($echo = true) {
					if ($echo)
						echo $this->draw('shell');
					else
						return $this->draw('shell');
				}
				
			/**
			 * Returns the current template type
			 * @return string Name of the current template ('default' by default)
			 */
				function getTemplateType() {
					return $this->templateType;
				}
				
			/**
			 * Sets the current template type
			 * @param string $template The name of the template you wish to use
			 */
				function setTemplateType($templateType) {
					if (!empty($templateType)) {
						$this->templateType = $templateType;
						return true;
					} else {
						return false;
					}
				}
				
			/**
			 * In case anyone's wondering whether this class is a reference or not.
			 */
				function sookie() {}
		
		}