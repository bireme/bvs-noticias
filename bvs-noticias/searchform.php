<?php
	echo '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
	echo '<label>';
	echo '<span class="screen-reader-text hide">' . _x( 'Pesquisar notícias:', 'bvs-noticias' ) . '</span>';
	echo '<input type="search" class="search-field" id="s" placeholder="' . esc_attr_x( 'Pesquisar notícias', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Pesquisar Notícias:', 'bvs-noticias' ) . '" />';
	echo '</label>';
	echo '<input type="submit" class="search-submit" value="'. esc_attr_x( 'Buscar', 'submit button' ) .'" />';
	echo '</form>';
?>