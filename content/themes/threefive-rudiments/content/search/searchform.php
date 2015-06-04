<form role="search" method="get" id="searchform" action="<?php home_url( '/' ); ?>" >
	<label class="screen-reader-text" for="s"> <?php _e( 'Search', 'rudiments' ); ?> </label>
	<input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'rudiments' ); ?>" />
	<button id="searchsubmit"><?php _e('Search', 'rudiments'); ?></button>
</form>
