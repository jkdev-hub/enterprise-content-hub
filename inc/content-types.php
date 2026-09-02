<?php
/**
 * Register custom post types and taxonomies.
 *
 * @package Enterprise_Content_Hub
 */

/**
 * Register Resource post type.
 */
function ech_register_resource_post_type() {

	$labels = array(
		'name'                  => __( 'Resources', 'enterprise-content-hub' ),
		'singular_name'         => __( 'Resource', 'enterprise-content-hub' ),
		'menu_name'             => __( 'Resources', 'enterprise-content-hub' ),
		'name_admin_bar'        => __( 'Resource', 'enterprise-content-hub' ),
		'add_new'               => __( 'Add New', 'enterprise-content-hub' ),
		'add_new_item'          => __( 'Add New Resource', 'enterprise-content-hub' ),
		'new_item'              => __( 'New Resource', 'enterprise-content-hub' ),
		'edit_item'             => __( 'Edit Resource', 'enterprise-content-hub' ),
		'view_item'             => __( 'View Resource', 'enterprise-content-hub' ),
		'all_items'             => __( 'All Resources', 'enterprise-content-hub' ),
		'search_items'          => __( 'Search Resources', 'enterprise-content-hub' ),
		'not_found'             => __( 'No resources found.', 'enterprise-content-hub' ),
		'not_found_in_trash'    => __( 'No resources found in Trash.', 'enterprise-content-hub' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-media-document',
		'supports'           => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'author',
		),
		'has_archive'        => true,
		'rewrite'            => array(
			'slug' => 'resources',
		),
	);

	register_post_type( 'resource', $args );
}

add_action( 'init', 'ech_register_resource_post_type' );

/**
 * Register Resource taxonomies.
 */
function ech_register_resource_taxonomies() {

	/**
	 * Resource Topics.
	 */
	$topic_labels = array(
		'name'          => __( 'Topics', 'enterprise-content-hub' ),
		'singular_name' => __( 'Topic', 'enterprise-content-hub' ),
		'search_items'  => __( 'Search Topics', 'enterprise-content-hub' ),
		'all_items'     => __( 'All Topics', 'enterprise-content-hub' ),
		'edit_item'     => __( 'Edit Topic', 'enterprise-content-hub' ),
		'update_item'   => __( 'Update Topic', 'enterprise-content-hub' ),
		'add_new_item'  => __( 'Add New Topic', 'enterprise-content-hub' ),
		'new_item_name' => __( 'New Topic Name', 'enterprise-content-hub' ),
		'menu_name'     => __( 'Topics', 'enterprise-content-hub' ),
	);

	$topic_args = array(
		'labels'       => $topic_labels,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'rewrite'      => array(
			'slug' => 'resource-topic',
		),
	);

	register_taxonomy(
		'resource_topic',
		array( 'resource' ),
		$topic_args
	);

	/**
	 * Resource Types.
	 */
	$type_labels = array(
		'name'          => __( 'Resource Types', 'enterprise-content-hub' ),
		'singular_name' => __( 'Resource Type', 'enterprise-content-hub' ),
		'search_items'  => __( 'Search Resource Types', 'enterprise-content-hub' ),
		'all_items'     => __( 'All Resource Types', 'enterprise-content-hub' ),
		'edit_item'     => __( 'Edit Resource Type', 'enterprise-content-hub' ),
		'update_item'   => __( 'Update Resource Type', 'enterprise-content-hub' ),
		'add_new_item'  => __( 'Add New Resource Type', 'enterprise-content-hub' ),
		'new_item_name' => __( 'New Resource Type Name', 'enterprise-content-hub' ),
		'menu_name'     => __( 'Resource Types', 'enterprise-content-hub' ),
	);

	$type_args = array(
		'labels'       => $type_labels,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'rewrite'      => array(
			'slug' => 'resource-type',
		),
	);

	register_taxonomy(
		'resource_type',
		array( 'resource' ),
		$type_args
	);
}

add_action( 'init', 'ech_register_resource_taxonomies' );