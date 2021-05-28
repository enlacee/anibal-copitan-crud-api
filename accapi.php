<?php

/**
 * WordPress plugin generator by Anibal Copitan
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://anibalcopitan.com
 * @since             1.0.0
 * @package            accapi
 *
 * @wordpress-plugin
 * Plugin Name:       Anibal Copitan Crud Api
 * Plugin URI:        http://anibalcopitan.com
 * Description:       Plugin create by Anibal Copitan
 * Version:           1.0.0
 * Author:            Anibal Copitan
 * Author URI:        http://anibalcopitan.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       accapi
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'ACCAPI_FILE' ) ) {
	define( 'ACCAPI_FILE', __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-accapi-activator.php
 * @param Boolean $networkwide status multisite
 * @return Void
 */
function activate_accapi($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-accapi-activator.php';
	 accapiActivator::activate($networkwide);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-accapi-deactivator.php
 * @param Boolean $networkwide status multisite
 * @return Void
 */
function deactivate_accapi($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-accapi-deactivator.php';
	 accapiDeactivator::deactivate($networkwide);
}

register_activation_hook( __FILE__, 'activate_accapi' );
register_deactivation_hook( __FILE__, 'deactivate_accapi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/libraries/class-accapi-gulpfile.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-accapi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_accapi() {

	$plugin = new  accapi();
	$plugin->run();

}
run_accapi();


/*
* Usefull functions prefix: an = anbNews
*/
function accapi_get_file_path()
{
	return __FILE__;
}
