<?php // Custom Search Form
global $searchform;
$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search', 'rudiments' ) . ' </label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search For...', 'rudiments' ) . '" />
	<button id="searchsubmit">' . __('Search', 'rudiments') . '</button>
	</form>';