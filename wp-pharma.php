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
define( 'THIVINFO_ITEM_NAME', 'WP-Pharma' );
define( 'SHOP_URL','https://wp-pharma.com' );
define( 'WP_PHARMA_AUTHOR', 'wp-pharma.com' );

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
	require_once WP_PHARMA_PATH . 'inc/admin/settings.php';
	require_once WP_PHARMA_PATH . 'inc/admin/updater/plugin-licence.php';
	require_once WP_PHARMA_PATH . 'inc/admin/updater/plugin-updater.php';
}

/**
 * Load ACF PRO
 */

add_filter('acf/settings/path', 'wp_pharma_acf_settings_path');

function wp_pharma_acf_settings_path( $path ) {

	// update path
	$path = WP_PHARMA_PATH . '/3rd-party/acf/';

	// return
	return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'wp_pharma_acf_settings_dir');

function wp_pharma_acf_settings_dir( $dir ) {

	// update path
	$dir = WP_PHARMA_URL . '/3rd-party/acf/';

	// return
	return $dir;

}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF

add_action('plugins_loaded', 'wp_pharma_load_acf');
function wp_pharma_load_acf() {
	include_once( WP_PHARMA_PATH . '3rd-party/acf/acf.php' );
}

/**
 * Load the theme textdomain
 *
 * @author Maxime CULEA
 * @url https://gist.github.com/MaximeCulea/94fef4ad5ba9338e2586f185e8b6a354
 * https://www.advancedcustomfields.com/resources/acf-settings/
 */

function mc_load_theme_textdomain() {
	load_theme_textdomain( 'wp-pharma', WP_PHARMA_PATH . '/languages' );
}
add_filter( 'acf/settings/l10n_textdomain', 'mc_load_theme_textdomain' );

/**
 * Search for update
 */
add_action('admin_init', 'wp_pharma_Updater', 0);
function wp_pharma_Updater() {

	// retrieve our license key from the DB
	$license_key = trim(get_option('gestsup_pro_license_key'));
	//var_dump($license_key);

	// setup the updater
	$edd_updater = new wp_pharma_Updater(SHOP_URL, __FILE__, array(
			'version'   => WP_PHARMA_VERSION,
			'license'   => $license_key,
			'item_name' => THIVINFO_ITEM_NAME,
			'author'    => WP_PHARMA_AUTHOR
		)
	);
	//var_dump($edd_updater);
}

/**
 * On activation, creating a custom area page
 */

function wp_pharma_install(){

}