<?php
/**
 * Plugin Name: Rudiments Updates
 * Plugin URI: http://3five.com
 * Description: Lock down updates and notify the user to request assistance.
 * Author: 3five, Vincent Listrani
 * Author URI: http://3five.com
 * Text Domain: rudiments-updates
 * Domain Path: /languages/
 * Version: 1.0
 *
 * @package   Rudiments User Roles
 * @author    Vincent Listrani vincent@3five.com
 * @license   GPL-2.0+
 * @link      http://3five.com
 * @copyright 2015 3five, Inc.
 *
 */

add_action( 'admin_menu', 'rudiments_updates_admin' );
function rudiments_updates_admin() {
	$get_updates = wp_get_update_data();
    $count = $get_updates['counts']['wordpress'] + $get_updates['counts']['themes'] + $get_updates['counts']['plugins'];
    $notification = '';
    if ( $count > 0 ) {
        $notification = '<span class="update-plugins"><span class="plugin-count">'.$count.'</span></span>';
    }
    add_dashboard_page( 'Updates', 'Updates '.$notification, 'administrator', 'updates', 'updates', '',71); 
}

function updates($count){
    // DO your stuff here
    $count = $get_updates['counts']['wordpress'] + $get_updates['counts']['themes'] + $get_updates['counts']['plugins'];
    echo '<h1>WordPress Updates</h1>';
    if ($count > 0) {
    	echo '<div class="updated" style="padding:15px; position:relative;">You have updates availabe to your worpress install. Please contact 3five support using the dashboard plugin <a href="'.home_url().'/wp-admin">here</a></div>.';
    } else {
    	echo '<div class="updated" style="padding:15px; position:relative;">Your worpress install and all plugins are up to date. Please contact 3five support for additional help <a href="'.home_url().'/wp-admin">here</a></div>.';
    }
}