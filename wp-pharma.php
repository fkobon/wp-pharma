<?php
/*
Plugin Name: WP-Pharma
Plugin URI: To Be Customized
Description: To Be Customized
Version: 0.1.0
Author: Sébastien SERRE
Author URI: http://www.thivinfo.com
Text Domain: wp-pharma
Domain Path: /languages
 */

// Plugin constants
define( 'WP_PHARMA_VERSION', '0.1.0' );
define( 'WP_PHARMA_FOLDER', 'wp-pharma' );
define( 'WP_PHARMA_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_PHARMA_DIR', plugin_dir_path( __FILE__ ) );

// Load Languages
add_action( 'plugins_loaded', 'wp_pharma_load_textdomain');
function wp_pharma_load_textdomain() {
	load_plugin_textdomain( 'wp-pharma', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

