<?php

/**
 * Class ThreeFive_Security
 *
 * Disable XMLRPC(pingbacks)
 */
class ThreeFive_Security {

	/** @var ThreeFive_Security */
	private static $instance;

	/**
	 * Add the hooks
	 */
	private function add_hooks() {
		$this->xmlrpc_filters();
	}

	/**
	 * XMLRPC security filters
	 */
	private function xmlrpc_filters() {

		// Disable XMLRPC all together by default
		if ( !defined('USE_XMLRPC') || USE_XMLRPC == false ) {
			add_filter('xmlrpc_enabled', '__return_false');
			return;
		}

		// Disable XMLRPC pingback
		// @see http://blog.sucuri.net/2014/03/more-than-162000-wordpress-sites-used-for-distributed-denial-of-service-attack.html
		if ( !defined('USE_XMLRPC_PINGBACK') || USE_XMLRPC_PINGBACK == false ) {
			add_filter( 'xmlrpc_methods', function( $methods ) {
				unset( $methods['pingback.ping'] );
				return $methods;
			} );
		}

	}

	/********** Singleton *************/

	/**
	 * Create the instance of the class
	 *
	 * @static
	 * @return void
	 */
	public static function init() {
		self::$instance = self::get_instance();
		self::$instance->add_hooks();
	}

	/**
	 * Get (and instantiate, if necessary) the instance of the class
	 * @static
	 * @return ThreeFive_Security
	 */
	public static function get_instance() {
		if ( ! is_a( self::$instance, __CLASS__ ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	final public function __clone() {
		trigger_error( "Singleton. No cloning allowed!", E_USER_ERROR );
	}

	final public function __wakeup() {
		trigger_error( "Singleton. No serialization allowed!", E_USER_ERROR );
	}

	protected function __construct() {}
}

