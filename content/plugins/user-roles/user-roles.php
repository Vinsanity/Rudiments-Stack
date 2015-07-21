<?php 
/**
 * Plugin Name: Rudiments User Roles
 * Plugin URI: http://3five.com
 * Description: Custom User Roles for the Rudiments Stack.
 * Author: 3five, Vincent Listrani
 * Author URI: http://3five.com
 * Text Domain: rudiments-user-roles
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

/**
 * Custom User Roles and Capabilities
 */
add_action('init', 'rudiments_admin');

function rudiments_admin()
{
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $admin = $wp_roles->get_role('administrator');
    
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('rudiments_admin', 'My Custom Role', $admin->capabilities);

    /**
     * Add custom capabilities to the new role(s)
     */
    // Rudiments Admin
    $rudiments_admin_role = get_role( 'rudiments_admin' );

    // Rudiments Admin Caps (add and remove)
    $admin_role->add_cap( 'gravityforms_edit_forms' );
    $admin_role->add_cap( 'gravityforms_delete_forms' );
	$admin_role->add_cap( 'gravityforms_create_form' );
	$admin_role->add_cap( 'gravityforms_view_entries' );
	$admin_role->add_cap( 'gravityforms_edit_entries' );
	$admin_role->add_cap( 'gravityforms_delete_entries' );
	$admin_role->add_cap( 'gravityforms_view_settings' );
	$admin_role->add_cap( 'gravityforms_edit_settings' );
	$admin_role->add_cap( 'gravityforms_export_entries' );
	$admin_role->add_cap( 'gravityforms_view_entry_notes' );
	$admin_role->add_cap( 'gravityforms_edit_entry_notes' );
    $admin_role->remove_cap( 'delete_plugins' );
    $admin_role->remove_cap( 'delete_themes' );
    $admin_role->remove_cap( 'edit_files' );
    $admin_role->remove_cap( 'edit_plugins' );
    $admin_role->remove_cap( 'edit_themes' );
    $admin_role->remove_cap( 'update_core' );
    $admin_role->remove_cap( 'update_plugins' );
    $admin_role->remove_cap( 'update_themes' );
    $admin_role->remove_cap( 'install_themes' );
    $admin_role->remove_cap( 'install_plugins' );

}