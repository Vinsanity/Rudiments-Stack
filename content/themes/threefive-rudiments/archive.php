<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="content-wrap">
		
		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'rudiments' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'rudiments' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'rudiments' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'rudiments' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'rudiments' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'rudiments' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'rudiments');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'rudiments');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'rudiments' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'rudiments' );

						else :
							_e( 'Archives', 'rudiments' );

						endif;
					?>
				</h1>
				
			</header><!-- .archive-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( '/content/loop/results' ); ?>

			<?php endwhile; ?>

			<?php rudiments_num_page_navi(); ?>

		<?php else : ?>

			<?php get_template_part( '/content/no-results' ); ?>

		<?php endif; ?>
		
		</div><!-- .content-wrap -->
	</main><!-- #main -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>