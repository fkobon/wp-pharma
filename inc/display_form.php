<?php
/**
 * Created by PhpStorm.
 * User: sebastien
 * Date: 23/06/17
 * Time: 07:21
 */

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

function wp_pharma_display_form() {
	if ( ! empty( $_GET['id'] ) && $_GET['id'] == 'upload' ) { ?>
		<div class="content-customer-area">
		<?php acf_form( array(
			'post_id'         => 'new_post',
			'post_title'      => true,
			'new_post'        => array(
				'post_type'   => 'wp_pharma_ordo',
				'post_status' => 'publish',
			),
			'submit_value'    => __( 'Add a prescription', 'wp_pharma' ),
			'updated_message' => '<div class="updated_message"><p>'.  __('Presciption well received', 'wp_pharma') .'</p></div>',
			'honeypot'        => true,
		) );
	}
}

function wp_pharma_prepare_title( $title ) {
	// override value
	$date = get_field('wp_pharma_initial_date');
	$title = $title . '-' . $date;

	return $title;

}
add_filter('the_title', 'wp_pharma_prepare_title');