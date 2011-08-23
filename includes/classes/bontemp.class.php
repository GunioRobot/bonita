<?php

	/**
	
		The main Bonita template class.
		
		Handles templating.
		
		@package Bonita
		@subpackage Templating
	
	*/

		class BonTemp {
		
			private $templateType = 'default';		// Which template are we using?
			private $vars = array();				// Template variables
			
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
		
		}