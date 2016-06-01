<?php

/**
 * Função que registra todos os custom fields do plugin BVS Notícias.
 *
 * @link       http://reddes.bvsalud.org/
 * @since      1.0.0
 *
 * @package    BVS_Noticias
 * @subpackage BVS_Noticias/includes
 */

/**
 * Função que registra todos os custom fields do plugin BVS Notícias.
 *
 * Registra todos os grupos de custom fields associados aos
 * custom post types específicos do plugin BVS Notícias.
 *
 * @package    BVS_Noticias
 * @subpackage BVS_Noticias/includes
 * @author     BIREME/OPAS/OMS <bvs.technical.support@listas.bireme.br>
 */
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_news-clipping',
        'title' => 'News Clipping',
        'fields' => array (
            array (
                'key' => 'field_55e599bf48c4d',
                'label' => __('News Type', 'bvs-events-calendar'),
                'name' => 'news_type',
                'type' => 'radio',
                'instructions' => __('Select type (News or Clipping)', 'bvs-events-calendar'),
                'required' => 1,
                'choices' => array (
                    'news' => __('Original news', 'bvs-events-calendar'),
                    'clipping' => __('News clipping', 'bvs-events-calendar'),
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_55e59fb8e87a0',
                'label' => __('News Source', 'bvs-events-calendar'),
                'name' => 'news_source',
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
                'label' => __('Source URL', 'bvs-events-calendar'),
                'name' => 'source_url',
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
                'placeholder' => __('URL', 'bvs-events-calendar'),
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_55e5e3fe76f67',
                'label' => __('Author', 'bvs-events-calendar'),
                'name' => 'author',
                'type' => 'text',
                'instructions' => __('News author name (personal or institutional)', 'bvs-events-calendar'),
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
                'placeholder' => __('Author', 'bvs-events-calendar'),
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_55e5e49576f68',
                'label' => __('Publish Date', 'bvs-events-calendar'),
                'name' => 'publish_date',
                'type' => 'date_picker',
                'instructions' => __('News publish date at the source', 'bvs-events-calendar'),
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