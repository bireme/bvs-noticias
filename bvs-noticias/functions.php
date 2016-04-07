<?php

if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
            'name' => __('Logo and Banner', 'bvsnoticias'),
            'id' => 'logo_banner',
            'description' => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<strong class="widget-title" style="display: none;">',
            'after_title' => '</strong>',
    ) );
}

function load_translation(){
    load_textdomain( 'bvsnoticias',  get_stylesheet_directory().'/languages/bvsnoticias-'.get_locale().'.mo' );
}
add_action( 'after_setup_theme', 'load_translation' );

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
    $args['reply_text'] = __( 'Reply', 'bvsnoticias' );
    return $args;
}
add_filter('comment_reply_link_args', 'custom_reply_link_args');

add_action( 'init', 'register_cpt_news' );
function register_cpt_news() {
    $labels = array(
        "name" => "News",
        "singular_name" => "News",
        "menu_name" => "Notícias",
        "all_items" => "Notícias",
        "add_new" => "Adicionar Notícias",
        "add_new_item" => "Adicionar Nova Notícia",
        "edit" => "Editar",
        "edit_item" => "Editar Notícia",
        "new_item" => "Nova Notícia",
        "view" => "Ver",
        "view_item" => "Ver Notícia",
        "search_items" => "Buscar Notícia",
        "not_found" => "Nenhuma Notícia Encontrada",
        "not_found_in_trash" => "Nenhuma Notícia Encontrada na Lixeira",
        );

    $args = array(
        "labels" => $labels,
        "description" => "Post type para Notícias ou Clipping de Notícias",
        "public" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "news", "with_front" => true ),
        "query_var" => true,
                
        "supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),      
        "taxonomies" => array( "category", "post_tag", "language", "news-source", "news-type" ),        
    );
    register_post_type( "news", $args );

// End of register_cpt_news()
}

add_action( 'init', 'register_tax_news_source' );
function register_tax_news_source() {

    $labels = array(
        "name" => "Sources",
        "label" => "Sources",
        "menu_name" => "Fontes",
        "all_items" => "Fontes",
        "edit_item" => "Editar Fonte",
        "view_item" => "Ver Fonte",
        "update_item" => "Atualizar Nome da Fonte",
        "add_new_item" => "Adicionar Nova Fonte",
        "new_item_name" => "Nome da Nova Fonte",
        "search_items" => "Buscar Fontes",
        "popular_items" => "Fontes mais populares",
        "separate_items_with_commas" => "Separar Fontes com vírgulas",
        "add_or_remove_items" => "Adicionar ou remover Fontes",
        "choose_from_most_used" => "Selecione a partir das Fontes mais usadas",
        "not_found" => "Nenhuma Fonte encontrada",
        );

    $args = array(
        "labels" => $labels,
        "hierarchical" => true,
        "label" => "Sources",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array( 'slug' => 'news-source', 'with_front' => true ),
        "show_admin_column" => false,
    );
    register_taxonomy( "news-source", array( "news" ), $args );

// End register_tax_news_source()
}

add_action( 'init', 'register_tax_news_type' );
function register_tax_news_type() {

    $labels = array(
        "name" => "news types",
        "label" => "news types",
        "menu_name" => "News Type",
        );

    $args = array(
        "labels" => $labels,
        "hierarchical" => false,
        "label" => "news types",
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array( 'slug' => 'news-type', 'with_front' => true ),
        "show_admin_column" => false,
    );
    register_taxonomy( "news-type", array( "news" ), $args );

// End register_tax_news_type()
}

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_clipping-de-noticias',
        'title' => 'Clipping de Notícias',
        'fields' => array (
            array (
                'key' => 'field_55e599bf48c4d',
                'label' => 'Tipo de Notícia',
                'name' => 'tipo_de_noticia',
                'type' => 'radio',
                'instructions' => 'Selecionar o tipo (Notícia ou Clipping)',
                'required' => 1,
                'choices' => array (
                    'news' => 'Notícia original',
                    'clipping' => 'Clipping de notícias',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_55e59fb8e87a0',
                'label' => 'Fonte da notícia',
                'name' => 'fonte',
                'type' => 'taxonomy',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_55e599bf48c4d',
                            'operator' => '==',
                            'value' => 'clipping',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'taxonomy' => 'news-source',
                'field_type' => 'select',
                'allow_null' => 1,
                'load_save_terms' => 1,
                'return_format' => 'object',
                'multiple' => 0,
            ),
            array (
                'key' => 'field_55e5e5b78575b',
                'label' => 'URL da Fonte',
                'name' => 'url_fonte',
                'type' => 'text',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_55e599bf48c4d',
                            'operator' => '==',
                            'value' => 'clipping',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => 'URL',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_55e5e3fe76f67',
                'label' => 'Autor',
                'name' => 'autor',
                'type' => 'text',
                'instructions' => 'Nome do autor da notícia (pessoal ou institucional).',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_55e599bf48c4d',
                            'operator' => '==',
                            'value' => 'clipping',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => 'Autor',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_55e5e49576f68',
                'label' => 'Data de Publicação',
                'name' => 'data_de_publicacao',
                'type' => 'date_picker',
                'instructions' => 'Data de publicação da notícia na fonte',
                'required' => 1,
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_55e599bf48c4d',
                            'operator' => '==',
                            'value' => 'clipping',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'date_format' => 'yymmdd',
                'display_format' => 'dd/mm/yy',
                'first_day' => 1,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'news',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'custom_fields',
                1 => 'format',
                2 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
}

include_once('advanced-custom-fields/acf.php');

?>
