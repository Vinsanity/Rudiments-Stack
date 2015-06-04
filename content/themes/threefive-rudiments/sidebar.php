<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Rudiments
 */
?>

<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	<section id="sidebar" class="widget-area column mobile-4 tablet-2 desktop-4 wide-4" role="complementary" itemtype="http://schema.org/WPSideBar">

		<?php dynamic_sidebar( 'primary-sidebar' ); ?>

	</section><!-- #sidebar -->
<?php endif; // end sidebar widget area ?>