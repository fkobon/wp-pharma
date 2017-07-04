<?php

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array (
		'key' => 'group_593ad0fa39369',
		'title' => 'WP-Pharma',
		'fields' => array (
			array (
				'key' => 'field_593ad12394a3b',
				'label' => __('Initial Date', 'wp-pharma'),
				'name' => 'wp_pharma_initial_date',
				'type' => 'date_picker',
				'instructions' => __('','wp-pharma'),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 1,
			),
			array (
				'key' => 'field_5948b0c550de9',
				'label' => __('Description', 'wp-pharma'),
				'name' => 'wp_pharma_desc',
				'type' => 'wysiwyg',
				'instructions' => __('Add here more info for the pharmacist','wp-pharma'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'visual',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
			),
			array (
				'key' => 'field_593ad14e94a3c',
				'label' => __('File','wp-pharma'),
				'name' => 'wp_pharma_file',
				'type' => 'file',
				'instructions' => __('','wp-pharma'),
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'uploadedTo',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => 'jpg, jpeg, pdf',
			),
			array (
				'key' => 'field_59509f832bc0a',
				'label' => __('Is it a renew?','wp-pharma'),
				'name' => 'wp_pharma_renew',
				'type' => 'radio',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					0 => __('No','wp-pharma'),
					1 => __('Yes','wp-pharma'),
				),
				'allow_null' => 1,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wp_pharma_ordo',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;