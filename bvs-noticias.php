<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://reddes.bvsalud.org/
 * @since             1.0.0
 * @package           BVS_Noticias
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin BVS Notícias
 * Plugin URI:        https://github.com/bireme/bvs-noticias
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            BIREME/OPAS/OMS
 * Author URI:        http://reddes.bvsalud.org/
 * License:           LGPL
 * License URI:       http://www.gnu.org/licenses/lgpl.html
 * Text Domain:       bvs-noticias
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bvs-noticias-activator.php
 */
function activate_bvs_noticias() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bvs-noticias-activator.php';
	BVS_Noticias_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bvs-noticias-deactivator.php
 */
function deactivate_bvs_noticias() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bvs-noticias-deactivator.php';
	BVS_Noticias_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bvs_noticias' );
register_deactivation_hook( __FILE__, 'deactivate_bvs_noticias' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bvs-noticias.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bvs_noticias() {

	$plugin = new BVS_Noticias();
	$plugin->run();

}
run_bvs_noticias();
