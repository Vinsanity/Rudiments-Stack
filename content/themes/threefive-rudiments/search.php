<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
	<div class="content-wrap">
	
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'rudiments' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content/search/results' ); ?>

			<?php endwhile; ?>

			<?php rudiments_num_page_navi(); ?>

		<?php else : ?>

			<?php get_template_part( '/content/no-results' ); ?>

		<?php endif; ?>
	
	</div><!-- .content-wrap -->
	</main><!-- #main -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>