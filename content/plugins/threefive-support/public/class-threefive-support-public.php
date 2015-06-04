<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://3five.com
 * @since      1.0.0
 *
 * @package    Threefive_Support
 * @subpackage Threefive_Support/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Threefive_Support
 * @subpackage Threefive_Support/public
 * @author     3five, VincentListrani <hello@3five.com>
 */
class Threefive_Support_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $threefive_support    The ID of this plugin.
	 */
	private $threefive_support;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $threefive_support       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $threefive_support, $version ) {

		$this->threefive_support = $threefive_support;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Threefive_Support_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Threefive_Support_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->threefive_support, plugin_dir_url( __FILE__ ) . 'css/threefive-support-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Threefive_Support_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Threefive_Support_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->threefive_support, plugin_dir_url( __FILE__ ) . 'js/threefive-support-public.js', array( 'jquery' ), $this->version, false );

	}

}
