<?php

	/**
	
		Bonita static management class file
		
		@package Bonita
	
	 */
	 
	 
		 class Bon {
		 
		 	/** Configuration variables **/
		 
			 	static $path = '';						// The path of the Bonita base
			 	static $additionalPaths = array();		// Additional paths to check for templates
			 	static $cache = false;					// Set depending on the existence of the cache
		 	
		 	/** Private helper vars **/
		 	
			 	private static $templates = array();	// Template overrides
		 	
		 	/** Useful functions **/
		 
				/**
				 * Returns whether or not we're running off the cache
				 * @return true|false
				 */

			 		static function cached() {
			 			return self::$cache;
			 		}
			 		
			 	/**
			 	 * Sets an additional path to check for (eg) templates
			 	 * Does nothing if we're running off the cache
			 	 * @param string $path A full path
			 	 * @return true|false Depending on success
			 	 */
			 
			 		static function additionalPath($path) {
			 			if (self::cached()) return false;
			 			if (!empty($path) && is_dir($path)) {
			 				if (!in_array($path,self::$additionalPaths)) {
			 					self::$additionalPaths[] = $path;
			 				}
			 			}
			 		}
			 		
			 	/**
			 	 * Get any saved additional paths (or an empty array if there aren't any)
			 	 * @return array
			 	 */
			 	 
			 		static function getAdditionalPaths() {
			 			return self::$additionalPaths;
			 		}
		 
		 }