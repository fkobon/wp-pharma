<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}


/**
 * Handle role in WP-Pharma
 */

/**
 * create patient role
 */

add_action('admin_init', 'wp_pharma_add_patient_role');
function wp_pharma_add_patient_role(){

	// uncomment to remove role
	/*	if( get_role('patient') ){
			remove_role( 'patient' );
	}
	*/
		if ( ! get_role( 'patient' ) ) {
			add_role( 'patient', 'Patient', array( 'read' => true, 'level_0' => true ) );
		}

		$roles = get_editable_roles();
		$role = get_role( 'patient' );
		if ( $roles['patient'] ) {
			$role->add_cap( 'edit_ordo' );
			$role->add_cap( 'edit_ordos' );
			$role->add_cap( 'read_ordo' );
			$role->add_cap( 'read' );
			$role->add_cap( 'create_ordos' );
			$role->add_cap( 'edit_published_ordos' );
			$role->add_cap( 'publish_ordos' );

		}


	$role = get_role( 'administrator' );
	if ( $role ) {
		$role->add_cap( 'edit_ordo' );
		$role->add_cap( 'edit_ordos' );
		$role->add_cap( 'read_ordo' );
		$role->add_cap( 'read' );
		$role->add_cap( 'create_ordos' );
		$role->add_cap( 'edit_published_ordos' );
		$role->add_cap( 'publish_ordos' );

	}


}