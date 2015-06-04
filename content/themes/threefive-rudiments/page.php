<?php
/**
 * The template for displaying all pages.
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main" itemprop="pageContent">
		<div class="content-wrap">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( '/content/page/default' ); ?>

		<?php endwhile; // end of the loop. ?>
	
		</div> <!-- .content-wrap -->
	</main><!-- #main -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
