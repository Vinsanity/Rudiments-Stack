<?php
/**
 * One!
 *
 * Get up on the downstroke. This is Rudements' 1.
 * 
 * @package Rudiments
 */

get_header(); ?>

	<div class="content-wrap clearfix">
	<main id="main" class="site-main column mobile-4 tablet-2 desktop-8 wide-8" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content/loop/results' ); ?>

				<?php endwhile; ?>

				<?php rudiments_num_page_navi(); ?>

			<?php else : ?>

				<?php get_template_part( 'content/no-results' ); ?>

			<?php endif; ?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
	</div><!-- .content-wrap -->
	
<?php get_footer(); ?>
