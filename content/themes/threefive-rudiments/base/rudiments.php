<?php
/**
 * Rudiments theme setup.
 *
 * @since rudiments 1.0
 * 
 * Based on:
 * Bones by Eddie Machado
 * @link http://themble.com/bones/
 * 
 * _S (Underscores) by Automatic
 * @link http://underscores.me/
 */


/**
 * "Can I count it off? 
 * 1, 2, 3, 4. Get on Up!"
 *
 * Set up theme defaults and add support for WordPress features.
 */
if ( ! function_exists( 'rudiments_count_it_off' ) ) {

	function rudiments_count_it_off() {

		// Clean out the HEAD
		add_action( 'init', 'rudiments_clear_head' );
		
		// Enqueue base scripts and styles
		add_action( 'wp_enqueue_scripts', 'rudiments_styles_and_scripts', 999 );

		// Adding theme support
		rudiments_theme_support();

		// Rudiments sidebars
		add_action( 'widgets_init', 'rudiments_register_sidebars' );

		// Rudiments Nav Menus (uses wp_nav_menu)
		rudiments_register_nav_menus();

		// adding the rudiments search form (created in functions.php)
		// add_filter( 'get_search_form', 'rudiments_search' );

		// Destroy <p> tags around images in the the_content()
		add_filter( 'the_content', 'rudiments_destroy_ptags_on_images' );
		
		// Custom excerpt_more.
		add_filter( 'excerpt_more', 'rudiments_excerpt_more' );

	}

}

add_action( 'after_setup_theme', 'rudiments_count_it_off' );

/**
 * Gets the current site version.
 *
 * If the Git_Info Plugin is active, it grabs the latest Git hash.
 * If not, it uses the give default.
 *
 * @param string $default
 *
 * @return string
 */
function rudiments_get_version( $default = '1.0' ) {

	$current_version = '0.1';

	if ( empty($current_version ) )
		return $default;

	$version = wp_cache_get( 'rudiments_version' );

	if ( empty( $version ) ) {
		$version = $current_version;
		wp_cache_set( 'rudiments_version', $version );
	}

	return $version;
}

/**
 * The best maid service in the biz. Bones head cleanup.
 */
if ( ! function_exists( 'rudiments_clear_head' ) ) {

	function rudiments_clear_head() {
		// category feeds
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		// post and comment feeds
		remove_action( 'wp_head', 'feed_links', 2 );
		// EditURI link
		remove_action( 'wp_head', 'rsd_link' );
		// windows live writer
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// index link
		remove_action( 'wp_head', 'index_rel_link' );
		// previous link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// start link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// links for adjacent posts
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// WP version
		remove_action( 'wp_head', 'wp_generator' );
	}

}

/**
 * Register and Enqueue Rudiments Stylesheets and Scripts
 */
if ( ! function_exists( 'rudiments_styles_and_scripts' ) ) {
	
	function rudiments_styles_and_scripts() {
		if (!is_admin()) {

			$css_dir = trailingslashit( get_stylesheet_directory_uri() ) . 'css/';
			$js_dir = trailingslashit( get_stylesheet_directory_uri() ) . 'js/';
			$version = rudiments_get_version();

			/**
			 * Styles
			 */
			// Rudiments master stylesheet.
			wp_register_style( 'rudiments-stylesheet', $css_dir . 'master.css', array(), $version, 'all' );
			// Rudiments overwrites stylesheet.
			wp_register_style( 'rudiments-overwrites', $css_dir . 'overwrites.css', array(), $version, 'all' );
			
			
			/**
			 * Scripts
			 */
			// Modernizr (without media query polyfill and printshiv).
			wp_register_script( 'rudiments-modernizr', $js_dir . 'libs/modernizr.min.js', array(), $version, false );
			// Rudiments custom scripts
			wp_register_script( 'rudiments-js', $js_dir . 'scripts.min.js', array( 'jquery' ), $version, true );
			// Rudiments compiled JS Libs
			wp_register_script( 'rudiments-libs', $js_dir . 'libs/libs.min.js', array( 'jquery' ), $version, true );
			// Comment reply script.
			if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
				wp_enqueue_script( 'comment-reply' );

			/**
			 * Enqueue styles and scripts.
			 */
			// Header styles and scripts
			wp_enqueue_script( 'rudiments-modernizr' );
			wp_enqueue_style( 'rudiments-stylesheet' );
			wp_enqueue_style( 'rudiments-overwrites' );

			// Footer Scripts (the lat parameter in wp_register_script needs to be set to true).
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'rudiments-libs' );
			wp_enqueue_script( 'rudiments-js' );

		}
	}
}

if ( ! function_exists( 'rudiments_theme_support' ) ) {
	function rudiments_theme_support() {
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'rudiments', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Enable support for HTML5 markup.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	}
}

/**
 * Register Rudiments sidebar(s).
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'rudiments_register_sidebars' ) ) {
	
	function rudiments_register_sidebars() {

		register_sidebar( array(
			'id' => 'primary-sidebar',
			'name' => __( 'Primary Sidebar', 'rudiments' ),
			'description' => __( 'Primary Sidebar', 'rudiments' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}

}

/**
 * Register Rudiments Nav Menus.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
if ( ! function_exists( 'rudiments_register_nav_menus' ) ) {
	
	function rudiments_register_nav_menus() {

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'rudiments' ),
			'footer' => __( 'Footer Menu', 'rudiments' ),
		) );

	}

}

/**
 * Build Rudiments Nav Menus 
 */
// Primary Nav Menu
function rudiments_primary_nav_menu() {
	wp_nav_menu(array(
		'container' => false,
		'container_class' => 'menu clearfix',
		'menu' => __( 'Primary Menu', 'rudiments' ),
		'menu_class' => 'nav primary-nav clearfix',
		'theme_location' => 'primary',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'depth' => 0,
		'fallback_cb' => 'rudiments_primary_nav_fallback'
	));
}

// Footer Nav Menu
function rudiments_footer_nav_menu() {
	wp_nav_menu(array(
		'container' => '', 
		'container_class' => 'menu clearfix',
		'menu' => __( 'Footer Menu', 'rudiments' ),
		'menu_class' => 'nav footer-nav clearfix',
		'theme_location' => 'footer',
		'before' => '',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'depth' => 0
	));
}

// Fallback for Primary Nav Menu
function rudiments_primary_nav_fallback() {
	wp_page_menu( array(
		'show_home'  => true,
		'menu_class' => 'nav primary-nav clearfix',
		'echo'       => true
	) );
}

// /**
//  * Rudiments Search From
//  */
// if ( ! function_exists( 'rudiments_search' ) ) {
// 	function rudiments_search($searchfoem) {
// 		$searchform = get_template_part('/content/search/searchform');
// 		return $searchform;
// 	}
// }

/**
 * Additional Cleanup Items
 */

// Remove the <p> tags from around images in the_content() (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function rudiments_destroy_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Custom More Excerpt
function rudiments_excerpt_more($more) {
	global $post;
	return '&hellip;  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'rudiments' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'rudiments' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function rudiments_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
?>