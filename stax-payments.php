<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Stax Payments
 *
 * @package           Stax
 * @author            Stax Payments
 * @copyright         2024 Fattmerchant, Inc
 * @license           LGPL-2.1-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Stax Payments
 * Description:       Take credit card payments on your Wordpress site using Stax payments.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Tested up to:      6.1
 * Author:            Stax Payments
 * Author URI:        https://staxpayments.com/
 * Text Domain:       stax-payments
 * License:           LGPL v2.1 or later
 * License URI:       http://www.gnu.org/licenses/lgpl-2.1.txt
 */

/**
 * Configure
 */
define('STAX_ASSET_VERSION', '0.0.1');
define('STAX_BASE_NAME', basename( dirname( __FILE__ ) ) );
define('STAX_BASE_FILEPATH', __FILE__ );
define('STAX_BASE_FILENAME', plugin_basename( __FILE__ ) );
define('STAX_PATH', plugin_dir_path(__FILE__)); // Plugin directory absolute path with the trailing slash. Useful for using with includes eg - /var/www/html/wp-content/plugins/stax-payments/
define('STAX_URL', plugin_dir_url(__FILE__)); // URL to the plugin folder with the trailing slash. Useful for referencing src eg - http://localhost/wp/wp-content/plugins/stax-payments/

/**
 * Load files.
 */
require_once STAX_PATH . 'functions/enqueues.php';
require_once STAX_PATH . 'functions/rest.php';
require_once STAX_PATH . 'functions/settings.php';
require_once STAX_PATH . 'functions/icons.php';
require_once STAX_PATH . 'functions/shortcode.php';

/**
 * Gutenberg Editor.
 */
require_once STAX_PATH . 'gutenberg-block/stax-payments-button.php';

/**
 * Run
 */
stax_init();

function stax_init(): void
{
  // add settings page
  add_action('admin_menu', 'stax_add_settings_page');

  // add link to settings page in plugin row
  add_filter( 'plugin_action_links_' . STAX_BASE_FILENAME, function( $actions ) {
    $url = add_query_arg(
			array(
				'page' => 'stax-payments-settings',
			),
			admin_url( 'options-general.php' )
		);

		$actions = array_merge(
			array(
				'welcome' => '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'stax-payments' ) . '</a>',
			),
			$actions
		);

		return $actions;
  } );
}
