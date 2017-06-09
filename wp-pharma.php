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


add_action( 'plugins_loaded', 'wp_pharma_load_textdomain');
function wp_pharma_load_textdomain() {
	load_plugin_textdomain( 'wp-pharma', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}