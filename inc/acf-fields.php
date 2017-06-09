<?php

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
				'key' => 'field_593ad1a694a3d',
				'label' => __('Renew','wp-pharma'),
				'name' => 'wp_pharma_renew',
				'type' => 'true_false',
				'instructions' => __('','wp-pharma'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
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