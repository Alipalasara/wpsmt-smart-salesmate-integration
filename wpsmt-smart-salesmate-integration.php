<?php
/**
 * Plugin Name:       WPSMT Smart Salesmate Integration
 * Plugin URI:        https://profiles.wordpress.org/iqbal1486/
 * Description:       WP Smart Salesmate help you to manage and synch possible WordPress data like customers, orders, products to the Salesmate modules as per your settings options.
 * Version:           2.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Geekerhub
 * Author URI:        https://profiles.wordpress.org/iqbal1486/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpsmt-smart-salesmate
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'restricted access' );
}

define( 'WPSMT_VERSION', '1.0.0' );

if (! defined('WPSMT_ADMIN_URL') ) {
    define('WPSMT_ADMIN_URL', get_admin_url());
}

if (! defined('WPSMT_PLUGIN_FILE') ) {
    define('WPSMT_PLUGIN_FILE', __FILE__);
}

if (! defined('WPSMT_PLUGIN_PATH') ) {
    define('WPSMT_PLUGIN_PATH', plugin_dir_path(WPSMT_PLUGIN_FILE));
}

if (! defined('WPSMT_PLUGIN_URL') ) {
    define('WPSMT_PLUGIN_URL', plugin_dir_url(WPSMT_PLUGIN_FILE));
}

if (! defined('WPSMT_REDIRECT_URI') ) {
    define('WPSMT_REDIRECT_URI', admin_url( 'admin.php?page=wpsmt_smart_salesmate_process' ));
}

if (! defined('WPSMT_SETTINGS_URI') ) {
    define('WPSMT_SETTINGS_URI', admin_url( 'admin.php?page=wpsmt-smart-salesmate-integration' ));
}

if (! defined('WPSMT_SALESMATEAPIS_URL') ) {
    define('WPSMT_SALESMATEAPIS_URL', 'https://api.salesmate.com');
}

function wpsmt_smart_salesmate_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.activator.php';
	$WPSMT_Smart_Salesmate_Activator = new WPSMT_Smart_Salesmate_Activator();
    $WPSMT_Smart_Salesmate_Activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpsmt-smart-salesmate-deactivator.php
 */
function wpsmt_smart_salesmate_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.deactivator.php';
    WPSMT_Smart_Salesmate_Deactivator::deactivate();
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpsmt-smart-salesmate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function wpsmt_smart_salesmate_run() {
    $plugin = new WPSMT_Smart_Salesmate();
	$plugin->run();
}

register_activation_hook( __FILE__, 'wpsmt_smart_salesmate_activate' );
register_deactivation_hook( __FILE__, 'wpsmt_smart_salesmate_deactivate' );

wpsmt_smart_salesmate_run();

function wpsmt_smart_salesmate_textdomain_init() {
    load_plugin_textdomain( 'wpsmt-smart-salesmate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'wpsmt_smart_salesmate_textdomain_init');
?>