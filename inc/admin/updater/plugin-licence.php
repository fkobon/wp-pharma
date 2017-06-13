<?php

function wp_pharma_license_menu() {
    add_submenu_page('wp-pharma', __('License','wp_pharma'), __('License','wp_pharma'), 'manage_options', 'wp_pharma-license', 'wp_pharma_license_page' );
}
add_action('admin_menu', 'wp_pharma_license_menu', 20);

function wp_pharma_license_page() {
	$license 	= get_option( 'wp_pharma_license_key' );
	$status 	= get_option( 'wp_pharma_license_status' );

	?>

		<form class="wp_pharma-option" method="post" action="options.php">

			<h1><span class="dashicons dashicons-admin-network"></span><?php _e('Plugin License Options','wp_pharma'); ?></h1>

			<?php settings_fields('wp_pharma_license'); ?>
			<p><?php _e('The license key is used to access automatic updates and support.','wp_pharma'); ?></p>
			<p><?php _e('Trouble to activate your licence key? Do it manually by adding your website to your WP-Pharma account','wp_pharma'); ?><br><br><a href="https://www.thivinfo.com/compte" class="button" target="_blank"><?php _e('Activate manually','wp_pharma'); ?></a></p>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key','wp_pharma'); ?>
						</th>
						<td>
                            <label class="description" for="wp_pharma_license_key"><?php _e('Enter your license key','wp_pharma'); ?></label>
							<input id="wp_pharma_license_key" name="wp_pharma_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />

						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License','wp_pharma'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color: green;vertical-align: middle;margin: 0 0 0 10px;line-height: 30px;font-style: italic;font-weight: bold;"><?php _e('active'); ?></span>
									<?php wp_nonce_field( 'wp_pharma_nonce', 'wp_pharma_nonce' ); ?>
									<input id="wp_pharma-edd-license-btn" type="submit" class="button-secondary" name="wp_pharma_license_deactivate" value="<?php _e('Deactivate License','wp_pharma'); ?>"/>
									<div class="spinner"></div>
								<?php } else {
									wp_nonce_field( 'wp_pharma_nonce', 'wp_pharma_nonce' ); ?>
									<input id="wp_pharma-edd-license-btn" type="submit" class="button-secondary" name="wp_pharma_license_activate" value="<?php _e('Activate License','wp_pharma'); ?>"/>
									<div class="spinner"></div>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

		</form>
	<?php
}

function wp_pharma_register_option() {
	// creates our settings in the options table
	register_setting('wp_pharma_license', 'wp_pharma_license_key', 'wp_pharma_sanitize_license' );
}
add_action('admin_init', 'wp_pharma_register_option');

function wp_pharma_sanitize_license( $new ) {
	$old = get_option( 'wp_pharma_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'wp_pharma_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}



/************************************
* this illustrates how to activate
* a license key
*************************************/

function wp_pharma_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wp_pharma_license_activate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'wp_pharma_nonce', 'wp_pharma_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wp_pharma_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( THIVINFO_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( SHOP_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"

		update_option( 'wp_pharma_license_status', $license_data->license );

	}
}
add_action('admin_init', 'wp_pharma_activate_license');


/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function wp_pharma_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wp_pharma_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'wp_pharma_nonce', 'wp_pharma_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wp_pharma_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( THIVINFO_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( SHOP_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'wp_pharma_license_status' );

	}
}
add_action('admin_init', 'wp_pharma_deactivate_license');
