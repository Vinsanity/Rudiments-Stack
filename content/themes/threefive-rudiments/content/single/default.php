<?php
/**
 * @package Rudiments
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

	</header><!-- .entry-header -->

	<?php // Featured Image
	if ( has_post_thumbnail() ) { ?>
		<figure class="entry-featured-img">
			<?php
				$attr = array(
					'class'	   => '',
					'itemprop' => 'thumbnailUrl'
				);
				$size = 'full';
				echo get_the_post_thumbnail( get_the_ID(), $size, $attr );
			?>
    	</figure><!-- .entry-featured-img -->
	<?php } ?>

	<div class="entry-content">

		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php // Post Meta ?>
		<p class="entry-meta">
			<time class="entry-date" pubdate>
				Posted <?php echo get_the_time( __( 'F jS, Y', 'rudiments' ) ); ?>
			</time>
			by 
			<span class="entry-author">
				<?php rudiments_author_posts_link(); ?>
			</span>
			in 
			<span class="category-list">
				<?php echo get_the_category_list(', '); ?>
			</span>
		</p>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
