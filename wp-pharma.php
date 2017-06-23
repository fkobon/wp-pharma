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
	require_once WP_PHARMA_PATH . 'inc/shortcode.php';
	require_once WP_PHARMA_PATH . 'inc/functions.php';
	require_once WP_PHARMA_PATH . 'inc/role.php';
	require_once WP_PHARMA_PATH . 'inc/display_list.php';
	require_once WP_PHARMA_PATH . 'inc/display_form.php';
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
register_activation_hook( __FILE__, 'wp_pharma_install' );
function wp_pharma_install(){

	if ( ! empty(get_option('customer_area_id')) ) {
		$customer = array(
			'post_title'   => __( 'Customer Area', 'wp_pharma' ),
			'post_content' => '[customer_area]',
			'post_status'  => 'publish'
		);
		$id       = wp_insert_post( $customer );
		update_option( 'customer_area_id', $id );
	}
}



add_action('wp_enqueue_scripts', 'wp_pharma_load_style');
function wp_pharma_load_style(){
	wp_enqueue_style('wp_pharma', WP_PHARMA_URL .'assets/css/style.css');
}

add_action('init', 'acf_form_head');


/**
 * Block access to non author of the ordo.
 */

add_action( 'template_redirect', 'wp_pharma_redirect_post' );
function wp_pharma_redirect_post() {
	global $post;
	$queried_post_type = get_post_type();
	$author = $post->post_author;
	$current = get_current_user_id();
	//var_dump($current);
	if ( is_single() && 'wp_pharma_ordo' ==  $queried_post_type && $author != $current ) {
		wp_redirect( home_url(), 301 );
		exit;
	}
}

/**
 * Fired on deactivation:
 * - Remove Custom Role "Patient"
 */
register_deactivation_hook(__FILE__, 'wp_pharma_deactivation');
function wp_pharma_deactivation(){
	/**
	 * Remove Custom Role "Patient"
	 */

	if( get_role('patient') ){
		$users = get_users(
			array(
				'role' => 'patient',
			)
		);

		/**
		 * update user with subscriber role
		 */

		foreach ($users as $user){
			wp_update_user(array('ID' => $user->data->ID, 'role' => 'subscriber'));
		}

		//var_dump($users); die;
		remove_role( 'patient' );
	}

	/**
	 * On deactivaton page is deleted
	 */

		$id = get_option('customer_area_id');
		wp_delete_post($id);
		delete_option('customer_area_id');
}