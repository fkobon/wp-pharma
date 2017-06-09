<?php
if ( ! function_exists('wp_pharma_ordonnance') ) {

// Register Custom Post Type
	function wp_pharma_ordonnance() {

		$labels = array(
			'name'                  => _x( 'Pharmacy prescriptions', 'Post Type General Name', 'wp-pharma' ),
			'singular_name'         => _x( 'Pharmacy prescription', 'Post Type Singular Name', 'wp-pharma' ),
			'menu_name'             => __( 'Pharmacy prescriptions', 'wp-pharma' ),
			'name_admin_bar'        => __( 'Pharmacy prescriptions', 'wp-pharma' ),
			'archives'              => __( 'Pharmacy prescriptions Archives', 'wp-pharma' ),
			'attributes'            => __( 'Pharmacy prescription Attributes', 'wp-pharma' ),
			'parent_item_colon'     => __( 'Parent Pharmacy prescription:', 'wp-pharma' ),
			'all_items'             => __( 'All Pharmacy prescriptions', 'wp-pharma' ),
			'add_new_item'          => __( 'Add New Pharmacy prescription', 'wp-pharma' ),
			'add_new'               => __( 'Add Pharmacy prescription', 'wp-pharma' ),
			'new_item'              => __( 'New Pharmacy prescription', 'wp-pharma' ),
			'edit_item'             => __( 'Edit Pharmacy prescription', 'wp-pharma' ),
			'update_item'           => __( 'Update Pharmacy prescription', 'wp-pharma' ),
			'view_item'             => __( 'View Pharmacy prescription', 'wp-pharma' ),
			'view_items'            => __( 'View Pharmacy prescription', 'wp-pharma' ),
			'search_items'          => __( 'Search Pharmacy prescription', 'wp-pharma' ),
			'not_found'             => __( 'Not found', 'wp-pharma' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-pharma' ),
			'featured_image'        => __( 'Featured Image', 'wp-pharma' ),
			'set_featured_image'    => __( 'Set featured image', 'wp-pharma' ),
			'remove_featured_image' => __( 'Remove featured image', 'wp-pharma' ),
			'use_featured_image'    => __( 'Use as featured image', 'wp-pharma' ),
			'insert_into_item'      => __( 'Insert into Pharmacy prescription', 'wp-pharma' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Pharmacy prescription', 'wp-pharma' ),
			'items_list'            => __( 'Pharmacy prescriptions list', 'wp-pharma' ),
			'items_list_navigation' => __( 'Pharmacy prescriptions list navigation', 'wp-pharma' ),
			'filter_items_list'     => __( 'Filter Pharmacy prescriptions list', 'wp-pharma' ),
		);
		$args = array(
			'label'                 => __( 'Pharmacy prescription', 'wp-pharma' ),
			'description'           => __( 'Pharmacy prescription', 'wp-pharma' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'wp_pharma_ordo', $args );

	}
	add_action( 'init', 'wp_pharma_ordonnance', 0 );

}