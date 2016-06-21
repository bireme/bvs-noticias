<?php

function the_titlesmall($before = '', $after = '', $echo = true, $length = false) {
	$title = get_the_title();

	if ( $length && is_numeric($length) ) {
		$title = substr( $title, 0, $length );
	}

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo )
			echo $title;
		else
			return $title;
	}
}

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_posts_per_page( $query ) {
    if ( !is_home() && !is_admin() && post_type_exists('news') )
        $query->set( 'posts_per_page', 10 );
    if ( $query->is_category || $query->is_tag )
        $query->set( 'post_type', 'any' );
    if ( $query->is_date )
        $query->set( 'post_type', array( 'news', 'post' ) );
}
add_filter('parse_query', 'custom_posts_per_page');

function custom_reply_link_args($args){
    $args['reply_text'] = __( 'Reply', 'bvs-noticias' );
    return $args;
}
add_filter('comment_reply_link_args', 'custom_reply_link_args');

?>
