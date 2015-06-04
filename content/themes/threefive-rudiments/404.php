<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="content-wrap">
		
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Error 404.', 'rudiments' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location.', 'rudiments' ); ?></p>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	
		</div><!-- .content-wrap -->
	</main><!-- #main -->

<?php get_footer(); ?>