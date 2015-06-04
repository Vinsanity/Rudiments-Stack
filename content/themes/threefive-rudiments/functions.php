<?php
/**
 * Rudiments functions and definitions
 *
 * @package Rudiments
 */

/**
 * Let's start the show.
 *
 * The rudiments.php file contains the base setup for the Rudiments theme. 
 * If you need to create additional functions, you can and should write them here in the functions.php file.
 */
require_once( 'base/rudiments.php' );

require_once( 'base/wp-admin.php' );

/**
 * "We've done four already but now we're steady, and then they went 1, 2, 3, 4!"
 * 
 * Take a solo. Drop in your own functions here or edit the pre-configured options below.
 */

/********************* MOBILE BRWOSER DETECTION *********************/
require_once( 'base/Mobile_Detect.php' );

global $mobile_detect;
$mobile_detect = new Mobile_Detect;

/********************* THUMBNAIL SIZE OPTIONS *********************/

// Thumbnail sizes
add_image_size( 'rudiments-medium', 300, 300, true );


function rudiments_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'rudiments-medium' => __('300px by 300px'),
    ) );
}
add_filter( 'image_size_names_choose', 'rudiments_custom_image_sizes' );

/********************* PAGE NAVI LAYOUT *********************/
/**
 * Numeric Page Navi
 * 
 * @link http://codex.wordpress.org/Function_Reference/paginate_links
 * 
 * @return void
 */
function rudiments_num_page_navi() {
	
	global $wp_query;
	
	$big = 999999999;
	$translated = __( 'Page', 'rudiments' ); // Supply translatable string

	if ( $wp_query->max_num_pages <= 1 )
		return;
	
	echo '<nav class="page-navi">';
	
		echo paginate_links( array(
			'base' 					=> str_replace( $big, '%#%', esc_url( get_pagenum_link($big) ) ),
			'format' 				=> '',
			'current' 				=> max( 1, get_query_var('paged') ),
			'total' 				=> $wp_query->max_num_pages,
			'prev_text' 			=> __('Previous', 'rudiments'),
			'next_text' 			=> __('Next', 'rudiments'),
			'type'					=> 'list',
			'end_size'				=> 1,
			'mid_size'				=> 3,
			'before_page_number'	=> '<span class="screen-reader-text">'.$translated.' </span>'
		) );
	
	echo '</nav>';
}