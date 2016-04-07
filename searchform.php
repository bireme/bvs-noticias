<?php
	echo '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
	echo '<label>';
	echo '<span class="screen-reader-text hide">' . __( 'Search news:', 'bvsnoticias' ) . '</span>';
	echo '<input type="search" class="search-field" id="s" placeholder="' . __( 'Search news', 'bvsnoticias' ) . '" value="' . get_search_query() . '" name="s" title="' . __( 'Search News:', 'bvsnoticias' ) . '" />';
	echo '</label>';
	echo '<input type="submit" class="search-submit" value="'. __( 'Search', 'bvsnoticias' ) .'" />';
	echo '</form>';
?>