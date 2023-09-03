<?php

register_post_type('partners', array(
	'label' => 'Partners',
	'description' => '',
	'hierarchical' => false,
	'supports' => array(
		0 => 'title',
		1 => 'thumbnail',
		2 => 'custom-fields',
	),
	'taxonomies' => array(
	),
	'public' => false,
	'exclude_from_search' => true,
	'publicly_queryable' => true,
	'can_export' => true,
	'delete_with_user' => 'null',
	'labels' => array(
	),
	'menu_icon' => 'dashicons-admin-site-alt3',
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'show_in_admin_bar' => true,
	'rewrite' => true,
	'has_archive' => false,
	'show_in_rest' => true,
	'rest_base' => '',
	'rest_controller_class' => 'WP_REST_Posts_Controller',
	'acfe_archive_template' => '',
	'acfe_archive_ppp' => 0,
	'acfe_archive_orderby' => NULL,
	'acfe_archive_order' => NULL,
	'acfe_single_template' => '',
	'acfe_admin_archive' => false,
	'acfe_admin_ppp' => 10,
	'acfe_admin_orderby' => 'date',
	'acfe_admin_order' => 'DESC',
	'capability_type' => 'post',
	'capabilities' => array(
	),
	'map_meta_cap' => NULL,
	'active' => true,
));

