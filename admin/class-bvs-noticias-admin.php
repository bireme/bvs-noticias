<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://reddes.bvsalud.org/
 * @since      1.0.0
 *
 * @package    BVS_Noticias
 * @subpackage BVS_Noticias/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BVS_Noticias
 * @subpackage BVS_Noticias/admin
 * @author     BIREME/OPAS/OMS <bvs.technical.support@listas.bireme.br>
 */
class BVS_Noticias_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BVS_Noticias_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BVS_Noticias_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'colorpicker', plugin_dir_url( __FILE__ ) . 'css/colorpicker.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bvs-noticias-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'thickbox' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BVS_Noticias_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BVS_Noticias_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery-colorpicker', plugin_dir_url( __FILE__ ) . 'js/colorpicker.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bvs-noticias-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'thickbox' );

	}

	/**
	 * Função que registra o custom post type News
	 *
	 * @since     1.0.0
	 */
	public function register_cpt_news() {
	    $labels = array(
	        "name" => __("News", 'bvs-noticias'),
	        "singular_name" => __("News", 'bvs-noticias'),
	        "menu_name" => __("News", 'bvs-noticias'),
	        "all_items" => __("All News", 'bvs-noticias'),
	        "add_new" => __("Add News", 'bvs-noticias'),
	        "add_new_item" => __("Add New News", 'bvs-noticias'),
	        "edit" => __("Edit", 'bvs-noticias'),
	        "edit_item" => __("Edit News", 'bvs-noticias'),
	        "new_item" => __("New News", 'bvs-noticias'),
	        "view" => __("View", 'bvs-noticias'),
	        "view_item" => __("View News", 'bvs-noticias'),
	        "search_items" => __("Search News", 'bvs-noticias'),
	        "not_found" => __("No News found", 'bvs-noticias'),
	        "not_found_in_trash" => __("No News found in Trash", 'bvs-noticias'),
	        "parent" => __("Parent News", 'bvs-noticias'),
	    );

	    $args = array(
	        "labels" => $labels,
	        "description" => __("Post type for News or News Clipping", 'bvs-noticias'),
	        "public" => true,
	        "show_ui" => true,
	        "show_in_rest" => false,
	        "has_archive" => false,
	        "show_in_menu" => true,
	        "exclude_from_search" => false,
	        "capability_type" => "post",
	        "map_meta_cap" => true,
	        "hierarchical" => false,
	        "rewrite" => array( "slug" => "news", "with_front" => true ),
	        "query_var" => true,
	        "supports" => array( "title", "editor", "excerpt", "custom-fields", "comments", "revisions", "thumbnail", "author" ),       
	        "taxonomies" => array( "category", "post_tag", "language", "news-source", "news-type" )
	    );
	    register_post_type( "news", $args );

	// End of register_cpt_news()
	}

	/**
	 * Função que registra a custom taxonomy Sources
	 *
	 * @since     1.0.0
	 */
	public function register_tax_news_source() {

	    $labels = array(
	        "name" => __("Sources", 'bvs-noticias'),
	        "label" => __("Sources", 'bvs-noticias'),
	        "menu_name" => __("Sources", 'bvs-noticias'),
	        "all_items" => __("All Sources", 'bvs-noticias'),
	        "edit_item" => __("Edit Source", 'bvs-noticias'),
	        "view_item" => __("View Source", 'bvs-noticias'),
	        "update_item" => __("Update Source Name", 'bvs-noticias'),
	        "add_new_item" => __("Add New Source", 'bvs-noticias'),
	        "new_item_name" => __("New Source Name", 'bvs-noticias'),
	        "parent_item" => __("Parent Source", 'bvs-noticias'),
	        "parent_item_colon" => __("Parent Source:", 'bvs-noticias'),
	        "search_items" => __("Search Sources", 'bvs-noticias'),
	        "popular_items" => __("Popular Sources", 'bvs-noticias'),
	        "separate_items_with_commas" => __("Separate Sources with commas", 'bvs-noticias'),
	        "add_or_remove_items" => __("Add or remove Sources", 'bvs-noticias'),
	        "choose_from_most_used" => __("Choose from the most used Sources", 'bvs-noticias'),
	        "not_found" => __("No Sources found", 'bvs-noticias'),
        );

	    $args = array(
	        "labels" => $labels,
	        "hierarchical" => true,
	        "label" => __("Sources", 'bvs-noticias'),
	        "show_ui" => true,
	        "query_var" => true,
	        "rewrite" => array( 'slug' => 'news-source', 'with_front' => true ),
	        "show_admin_column" => false,
	    );
	    register_taxonomy( "news-source", array( "news" ), $args );

	// End register_tax_news_source()
	}

	/**
	 * Função que registra o custom taxonomy Types
	 *
	 * @since     1.0.0
	 */
	public function register_tax_news_type() {

	    $labels = array(
            "name" => __("News Types", 'bvs-noticias'),
            "label" => __("News Types", 'bvs-noticias'),
            "menu_name" => __("News Types", 'bvs-noticias'),
            "all_items" => __("All News Types", 'bvs-noticias'),
            "edit_item" => __("Edit News Type", 'bvs-noticias'),
            "view_item" => __("View News Type", 'bvs-noticias'),
            "update_item" => __("Update News Type Name", 'bvs-noticias'),
            "add_new_item" => __("Add New News Type", 'bvs-noticias'),
            "new_item_name" => __("New News Type Name", 'bvs-noticias'),
            "parent_item" => __("Parent News Type", 'bvs-noticias'),
            "parent_item_colon" => __("Parent News Type:", 'bvs-noticias'),
            "search_items" => __("Search News Types", 'bvs-noticias'),
            "popular_items" => __("Popular News Types", 'bvs-noticias'),
            "separate_items_with_commas" => __("Separate News Types with commas", 'bvs-noticias'),
            "add_or_remove_items" => __("Add or remove News Types", 'bvs-noticias'),
            "choose_from_most_used" => __("Choose from the most used News Types", 'bvs-noticias'),
            "not_found" => __("No News Types found", 'bvs-noticias'),
        );

	    $args = array(
	        "labels" => $labels,
	        "hierarchical" => true,
	        "label" => __("News Types", 'bvs-noticias'),
	        "show_ui" => true,
	        "query_var" => true,
	        "rewrite" => array( 'slug' => 'news-type', 'with_front' => true ),
	        "show_admin_column" => false,
	    );
	    register_taxonomy( "news-type", array( "news" ), $args );

	// End register_tax_news_type()
	}

}
