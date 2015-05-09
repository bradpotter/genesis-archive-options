<?php namespace Genesis_Archive_Options;

/**
 * Genesis Archive Options
 *
 * @package           Genesis_Archive_Options
 * @author            Brad Potter
 * @license           GPL-2.0+
 * @link              http://www.bradpotter.com/plugins/genesis-archive-options
 * @copyright         Copyright (c) 2015, Brad Potter
 *
 * @wordpress-plugin
 * Plugin Name:       Genesis Archive Options
 * Plugin URI:        https://github.com/bradpotter/genesis-archive-options
 * Description:       Adds additional archive options to the Genesis Framework.
 * Version:           0.9.0
 * Author:            Brad Potter
 * Author URI:        http://www.bradpotter.com
 * Text Domain:       genesis-archive-options
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/bradpotter/genesis-archive-options
 * GitHub Branch:     master
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Set constants
 */
define( 'GAO_PLUGIN_DIR', trailingslashit( dirname( __FILE__ ) ) );
define( 'GAO_URL' , WP_PLUGIN_URL . '/' . str_replace( basename( __FILE__ ), "" , plugin_basename( __FILE__ ) ) );

add_action( 'genesis_init', __NAMESPACE__ . '\\init_admin', 99 );
/**
 * Required files
 */
function init_admin() {
	
	if ( is_admin() ) {
		require( GAO_PLUGIN_DIR. 'lib/admin/admin.php' );
	}
}

/**
 * Required files
 */
require( GAO_PLUGIN_DIR . 'lib/archive.php' );
