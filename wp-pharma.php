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
define( 'WP_PHARMA_PATH', plugin_dir_path( __FILE__ ) );

// Load Languages
add_action( 'plugins_loaded', 'wp_pharma_load_textdomain');
function wp_pharma_load_textdomain() {
	load_plugin_textdomain( 'wp-pharma', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Includes Files
add_action('plugins_loaded','wp_pharma_load_files', 999);
function wp_pharma_load_files(){
	require_once WP_PHARMA_PATH . 'inc/cpt-ordo.php';
	require_once WP_PHARMA_PATH . 'inc/acf-fields.php';
}

/**
 * Load ACF PRO
 */

add_filter('acf/settings/path', 'wp_pharma_acf_settings_path');

function wp_pharma_acf_settings_path( $path ) {

	// update path
	$path = WP_PHARMA_PATH . '/inc/acf/';

	// return
	return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'wp_pharma_acf_settings_dir');

function wp_pharma_acf_settings_dir( $dir ) {

	// update path
	$dir = WP_PHARMA_URL . 'inc/acf/';

	// return
	return $dir;

}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF

add_action('plugins_loaded', 'wp_pharma_load_acf');
function wp_pharma_load_acf() {
	include_once( WP_PHARMA_PATH . 'inc/acf/acf.php' );
}