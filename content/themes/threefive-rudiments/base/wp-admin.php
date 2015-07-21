<?php
/**
 * Theme based admin functions.
 * 
 * This will eventually be turned into an MU plugin.
 *
 *
 */

/**
 * DASHBOARD WIDGETS
 */

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
}

// 3five Example Widget
function threefive_example_widget() {
	return;
}

function rudiments_custom_dashboard() {
	// wp_add_dashboard_widget('threefive_example_widget', '3five Example Widget', 'threefive_example_widget');
}

// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'rudiments_custom_dashboard' );


/** 
 * CUSTOM LOGIN PAGE
 */

function rudiments_login_css() {
	$version = rudiments_get_version();
	wp_enqueue_style( 'rudiments_login_css', get_template_directory_uri() . '/css/login.css', array(),  $version, false );
}

// changing the logo link from wordpress.org to your site
function rudiments_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function rudiments_login_title() { return get_option( 'blogname' ); }

add_action( 'login_enqueue_scripts', 'rudiments_login_css', 10 );
add_filter( 'login_headerurl', 'rudiments_login_url' );
add_filter( 'login_headertitle', 'rudiments_login_title' );


/**
 * CUSTOMIZE ADMIN
 */

// Custom Admin Menu settings

// Remove Menu Items For All Non-Admin Users
function rudiments_remove_menu_items() {
	if ( ! current_user_can('manage_options') ) {
		// Removing Menu Items for all
	    remove_menu_page('edit-comments.php'); // Remove the Tools Menu
	    remove_menu_page('theme-global-settings'); // Remove the Theme Options Menu example
	    remove_menu_page('tools.php'); // Remove the Tools Menu
	}
}
add_action( 'admin_menu', 'rudiments_remove_menu_items', 99);

// Rename Menu items
function rudiments_edit_admin_menus() {  
    global $menu;  
    global $submenu;  
    // Returned Array Keys
    // Array ( [0] => Posts [1] => edit_posts [2] => edit.php [3] => [4] => open-if-no-js menu-top menu-icon-post [5] => menu-posts [6] => none )
    // [0] = Label
    // [1] = Menu Slug
    // [2] = Menu Page (use this to hide a page)
    // [3] = ??
    // [4] = Menu Item Class
    // [5] = Menu Item ID
    // [6] = Custom Icon URL
    
    // Example Usage:
    // $menu[5][0] = 'Recipes'; // Change Posts to Recipes  
    // $submenu['edit.php'][5][0] = 'All Recipes';
}  
add_action( 'admin_menu', 'rudiments_edit_admin_menus' );  

// Reorder Menu items
function rudiments_custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	
	return array(
		// Uncomment these options to rearrange the menu order to your liking.
		
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php', // Posts
		// 'edit.php?post_type=page', // Pages
		// 'edit.php?post_type=custom_post_type', // Custom Post Type Example
		// 'gf_edit_forms', // Gravity Forms
		// 'upload.php', // Media
		// 'theme-global-settings', // ACF Options Page Example
		// 'separator2', // Second separator
	);
}
add_filter('custom_menu_order', 'rudiments_custom_menu_order');
add_filter('menu_order', 'rudiments_custom_menu_order');

// Customized Footer Message
function rudiments_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://3five.com" target="_blank">3five, Inc.</a></span>.', 'rudiments' );
}
// adding it to the admin area
add_filter( 'admin_footer_text', 'rudiments_admin_footer' );

?>
