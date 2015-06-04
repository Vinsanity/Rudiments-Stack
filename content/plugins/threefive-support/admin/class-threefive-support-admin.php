<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://3five.com
 * @since      1.0.0
 *
 * @package    Threefive_Support
 * @subpackage Threefive_Support/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Threefive_Support
 * @subpackage Threefive_Support/admin
 * @author     3five, VincentListrani <hello@3five.com>
 */
class Threefive_Support_Admin {

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
	 * @param      string    $threefive_support       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $threefive_support, $version ) {

		$this->threefive_support = $threefive_support;
		$this->version = $version;
		add_action('wp_dashboard_setup', array($this, 'load_admin_form_widget') );

	}

	/**
	 * Create the admin support form widget
	 *
	 * @since    1.0.0
	 * @access public
	 */
	public function load_admin_form_widget() {

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		add_meta_box('threefive_support_widget', 'Get 3five Support', array($this, 'threefive_support_dashboard_widget'), 'dashboard', 'normal', 'high' );
	}

	/**
	 * Support form callback function
	 * 
	 *  - Used as a callback function in load_admin_form_widget()
	 *  
	 * @return void
	 * @since  1.0.0
	 * @access public
	 */
	public function threefive_support_dashboard_widget() {
		/**
		 * Load the dashboard widget form and widget contents.
		 */		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/threefive-support-admin-display.php';
	}

	/**
	 * Support form data handling and mail sender
	 *
	 * - Used as the form POST handler
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function threefive_support_dashboard_widget_handler() {
		global $get_updates, $wp_version;
		
		// $_POST vars
		$email = esc_html($_POST['email']);
		$name = esc_html($_POST['name']);
		$message_body = esc_html($_POST['message']);
		
		// Add WP Stats to the message field.
		$plugins = $get_updates['counts']['plugins'];
		$themes = $get_updates['counts']['themes'];
		$wordpress = $get_updates['counts']['wordpress'];

		// Additional Stats
		$browser = $_SERVER['HTTP_USER_AGENT'];

		// Build the message body
		$message = 'Support Request Details:' . PHP_EOL;
		$message .= $message_body . PHP_EOL . PHP_EOL;
		$message .= 'WordPress Site Statistics:' . PHP_EOL;
		$message .= 'Site URL: ' . get_bloginfo('url') . PHP_EOL;
		$message .= 'WordPress Version: ' . $wp_version . PHP_EOL;
		$message .= 'Core Updates available: ' . $wordpress . PHP_EOL;
		$message .= 'Plugin Updates available: ' . $plugins . PHP_EOL;
		$message .= 'Theme Updates available: ' . $themes . PHP_EOL;
		$message .= 'Using Browser: ' . $browser . PHP_EOL;

		echo $message;

		// Constants
		$to = 'support@3five.com';
		$subject = 'Support Request From ' .$name. ' at ' .get_bloginfo('name'). '.';
		$headers[] = 'From: '.$name.' <'.$email.'>';

		wp_mail($to, $subject, $message, $headers);

		die('Great Success!');
	}

	public function get_wp_updates() {
		if ( function_exists('wp_get_update_data') ) {
			global $get_updates;
			$get_updates = wp_get_update_data();
			return $get_updates;
		}
	}

	/**
	 * Register the stylesheets for the Dashboard.
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

		wp_enqueue_style( $this->threefive_support, plugin_dir_url( __FILE__ ) . 'css/threefive-support-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
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

		wp_enqueue_script( $this->threefive_support, plugin_dir_url( __FILE__ ) . 'js/threefive-support-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->threefive_support, 'wpAdminAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

}
