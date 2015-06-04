<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="content-wrap">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( '/content/single/default' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- .content-wrap -->
	</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>