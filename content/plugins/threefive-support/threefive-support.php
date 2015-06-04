<?php

/**
 * @link              http://3five.com
 * @since             1.0.0
 * @package           Threefive_Support
 *
 * @wordpress-plugin
 * Plugin Name:       3five Support
 * Plugin URI:        http://3five.com
 * Description:       3five WordPress Dashboard Support Ticket generator.
 * Version:           1.0.0
 * Author:            3five, VincentListrani
 * Author URI:        http://3five.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       threefive-support
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-threefive-support-activator.php
 */
function activate_threefive_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-threefive-support-activator.php';
	Threefive_Support_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-threefive-support-deactivator.php
 */
function deactivate_threefive_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-threefive-support-deactivator.php';
	Threefive_Support_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_threefive_support' );
register_deactivation_hook( __FILE__, 'deactivate_threefive_support' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-threefive-support.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_threefive_support() {

	$plugin = new Threefive_Support();
	$plugin->run();

}
run_threefive_support();

new ThreeFiveSupportGitUpdater( __FILE__, '3five', "3five-Support-Plugin" );
