<?php
function ech_setup() {

    add_theme_support( 'title-tag' );   
    add_theme_support( 'post-thumbnails' );
    add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'enterprise-content-hub' ),
			'footer'  => __( 'Footer Menu', 'enterprise-content-hub' ),
		)
	);
}

/**
 * Save ACF field groups as local JSON inside the theme.
 */
add_action( 'after_setup_theme', 'ech_setup' );

function ech_acf_json_save_path( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'ech_acf_json_save_path' );

function ech_acf_json_load_paths( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'ech_acf_json_load_paths' );