<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Rudiments
 */
?>

<article id="page-<?php the_ID(); ?>">
	<header class="entry-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #page-## -->