<?php
/**
 * Main file for WordPress.
 *
 * @wordpress-plugin
 * Plugin Name: 	XDC Datachain Gateway
 * Plugin URI:		https://www.datachain.one/
 * Description: 	XDC Datachain Gateway for Woocommerce.
 * Author:          Datachain
 * Version: 		1.0.0
 * Text Domain:		xdc-datachain-gateway
 * Domain Path:		/languages
 */

defined('ABSPATH') or die( 'No script kiddies please!' ); // Avoid direct file request

/**
 * Plugin constants. This file is procedural coding style for initialization of
 * the plugin core and definition of plugin configuration.
 */
if (defined('XDG_PATH')) {
    return;
}
define('XDG_FILE', __FILE__);
define('XDG_PATH', dirname(XDG_FILE));
define('XDG_ROOT_SLUG', 'tatum');
define('XDG_SLUG', basename(XDG_PATH));
define('XDG_INC', trailingslashit(path_join(XDG_PATH, 'inc')));
define('XDG_MIN_PHP', '7.0.0'); // Minimum of PHP 5.3 required for autoloading and namespacing
define('XDG_MIN_WP', '5.2.0'); // Minimum of WordPress 5.0 required
define('XDG_NS', 'Datachin\\XdcDatachainGateway');
define('XDG_DB_PREFIX', 'xdg'); // The table name prefix wp_{prefix}
define('XDG_OPT_PREFIX', 'xdg'); // The option name prefix in wp_options
define('XDG_SLUG_CAMELCASE', lcfirst(str_replace('-', '', ucwords(XDG_SLUG, '-'))));
//define('XDG_TD', ''); This constant is defined in the core class. Use this constant in all your __() methods
//define('XDG_VERSION', ''); This constant is defined in the core class
//define('XDG_DEBUG', true); This constant should be defined in wp-config.php to enable the Base#debug() method

// Check PHP Version and print notice if minimum not reached, otherwise start the plugin core
require_once XDG_INC .
    'base/others/' .
    (version_compare(phpversion(), XDG_MIN_PHP, '>=') ? 'start.php' : 'fallback-php-version.php');
require_once XDG_INC .'XdcDatachainGateway.php';