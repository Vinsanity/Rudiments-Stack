<?php
/*
Plugin Name: 3five Security
Description: Add a series of security best practices
Author: Modern Tribe, Inc.
Author URI: http://tri.be
Version: 1.0
*/

/**
 * Load all the plugin files and initialize appropriately
 *
 * @return void
 */
if ( !function_exists('threefive_security_load') ) { // play nice
	function threefive_security_load() {

		// ok, we have permission to load
		require_once( 'ThreeFive_Security.php' );
		add_action( 'plugins_loaded', array( 'ThreeFive_Security', 'init' ), 0, 0 );
	}

	threefive_security_load();
}
